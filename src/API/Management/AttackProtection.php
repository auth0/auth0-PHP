<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\AttackProtectionInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Attack Protection.
 * Handles requests to the Attack Protection endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Attack_Protection
 */
final class AttackProtection extends ManagementEndpoint implements AttackProtectionInterface
{
    /**
     * Get breached password detection settings.
     * Required scope: `read:attack_protection`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Attack_Protection/get_breached_password_detection
     */
    public function getBreachedPasswordDetection(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('get')
            ->addPath('attack-protection', 'breached-password-detection')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get the brute force configuration.
     * Required scope: `read:attack_protection`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Attack_Protection/get_brute_force_protection
     */
    public function getBruteForceProtection(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('get')
            ->addPath('attack-protection', 'brute-force-protection')
            ->withOptions($options)
            ->call();
    }

    /**
     * Get the suspicious IP throttling configuration.
     * Required scope: `read:attack_protection`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Attack_Protection/get_suspicious_ip_throttling
     */
    public function getSuspiciousIpThrottling(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('get')
            ->addPath('attack-protection', 'suspicious-ip-throttling')
            ->withOptions($options)
            ->call();
    }

    /**
     * Update breached password detection settings.
     * Required scope: `update:attack_protection`
     *
     * @param array<mixed>        $body    Body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `body` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Attack_Protection/patch_breached_password_detection
     */
    public function updateBreachedPasswordDetection(
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
            ->addPath('attack-protection', 'breached-password-detection')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update the brute force configuration.
     * Required scope: `update:attack_protection`
     *
     * @param array<mixed>        $body    Body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Attack_Protection/patch_brute_force_protection
     */
    public function updateBruteForceProtection(
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
            ->addPath('attack-protection', 'brute-force-protection')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update the suspicious IP throttling configuration.
     * Required scope: `update:attack_protection`
     *
     * @param array<mixed>        $body    Body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Attack_Protection/patch_suspicious_ip_throttling
     */
    public function updateSuspiciousIpThrottling(
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
            ->addPath('attack-protection', 'suspicious-ip-throttling')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }
}
