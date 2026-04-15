<?php

namespace Auth0\SDK\API\Management\Branding;

use Auth0\SDK\API\Management\Branding\Templates\TemplatesClient;
use Auth0\SDK\API\Management\Branding\Themes\ThemesClient;
use Auth0\SDK\API\Management\Branding\Phone\PhoneClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Types\GetBrandingResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Branding\Requests\UpdateBrandingRequestContent;
use Auth0\SDK\API\Management\Types\UpdateBrandingResponseContent;
use Auth0\SDK\API\Management\Branding\Templates\TemplatesClientInterface;
use Auth0\SDK\API\Management\Branding\Themes\ThemesClientInterface;
use Auth0\SDK\API\Management\Branding\Phone\PhoneClientInterface;

class BrandingClient implements BrandingClientInterface
{
    /**
     * @var TemplatesClient $templates
     */
    public TemplatesClient $templates;

    /**
     * @var ThemesClient $themes
     */
    public ThemesClient $themes;

    /**
     * @var PhoneClient $phone
     */
    public PhoneClient $phone;

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
        $this->templates = new TemplatesClient($this->client, $this->options);
        $this->themes = new ThemesClient($this->client, $this->options);
        $this->phone = new PhoneClient($this->client, $this->options);
    }

    /**
     * Retrieve branding settings.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetBrandingResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(?array $options = null): ?GetBrandingResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "branding",
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
                return GetBrandingResponseContent::fromJson($json);
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
     * Update branding settings.
     *
     * @param UpdateBrandingRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateBrandingResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(UpdateBrandingRequestContent $request = new UpdateBrandingRequestContent(), ?array $options = null): ?UpdateBrandingResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "branding",
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
                return UpdateBrandingResponseContent::fromJson($json);
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
     * @return TemplatesClientInterface
     */
    public function getTemplates(): TemplatesClientInterface
    {
        return $this->templates;
    }

    /**
     * @return ThemesClientInterface
     */
    public function getThemes(): ThemesClientInterface
    {
        return $this->themes;
    }

    /**
     * @return PhoneClientInterface
     */
    public function getPhone(): PhoneClientInterface
    {
        return $this->phone;
    }
}
