<?php

namespace Auth0\SDK\API\Management\Guardian\Factors;

use Auth0\SDK\API\Management\Guardian\Factors\Phone\PhoneClient;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\PushNotificationClient;
use Auth0\SDK\API\Management\Guardian\Factors\Sms\SmsClient;
use Auth0\SDK\API\Management\Guardian\Factors\Duo\DuoClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Types\GuardianFactor;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use Auth0\SDK\API\Management\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Types\GuardianFactorNameEnum;
use Auth0\SDK\API\Management\Guardian\Factors\Requests\SetGuardianFactorRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Phone\PhoneClientInterface;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\PushNotificationClientInterface;
use Auth0\SDK\API\Management\Guardian\Factors\Sms\SmsClientInterface;
use Auth0\SDK\API\Management\Guardian\Factors\Duo\DuoClientInterface;

class FactorsClient implements FactorsClientInterface
{
    /**
     * @var PhoneClient $phone
     */
    public PhoneClient $phone;

    /**
     * @var PushNotificationClient $pushNotification
     */
    public PushNotificationClient $pushNotification;

    /**
     * @var SmsClient $sms
     */
    public SmsClient $sms;

    /**
     * @var DuoClient $duo
     */
    public DuoClient $duo;

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
        $this->phone = new PhoneClient($this->client, $this->options);
        $this->pushNotification = new PushNotificationClient($this->client, $this->options);
        $this->sms = new SmsClient($this->client, $this->options);
        $this->duo = new DuoClient($this->client, $this->options);
    }

    /**
     * Retrieve details of all <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors">multi-factor authentication factors</a> associated with your tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<GuardianFactor>
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
                    path: "guardian/factors",
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
                return JsonDecoder::decodeArray($json, [GuardianFactor::class]); // @phpstan-ignore-line
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
     * Update the status (i.e., enabled or disabled) of a specific multi-factor authentication factor.
     *
     * @param value-of<GuardianFactorNameEnum> $name Factor name. Can be `sms`, `push-notification`, `email`, `duo` `otp` `webauthn-roaming`, `webauthn-platform`, or `recovery-code`.
     * @param SetGuardianFactorRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function set(string $name, SetGuardianFactorRequestContent $request, ?array $options = null): ?SetGuardianFactorResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "guardian/factors/{$name}",
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
                return SetGuardianFactorResponseContent::fromJson($json);
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
     * @return PhoneClientInterface
     */
    public function getPhone(): PhoneClientInterface
    {
        return $this->phone;
    }

    /**
     * @return PushNotificationClientInterface
     */
    public function getPushNotification(): PushNotificationClientInterface
    {
        return $this->pushNotification;
    }

    /**
     * @return SmsClientInterface
     */
    public function getSms(): SmsClientInterface
    {
        return $this->sms;
    }

    /**
     * @return DuoClientInterface
     */
    public function getDuo(): DuoClientInterface
    {
        return $this->duo;
    }
}
