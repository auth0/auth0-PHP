<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface AttackProtectionInterface.
 */
interface AttackProtectionInterface
{
    /**
     * Get breached password detection settings.
     * Required scope: `read:attack_protection`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Attack_Protection/get_breached_password_detection
     */
    public function getBreachedPasswordDetection(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get the brute force configuration.
     * Required scope: `read:attack_protection`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Attack_Protection/get_brute_force_protection
     */
    public function getBruteForceProtection(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get the suspicious IP throttling configuration.
     * Required scope: `read:attack_protection`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Attack_Protection/get_suspicious_ip_throttling
     */
    public function getSuspiciousIpThrottling(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update breached password detection settings.
     * Required scope: `update:attack_protection`.
     *
     * @param  array<mixed>  $body  Body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Attack_Protection/patch_breached_password_detection
     */
    public function updateBreachedPasswordDetection(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update the brute force configuration.
     * Required scope: `update:attack_protection`.
     *
     * @param  array<mixed>  $body  Body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Attack_Protection/patch_brute_force_protection
     */
    public function updateBruteForceProtection(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update the suspicious IP throttling configuration.
     * Required scope: `update:attack_protection`.
     *
     * @param  array<mixed>  $body  Body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Attack_Protection/patch_suspicious_ip_throttling
     */
    public function updateSuspiciousIpThrottling(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
