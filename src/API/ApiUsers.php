<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\ApiClient;
use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;
use Auth0\SDK\API\Header\ContentType;

class ApiUsers {

    protected static function getApiV2Client($domain) {

        $apiDomain = "https://$domain";

        $client = new ApiClient(array(
            'domain' => $apiDomain,
            'basePath' => '/api/v2',
        ));
        return $client;
    }

    public static function get($domain, $token, $user_id) {

        $user_info = self::getApiV2Client($domain)->get()
            ->users($user_id)
            ->withHeader(new AuthorizationBearer($token))
            ->call();

        return $user_info;
    }

    public static function update($domain, $token, $user_id, $data) {

        $user_info = self::getApiV2Client($domain)->patch()
            ->users($user_id)
            ->withHeader(new AuthorizationBearer($token))
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();

        return $user_info;
    }

    public static function create($domain, $token, $data) {

        $user_info = self::getApiV2Client($domain)->post()
            ->users()
            ->withHeader(new AuthorizationBearer($token))
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($data))
            ->call();

        return $user_info;
    }

    public static function search($domain, $token, $params) {

        $client = self::getApiV2Client($domain)->get()
            ->users()
            ->withHeader(new AuthorizationBearer($token))
            ->withHeader(new ContentType('application/json'));

        foreach ($params as $param => $value) {
            $client->withParam($param, $value);
        }

        return $client->call();
    }

    public static function deleteAll($domain, $token) {

        self::getApiV2Client($domain)->delete()
            ->users()
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function delete($domain, $token, $user_id) {

        self::getApiV2Client($domain)->delete()
            ->users($user_id)
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function getDevices($domain, $token, $user_id) {

        self::getApiV2Client($domain)->get()
            ->users($user_id)
            ->devices()
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function linkAccount($domain, $token, $user_id, $post_identities_body) {

        return self::getApiV2Client($domain)->post()
            ->users($user_id)
            ->identities()
            ->withHeader(new AuthorizationBearer($token))
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($post_identities_body))
            ->call();
    }

    public static function unlinkAccount($domain, $token, $user_id, $provider, $identity_id) {

        return self::getApiV2Client($domain)->delete()
            ->users($user_id)
            ->identities($provider)
            ->addPathVariable($identity_id)
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function unlinkDevice($domain, $token, $user_id, $device_id) {
        self::getApiV2Client($domain)->delete()
            ->users($user_id)
            ->devices($device_id)
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function deleteMultifactorProvider($domain, $token, $user_id, $multifactor_provider) {
        self::getApiV2Client($domain)->delete()
            ->users($user_id)
            ->multifactor($multifactor_provider)
            ->withHeader(new AuthorizationBearer($token))
            ->call();
    }

    public static function createEmailVerificationTicket($domain, $token, $user_id, $result_url = null) {

        $body = array('user_id' => $user_id);
        if ($result_url !== null) {
            $body['result_url'] = $result_url;
        }

        $request = self::getApiV2Client($domain)->post()
            ->tickets()
            ->addPath('email-verification')
            ->withHeader(new ContentType('application/json'))
            ->withHeader(new AuthorizationBearer($token))
            ->withBody(json_encode($body));

        return $request->call();

    }

    public static function createPasswordChangeTicket($domain, $token, $user_id, $new_password, $result_url = null) {

        $body = array(
            'user_id' => $user_id,
            'new_password' => $new_password
        );

        if ($result_url) {
            $body['result_url'] = $result_url;
        }

        return self::getApiV2Client($domain)->post()
            ->tickets()
            ->addPath('password-change')
            ->withHeader(new AuthorizationBearer($token))
            ->withBody(json_encode($body))
            ->call();

    }

}
