<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\ApiClient;
use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;
use Auth0\SDK\API\Header\ContentType;

class ApiUsers {

    protected static function getApiV2Client() {
        return new ApiClient(array(
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ));
    }

    public static function get($token, $user_id) {

        $user_info = self::getApiV2Client()->get()
            ->users($user_id)
            ->withHeader(new AuthorizationBearer($token))
            ->call();

        return $user_info;
    }

    public static function update($token, $user_id, $data) {

        $user_info = self::getApiV2Client()->patch()
            ->users($user_id)
            ->withHeader(new AuthorizationBearer($token))
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();

        return $user_info;
    }

    public static function create($token, $data) {

        $user_info = self::getApiV2Client()->post()
            ->users()
            ->withHeader(new AuthorizationBearer($token))
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();

        return $user_info;
    }

    public static function search($token, $params) {

        $client = self::getApiV2Client()->post()
            ->users()
            ->withHeader(new AuthorizationBearer($token))
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data));

        foreach ($params as $param => $value) {
            $client->withParam($param, $value);
        }

        return $client->call();
    }

    public static function deleteAll($token) {

        self::getApiV2Client()->delete()
            ->users()
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function delete($token, $user_id) {

        self::getApiV2Client()->delete()
            ->users($user_id)
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function getDevices($token, $user_id) {

        self::getApiV2Client()->get()
            ->users($user_id)
            ->devices()
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function linkAccount($token, $user_id, $post_identities_body) {

        return self::getApiV2Client()->post()
            ->users($user_id)
            ->devices()
            ->withHeader(new AuthorizationBearer($token))
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($body))
            ->call();
    }

    public static function unlinkAccount($token, $user_id, $multifactor_provider, $identity) {

        return self::getApiV2Client()->delete()
            ->users($user_id)
            ->addPathVariable($identity)
            ->identities($multifactor_provider)
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function unlinkDevice($token, $user_id, $device_id) {
        self::getApiV2Client()->delete()
            ->users($user_id)
            ->devices($device_id)
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function deleteMultifactorProvider($token, $user_id, $multifactor_provider) {
        self::getApiV2Client()->delete()
            ->users($user_id)
            ->multifactor($multifactor_provider)
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function createEmailVerificationTicket($token, $user_id, $result_url = null) {

        $request = self::getApiV2Client()->post()
            ->users($user_id)
            ->tickets()
            ->email_verification()
            ->withHeader(new AuthorizationBearer($token));

        if ($result_url) {
            $body = json_encode(array(
                'result_url' => $result_url
            ));
            $request->withBody($body);
        }

        return $request->call();

    }

    public static function createPasswordChangeTicket($token, $user_id, $new_password, $result_url = null) {

        $body = array(
            'new_password' => $new_password
        );

        if ($result_url) {
            $body['result_url'] = $result_url;
        }

        return self::getApiV2Client()->post()
            ->users($user_id)
            ->tickets()
            ->email_verification()
            ->withHeader(new AuthorizationBearer($token))
            ->withBody(json_encode($body))
            ->call();

    }

}
