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
     * Retrieve details on <a href="https://auth0.com/docs/logs/streams">log streams</a>.
     * <h5>Sample Response</h5><pre><code>[{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "eventbridge",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"awsAccountId": "string",
     * 		"awsRegion": "string",
     * 		"awsPartnerEventSource": "string"
     * 	}
     * }, {
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "http",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"httpContentFormat": "JSONLINES|JSONARRAY",
     * 		"httpContentType": "string",
     * 		"httpEndpoint": "string",
     * 		"httpAuthorization": "string"
     * 	}
     * },
     * {
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "eventgrid",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"azureSubscriptionId": "string",
     * 		"azureResourceGroup": "string",
     * 		"azureRegion": "string",
     * 		"azurePartnerTopic": "string"
     * 	}
     * },
     * {
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "splunk",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"splunkDomain": "string",
     * 		"splunkToken": "string",
     * 		"splunkPort": "string",
     * 		"splunkSecure": "boolean"
     * 	}
     * },
     * {
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "sumo",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"sumoSourceAddress": "string",
     * 	}
     * },
     * {
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "datadog",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"datadogRegion": "string",
     * 		"datadogApiKey": "string"
     * 	}
     * }]</code></pre>
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
     * <h5>Log Stream Types</h5> The <code>type</code> of log stream being created determines the properties required in the <code>sink</code> payload.
     * <h5>HTTP Stream</h5> For an <code>http</code> Stream, the <code>sink</code> properties are listed in the payload below
     * Request: <pre><code>{
     * 	"name": "string",
     * 	"type": "http",
     * 	"sink": {
     * 		"httpEndpoint": "string",
     * 		"httpContentType": "string",
     * 		"httpContentFormat": "JSONLINES|JSONARRAY",
     * 		"httpAuthorization": "string"
     * 	}
     * }</code></pre>
     * Response: <pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "http",
     * 	"status": "active",
     * 	"sink": {
     * 		"httpEndpoint": "string",
     * 		"httpContentType": "string",
     * 		"httpContentFormat": "JSONLINES|JSONARRAY",
     * 		"httpAuthorization": "string"
     * 	}
     * }</code></pre>
     * <h5>Amazon EventBridge Stream</h5> For an <code>eventbridge</code> Stream, the <code>sink</code> properties are listed in the payload below
     * Request: <pre><code>{
     * 	"name": "string",
     * 	"type": "eventbridge",
     * 	"sink": {
     * 		"awsRegion": "string",
     * 		"awsAccountId": "string"
     * 	}
     * }</code></pre>
     * The response will include an additional field <code>awsPartnerEventSource</code> in the <code>sink</code>: <pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "eventbridge",
     * 	"status": "active",
     * 	"sink": {
     * 		"awsAccountId": "string",
     * 		"awsRegion": "string",
     * 		"awsPartnerEventSource": "string"
     * 	}
     * }</code></pre>
     * <h5>Azure Event Grid Stream</h5> For an <code>Azure Event Grid</code> Stream, the <code>sink</code> properties are listed in the payload below
     * Request: <pre><code>{
     * 	"name": "string",
     * 	"type": "eventgrid",
     * 	"sink": {
     * 		"azureSubscriptionId": "string",
     * 		"azureResourceGroup": "string",
     * 		"azureRegion": "string"
     * 	}
     * }</code></pre>
     * Response: <pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "http",
     * 	"status": "active",
     * 	"sink": {
     * 		"azureSubscriptionId": "string",
     * 		"azureResourceGroup": "string",
     * 		"azureRegion": "string",
     * 		"azurePartnerTopic": "string"
     * 	}
     * }</code></pre>
     * <h5>Datadog Stream</h5> For a <code>Datadog</code> Stream, the <code>sink</code> properties are listed in the payload below
     * Request: <pre><code>{
     * 	"name": "string",
     * 	"type": "datadog",
     * 	"sink": {
     * 		"datadogRegion": "string",
     * 		"datadogApiKey": "string"
     * 	}
     * }</code></pre>
     * Response: <pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "datadog",
     * 	"status": "active",
     * 	"sink": {
     * 		"datadogRegion": "string",
     * 		"datadogApiKey": "string"
     * 	}
     * }</code></pre>
     * <h5>Splunk Stream</h5> For a <code>Splunk</code> Stream, the <code>sink</code> properties are listed in the payload below
     * Request: <pre><code>{
     * 	"name": "string",
     * 	"type": "splunk",
     * 	"sink": {
     * 		"splunkDomain": "string",
     * 		"splunkToken": "string",
     * 		"splunkPort": "string",
     * 		"splunkSecure": "boolean"
     * 	}
     * }</code></pre>
     * Response: <pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "splunk",
     * 	"status": "active",
     * 	"sink": {
     * 		"splunkDomain": "string",
     * 		"splunkToken": "string",
     * 		"splunkPort": "string",
     * 		"splunkSecure": "boolean"
     * 	}
     * }</code></pre>
     * <h5>Sumo Logic Stream</h5> For a <code>Sumo Logic</code> Stream, the <code>sink</code> properties are listed in the payload below
     * Request: <pre><code>{
     * 	"name": "string",
     * 	"type": "sumo",
     * 	"sink": {
     * 		"sumoSourceAddress": "string",
     * 	}
     * }</code></pre>
     * Response: <pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "sumo",
     * 	"status": "active",
     * 	"sink": {
     * 		"sumoSourceAddress": "string",
     * 	}
     * }</code></pre>
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
     * <h5>Sample responses</h5><h5>Amazon EventBridge Log Stream</h5><pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "eventbridge",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"awsAccountId": "string",
     * 		"awsRegion": "string",
     * 		"awsPartnerEventSource": "string"
     * 	}
     * }</code></pre> <h5>HTTP Log Stream</h5><pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "http",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"httpContentFormat": "JSONLINES|JSONARRAY",
     * 		"httpContentType": "string",
     * 		"httpEndpoint": "string",
     * 		"httpAuthorization": "string"
     * 	}
     * }</code></pre> <h5>Datadog Log Stream</h5><pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "datadog",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"datadogRegion": "string",
     * 		"datadogApiKey": "string"
     * 	}
     *
     * }</code></pre><h5>Mixpanel</h5>
     *
     * 	Request: <pre><code>{
     * 	  "name": "string",
     * 	  "type": "mixpanel",
     * 	  "sink": {
     * 		"mixpanelRegion": "string", // "us" | "eu",
     * 		"mixpanelProjectId": "string",
     * 		"mixpanelServiceAccountUsername": "string",
     * 		"mixpanelServiceAccountPassword": "string"
     * 	  }
     * 	} </code></pre>
     *
     *
     * 	Response: <pre><code>{
     * 		"id": "string",
     * 		"name": "string",
     * 		"type": "mixpanel",
     * 		"status": "active",
     * 		"sink": {
     * 		  "mixpanelRegion": "string", // "us" | "eu",
     * 		  "mixpanelProjectId": "string",
     * 		  "mixpanelServiceAccountUsername": "string",
     * 		  "mixpanelServiceAccountPassword": "string" // the following is redacted on return
     * 		}
     * 	  } </code></pre>
     *
     * 	<h5>Segment</h5>
     *
     * 	Request: <pre><code> {
     * 	  "name": "string",
     * 	  "type": "segment",
     * 	  "sink": {
     * 		"segmentWriteKey": "string"
     * 	  }
     * 	}</code></pre>
     *
     * 	Response: <pre><code>{
     * 	  "id": "string",
     * 	  "name": "string",
     * 	  "type": "segment",
     * 	  "status": "active",
     * 	  "sink": {
     * 		"segmentWriteKey": "string"
     * 	  }
     * 	} </code></pre>
     *
     * <h5>Splunk Log Stream</h5><pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "splunk",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"splunkDomain": "string",
     * 		"splunkToken": "string",
     * 		"splunkPort": "string",
     * 		"splunkSecure": "boolean"
     * 	}
     * }</code></pre> <h5>Sumo Logic Log Stream</h5><pre><code>{
     * 	"id": "string",
     * 	"name": "string",
     * 	"type": "sumo",
     * 	"status": "active|paused|suspended",
     * 	"sink": {
     * 		"sumoSourceAddress": "string",
     * 	}
     * }</code></pre> <h5>Status</h5> The <code>status</code> of a log stream maybe any of the following:
     * 1. <code>active</code> - Stream is currently enabled.
     * 2. <code>paused</code> - Stream is currently user disabled and will not attempt log delivery.
     * 3. <code>suspended</code> - Stream is currently disabled because of errors and will not attempt log delivery.
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
     * <h4>Examples of how to use the PATCH endpoint.</h4> The following fields may be updated in a PATCH operation: <ul><li>name</li><li>status</li><li>sink</li></ul> Note: For log streams of type <code>eventbridge</code> and <code>eventgrid</code>, updating the <code>sink</code> is not permitted.
     * <h5>Update the status of a log stream</h5><pre><code>{
     * 	"status": "active|paused"
     * }</code></pre>
     * <h5>Update the name of a log stream</h5><pre><code>{
     * 	"name": "string"
     * }</code></pre>
     * <h5>Update the sink properties of a stream of type <code>http</code></h5><pre><code>{
     *   "sink": {
     *     "httpEndpoint": "string",
     *     "httpContentType": "string",
     *     "httpContentFormat": "JSONARRAY|JSONLINES",
     *     "httpAuthorization": "string"
     *   }
     * }</code></pre>
     * <h5>Update the sink properties of a stream of type <code>datadog</code></h5><pre><code>{
     *   "sink": {
     * 		"datadogRegion": "string",
     * 		"datadogApiKey": "string"
     *   }
     * }</code></pre>
     * <h5>Update the sink properties of a stream of type <code>splunk</code></h5><pre><code>{
     *   "sink": {
     *     "splunkDomain": "string",
     *     "splunkToken": "string",
     *     "splunkPort": "string",
     *     "splunkSecure": "boolean"
     *   }
     * }</code></pre>
     * <h5>Update the sink properties of a stream of type <code>sumo</code></h5><pre><code>{
     *   "sink": {
     *     "sumoSourceAddress": "string"
     *   }
     * }</code></pre>
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
