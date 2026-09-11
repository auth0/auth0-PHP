<?php

namespace Auth0\SDK\API\Management\Guardian;

use Auth0\SDK\API\Management\Guardian\Enrollments\EnrollmentsClient;
use Auth0\SDK\API\Management\Guardian\Factors\FactorsClient;
use Auth0\SDK\API\Management\Guardian\Policies\PoliciesClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Types\GetGuardianSettingsResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Guardian\Requests\SetGuardianSettingsRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianSettingsResponseContent;
use Auth0\SDK\API\Management\Guardian\Enrollments\EnrollmentsClientInterface;
use Auth0\SDK\API\Management\Guardian\Factors\FactorsClientInterface;
use Auth0\SDK\API\Management\Guardian\Policies\PoliciesClientInterface;

class GuardianClient implements GuardianClientInterface
{
    /**
     * @var EnrollmentsClient $enrollments
     */
    public EnrollmentsClient $enrollments;

    /**
     * @var FactorsClient $factors
     */
    public FactorsClient $factors;

    /**
     * @var PoliciesClient $policies
     */
    public PoliciesClient $policies;

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
        $this->enrollments = new EnrollmentsClient($this->client, $this->options);
        $this->factors = new FactorsClient($this->client, $this->options);
        $this->policies = new PoliciesClient($this->client, $this->options);
    }

    /**
     * TODO: Link this endpoint to relevant documentation when available.
     *
     * Example:
     * ```php
     * $client->guardian->get();
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
     * @return ?GetGuardianSettingsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(?array $options = null): ?GetGuardianSettingsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "guardian/settings",
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
                return GetGuardianSettingsResponseContent::fromJson($json);
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
     * Update a tenant's guardian settings such as Remember Me
     *
     * Example:
     * ```php
     * $client->guardian->set(
     *     new SetGuardianSettingsRequestContent([
     *         'displayRememberMeCheckbox' => true,
     *         'rememberMeDefaultValue' => true,
     *         'mfaSessionInactivityTimeout' => 1,
     *         'mfaSessionOverallTimeout' => 1,
     *     ]),
     * );
     * ```
     *
     * @param SetGuardianSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianSettingsResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function set(SetGuardianSettingsRequestContent $request, ?array $options = null): ?SetGuardianSettingsResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "guardian/settings",
                    method: HttpMethod::PUT,
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
                return SetGuardianSettingsResponseContent::fromJson($json);
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
     * @return EnrollmentsClientInterface
     */
    public function getEnrollments(): EnrollmentsClientInterface
    {
        return $this->enrollments;
    }

    /**
     * @return FactorsClientInterface
     */
    public function getFactors(): FactorsClientInterface
    {
        return $this->factors;
    }

    /**
     * @return PoliciesClientInterface
     */
    public function getPolicies(): PoliciesClientInterface
    {
        return $this->policies;
    }
}
