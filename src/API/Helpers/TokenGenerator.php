<?php namespace Auth0\SDK\API\Helpers;

use Firebase\JWT\JWT;

/**
 * Class TokenGenerator.
 * Generates HS256 ID tokens.
 *
 * @package Auth0\SDK\API\Helpers
 */
class TokenGenerator
{
    /**
     * Default token expiration time.
     */
    const DEFAULT_LIFETIME = 3600;

    /**
     * Client ID for the token.
     *
     * @var string
     */
    protected $client_id;

    /**
     * Client Secret for the token.
     *
     * @var string
     */
    protected $client_secret;

    /**
     * TokenGenerator constructor.
     *
     * @param string $client_id     Client ID to use.
     * @param string $client_secret Client Secret to use.
     */
    public function __construct($client_id, $client_secret)
    {
        $this->client_id     = $client_id;
        $this->client_secret = $client_secret;
    }

    /**
     * Create the ID token.
     *
     * @param array   $scopes         Array of scopes to include.
     * @param integer $lifetime       Lifetime of the token.
     * @param boolean $secret_encoded True to base64 decode the client secret.
     *
     * @return string
     */
    public function generate(array $scopes, $lifetime = self::DEFAULT_LIFETIME, $secret_encoded = true)
    {
        $time           = time();
        $payload        = [
            'iat' => $time,
            'scopes' => $scopes,
            'exp' => $time + $lifetime,
            'aud' => $this->client_id,
        ];
        $payload['jti'] = md5(json_encode($payload));

        $secret = $secret_encoded ? base64_decode(strtr($this->client_secret, '-_', '+/')) : $this->client_secret;

        return JWT::encode($payload, $secret);
    }
}
