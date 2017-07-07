<?php

namespace Auth0\SDK;

use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\JWKFetcher;
use Firebase\JWT\JWT;

class JWTVerifier
{
    /**
     * @var JWKFetcher
     */
    private $JWKFetcher;

    /**
     * @var array
     */
    private $supportedAlgs;

    /**
     * @var array
     */
    private $validAudiences;

    /**
     * @var array
     */
    private $authorizedIss;

    /**
     * @var string|null
     */
    private $clientSecret;

    /**
     * @var bool
     */
    private $secretBase64Encoded = true;

    /**
     * @param array $config {
     *
     *      @var array                           $valid_audiences       Required. The list of audiences accepted by the service
     *      @var string                          $client_secret         Required (if supported HS256). The Auth0 application secret
     *      @var array                           $authorized_iss        Required (if supported RS256). The list of issuers trusted by the service
     *      @var \Psr\SimpleCache\CacheInterface $cache Optional.       Used to cache the JWKs
     *      @var array                           $supported_algs        Optional. The list of supported algorithms. By default only HS256
     *      @var bool                            $secret_base64_encoded Optional. Default true
     * }
     *
     * @throws CoreException
     */
    public function __construct($config)
    {
        $cache = null;

        if (isset($config['cache'])) {
            $cache = $config['cache'];
        }

        if (isset($config['suported_algs'])) {
            throw new CoreException('`suported_algs` was properly renamed to `supported_algs`.');
        }

        if (!isset($config['supported_algs'])) {
            $config['supported_algs'] = ['HS256'];
        }

        if (isset($config['secret_base64_encoded'])) {
            $this->secretBase64Encoded = $config['secret_base64_encoded'];
        }

        if (!isset($config['valid_audiences'])) {
            throw new CoreException('The audience is mandatory');
        }

        if (!isset($config['authorized_iss'])) {
            if (in_array('RS256', $config['supported_algs'])) {
                throw new CoreException('The iss is mandatory when accepting RS256 signed tokens');
            } else {
                $config['authorized_iss'] = [];
            }
        }

        if (in_array('HS256', $config['supported_algs']) && !isset($config['client_secret'])) {
            throw new CoreException('The client_secret is mandatory when accepting HS256 signed tokens');
        }

        $this->supportedAlgs = $config['supported_algs'];
        $this->validAudiences = $config['valid_audiences'];
        $this->authorizedIss = $config['authorized_iss'];

        if (in_array('HS256', $config['supported_algs'])) {
            $this->clientSecret = $config['client_secret'];
        }

        $this->JWKFetcher = new JWKFetcher($cache);
    }

    /**
     * @param string $jwt
     *
     * @throws CoreException
     * @throws InvalidTokenException
     *
     * @return object
     */
    public function verifyAndDecode($jwt)
    {
        $tks = explode('.', $jwt);
        if (count($tks) != 3) {
            throw new InvalidTokenException('Wrong number of segments');
        }

        $headb64 = $tks[0];
        $body64 = $tks[1];
        $head = json_decode(JWT::urlsafeB64Decode($headb64));

        if (!is_object($head) || !isset($head->alg)) {
            throw new InvalidTokenException('Invalid token');
        }

        if (!in_array($head->alg, $this->supportedAlgs)) {
            throw new InvalidTokenException('Invalid signature algorithm');
        }

        if ($head->alg === 'RS256') {
            $body = json_decode(JWT::urlsafeB64Decode($body64));
            if (!in_array($body->iss, $this->authorizedIss)) {
                throw new CoreException("We can't trust on a token issued by: `{$body->iss}`.");
            }
            $secret = $this->JWKFetcher->fetchKeys($body->iss);
        } elseif ($head->alg === 'HS256') {
            if ($this->secretBase64Encoded) {
                $secret = JWT::urlsafeB64Decode($this->clientSecret);
            } else {
                $secret = $this->clientSecret;
            }
        } else {
            throw new InvalidTokenException('Invalid signature algorithm');
        }

        try {
            // Decode the user
            $decodedToken = JWT::decode($jwt, $secret, ['HS256', 'RS256']);
            // validate that this JWT was made for us
            $audience = $decodedToken->aud;
            if (!is_array($audience)) {
                $audience = [$audience];
            }
            if (count(array_intersect($audience, $this->validAudiences)) == 0) {
                throw new InvalidTokenException('This token is not intended for us.');
            }
        } catch (\Exception $e) {
            throw new CoreException($e->getMessage());
        }

        return $decodedToken;
    }
}
