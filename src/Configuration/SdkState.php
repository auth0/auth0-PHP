<?php

declare(strict_types=1);

namespace Auth0\SDK\Configuration;

use Auth0\SDK\Contract\ConfigurableContract;
use Auth0\SDK\Mixins\ConfigurableMixin;

/**
 * Internal state container for use with Auth0\SDK
 */
final class SdkState implements ConfigurableContract
{
    use ConfigurableMixin;

    /**
     * SdkState Constructor
     *
     * @param array|null $configuration Optional. Pass an array of parameter keys and values to define the internal state of the SDK.
     */
    public function __construct(
        ?array $configuration = null,
        ?string $idToken = null,
        ?string $accessToken = null,
        ?string $refreshToken = null,
        ?array $idTokenDecoded = null,
        ?array $user = null,
        ?string $tokenExpiration = null
    ) {
        $this->setState(func_get_args());
    }
}
