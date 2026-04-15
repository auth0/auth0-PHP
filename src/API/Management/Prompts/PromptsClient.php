<?php

namespace Auth0\SDK\API\Management\Prompts;

use Auth0\SDK\API\Management\Prompts\Rendering\RenderingClient;
use Auth0\SDK\API\Management\Prompts\CustomText\CustomTextClient;
use Auth0\SDK\API\Management\Prompts\Partials\PartialsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Types\GetSettingsResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Prompts\Requests\UpdateSettingsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateSettingsResponseContent;
use Auth0\SDK\API\Management\Prompts\Rendering\RenderingClientInterface;
use Auth0\SDK\API\Management\Prompts\CustomText\CustomTextClientInterface;
use Auth0\SDK\API\Management\Prompts\Partials\PartialsClientInterface;

class PromptsClient implements PromptsClientInterface
{
    /**
     * @var RenderingClient $rendering
     */
    public RenderingClient $rendering;

    /**
     * @var CustomTextClient $customText
     */
    public CustomTextClient $customText;

    /**
     * @var PartialsClient $partials
     */
    public PartialsClient $partials;

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
        $this->rendering = new RenderingClient($this->client, $this->options);
        $this->customText = new CustomTextClient($this->client, $this->options);
        $this->partials = new PartialsClient($this->client, $this->options);
    }

    /**
     * Retrieve details of the Universal Login configuration of your tenant. This includes the <a href="https://auth0.com/docs/authenticate/login/auth0-universal-login/identifier-first">Identifier First Authentication</a> and <a href="https://auth0.com/docs/secure/multi-factor-authentication/fido-authentication-with-webauthn/configure-webauthn-device-biometrics-for-mfa">WebAuthn with Device Biometrics for MFA</a> features.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetSettingsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function getSettings(?array $options = null): ?GetSettingsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "prompts",
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
                return GetSettingsResponseContent::fromJson($json);
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
     * Update the Universal Login configuration of your tenant. This includes the <a href="https://auth0.com/docs/authenticate/login/auth0-universal-login/identifier-first">Identifier First Authentication</a> and <a href="https://auth0.com/docs/secure/multi-factor-authentication/fido-authentication-with-webauthn/configure-webauthn-device-biometrics-for-mfa">WebAuthn with Device Biometrics for MFA</a> features.
     *
     * @param UpdateSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateSettingsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function updateSettings(UpdateSettingsRequestContent $request = new UpdateSettingsRequestContent(), ?array $options = null): ?UpdateSettingsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "prompts",
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
                return UpdateSettingsResponseContent::fromJson($json);
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
     * @return RenderingClientInterface
     */
    public function getRendering(): RenderingClientInterface
    {
        return $this->rendering;
    }

    /**
     * @return CustomTextClientInterface
     */
    public function getCustomText(): CustomTextClientInterface
    {
        return $this->customText;
    }

    /**
     * @return PartialsClientInterface
     */
    public function getPartials(): PartialsClientInterface
    {
        return $this->partials;
    }
}
