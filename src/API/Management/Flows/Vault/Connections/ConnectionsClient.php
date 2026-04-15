<?php

namespace Auth0\SDK\API\Management\Flows\Vault\Connections;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Flows\Vault\Connections\Requests\ListFlowsVaultConnectionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectionSummary;
use Auth0\SDK\API\Management\Core\Pagination\OffsetPager;
use Auth0\SDK\API\Management\Types\ListFlowsVaultConnectionsOffsetPaginatedResponseContent;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionActivecampaignApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionActivecampaignUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionAirtableApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionAirtableUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionAuth0OauthApp;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionAuth0Uninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionBigqueryJwt;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionBigqueryUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionClearbitApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionClearbitUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionDocusignOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionDocusignUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionGoogleSheetsOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionGoogleSheetsUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHttpBearer;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHttpBasicAuth;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHttpApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHttpOauthClientCredentials;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHttpUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHubspotApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHubspotOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHubspotUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionJwtJwt;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionJwtUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionMailchimpApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionMailchimpOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionMailchimpUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionMailjetApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionMailjetUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionPipedriveToken;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionPipedriveOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionPipedriveUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSalesforceOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSalesforceUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSendgridApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSendgridUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSlackWebhook;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSlackOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSlackUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionStripeKeyPair;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionStripeOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionStripeUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionTelegramToken;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionTelegramUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionTwilioApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionTwilioUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionWhatsappToken;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionWhatsappUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionZapierWebhook;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionZapierUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use Auth0\SDK\API\Management\Core\Json\JsonSerializer;
use Auth0\SDK\API\Management\Core\Types\Union;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\GetFlowsVaultConnectionResponseContent;
use Auth0\SDK\API\Management\Flows\Vault\Connections\Requests\UpdateFlowsVaultConnectionRequestContent;
use Auth0\SDK\API\Management\Types\UpdateFlowsVaultConnectionResponseContent;

class ConnectionsClient implements ConnectionsClientInterface
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
     * @param ListFlowsVaultConnectionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<FlowsVaultConnectionSummary>
     */
    public function list(ListFlowsVaultConnectionsRequestParameters $request = new ListFlowsVaultConnectionsRequestParameters(), ?array $options = null): Pager
    {
        return new OffsetPager(
            request: $request,
            getNextPage: fn (ListFlowsVaultConnectionsRequestParameters $request) => $this->_list($request, $options),
            /* @phpstan-ignore-next-line */
            getOffset: fn (ListFlowsVaultConnectionsRequestParameters $request) => $request?->getPage() ?? 0,
            setOffset: function (ListFlowsVaultConnectionsRequestParameters $request, int $offset) {
                $request->setPage($offset);
            },
            /* @phpstan-ignore-next-line */
            getStep: fn (ListFlowsVaultConnectionsRequestParameters $request) => $request?->getPerPage() ?? 0,
            /* @phpstan-ignore-next-line */
            getItems: fn (?ListFlowsVaultConnectionsOffsetPaginatedResponseContent $response) => $response?->getConnections() ?? [],
            /* @phpstan-ignore-next-line */
            hasNextPage: null,
        );
    }

    /**
     * @param (
     *    CreateFlowsVaultConnectionActivecampaignApiKey
     *   |CreateFlowsVaultConnectionActivecampaignUninitialized
     *   |CreateFlowsVaultConnectionAirtableApiKey
     *   |CreateFlowsVaultConnectionAirtableUninitialized
     *   |CreateFlowsVaultConnectionAuth0OauthApp
     *   |CreateFlowsVaultConnectionAuth0Uninitialized
     *   |CreateFlowsVaultConnectionBigqueryJwt
     *   |CreateFlowsVaultConnectionBigqueryUninitialized
     *   |CreateFlowsVaultConnectionClearbitApiKey
     *   |CreateFlowsVaultConnectionClearbitUninitialized
     *   |CreateFlowsVaultConnectionDocusignOauthCode
     *   |CreateFlowsVaultConnectionDocusignUninitialized
     *   |CreateFlowsVaultConnectionGoogleSheetsOauthCode
     *   |CreateFlowsVaultConnectionGoogleSheetsUninitialized
     *   |CreateFlowsVaultConnectionHttpBearer
     *   |CreateFlowsVaultConnectionHttpBasicAuth
     *   |CreateFlowsVaultConnectionHttpApiKey
     *   |CreateFlowsVaultConnectionHttpOauthClientCredentials
     *   |CreateFlowsVaultConnectionHttpUninitialized
     *   |CreateFlowsVaultConnectionHubspotApiKey
     *   |CreateFlowsVaultConnectionHubspotOauthCode
     *   |CreateFlowsVaultConnectionHubspotUninitialized
     *   |CreateFlowsVaultConnectionJwtJwt
     *   |CreateFlowsVaultConnectionJwtUninitialized
     *   |CreateFlowsVaultConnectionMailchimpApiKey
     *   |CreateFlowsVaultConnectionMailchimpOauthCode
     *   |CreateFlowsVaultConnectionMailchimpUninitialized
     *   |CreateFlowsVaultConnectionMailjetApiKey
     *   |CreateFlowsVaultConnectionMailjetUninitialized
     *   |CreateFlowsVaultConnectionPipedriveToken
     *   |CreateFlowsVaultConnectionPipedriveOauthCode
     *   |CreateFlowsVaultConnectionPipedriveUninitialized
     *   |CreateFlowsVaultConnectionSalesforceOauthCode
     *   |CreateFlowsVaultConnectionSalesforceUninitialized
     *   |CreateFlowsVaultConnectionSendgridApiKey
     *   |CreateFlowsVaultConnectionSendgridUninitialized
     *   |CreateFlowsVaultConnectionSlackWebhook
     *   |CreateFlowsVaultConnectionSlackOauthCode
     *   |CreateFlowsVaultConnectionSlackUninitialized
     *   |CreateFlowsVaultConnectionStripeKeyPair
     *   |CreateFlowsVaultConnectionStripeOauthCode
     *   |CreateFlowsVaultConnectionStripeUninitialized
     *   |CreateFlowsVaultConnectionTelegramToken
     *   |CreateFlowsVaultConnectionTelegramUninitialized
     *   |CreateFlowsVaultConnectionTwilioApiKey
     *   |CreateFlowsVaultConnectionTwilioUninitialized
     *   |CreateFlowsVaultConnectionWhatsappToken
     *   |CreateFlowsVaultConnectionWhatsappUninitialized
     *   |CreateFlowsVaultConnectionZapierWebhook
     *   |CreateFlowsVaultConnectionZapierUninitialized
     * ) $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateFlowsVaultConnectionResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateFlowsVaultConnectionActivecampaignApiKey|CreateFlowsVaultConnectionActivecampaignUninitialized|CreateFlowsVaultConnectionAirtableApiKey|CreateFlowsVaultConnectionAirtableUninitialized|CreateFlowsVaultConnectionAuth0OauthApp|CreateFlowsVaultConnectionAuth0Uninitialized|CreateFlowsVaultConnectionBigqueryJwt|CreateFlowsVaultConnectionBigqueryUninitialized|CreateFlowsVaultConnectionClearbitApiKey|CreateFlowsVaultConnectionClearbitUninitialized|CreateFlowsVaultConnectionDocusignOauthCode|CreateFlowsVaultConnectionDocusignUninitialized|CreateFlowsVaultConnectionGoogleSheetsOauthCode|CreateFlowsVaultConnectionGoogleSheetsUninitialized|CreateFlowsVaultConnectionHttpBearer|CreateFlowsVaultConnectionHttpBasicAuth|CreateFlowsVaultConnectionHttpApiKey|CreateFlowsVaultConnectionHttpOauthClientCredentials|CreateFlowsVaultConnectionHttpUninitialized|CreateFlowsVaultConnectionHubspotApiKey|CreateFlowsVaultConnectionHubspotOauthCode|CreateFlowsVaultConnectionHubspotUninitialized|CreateFlowsVaultConnectionJwtJwt|CreateFlowsVaultConnectionJwtUninitialized|CreateFlowsVaultConnectionMailchimpApiKey|CreateFlowsVaultConnectionMailchimpOauthCode|CreateFlowsVaultConnectionMailchimpUninitialized|CreateFlowsVaultConnectionMailjetApiKey|CreateFlowsVaultConnectionMailjetUninitialized|CreateFlowsVaultConnectionPipedriveToken|CreateFlowsVaultConnectionPipedriveOauthCode|CreateFlowsVaultConnectionPipedriveUninitialized|CreateFlowsVaultConnectionSalesforceOauthCode|CreateFlowsVaultConnectionSalesforceUninitialized|CreateFlowsVaultConnectionSendgridApiKey|CreateFlowsVaultConnectionSendgridUninitialized|CreateFlowsVaultConnectionSlackWebhook|CreateFlowsVaultConnectionSlackOauthCode|CreateFlowsVaultConnectionSlackUninitialized|CreateFlowsVaultConnectionStripeKeyPair|CreateFlowsVaultConnectionStripeOauthCode|CreateFlowsVaultConnectionStripeUninitialized|CreateFlowsVaultConnectionTelegramToken|CreateFlowsVaultConnectionTelegramUninitialized|CreateFlowsVaultConnectionTwilioApiKey|CreateFlowsVaultConnectionTwilioUninitialized|CreateFlowsVaultConnectionWhatsappToken|CreateFlowsVaultConnectionWhatsappUninitialized|CreateFlowsVaultConnectionZapierWebhook|CreateFlowsVaultConnectionZapierUninitialized $request, ?array $options = null): ?CreateFlowsVaultConnectionResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "flows/vault/connections",
                    method: HttpMethod::POST,
                    body: JsonSerializer::serializeUnion($request, new Union(CreateFlowsVaultConnectionActivecampaignApiKey::class, CreateFlowsVaultConnectionActivecampaignUninitialized::class, CreateFlowsVaultConnectionAirtableApiKey::class, CreateFlowsVaultConnectionAirtableUninitialized::class, CreateFlowsVaultConnectionAuth0OauthApp::class, CreateFlowsVaultConnectionAuth0Uninitialized::class, CreateFlowsVaultConnectionBigqueryJwt::class, CreateFlowsVaultConnectionBigqueryUninitialized::class, CreateFlowsVaultConnectionClearbitApiKey::class, CreateFlowsVaultConnectionClearbitUninitialized::class, CreateFlowsVaultConnectionDocusignOauthCode::class, CreateFlowsVaultConnectionDocusignUninitialized::class, CreateFlowsVaultConnectionGoogleSheetsOauthCode::class, CreateFlowsVaultConnectionGoogleSheetsUninitialized::class, CreateFlowsVaultConnectionHttpBearer::class, CreateFlowsVaultConnectionHttpBasicAuth::class, CreateFlowsVaultConnectionHttpApiKey::class, CreateFlowsVaultConnectionHttpOauthClientCredentials::class, CreateFlowsVaultConnectionHttpUninitialized::class, CreateFlowsVaultConnectionHubspotApiKey::class, CreateFlowsVaultConnectionHubspotOauthCode::class, CreateFlowsVaultConnectionHubspotUninitialized::class, CreateFlowsVaultConnectionJwtJwt::class, CreateFlowsVaultConnectionJwtUninitialized::class, CreateFlowsVaultConnectionMailchimpApiKey::class, CreateFlowsVaultConnectionMailchimpOauthCode::class, CreateFlowsVaultConnectionMailchimpUninitialized::class, CreateFlowsVaultConnectionMailjetApiKey::class, CreateFlowsVaultConnectionMailjetUninitialized::class, CreateFlowsVaultConnectionPipedriveToken::class, CreateFlowsVaultConnectionPipedriveOauthCode::class, CreateFlowsVaultConnectionPipedriveUninitialized::class, CreateFlowsVaultConnectionSalesforceOauthCode::class, CreateFlowsVaultConnectionSalesforceUninitialized::class, CreateFlowsVaultConnectionSendgridApiKey::class, CreateFlowsVaultConnectionSendgridUninitialized::class, CreateFlowsVaultConnectionSlackWebhook::class, CreateFlowsVaultConnectionSlackOauthCode::class, CreateFlowsVaultConnectionSlackUninitialized::class, CreateFlowsVaultConnectionStripeKeyPair::class, CreateFlowsVaultConnectionStripeOauthCode::class, CreateFlowsVaultConnectionStripeUninitialized::class, CreateFlowsVaultConnectionTelegramToken::class, CreateFlowsVaultConnectionTelegramUninitialized::class, CreateFlowsVaultConnectionTwilioApiKey::class, CreateFlowsVaultConnectionTwilioUninitialized::class, CreateFlowsVaultConnectionWhatsappToken::class, CreateFlowsVaultConnectionWhatsappUninitialized::class, CreateFlowsVaultConnectionZapierWebhook::class, CreateFlowsVaultConnectionZapierUninitialized::class)),
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return CreateFlowsVaultConnectionResponseContent::fromJson($json);
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
     * @param string $id Flows Vault connection ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetFlowsVaultConnectionResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): ?GetFlowsVaultConnectionResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "flows/vault/connections/{$id}",
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
                return GetFlowsVaultConnectionResponseContent::fromJson($json);
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
     * @param string $id Vault connection id
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
                    path: "flows/vault/connections/{$id}",
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
     * @param string $id Flows Vault connection ID
     * @param UpdateFlowsVaultConnectionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateFlowsVaultConnectionResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateFlowsVaultConnectionRequestContent $request = new UpdateFlowsVaultConnectionRequestContent(), ?array $options = null): ?UpdateFlowsVaultConnectionResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "flows/vault/connections/{$id}",
                    method: HttpMethod::PATCH,
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
                return UpdateFlowsVaultConnectionResponseContent::fromJson($json);
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
     * @param ListFlowsVaultConnectionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListFlowsVaultConnectionsOffsetPaginatedResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    private function _list(ListFlowsVaultConnectionsRequestParameters $request = new ListFlowsVaultConnectionsRequestParameters(), ?array $options = null): ?ListFlowsVaultConnectionsOffsetPaginatedResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getPage() != null) {
            $query['page'] = $request->getPage();
        }
        if ($request->getPerPage() != null) {
            $query['per_page'] = $request->getPerPage();
        }
        if ($request->getIncludeTotals() != null) {
            $query['include_totals'] = $request->getIncludeTotals();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "flows/vault/connections",
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
                return ListFlowsVaultConnectionsOffsetPaginatedResponseContent::fromJson($json);
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
