<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Exception\NetworkException;
use Auth0\SDK\Exception\PaginatorException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpResponsePaginator.
 */
final class HttpResponsePaginator implements \Countable, \Iterator
{
    private HttpClient $httpClient;

    private int $position = 0;
    private int $requestLimit = 0;
    private int $requestTotal = 0;
    private int $requestCount = 0;
    private array $results = [];

    public function __construct(
        HttpClient $httpClient
    ) {
        $this->httpClient = $httpClient;
        $this->processLastResponse();
    }

    public function countNetworkRequests(): int
    {
        return $this->requestCount;
    }

    /**
     * Return the total number of results available, according to the API.
     */
    public function count(): int
    {
        return $this->requestTotal;
    }

    /**
     * Return the current result at our position, if available.
     */
    public function current()
    {
        return $this->valid() ? $this->result() : false;
    }

    /**
     * Retrieve the current position, if valid.
     */
    public function key(): int
    {
        return $this->valid() ? $this->position : null;
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
        if ($this->result()) {
            return true;
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
     */
    private function result()
    {
        return $this->results[$this->position] ?? null;
    }

    /**
     * Set an HttpRequest's pagination params to safe defaults. Triggered when a HttpResponse is provided that isn't paginated, or doesn't have include_totals set (required for iteration.)
     */
    private function resetResults(): bool
    {
        if ($this->lastBuilder()) {
            // Retrieve the active HttpRequest instance to repeat the request.
            $lastBuilder = $this->lastBuilder();

            // Get the current HttpRequest parameters.
            $params = $lastBuilder->getParams();

            // Ensure basic pagination details are included in the request.

            // Is ?page= present? If not, request the first page.
            if (! mb_strstr($params, 'page=')) {
                $lastBuilder->withParam('page', 0);
            }

            // Is ?per_page present? If not, set a sane default.
            if (! mb_strstr($params, 'per_page=')) {
                $lastBuilder->withParam('per_page', 100);
            }

            // Ensure ?include_totals=true is present, required to iterate using this class.
            $lastBuilder->withParam('include_totals', true);

            // Increment our network request tracker for reference.
            ++$this->requestCount;

            // Issue next paged request.
            try {
                $response = $lastBuilder->call();
            } catch (NetworkException $exception) {
                return false;
            }

            // Process the response.
            return $this->processLastResponse();
        }

        return false;
    }

    /**
     * Make a network request for the next page of results.
     */
    private function getNextResults(): bool
    {
        if ($this->lastBuilder() && $this->lastResponse()) {
            // Retrieve the active HttpRequest instance to repeat the request.
            $lastBuilder = $this->lastBuilder();

            // Get the next page.
            $page = ceil($this->position / $this->requestLimit);

            // Set the next page.
            $lastBuilder->withParam('page', $page);

            // Increment our network request tracker for reference.
            ++$this->requestCount;

            // Issue next paged request.
            try {
                $response = $lastBuilder->call();
            } catch (NetworkException $exception) {
                return false;
            }

            // Process the response.
            return $this->processLastResponse();
        }

        return false;
    }

    /**
     * Process the previous HttpResponse results and cache them for iterator content.
     */
    private function processLastResponse(): bool
    {
        $lastRequest = $this->lastRequest();
        $lastResponse = $this->lastResponse();

        if ($lastRequest && $lastResponse) {
            // We can only paginate GET requests.
            if (mb_strtolower($lastRequest->getMethod()) !== 'get') {
                throw PaginatorException::httpMethodUnsupported();
            }

            // Was the HTTP request successful?
            if (HttpResponse::wasSuccessful($lastResponse)) {
                // Decode the response.
                $results = HttpResponse::decodeContent($lastResponse);

                // No results, abort processing.
                if (! is_array($results) || ! count($results)) {
                    return false;
                }

                // There is no 'start' key, the request was probably made without the include_totals param. Try again using safe pagination defaults.
                if (! isset($results['start'])) {
                    return $this->resetResults();
                }

                $start = $results['start'] ?? $this->position;
                $hadResults = false;

                foreach ($results as $resultKey => $result) {
                    if ($resultKey === 'limit') {
                        $this->requestLimit = (int) $result;
                        continue;
                    }

                    if ($resultKey === 'total') {
                        $this->requestTotal = (int) $result;
                        continue;
                    }

                    if ($resultKey === 'length') {
                        $hadResults = true;
                        continue;
                    }

                    if ($resultKey !== 'start') {
                        for ($i = 0; $i < count($result); $i++) {
                            $this->results[$start + $i] = $result[$i];
                        }
                    }
                }

                if ($hadResults) {
                    // We successfully retrieved results.
                    return true;
                }
            }

            return false;
        }

        // No request has been issued yet; do we at least have a builder?
        if ($this->lastBuilder()) {
            // Try issuing the request.
            return $this->resetResults();
        }

        return false;
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
        if ($this->lastBuilder()) {
            return $this->lastBuilder()->getLastRequest();
        }

        return null;
    }

    /**
     * Return a ResponseInterface representing the most recently returned HTTP response.
     */
    private function lastResponse(): ?ResponseInterface
    {
        if ($this->lastBuilder()) {
            return $this->lastBuilder()->getLastResponse();
        }

        return null;
    }
}
