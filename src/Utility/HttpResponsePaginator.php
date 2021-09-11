<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpResponsePaginator.
 *
 * @phpstan-implements \Iterator<int,mixed>
 */
final class HttpResponsePaginator implements \Countable, \Iterator
{
    /**
     * These endpoints support checkpoint-based pagination (from, take). A 'next' value will be present in responses if more results are available.
     */
    private const SUPPORTED_ENDPOINTS_WITH_CHECKPOINT = [
        '/api/v2/logs',
        '/api/v2/organizations',
        '^\/api\/v2\/organizations\/(.*)\/members$',
        '^\/api\/v2\/roles\/(.*)\/users$',
    ];

    /**
     * An instance of the current HttpClient to use for network requests.
     */
    private HttpClient $httpClient;

    /**
     * The current position in use by the Iterator, for tracking our index while looping.
     */
    private int $position = 0;

    /**
     * The 'limit' value returned with the last network response.
     */
    private int $requestLimit = 0;

    /**
     * The 'total' value returned with the last network response.
     */
    private int $requestTotal = 0;

    /**
     * A counter for tracking the number of network requests made for pagination. Does not include any initial network request involved in passing seed data to the class constructor.
     */
    private int $requestCount = 0;

    /**
     * A cache of the paginated results. Appended to when new responses are retrieved from the network.
     *
     * @var array<int,array>
     */
    private array $results = [];

    /**
     * Whether the requested endpoint we're paginated supports checkpoint-based pagination.
     */
    private bool $usingCheckpointPagination = false;

    /**
     * The 'next' value pulled from checkpoint-paginated results to indicate next page query id.
     */
    private ?string $nextCheckpoint = null;

    /**
     * HttpResponsePaginator constructor.
     *
     * @param HttpClient $httpClient An instance of HttpClient to use for paginated network requests.
     *
     * @throws \Auth0\SDK\Exception\PaginatorException When an unsupported request type is provided.
     */
    public function __construct(
        HttpClient $httpClient
    ) {
        $this->httpClient = $httpClient;
        $lastRequest = $this->lastRequest();
        $lastResponse = $this->lastResponse();

        // Did the network request return a successful response?
        if ($lastResponse === null || ! HttpResponse::wasSuccessful($lastResponse)) {
            throw \Auth0\SDK\Exception\PaginatorException::httpBadResponse();
        }

        // Was the last request a GET request?
        if ($lastRequest === null || mb_strtolower($lastRequest->getMethod()) !== 'get') {
            throw \Auth0\SDK\Exception\PaginatorException::httpMethodUnsupported();
        }

        // Get the last request path.
        $requestPath = mb_strtolower($lastRequest->getUri()->getPath());

        // Get the last request query to check for checkpoint pagination params.
        $requestQuery = '&' . $lastRequest->getUri()->getQuery();

        if (mb_strpos($requestQuery, '&take=') !== false || mb_strpos($requestQuery, '&from=') !== false) {
            $endpointSupported = false;

            // Iterate through SUPPORTED_ENDPOINTS to check if this endpoint will work for pagination.
            foreach (self::SUPPORTED_ENDPOINTS_WITH_CHECKPOINT as $endpoint) {
                // Try a plain text match first:
                if ($endpoint === $requestPath) {
                    // Match! Break out of loop and give this paginator a green light for processing.
                    $endpointSupported = true;
                    break;
                }

                // Perform regex matches where appropriate:
                if (mb_substr($endpoint, 0, 1) === '^' && preg_match('/' . $endpoint . '/', $requestPath) === 1) {
                    // Match! Break out of loop and give this paginator a green light for processing.
                    $endpointSupported = true;
                    break;
                }
            }

            // The provided endpoint is not supported for checkpoint-based pagination; throw an error.
            if (! $endpointSupported) {
                throw \Auth0\SDK\Exception\PaginatorException::httpEndpointUnsupportedCheckpoints($requestPath);
            }

            $this->usingCheckpointPagination = true;
        }

        $this->processLastResponse();
    }

    /**
     * Return the total number of network requests made for this paginator instance.
     */
    public function countNetworkRequests(): int
    {
        return $this->requestCount;
    }

    /**
     * Return the total number of results available, according to the API.
     */
    public function count(): int
    {
        if ($this->usingCheckpointPagination) {
            throw \Auth0\SDK\Exception\PaginatorException::httpCheckpointCannotBeCounted();
        }

        return $this->requestTotal;
    }

    /**
     * Return the current result at our position, if available.
     *
     * @return mixed
     *
     * @psalm-suppress InvalidAttribute
     *
     * @codeCoverageIgnore
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
        if ($this->valid()) {
            return $this->result() ?? false;
        }

        return false;
    }

    /**
     * Retrieve the current position, if valid.
     */
    public function key(): int
    {
        return $this->valid() ? $this->position : 0;
    }

    /**
     * Increase our position cursor.
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * Return true if a result is available. If a result is not immediately available (cached) but the current position is less than the API-reported total results, a paginated network request will be attempted to get the next results. Returns false when no results are available at the current position.
     */
    public function valid(): bool
    {
        // A cached result is available.
        if ($this->result() !== null) {
            return true;
        }

        // When using checkpoint-based pagination, we don't have a 'total' API response to work with.
        if ($this->usingCheckpointPagination) {
            // If we have a next checkpoint to query, do that.
            if ($this->nextCheckpoint !== null) {
                return $this->getNextResults();
            }

            // Otherwise, no more results.
            return false;
        }

        // No cached result available; is our position beyond the API's reported total?
        if ($this->position < $this->requestTotal) {
            // No, there should be more results available for request. Do that.
            return $this->getNextResults();
        }

        return false;
    }

    /**
     * Reset position to 0.
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * Return the current result at our position, if available.
     *
     * @return array<mixed>|null
     */
    private function result()
    {
        return $this->results[$this->position] ?? null;
    }

    /**
     * Make a network request for the next page of results.
     */
    private function getNextResults(): bool
    {
        // Retrieve the active HttpRequest instance to repeat the request.
        $lastBuilder = $this->lastBuilder();

        if ($lastBuilder !== null && $this->lastResponse() !== null) {
            // Ensure basic pagination details are included in the request.
            if ($this->usingCheckpointPagination) {
                // @codeCoverageIgnoreStart
                if ($this->nextCheckpoint === null) {
                    return false;
                }
                // @codeCoverageIgnoreEnd

                $lastBuilder->withParam('from', $this->nextCheckpoint);
            } else {
                // Get the next page.
                $page = intval(ceil($this->position / $this->requestLimit));

                // Set the next page.
                $lastBuilder->withParam('page', $page);
            }

            // Increment our network request tracker for reference.
            ++$this->requestCount;

            // Issue next paged request.
            try {
                $lastBuilder->call();
            } catch (\Auth0\SDK\Exception\NetworkException $exception) {
                return false;
            }

            // Process the response.
            return $this->processLastResponse();
        }

        // @codeCoverageIgnoreStart
        return false;
        // @codeCoverageIgnoreEnd
    }

    /**
     * Process the previous HttpResponse results and cache them for iterator content.
     */
    private function processLastResponse(): bool
    {
        $lastRequest = $this->lastRequest();
        $lastResponse = $this->lastResponse();

        if ($lastRequest !== null && $lastResponse !== null) {
            // Was the HTTP request successful?
            if (HttpResponse::wasSuccessful($lastResponse)) {
                // Decode the response.
                try {
                    $results = HttpResponse::decodeContent($lastResponse);
                } catch (\Throwable $throwable) {
                    throw \Auth0\SDK\Exception\PaginatorException::httpBadResponse();
                }

                // If not using checkpoint pagination, grab the 'start' value.
                $start = $results['start'] ?? null;

                // There is no 'start' key, the request was probably made without the include_totals param.
                if ($start === null && ! $this->usingCheckpointPagination) {
                    throw \Auth0\SDK\Exception\PaginatorException::httpBadResponse();
                }

                if ($start === null) {
                    $start = $this->position;
                }

                $start = (int) $start;

                // @codeCoverageIgnoreStart
                // No results, abort processing.
                if (! is_array($results) || count($results) === 0) {
                    return false;
                }
                // @codeCoverageIgnoreEnd

                $hadResults = false;
                $nextCheckpoint = null;

                foreach ($results as $resultKey => $result) {
                    if (! $this->usingCheckpointPagination) {
                        if ($resultKey === 'limit') {
                            $this->requestLimit = (int) $result;
                            continue;
                        }

                        if ($resultKey === 'total') {
                            $this->requestTotal = (int) $result;
                            continue;
                        }

                        if ($resultKey === 'length') {
                            continue;
                        }
                    } else {
                        if ($resultKey === 'next') {
                            $nextCheckpoint = (string) $result;
                            continue;
                        }
                    }

                    if ($resultKey !== 'start') {
                        $resultCount = is_array($result) ? count($result) : 0;

                        for ($i = 0; $i < $resultCount; $i++) {
                            $hadResults = true;

                            if (! $this->usingCheckpointPagination) {
                                $this->results[$start + $i] = $result[$i];
                                continue;
                            }

                            $this->results[] = $result[$i];
                        }
                    }
                }

                // Using checkpoint-pagination, track the value of 'next' in responses. If none was provided, set our internal cursor to null to indicate no more results available.
                if ($this->usingCheckpointPagination) {
                    $this->nextCheckpoint = $nextCheckpoint;
                }

                // We successfully retrieved results.
                if ($hadResults) {
                    return true;
                }
            }

            return false;
        }

        // @codeCoverageIgnoreStart
        return false;
        // @codeCoverageIgnoreEnd
    }

    /**
     * Return the current instance of the HttpRequest.
     */
    private function lastBuilder(): ?HttpRequest
    {
        return $this->httpClient->getLastRequest();
    }

    /**
     * Return a RequestInterface representing the most recent sent HTTP request.
     */
    private function lastRequest(): ?RequestInterface
    {
        $lastBuilder = $this->lastBuilder();

        if ($lastBuilder !== null) {
            return $lastBuilder->getLastRequest();
        }

        return null;
    }

    /**
     * Return a ResponseInterface representing the most recently returned HTTP response.
     */
    private function lastResponse(): ?ResponseInterface
    {
        $lastBuilder = $this->lastBuilder();

        if ($lastBuilder !== null) {
            return $lastBuilder->getLastResponse();
        }

        return null;
    }
}
