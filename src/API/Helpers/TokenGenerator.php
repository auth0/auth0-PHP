<?php namespace Auth0\SDK\API; 

use Firebase\JWT\JWT;    

class TokenGenerator {
    
    protected $client_id;
    protected $client_secret;
    
     /**
     * TokenGenerator Constructor.
     *
     * Configuration:
     *     - client_id              (String)  Required. The id of the application, you can get this in the
     *                                                  auth0 console
     *     - client_secret          (String)  Required. The application secret, same comment as above
     *
     */
    public function __construct($credentials) {
        
        $this->client_id = $credentials['client_id'];
        $this->client_secret = $credentials['client_secret'];
        
    }
    
    protected function bstr2bin($input)
    // Binary representation of a binary-string
    {    
      // Unpack as a hexadecimal string
      $value = $this->str2hex($input);
    
      // Output binary representation
      return base_convert($value, 16, 2);
    }
    
    protected function str2hex($input) {
        $data = unpack('H*', $input);
        return $data[1];
    }
    
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
        
        $secret = base64_decode(strtr($this->client_secret, '-_', '+/'));
        
        $jwt = JWT::encode($payload, $secret);
        
        return $jwt;
    }
    
}