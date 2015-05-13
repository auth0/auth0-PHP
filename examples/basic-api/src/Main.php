<?php

namespace App;

class Main {

    protected $token;
    protected $tokenInfo;

    public function setCurrentToken($token) {

        try {
            $this->tokenInfo = \Auth0\SDK\Auth0JWT::decode($token, getenv('AUTH0_CLIENT_ID'), getenv('AUTH0_CLIENT_SECRET'));
            $this->token = $token;
        }
        catch(\Auth0\SDK\Exception\CoreException $e) {
          throw $e;
        }
    }

    public function publicPing(){
        return array(
            "status" => 'ok',
            "message" => 'Everybody can do this...'
        );
    }

    public function privatePing(){

        $userData = \Auth0\SDK\Api\ApiUsers::get(getenv('AUTH0_DOMAIN'),$this->token, $this->tokenInfo->sub);

        return array(
            "status" => 'ok',
            "message" => 'Shh, it\' secret',
            "user" => array(
                "email" => $userData["email"],
                "username" => $userData["username"]
            )
        );
    }

}
