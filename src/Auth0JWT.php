<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/23/15
 * Time: 12:24 PM
 */

namespace Auth0\SDK;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\ApiException;
use Firebase\JWT\JWT;

/**
 * @deprecated
 */
class Auth0JWT {

    public static function decode($jwt, $valid_audiences, $client_secret, array $authorized_iss = []) {

        if (!is_array($valid_audiences)) {
            $valid_audiences = [$valid_audiences];
        }
        
        $tks = explode('.', $jwt);
        if (count($tks) != 3) {
            throw new InvalidTokenException('Wrong number of segments');
        }
        $headb64 = $tks[0];
        $body64 = $tks[1];
        $head = json_decode(JWT::urlsafeB64Decode($headb64));

        if ( !is_object($head) || ! isset($head->alg))
        {
            throw new InvalidTokenException("Invalid token");
        }

        if ($head->alg === 'RS256') {
            $body = json_decode(JWT::urlsafeB64Decode($body64));
            if ( !in_array($body->iss, $authorized_iss) ) {
                throw new CoreException("We can't trust on a token issued by: `{$body->iss}`.");
            }
            $secret = self::fetch_public_key($body->iss);
        } elseif ($head->alg === 'HS256') {
            $secret = JWT::urlsafeB64Decode($client_secret);
        } else {
            throw new CoreException("Invalid signature algorithm");
        }
        
        try {
            // Decode the user
            $decodedToken = JWT::decode($jwt, $secret, array('HS256', 'RS256'));
            // validate that this JWT was made for us
            $audience = $decodedToken->aud;
            if (! is_array($audience)) {
                $audience = [$audience];
            }
            if (count(array_intersect($audience, $valid_audiences)) == 0) {
                throw new CoreException("This token is not intended for us.");
            }
        } catch(\Exception $e) {
            throw new CoreException($e->getMessage());
        }
        return $decodedToken;
    }

    /**
     * $scopes: should be an array with the follow structure:
     *
     *          'scope' => [
     *              'actions' => ['action1', 'action2']
     *          ],
     *          'scope2' => [
     *              'actions' => ['action1', 'action2']
     *          ]
     */
    public static function encode($audience, $client_secret, $scopes = null, $custom_payload = null, $lifetime = 36000) {

        $time = time();

        $payload = array(
            "iat" => $time,
        );

        if ($scopes) {
            $payload["scopes"] = $scopes;
        }

        if ($custom_payload) {
            $payload = array_merge($custom_payload, $payload);
        }

        $jti = md5(json_encode($payload));

        $payload['jti'] = $jti;
        $payload["exp"] = $time + $lifetime;
        $payload["aud"] = $audience;

        $secret = base64_decode(strtr($client_secret, '-_', '+/'));

        $jwt = JWT::encode($payload, $secret);

        return $jwt;

    }

}
