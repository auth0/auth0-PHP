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

        $auth0Api = new \Auth0\SDK\Auth0Api($this->token, getenv('AUTH0_DOMAIN'));
        $userData = $auth0Api->users->get($this->tokenInfo->sub);
        
        return array(
            "status" => 'ok',
            "message" => 'Shh, it\' secret',
            "user" => array(
                "email" => $userData["email"],
                "name" => $userData["name"]
            )
        );
    }

}
