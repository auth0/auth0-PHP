<?php
namespace Auth0\Tests;

use Auth0\SDK\API\Helpers\TokenGenerator;
use M1\Env\Parser;

class ApiTests extends \PHPUnit_Framework_TestCase {
  protected function getEnv() {
    $env = new Parser(file_get_contents('.env'));
    return $env->getContent();
  }

  protected function getToken($env, $scopes) {
    $generator = new TokenGenerator([ 'client_id' => $env['GLOBAL_CLIENT_ID'], 'client_secret' => $env['GLOBAL_CLIENT_SECRET' ] ]);
    return $generator->generate($scopes);
  }
}