<?php
namespace Auth0\Tests\API;

use Auth0\SDK\API\Helpers\TokenGenerator;
use josegonzalez\Dotenv\Loader;

class ApiTests extends \PHPUnit_Framework_TestCase
{

    protected function getEnv()
    {
        return self::getEnvStatic();
    }

    protected static function getEnvStatic()
    {
        $env_path = '.env';
        if (file_exists($env_path)) {
            $loader = new Loader($env_path);
            $loader->parse()->putenv(true);
        }

        return [
        "GLOBAL_CLIENT_ID" => getenv('GLOBAL_CLIENT_ID'),
        "GLOBAL_CLIENT_SECRET" => getenv('GLOBAL_CLIENT_SECRET'),
        "APP_CLIENT_ID" => getenv('APP_CLIENT_ID'),
        "APP_CLIENT_SECRET" => getenv('APP_CLIENT_SECRET'),
        "NIC_ID" => getenv('NIC_ID'),
        "NIC_SECRET" => getenv('NIC_SECRET'),
        "DOMAIN" => getenv('DOMAIN'),
        ];
    }

    protected function getToken($env, $scopes)
    {
        return self::getTokenStatic($env, $scopes);
    }

    protected static function getTokenStatic($env, $scopes)
    {
        $generator = new TokenGenerator([
        'client_id' => $env['GLOBAL_CLIENT_ID'],
        'client_secret' => $env['GLOBAL_CLIENT_SECRET']
        ]);
        return $generator->generate($scopes);
    }
}
