<?php namespace Auth0\SDK\API\Helpers;

use Firebase\JWT\JWT;

class TokenGenerator {

    /**
     * @var string
     */
    protected $client_id;

    /**
     * @var string
     */
    protected $client_secret;

     /**
     * TokenGenerator Constructor.
     *
     * Configuration:
     *     - client_id              (String)  Required. The id of the application, you can get this in the
     *                                                  auth0 console
     *     - client_secret          (String)  Required. The application secret, same comment as above
     *
     * @param array $credentials
     */
    public function __construct($credentials) {

      if (!isset($credentials['secret_base64_encoded'])) {
        $credentials['secret_base64_encoded'] = true;
      }

      $this->client_id = $credentials['client_id'];
      $this->client_secret = $credentials['client_secret'];
      $this->secret_base64_encoded = $credentials['secret_base64_encoded'];

    }

    /**
     * @param string $input
     * @return string
     */
    protected function bstr2bin($input)
    // Binary representation of a binary-string
    {
      // Unpack as a hexadecimal string
      $value = $this->str2hex($input);

      // Output binary representation
      return base_convert($value, 16, 2);
    }

    /**
     * @param string $input
     * @return mixed
     */
    protected function str2hex($input) {
        $data = unpack('H*', $input);
        return $data[1];
    }

    /**
     * @param $scopes
     * @param int $lifetime
     * @return string
     */
    public function generate($scopes, $lifetime = 36000) {

        $time = time();

        $payload = array(
            "iat" => $time,
            "scopes" => $scopes
        );

        $jti = md5(json_encode($payload));

        $payload['jti'] = $jti;
        $payload["exp"] = $time + $lifetime;
        $payload["aud"] = $this->client_id;

        if ($this->secret_base64_encoded) {
          $secret = base64_decode(strtr($this->client_secret, '-_', '+/'));
        } else {
          $secret = $this->client_secret;
        }

        $jwt = JWT::encode($payload, $secret);

        return $jwt;
    }

}