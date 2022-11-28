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
 * @see https://auth0.com/docs/api/management/v2#!/Attack_Protection
 */
final class AttackProtection extends ManagementEndpoint implements AttackProtectionInterface
{
    public function getBreachedPasswordDetection(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('attack-protection', 'breached-password-detection')->
            withOptions($options)->
            call();
    }

    public function getBruteForceProtection(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('attack-protection', 'brute-force-protection')->
            withOptions($options)->
            call();
    }

    public function getSuspiciousIpThrottling(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('attack-protection', 'suspicious-ip-throttling')->
            withOptions($options)->
            call();
    }

    public function updateBreachedPasswordDetection(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('patch')->
            addPath('attack-protection', 'breached-password-detection')->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function updateBruteForceProtection(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('patch')->
            addPath('attack-protection', 'brute-force-protection')->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }

    public function updateSuspiciousIpThrottling(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()->
            method('patch')->
            addPath('attack-protection', 'suspicious-ip-throttling')->
            withBody((object) $body)->
            withOptions($options)->
            call();
    }
}
