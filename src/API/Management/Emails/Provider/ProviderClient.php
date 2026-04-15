<?php

namespace Auth0\SDK\API\Management\Emails\Provider;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Emails\Provider\Requests\GetEmailProviderRequestParameters;
use Auth0\SDK\API\Management\Types\GetEmailProviderResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Emails\Provider\Requests\CreateEmailProviderRequestContent;
use Auth0\SDK\API\Management\Types\CreateEmailProviderResponseContent;
use Auth0\SDK\API\Management\Emails\Provider\Requests\UpdateEmailProviderRequestContent;
use Auth0\SDK\API\Management\Types\UpdateEmailProviderResponseContent;

class ProviderClient implements ProviderClientInterface
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
     * Retrieve details of the <a href="https://auth0.com/docs/customize/email/smtp-email-providers">email provider configuration</a> in your tenant. A list of fields to include or exclude may also be specified.
     *
     * @param GetEmailProviderRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetEmailProviderResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(GetEmailProviderRequestParameters $request = new GetEmailProviderRequestParameters(), ?array $options = null): ?GetEmailProviderResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "emails/provider",
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
                return GetEmailProviderResponseContent::fromJson($json);
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
     * Create an <a href="https://auth0.com/docs/email/providers">email provider</a>. The <code>credentials</code> object
     * requires different properties depending on the email provider (which is specified using the <code>name</code> property):
     * <ul>
     *   <li><code>mandrill</code> requires <code>api_key</code></li>
     *   <li><code>sendgrid</code> requires <code>api_key</code></li>
     *   <li>
     *     <code>sparkpost</code> requires <code>api_key</code>. Optionally, set <code>region</code> to <code>eu</code> to use
     *     the SparkPost service hosted in Western Europe; set to <code>null</code> to use the SparkPost service hosted in
     *     North America. <code>eu</code> or <code>null</code> are the only valid values for <code>region</code>.
     *   </li>
     *   <li>
     *     <code>mailgun</code> requires <code>api_key</code> and <code>domain</code>. Optionally, set <code>region</code> to
     *     <code>eu</code> to use the Mailgun service hosted in Europe; set to <code>null</code> otherwise. <code>eu</code> or
     *     <code>null</code> are the only valid values for <code>region</code>.
     *   </li>
     *   <li><code>ses</code> requires <code>accessKeyId</code>, <code>secretAccessKey</code>, and <code>region</code></li>
     *   <li>
     *     <code>smtp</code> requires <code>smtp_host</code>, <code>smtp_port</code>, <code>smtp_user</code>, and
     *     <code>smtp_pass</code>
     *   </li>
     * </ul>
     * Depending on the type of provider it is possible to specify <code>settings</code> object with different configuration
     * options, which will be used when sending an email:
     * <ul>
     *   <li>
     *     <code>smtp</code> provider, <code>settings</code> may contain <code>headers</code> object.
     *     <ul>
     *       <li>
     *         When using AWS SES SMTP host, you may provide a name of configuration set in
     *         <code>X-SES-Configuration-Set</code> header. Value must be a string.
     *       </li>
     *       <li>
     *         When using Sparkpost host, you may provide value for
     *         <code>X-MSYS_API</code> header. Value must be an object.
     *       </li>
     *     </ul>
     *   </li>
     *   <li>
     *     for <code>ses</code> provider, <code>settings</code> may contain <code>message</code> object, where you can provide
     *     a name of configuration set in <code>configuration_set_name</code> property. Value must be a string.
     *   </li>
     * </ul>
     *
     * @param CreateEmailProviderRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateEmailProviderResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateEmailProviderRequestContent $request, ?array $options = null): ?CreateEmailProviderResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "emails/provider",
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
                return CreateEmailProviderResponseContent::fromJson($json);
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
     * Delete the email provider.
     *
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
    public function delete(?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "emails/provider",
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
     * Update an <a href="https://auth0.com/docs/email/providers">email provider</a>. The <code>credentials</code> object
     * requires different properties depending on the email provider (which is specified using the <code>name</code> property):
     * <ul>
     *   <li><code>mandrill</code> requires <code>api_key</code></li>
     *   <li><code>sendgrid</code> requires <code>api_key</code></li>
     *   <li>
     *     <code>sparkpost</code> requires <code>api_key</code>. Optionally, set <code>region</code> to <code>eu</code> to use
     *     the SparkPost service hosted in Western Europe; set to <code>null</code> to use the SparkPost service hosted in
     *     North America. <code>eu</code> or <code>null</code> are the only valid values for <code>region</code>.
     *   </li>
     *   <li>
     *     <code>mailgun</code> requires <code>api_key</code> and <code>domain</code>. Optionally, set <code>region</code> to
     *     <code>eu</code> to use the Mailgun service hosted in Europe; set to <code>null</code> otherwise. <code>eu</code> or
     *     <code>null</code> are the only valid values for <code>region</code>.
     *   </li>
     *   <li><code>ses</code> requires <code>accessKeyId</code>, <code>secretAccessKey</code>, and <code>region</code></li>
     *   <li>
     *     <code>smtp</code> requires <code>smtp_host</code>, <code>smtp_port</code>, <code>smtp_user</code>, and
     *     <code>smtp_pass</code>
     *   </li>
     * </ul>
     * Depending on the type of provider it is possible to specify <code>settings</code> object with different configuration
     * options, which will be used when sending an email:
     * <ul>
     *   <li>
     *     <code>smtp</code> provider, <code>settings</code> may contain <code>headers</code> object.
     *     <ul>
     *       <li>
     *         When using AWS SES SMTP host, you may provide a name of configuration set in
     *         <code>X-SES-Configuration-Set</code> header. Value must be a string.
     *       </li>
     *       <li>
     *         When using Sparkpost host, you may provide value for
     *         <code>X-MSYS_API</code> header. Value must be an object.
     *       </li>
     *     </ul>
     *     for <code>ses</code> provider, <code>settings</code> may contain <code>message</code> object, where you can provide
     *     a name of configuration set in <code>configuration_set_name</code> property. Value must be a string.
     *   </li>
     * </ul>
     *
     * @param UpdateEmailProviderRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateEmailProviderResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(UpdateEmailProviderRequestContent $request = new UpdateEmailProviderRequestContent(), ?array $options = null): ?UpdateEmailProviderResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "emails/provider",
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
                return UpdateEmailProviderResponseContent::fromJson($json);
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
