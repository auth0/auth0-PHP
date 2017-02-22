<?php

namespace App;

use Auth0\SDK\JWTVerifier;

class Main {

    protected $token;
    protected $tokenInfo;

    public function setCurrentToken($token) {

        try {
          $verifier = new JWTVerifier([
            'supported_algs' => ['RS256'],
            'valid_audiences' => [getenv('AUTH0_AUDIENCE')],
            'authorized_iss' => ['https://' . getenv('AUTH0_DOMAIN') . '/']
          ]);

          $this->token = $token;
          $this->tokenInfo = $verifier->verifyAndDecode($token);
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
