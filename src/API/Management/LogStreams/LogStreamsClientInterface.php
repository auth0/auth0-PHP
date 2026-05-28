<?php

namespace Auth0\SDK\API\Management\LogStreams;

use Auth0\SDK\API\Management\Types\LogStreamHttpResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamEventBridgeResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamEventGridResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamDatadogResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamSplunkResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamSumoResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamSegmentResponseSchema;
use Auth0\SDK\API\Management\Types\LogStreamMixpanelResponseSchema;
use Auth0\SDK\API\Management\Types\CreateLogStreamHttpRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamEventBridgeRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamEventGridRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamDatadogRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamSplunkRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamSumoRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamSegmentRequestBody;
use Auth0\SDK\API\Management\Types\CreateLogStreamMixpanelRequestBody;
use Auth0\SDK\API\Management\LogStreams\Requests\UpdateLogStreamRequestContent;

interface LogStreamsClientInterface
{
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
     */
    public function list(?array $options = null): ?array;

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
     */
    public function create(CreateLogStreamHttpRequestBody|CreateLogStreamEventBridgeRequestBody|CreateLogStreamEventGridRequestBody|CreateLogStreamDatadogRequestBody|CreateLogStreamSplunkRequestBody|CreateLogStreamSumoRequestBody|CreateLogStreamSegmentRequestBody|CreateLogStreamMixpanelRequestBody $request, ?array $options = null): LogStreamHttpResponseSchema|LogStreamEventBridgeResponseSchema|LogStreamEventGridResponseSchema|LogStreamDatadogResponseSchema|LogStreamSplunkResponseSchema|LogStreamSumoResponseSchema|LogStreamSegmentResponseSchema|LogStreamMixpanelResponseSchema|null;

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
     */
    public function get(string $id, ?array $options = null): LogStreamHttpResponseSchema|LogStreamEventBridgeResponseSchema|LogStreamEventGridResponseSchema|LogStreamDatadogResponseSchema|LogStreamSplunkResponseSchema|LogStreamSumoResponseSchema|LogStreamSegmentResponseSchema|LogStreamMixpanelResponseSchema|null;

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
     */
    public function delete(string $id, ?array $options = null): void;

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
     */
    public function update(string $id, UpdateLogStreamRequestContent $request = new UpdateLogStreamRequestContent(), ?array $options = null): LogStreamHttpResponseSchema|LogStreamEventBridgeResponseSchema|LogStreamEventGridResponseSchema|LogStreamDatadogResponseSchema|LogStreamSplunkResponseSchema|LogStreamSumoResponseSchema|LogStreamSegmentResponseSchema|LogStreamMixpanelResponseSchema|null;
}
