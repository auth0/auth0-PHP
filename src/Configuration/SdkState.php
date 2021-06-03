<?php

declare(strict_types=1);

namespace Auth0\SDK\Configuration;

use Auth0\SDK\Contract\ConfigurableContract;
use Auth0\SDK\Mixins\ConfigurableMixin;

/**
 * Internal state container for use with Auth0\SDK
 *
 * @method SdkState setIdToken(?string $idToken = null)
 * @method SdkState setAccessToken(?string $accessToken = null)
 * @method SdkState setRefreshToken(?string $refreshToken = null)
 * @method SdkState setIdTokenDecoded(?array $idTokenDecoded = null)
 * @method SdkState setUser(?array $user = null)
 * @method SdkState setAccessTokenExpiration(?int $accessTokenExpiration = null)
 *
 * @method string|null getIdToken()
 * @method string|null getAccessToken()
 * @method string|null getRefreshToken()
 * @method array<mixed>|null getIdTokenDecoded()
 * @method array<mixed>|null getUser()
 * @method int|null getAccessTokenExpiration()
 *
 * @method bool hasIdToken()
 * @method bool hasAccessToken()
 * @method bool hasRefreshToken()
 * @method bool hasIdTokenDecoded()
 * @method bool hasUser()
 * @method bool hasAccessTokenExpiration()
 */
final class SdkState implements ConfigurableContract
{
    use ConfigurableMixin;

    /**
     * SdkState Constructor
     *
     * @param array<mixed>|null $configuration         Optional. Pass an array of parameter keys and values to define the internal state of the SDK.
     * @param string|null       $idToken               Optional. The id token currently in use for the session, if available.
     * @param string|null       $accessToken           Optional. The access token currently in use for the session, if available.
     * @param string|null       $refreshToken          Optional. The refresh token currently in use for the session, if available.
     * @param array<mixed>|null $idTokenDecoded        Optional. An array representing the id token in it's decoded form, if available.
     * @param array<mixed>|null $user                  Optional. An array representing the user data, if available.
     * @param int|null          $accessTokenExpiration Optional. When the $accessToken is expected to expire, if available.
     */
    public function __construct(
        ?array $configuration = null,
        ?string $idToken = null,
        ?string $accessToken = null,
        ?string $refreshToken = null,
        ?array $idTokenDecoded = null,
        ?array $user = null,
        ?int $accessTokenExpiration = null
    ) {
        $this->setState(func_get_args());
    }
}
