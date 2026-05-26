<?php

namespace Auth0\SDK\API\Management\LogStreams;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Types\LogStreamHttpResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamEventBridgeResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamEventGridResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamDatadogResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamSplunkResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamSumoResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamSegmentResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamMixpanelResponseSchema;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use Auth0\SDK\API\Management\Core\Json\JsonDecoder;
use Auth0\SDK\API\Management\Core\Types\Union;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\CreateLogStreamHttpRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamEventBridgeRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamEventGridRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamDatadogRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamSplunkRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamSumoRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamSegmentRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamMixpanelRequestBody;
use Auth0\SDK\API\Management\Core\Json\JsonSerializer;
use Auth0\SDK\API\Management\LogStreams\Requests\UpdateLogStreamRequestContent;

class LogStreamsClient implements LogStreamsClientInterface
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
     * Retrieve details on [log streams](https://auth0.com/docs/logs/streams).
     *
     * **Sample Response**
     *
     * ```json
     * [{
     *   "id": "string",
     *   "name": "string",
     *   "type": "eventbridge",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "awsAccountId": "string",
     *     "awsRegion": "string",
     *     "awsPartnerEventSource": "string"
     *   }
     * }, {
     *   "id": "string",
     *   "name": "string",
     *   "type": "http",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "httpContentFormat": "JSONLINES|JSONARRAY",
     *     "httpContentType": "string",
     *     "httpEndpoint": "string",
     *     "httpAuthorization": "string"
     *   }
     * },
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "eventgrid",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "azureSubscriptionId": "string",
     *     "azureResourceGroup": "string",
     *     "azureRegion": "string",
     *     "azurePartnerTopic": "string"
     *   }
     * },
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "splunk",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "splunkDomain": "string",
     *     "splunkToken": "string",
     *     "splunkPort": "string",
     *     "splunkSecure": "boolean"
     *   }
     * },
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "sumo",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "sumoSourceAddress": "string"
     *   }
     * },
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "datadog",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "datadogRegion": "string",
     *     "datadogApiKey": "string"
     *   }
     * }]
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<(
     *    LogStreamHttpResponseSchema
     *   |LogStreamEventBridgeResponseSchema
     *   |LogStreamEventGridResponseSchema
     *   |LogStreamDatadogResponseSchema
     *   |LogStreamSplunkResponseSchema
     *   |LogStreamSumoResponseSchema
     *   |LogStreamSegmentResponseSchema
     *   |LogStreamMixpanelResponseSchema
     * )>
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function list(?array $options = null): ?array
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "log-streams",
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
                return JsonDecoder::decodeArray($json, [new Union(LogStreamHttpResponseSchema::class, LogStreamEventBridgeResponseSchema::class, LogStreamEventGridResponseSchema::class, LogStreamDatadogResponseSchema::class, LogStreamSplunkResponseSchema::class, LogStreamSumoResponseSchema::class, LogStreamSegmentResponseSchema::class, LogStreamMixpanelResponseSchema::class)]); // @phpstan-ignore-line
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
     * Create a log stream.
     *
     * **Log Stream Types**
     *
     * The `type` of log stream being created determines the properties required in the `sink` payload.
     *
     * **HTTP Stream**
     *
     * For an `http` Stream, the `sink` properties are listed in the payload below.
     *
     * **Request:**
     * ```json
     * {
     *   "name": "string",
     *   "type": "http",
     *   "sink": {
     *     "httpEndpoint": "string",
     *     "httpContentType": "string",
     *     "httpContentFormat": "JSONLINES|JSONARRAY",
     *     "httpAuthorization": "string"
     *   }
     * }
     * ```
     *
     * **Response:**
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "http",
     *   "status": "active",
     *   "sink": {
     *     "httpEndpoint": "string",
     *     "httpContentType": "string",
     *     "httpContentFormat": "JSONLINES|JSONARRAY",
     *     "httpAuthorization": "string"
     *   }
     * }
     * ```
     *
     * **Amazon EventBridge Stream**
     *
     * For an `eventbridge` Stream, the `sink` properties are listed in the payload below.
     *
     * **Request:**
     * ```json
     * {
     *   "name": "string",
     *   "type": "eventbridge",
     *   "sink": {
     *     "awsRegion": "string",
     *     "awsAccountId": "string"
     *   }
     * }
     * ```
     *
     * The response will include an additional field `awsPartnerEventSource` in the `sink`:
     *
     * **Response:**
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "eventbridge",
     *   "status": "active",
     *   "sink": {
     *     "awsAccountId": "string",
     *     "awsRegion": "string",
     *     "awsPartnerEventSource": "string"
     *   }
     * }
     * ```
     *
     * **Azure Event Grid Stream**
     *
     * For an `Azure Event Grid` Stream, the `sink` properties are listed in the payload below.
     *
     * **Request:**
     * ```json
     * {
     *   "name": "string",
     *   "type": "eventgrid",
     *   "sink": {
     *     "azureSubscriptionId": "string",
     *     "azureResourceGroup": "string",
     *     "azureRegion": "string"
     *   }
     * }
     * ```
     *
     * **Response:**
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "http",
     *   "status": "active",
     *   "sink": {
     *     "azureSubscriptionId": "string",
     *     "azureResourceGroup": "string",
     *     "azureRegion": "string",
     *     "azurePartnerTopic": "string"
     *   }
     * }
     * ```
     *
     * **Datadog Stream**
     *
     * For a `Datadog` Stream, the `sink` properties are listed in the payload below.
     *
     * **Request:**
     * ```json
     * {
     *   "name": "string",
     *   "type": "datadog",
     *   "sink": {
     *     "datadogRegion": "string",
     *     "datadogApiKey": "string"
     *   }
     * }
     * ```
     *
     * **Response:**
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "datadog",
     *   "status": "active",
     *   "sink": {
     *     "datadogRegion": "string",
     *     "datadogApiKey": "string"
     *   }
     * }
     * ```
     *
     * **Splunk Stream**
     *
     * For a `Splunk` Stream, the `sink` properties are listed in the payload below.
     *
     * **Request:**
     * ```json
     * {
     *   "name": "string",
     *   "type": "splunk",
     *   "sink": {
     *     "splunkDomain": "string",
     *     "splunkToken": "string",
     *     "splunkPort": "string",
     *     "splunkSecure": "boolean"
     *   }
     * }
     * ```
     *
     * **Response:**
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "splunk",
     *   "status": "active",
     *   "sink": {
     *     "splunkDomain": "string",
     *     "splunkToken": "string",
     *     "splunkPort": "string",
     *     "splunkSecure": "boolean"
     *   }
     * }
     * ```
     *
     * **Sumo Logic Stream**
     *
     * For a `Sumo Logic` Stream, the `sink` properties are listed in the payload below.
     *
     * **Request:**
     * ```json
     * {
     *   "name": "string",
     *   "type": "sumo",
     *   "sink": {
     *     "sumoSourceAddress": "string"
     *   }
     * }
     * ```
     *
     * **Response:**
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "sumo",
     *   "status": "active",
     *   "sink": {
     *     "sumoSourceAddress": "string"
     *   }
     * }
     * ```
     *
     * @param (
     *    CreateLogStreamHttpRequestBody
     *   |CreateLogStreamEventBridgeRequestBody
     *   |CreateLogStreamEventGridRequestBody
     *   |CreateLogStreamDatadogRequestBody
     *   |CreateLogStreamSplunkRequestBody
     *   |CreateLogStreamSumoRequestBody
     *   |CreateLogStreamSegmentRequestBody
     *   |CreateLogStreamMixpanelRequestBody
     * ) $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return (
     *    LogStreamHttpResponseSchema
     *   |LogStreamEventBridgeResponseSchema
     *   |LogStreamEventGridResponseSchema
     *   |LogStreamDatadogResponseSchema
     *   |LogStreamSplunkResponseSchema
     *   |LogStreamSumoResponseSchema
     *   |LogStreamSegmentResponseSchema
     *   |LogStreamMixpanelResponseSchema
     * )|null
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateLogStreamHttpRequestBody|CreateLogStreamEventBridgeRequestBody|CreateLogStreamEventGridRequestBody|CreateLogStreamDatadogRequestBody|CreateLogStreamSplunkRequestBody|CreateLogStreamSumoRequestBody|CreateLogStreamSegmentRequestBody|CreateLogStreamMixpanelRequestBody $request, ?array $options = null): LogStreamHttpResponseSchema|LogStreamEventBridgeResponseSchema|LogStreamEventGridResponseSchema|LogStreamDatadogResponseSchema|LogStreamSplunkResponseSchema|LogStreamSumoResponseSchema|LogStreamSegmentResponseSchema|LogStreamMixpanelResponseSchema|null
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "log-streams",
                    method: HttpMethod::POST,
                    body: JsonSerializer::serializeUnion($request, new Union(CreateLogStreamHttpRequestBody::class, CreateLogStreamEventBridgeRequestBody::class, CreateLogStreamEventGridRequestBody::class, CreateLogStreamDatadogRequestBody::class, CreateLogStreamSplunkRequestBody::class, CreateLogStreamSumoRequestBody::class, CreateLogStreamSegmentRequestBody::class, CreateLogStreamMixpanelRequestBody::class)),
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return JsonDecoder::decodeUnion($json, new Union(LogStreamHttpResponseSchema::class, LogStreamEventBridgeResponseSchema::class, LogStreamEventGridResponseSchema::class, LogStreamDatadogResponseSchema::class, LogStreamSplunkResponseSchema::class, LogStreamSumoResponseSchema::class, LogStreamSegmentResponseSchema::class, LogStreamMixpanelResponseSchema::class)); // @phpstan-ignore-line
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
     * Retrieve a log stream configuration and status.
     *
     * **Sample responses**
     *
     * **Amazon EventBridge Log Stream**
     *
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "eventbridge",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "awsAccountId": "string",
     *     "awsRegion": "string",
     *     "awsPartnerEventSource": "string"
     *   }
     * }
     * ```
     *
     * **HTTP Log Stream**
     *
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "http",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "httpContentFormat": "JSONLINES|JSONARRAY",
     *     "httpContentType": "string",
     *     "httpEndpoint": "string",
     *     "httpAuthorization": "string"
     *   }
     * }
     * ```
     *
     * **Datadog Log Stream**
     *
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "datadog",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "datadogRegion": "string",
     *     "datadogApiKey": "string"
     *   }
     * }
     * ```
     *
     * **Mixpanel**
     *
     * **Request:**
     *
     * ```json
     * {
     *   "name": "string",
     *   "type": "mixpanel",
     *   "sink": {
     *     "mixpanelRegion": "string",
     *     "mixpanelProjectId": "string",
     *     "mixpanelServiceAccountUsername": "string",
     *     "mixpanelServiceAccountPassword": "string"
     *   }
     * }
     * ```
     *
     * **Response:**
     *
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "mixpanel",
     *   "status": "active",
     *   "sink": {
     *     "mixpanelRegion": "string",
     *     "mixpanelProjectId": "string",
     *     "mixpanelServiceAccountUsername": "string",
     *     "mixpanelServiceAccountPassword": "string"
     *   }
     * }
     * ```
     *
     * **Segment**
     *
     * **Request:**
     *
     * ```json
     * {
     *   "name": "string",
     *   "type": "segment",
     *   "sink": {
     *     "segmentWriteKey": "string"
     *   }
     * }
     * ```
     *
     * **Response:**
     *
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "segment",
     *   "status": "active",
     *   "sink": {
     *     "segmentWriteKey": "string"
     *   }
     * }
     * ```
     *
     * **Splunk Log Stream**
     *
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "splunk",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "splunkDomain": "string",
     *     "splunkToken": "string",
     *     "splunkPort": "string",
     *     "splunkSecure": "boolean"
     *   }
     * }
     * ```
     *
     * **Sumo Logic Log Stream**
     *
     * ```json
     * {
     *   "id": "string",
     *   "name": "string",
     *   "type": "sumo",
     *   "status": "active|paused|suspended",
     *   "sink": {
     *     "sumoSourceAddress": "string"
     *   }
     * }
     * ```
     *
     * **Status**
     *
     * The `status` of a log stream maybe any of the following:
     *
     * 1. `active` - Stream is currently enabled.
     * 2. `paused` - Stream is currently user disabled and will not attempt log delivery.
     * 3. `suspended` - Stream is currently disabled because of errors and will not attempt log delivery.
     *
     * @param string $id The id of the log stream to get
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return (
     *    LogStreamHttpResponseSchema
     *   |LogStreamEventBridgeResponseSchema
     *   |LogStreamEventGridResponseSchema
     *   |LogStreamDatadogResponseSchema
     *   |LogStreamSplunkResponseSchema
     *   |LogStreamSumoResponseSchema
     *   |LogStreamSegmentResponseSchema
     *   |LogStreamMixpanelResponseSchema
     * )|null
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(string $id, ?array $options = null): LogStreamHttpResponseSchema|LogStreamEventBridgeResponseSchema|LogStreamEventGridResponseSchema|LogStreamDatadogResponseSchema|LogStreamSplunkResponseSchema|LogStreamSumoResponseSchema|LogStreamSegmentResponseSchema|LogStreamMixpanelResponseSchema|null
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "log-streams/{$id}",
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
                return JsonDecoder::decodeUnion($json, new Union(LogStreamHttpResponseSchema::class, LogStreamEventBridgeResponseSchema::class, LogStreamEventGridResponseSchema::class, LogStreamDatadogResponseSchema::class, LogStreamSplunkResponseSchema::class, LogStreamSumoResponseSchema::class, LogStreamSegmentResponseSchema::class, LogStreamMixpanelResponseSchema::class)); // @phpstan-ignore-line
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
     * Delete a log stream.
     *
     * @param string $id The id of the log stream to delete
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
                    path: "log-streams/{$id}",
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
     * Update a log stream.
     *
     * **Examples of how to use the PATCH endpoint.**
     *
     * The following fields may be updated in a PATCH operation:
     *
     * - name
     * - status
     * - sink
     *
     * Note: For log streams of type `eventbridge` and `eventgrid`, updating the `sink` is not permitted.
     *
     * **Update the status of a log stream**
     *
     * ```json
     * {
     *   "status": "active|paused"
     * }
     * ```
     *
     * **Update the name of a log stream**
     *
     * ```json
     * {
     *   "name": "string"
     * }
     * ```
     *
     * **Update the sink properties of a stream of type `http`**
     *
     * ```json
     * {
     *   "sink": {
     *     "httpEndpoint": "string",
     *     "httpContentType": "string",
     *     "httpContentFormat": "JSONARRAY|JSONLINES",
     *     "httpAuthorization": "string"
     *   }
     * }
     * ```
     *
     * **Update the sink properties of a stream of type `datadog`**
     *
     * ```json
     * {
     *   "sink": {
     *     "datadogRegion": "string",
     *     "datadogApiKey": "string"
     *   }
     * }
     * ```
     *
     * **Update the sink properties of a stream of type `splunk`**
     *
     * ```json
     * {
     *   "sink": {
     *     "splunkDomain": "string",
     *     "splunkToken": "string",
     *     "splunkPort": "string",
     *     "splunkSecure": "boolean"
     *   }
     * }
     * ```
     *
     * **Update the sink properties of a stream of type `sumo`**
     *
     * ```json
     * {
     *   "sink": {
     *     "sumoSourceAddress": "string"
     *   }
     * }
     * ```
     *
     * @param string $id The id of the log stream to get
     * @param UpdateLogStreamRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return (
     *    LogStreamHttpResponseSchema
     *   |LogStreamEventBridgeResponseSchema
     *   |LogStreamEventGridResponseSchema
     *   |LogStreamDatadogResponseSchema
     *   |LogStreamSplunkResponseSchema
     *   |LogStreamSumoResponseSchema
     *   |LogStreamSegmentResponseSchema
     *   |LogStreamMixpanelResponseSchema
     * )|null
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(string $id, UpdateLogStreamRequestContent $request = new UpdateLogStreamRequestContent(), ?array $options = null): LogStreamHttpResponseSchema|LogStreamEventBridgeResponseSchema|LogStreamEventGridResponseSchema|LogStreamDatadogResponseSchema|LogStreamSplunkResponseSchema|LogStreamSumoResponseSchema|LogStreamSegmentResponseSchema|LogStreamMixpanelResponseSchema|null
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "log-streams/{$id}",
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
                return JsonDecoder::decodeUnion($json, new Union(LogStreamHttpResponseSchema::class, LogStreamEventBridgeResponseSchema::class, LogStreamEventGridResponseSchema::class, LogStreamDatadogResponseSchema::class, LogStreamSplunkResponseSchema::class, LogStreamSumoResponseSchema::class, LogStreamSegmentResponseSchema::class, LogStreamMixpanelResponseSchema::class)); // @phpstan-ignore-line
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
