<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/23/15
 * Time: 12:24 PM
 */

namespace Auth0\SDK;

use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\ApiException;
use Firebase\JWT\JWT;

class Auth0JWT {

    public static function decode($jwt, $client_id, $client_secret) {

        $secret = base64_decode(strtr($client_secret, '-_', '+/'));

        try {
            // Decode the user
            $decodedToken = JWT::decode($jwt, $secret, array('HS256'));
            // validate that this JWT was made for us
            if ($decodedToken->aud != $client_id) {
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
    public static function encode($client_id, $client_secret, $scopes = null, $custom_payload = null, $lifetime = 36000) {

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
            $payload["aud"] = $client_id;

            $secret = base64_decode(strtr($client_secret, '-_', '+/'));

            $jwt = JWT::encode($payload, $secret);

            return $jwt;


    }

}
