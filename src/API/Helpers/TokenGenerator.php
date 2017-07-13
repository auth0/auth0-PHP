<?php

namespace Auth0\SDK\API\Helpers;

use Firebase\JWT\JWT;

final class TokenGenerator
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var bool
     */
    private $secretBase64Encoded = true;

    /**
     * @param array $credentials {
     *
     *     @var string $client_id     Required. The id of the application, you can get this in the auth0 console
     *     @var string $client_secret Required. The application secret, same comment as above
     *     @var bool   $replace       Optional.
     * }
     */
    public function __construct(array $credentials)
    {
        if (isset($credentials['secret_base64_encoded'])) {
            $this->secretBase64Encoded = $credentials['secret_base64_encoded'];
        }

        $this->clientId = $credentials['client_id'];
        $this->clientSecret = $credentials['client_secret'];
    }

    /**
     * Binary representation of a binary-string.
     *
     * @param string $input
     *
     * @return string
     */
    protected function bstr2bin($input)
    {
        // Unpack as a hexadecimal string
        $value = $this->str2hex($input);

        // Output binary representation
        return base_convert($value, 16, 2);
    }

    /**
     * @param string $input
     *
     * @return mixed
     */
    protected function str2hex($input)
    {
        $data = unpack('H*', $input);

        return $data[1];
    }

    /**
     * @param $scopes
     * @param int $lifetime
     *
     * @return string
     */
    public function generate($scopes, $lifetime = 36000)
    {
        $time = time();

        $payload = [
            'iat'    => $time,
            'scopes' => $scopes,
        ];

        $jti = md5(json_encode($payload));

        $payload['jti'] = $jti;
        $payload['exp'] = $time + $lifetime;
        $payload['aud'] = $this->clientId;

        if ($this->secretBase64Encoded) {
            $secret = base64_decode(strtr($this->clientSecret, '-_', '+/'));
        } else {
            $secret = $this->clientSecret;
        }

        $jwt = JWT::encode($payload, $secret);

        return $jwt;
    }
}
