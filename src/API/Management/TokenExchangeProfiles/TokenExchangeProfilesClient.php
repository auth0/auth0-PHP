<?php

namespace Auth0\SDK\API\Management\TokenExchangeProfiles;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\TokenExchangeProfiles\Requests\TokenExchangeProfilesListRequest;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\TokenExchangeProfileResponseContent;
use Auth0\SDK\API\Management\Core\Pagination\CursorPager;
use Auth0\SDK\API\Management\Types\ListTokenExchangeProfileResponseContent;
use Auth0\SDK\API\Management\TokenExchangeProfiles\Requests\CreateTokenExchangeProfileRequestContent;
use Auth0\SDK\API\Management\Types\CreateTokenExchangeProfileResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\GetTokenExchangeProfileResponseContent;
use Auth0\SDK\API\Management\TokenExchangeProfiles\Requests\UpdateTokenExchangeProfileRequestContent;

class TokenExchangeProfilesClient implements TokenExchangeProfilesClientInterface
{
    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

    /**
     * Retrieve a list of all Token Exchange Profiles available in your tenant.
     *
     * By using this feature, you agree to the applicable Free Trial terms in [Okta’s Master Subscription Agreement](https://www.okta.com/legal/). It is your responsibility to securely validate the user’s subject_token. See [User Guide](https://auth0.com/docs/authenticate/custom-token-exchange) for more details.
     *
     * This endpoint supports Checkpoint pagination. To search by checkpoint, use the following parameters:
     *
     * - `from`: Optional id from which to start selection.
     * - `take`: The total amount of entries to retrieve when using the from parameter. Defaults to 50.
     *
     * **Note**: The first time you call this endpoint using checkpoint pagination, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no pages are remaining.
     *
     * @param TokenExchangeProfilesListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<TokenExchangeProfileResponseContent>
     */
    public function list(TokenExchangeProfilesListRequest $request = new TokenExchangeProfilesListRequest(), ?array $options = null): Pager
    {
        return new CursorPager(
            request: $request,
            getNextPage: fn (TokenExchangeProfilesListRequest $request) => $this->_list($request, $options),
            setCursor: function (TokenExchangeProfilesListRequest $request, ?string $cursor) {
                $request->setFrom($cursor);
            },
            /* @phpstan-ignore-next-line */
            getNextCursor: fn (?ListTokenExchangeProfileResponseContent $response) => $response?->getNext() ?? null,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListTokenExchangeProfileResponseContent $response) => $response?->getTokenExchangeProfiles() ?? [],
        );
    }

    /**
     * Create a new Token Exchange Profile within your tenant.
     *
     * By using this feature, you agree to the applicable Free Trial terms in [Okta’s Master Subscription Agreement](https://www.okta.com/legal/). It is your responsibility to securely validate the user’s subject_token. See [User Guide](https://auth0.com/docs/authenticate/custom-token-exchange) for more details.
     *
     * @param CreateTokenExchangeProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateTokenExchangeProfileResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateTokenExchangeProfileRequestContent $request, ?array $options = null): ?CreateTokenExchangeProfileResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "token-exchange-profiles",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return CreateTokenExchangeProfileResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Retrieve details about a single Token Exchange Profile specified by ID.
     *
     * By using this feature, you agree to the applicable Free Trial terms in [Okta’s Master Subscription Agreement](https://www.okta.com/legal/). It is your responsibility to securely validate the user’s subject_token. See [User Guide](https://auth0.com/docs/authenticate/custom-token-exchange) for more details.
     *
     * @param string $id ID of the Token Exchange Profile to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetTokenExchangeProfileResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): ?GetTokenExchangeProfileResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "token-exchange-profiles/{$id}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetTokenExchangeProfileResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Delete a Token Exchange Profile within your tenant.
     *
     * By using this feature, you agree to the applicable Free Trial terms in [Okta's Master Subscription Agreement](https://www.okta.com/legal/). It is your responsibility to securely validate the user's subject_token. See [User Guide](https://auth0.com/docs/authenticate/custom-token-exchange) for more details.
     *
     * @param string $id ID of the Token Exchange Profile to delete.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function delete(string $id, ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "token-exchange-profiles/{$id}",
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Update a Token Exchange Profile within your tenant.
     *
     * By using this feature, you agree to the applicable Free Trial terms in [Okta's Master Subscription Agreement](https://www.okta.com/legal/). It is your responsibility to securely validate the user's subject_token. See [User Guide](https://auth0.com/docs/authenticate/custom-token-exchange) for more details.
     *
     * @param string $id ID of the Token Exchange Profile to update.
     * @param UpdateTokenExchangeProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateTokenExchangeProfileRequestContent $request = new UpdateTokenExchangeProfileRequestContent(), ?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "token-exchange-profiles/{$id}",
                    method: HttpMethod::PATCH,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Retrieve a list of all Token Exchange Profiles available in your tenant.
     *
     * By using this feature, you agree to the applicable Free Trial terms in [Okta’s Master Subscription Agreement](https://www.okta.com/legal/). It is your responsibility to securely validate the user’s subject_token. See [User Guide](https://auth0.com/docs/authenticate/custom-token-exchange) for more details.
     *
     * This endpoint supports Checkpoint pagination. To search by checkpoint, use the following parameters:
     *
     * - `from`: Optional id from which to start selection.
     * - `take`: The total amount of entries to retrieve when using the from parameter. Defaults to 50.
     *
     * **Note**: The first time you call this endpoint using checkpoint pagination, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no pages are remaining.
     *
     * @param TokenExchangeProfilesListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListTokenExchangeProfileResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(TokenExchangeProfilesListRequest $request = new TokenExchangeProfilesListRequest(), ?array $options = null): ?ListTokenExchangeProfileResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFrom() != null) {
            $query['from'] = $request->getFrom();
        }
        if ($request->getTake() != null) {
            $query['take'] = $request->getTake();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "token-exchange-profiles",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ListTokenExchangeProfileResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
