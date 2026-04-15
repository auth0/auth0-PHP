<?php

namespace Auth0\SDK\API\Management\Guardian\Factors;

use Auth0\SDK\API\Management\Types\GuardianFactor;
use Auth0\SDK\API\Management\Types\GuardianFactorNameEnum;
use Auth0\SDK\API\Management\Guardian\Factors\Requests\SetGuardianFactorRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Phone\PhoneClientInterface;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\PushNotificationClientInterface;
use Auth0\SDK\API\Management\Guardian\Factors\Sms\SmsClientInterface;
use Auth0\SDK\API\Management\Guardian\Factors\Duo\DuoClientInterface;

interface FactorsClientInterface
{
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
     */
    public function list(?array $options = null): ?array;

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
     */
    public function set(string $name, SetGuardianFactorRequestContent $request, ?array $options = null): ?SetGuardianFactorResponseContent;

    /**
     * @return PhoneClientInterface
     */
    public function getPhone(): PhoneClientInterface;

    /**
     * @return PushNotificationClientInterface
     */
    public function getPushNotification(): PushNotificationClientInterface;

    /**
     * @return SmsClientInterface
     */
    public function getSms(): SmsClientInterface;

    /**
     * @return DuoClientInterface
     */
    public function getDuo(): DuoClientInterface;
}
