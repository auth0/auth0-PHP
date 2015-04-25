<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/23/15
 * Time: 12:24 PM
 */

namespace Auth0\SDK;


class Auth0JWT {

    public static function decode($jwt, $client_id, $client_secret) {

        $secret = base64_decode(strtr($client_secret, '-_', '+/'));

        try {
            // Decode the user
            $decodedToken = \JWT::decode($jwt, $secret, ['HS256']);
            // validate that this JWT was made for us
            if ($decodedToken->aud != $client_id) {
                throw new CoreException("This token is not intended for us.");
            }
        } catch(\UnexpectedValueException $e) {
            throw new CoreException($e->getMessage());
        }

        return $decodedToken;
    }

}