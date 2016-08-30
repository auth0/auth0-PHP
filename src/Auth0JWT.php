<?php

namespace Auth0\SDK;

/**
 * This class provides access to Auth0 JWT decoder.
 *
 * @author Auth0
 * @deprecated This class is provided to bring backward compatibility and will be soon removed. Use Auth0\SDK\JWTVerifier instead
 */
class Auth0JWT {

  public static function decode($jwt, $valid_audiences, $client_secret, array $authorized_iss = [], $cache = null) {

    $verifier = new JWTVerifier([
        'valid_audiences' => is_array($valid_audiences) ? $valid_audiences : [$valid_audiences],
        'client_secret' => $client_secret,
        'authorized_iss' => $authorized_iss,
        'cache' => $cache,
    ]);

    return $verifier->verifyAndDecode($jwt);
  }
}
