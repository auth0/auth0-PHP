<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\Contract\Token\GeneratorInterface;
use Auth0\SDK\Exception\TokenException;
use Auth0\SDK\Token;
use OpenSSLAsymmetricKey;
use Throwable;

final class Generator implements GeneratorInterface
{
    /**
     * Supported algorithms for token generation.
     */
    public const CONST_SUPPORTED_ALGOS = [
        Token::ALGO_RS256,
        Token::ALGO_HS256,
    ];

    /**
     * Minimum signing key lengths for token generation.
     */
    public const CONST_ALGO_MIN_LENGTHS = [
        Token::ALGO_RS256 => 2048,
        Token::ALGO_HS256 => 2048
    ];

    /**
     * Maximum signing key lengths for token generation.
     */
    public const CONST_ALGO_MAX_LENGTHS = [
        Token::ALGO_RS256 => 4096,
        Token::ALGO_HS256 => 4096
    ];

    /**
     * Supported key types for token generation.
     */
    public const CONST_SUPPORTED_KEY_TYPES = [
        OPENSSL_KEYTYPE_RSA => 'RSA',
        OPENSSL_KEYTYPE_DSA => 'DSA',
        OPENSSL_KEYTYPE_DH => 'DH',
        OPENSSL_KEYTYPE_EC => 'EC',
    ];

    public static function create(
        OpenSSLAsymmetricKey|string $signingKey,
        string $algorithm = Token::ALGO_RS256,
        array $claims = [],
        array $headers = [],
        null|string $signingKeyPassphrase = null
    ): static {
        return new self(
            signingKey: $signingKey,
            algorithm: $algorithm,
            claims: $claims,
            headers: $headers,
            signingKeyPassphrase: $signingKeyPassphrase
        );
    }

    public function toArray(
        $encodeSegments = true
    ): array {
        // Build token from headers and claims.
        $segments = [
            static::encode(data: $this->headers, segment: 'headers', skip: !$encodeSegments),
            static::encode(data: $this->claims, segment: 'claims', skip: !$encodeSegments)
        ];

        // Sign the token.
        $signature = $this->sign(
            data: $this->glue($segments)
        );

        // Attach the signature to the token.
        $segments[] = $signature;

        if (! $encodeSegments) {
            return [
                'headers' => $this->headers,
                'claims' => $this->claims,
                'signature' => $signature
            ];
        }

        // Return the token with encoded segments.
        return $segments;
    }

    public function toString(): string
    {
        return $this->glue(array_values($this->toArray()));
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Create a new token generator instance.
     *
     * @param OpenSSLAsymmetricKey|string $signingKey Signing key to use for signing the token. This MUST be a string for HS256. MUST be either a string or OpenSSLAsymmetricKey for RS256.
     * @param string $algorithm Algorithm to use for signing the token. Defaults to RS256.
     * @param array<mixed> $claims Claims to include in the token. Defaults to an empty array.
     * @param array<string> $headers Headers to include in the token. Defaults to an empty array. The the "alg" header will be set to represent $algorithm appropriately.
     * @param null|string $signingKeyPassphrase Optional. Passphrase to use for signing key if it is encrypted. Defaults to null.
     *
     * @throws TokenException When an unsupported algorithm is provided.
     * @throws TokenException When a non-string $signingKey is provided for HS256.
     * @throws TokenException When a string $signingKey is used with RS256.
     * @throws TokenException When using RS256 and openssl_pkey_get_private() is unable to load the provided signing key.
     */
    private function __construct(
        private OpenSSLAsymmetricKey|string $signingKey,
        private string $algorithm = Token::ALGO_RS256,
        private array $claims = [],
        private array $headers = [],
        private null|string $signingKeyPassphrase = null
    ) {
        // Ensure the environment is configured with the necessary OpenSSL extension support.
        $this->checkEnvironment();

        // Merge any provided headers with the defaults.
        $this->headers = array_merge($this->headers, ['type' => 'JWT', 'alg' => $this->algorithm]);

        // Convert the provided signing key to the appropriate type.
        $this->signingKey = $this->loadSigningKey($this->signingKey, $this->signingKeyPassphrase);
    }

    // @codeCoverageIgnoreStart
    /**
     * Ensure the environment is configured with the necessary OpenSSL extension support.
     *
     * @throws TokenException When a configuration issue in the host environment is detected.
     */
    private function checkEnvironment(): void
    {
        if (! extension_loaded('openssl')) {
            throw TokenException::openSslMissing();
        }

        $envSupportsDigestMethods = openssl_get_md_methods(true);
        $sdkRequiredDigestMethods = ['sha256', 'sha384', 'sha512'];

        foreach ($sdkRequiredDigestMethods as $method) {
            if (! in_array($method, $envSupportsDigestMethods, true)) {
                throw TokenException::openSslMissingAlgo($method);
            }
        }

        // $envSupportsCurveMethods = openssl_get_curve_names();
    }
    // @codeCoverageIgnoreEnd

    /**
     * Load the provided signing key and return as an appropriate object type.
     *
     * @param OpenSSLAsymmetricKey|string $signingKey Signing key to use for signing the token. This MUST be a string for HS256. MUST be either a string or OpenSSLAsymmetricKey for RS256.
     * @param null|string $signingKeyPassphrase Optional. Passphrase to use for signing key if it is encrypted. Defaults to null.
     *
     * @throws TokenException When an unsupported algorithm is provided.
     * @throws TokenException When a non-string $signingKey is provided for HS256.
     * @throws TokenException When a string $signingKey is used with RS256.
     * @throws TokenException When using RS256 and openssl_pkey_get_private() is unable to load the provided signing key.
     */
    private function loadSigningKey(OpenSSLAsymmetricKey|string $signingKey, null|string $signingKeyPassphrase = null): OpenSSLAsymmetricKey|string
    {
        // Ensure the provided algorithm is supported.
        if (! \in_array($this->algorithm, static::CONST_SUPPORTED_ALGOS, true)) {
            throw TokenException::unsupportedAlgorithm($this->algorithm, implode(',', static::CONST_SUPPORTED_ALGOS));
        }

        // For HS256, if signing key is a string, use it.
        if ($this->algorithm === Token::ALGO_HS256) {
            if (! is_string($signingKey)) {
                throw TokenException::requireKeyAsStringHs256();
            }

            return $signingKey;
        }

        // Otherwise, process as the default RS256 algorithm...
        $failure = null;
        $details = null;

        try {
            // Attempt to load it with openssl_pkey_get_private() and return an OpenSSLAsymmetricKey.
            $signingKey = openssl_pkey_get_private(
                private_key: $signingKey,
                passphrase: $signingKeyPassphrase
            );

            // Get the details of the key.
            if ($signingKey instanceof OpenSSLAsymmetricKey) {
                $details = openssl_pkey_get_details($signingKey);
            }
            // @codeCoverageIgnoreStart
        } catch (Throwable $th) {
            $failure = $th;
        }

        // If we were unable to load the key, throw an exception.
        if (! $signingKey instanceof OpenSSLAsymmetricKey || $details === false) {
            $message = implode(', ', $this->openSslErrors());
            $message = (($failure instanceof Throwable) ? $failure->getMessage() : TokenException::MSG_UNKNOWN_ERROR) .  ' (' . $message . ')';
            throw TokenException::unableToProcessSigningKey($message, $failure);
        }
        // @codeCoverageIgnoreEnd

        // If the key is not an RSA key, throw an exception.
        if (! isset($details['type']) || $details['type'] !== OPENSSL_KEYTYPE_RSA || ! isset($details['rsa'])) {
            throw TokenException::unableToProcessSigningKey(sprintf(TokenException::MSG_KEY_TYPE_NOT_SUPPORTED, $details['type'] ?? 'unknown'));
        }

        if (! isset($details['bits']) || intval($details['bits']) < self::CONST_ALGO_MIN_LENGTHS[$this->algorithm] || intval($details['bits']) > self::CONST_ALGO_MAX_LENGTHS[$this->algorithm]) {
            throw TokenException::keyLengthNotSupported((string) $details['bits'] ?? 'unknown', $this->algorithm);
        }

        return $signingKey;
    }

    /**
     * Glue the provided data segments together with a period, to produce a formatted token.
     *
     * @param array<mixed> $data Data segments to glue together.
     */
    private function glue(array $data): string
    {
        return implode(
            separator: '.',
            array: $data
        );
    }

    /**
     * Encode the provided data segment as a base64-encoded string. Optionally, encode the data as JSON.
     *
     * @param string|array<mixed> $data Data to encode.
     * @param string $segment Segment name to use for error messages.
     * @param bool $json Whether to encode the data as JSON. Defaults to true.
     * @param bool $skip Whether to skip encoding the data. Defaults to false.
     *
     * @throws TokenException When unable to encode the data segment.
     */
    private function encode(string|array $data, string $segment, bool $json = true, bool $skip = false): string
    {
        // If $skip is true, return the data as-is.
        if ($skip) {
            $data = json_encode($data);

            if ($data !== false) {
                return $data;
            }

            // @codeCoverageIgnoreStart
            return 'JSON_ENCODING_ERROR';
            // @codeCoverageIgnoreEnd
        }

        // If the data is an array, or $json is true, encode it as JSON.
        if ($json || ! is_string($data)) {
            try {
                $data = json_encode(
                    value: $data,
                    flags: \JSON_UNESCAPED_SLASHES | \JSON_THROW_ON_ERROR
                );
                // @codeCoverageIgnoreStart
            } catch (Throwable $th) {
                throw TokenException::unableToEncodeSegment($segment, $th->getMessage());
            }
            // @codeCoverageIgnoreEnd
        }

        // Return the sanitized base64-encoded data.
        return str_replace(
            search: '=',
            replace: '',
            subject: strtr(base64_encode($data), '+/', '-_')
        );
    }

    /**
     * Sign the provided data with the provided signing key.
     *
     * @param string $data Data to sign.
     *
     * @throws TokenException When an unsupported algorithm is provided.
     * @throws TokenException When a signature is unable to be generated.
     * @throws TokenException When unable to encode the data segment.
     */
    private function sign(string $data): string
    {
        // For HS256, use hash_hmac() to sign the data.
        if ($this->algorithm === Token::ALGO_HS256) {
            // @codeCoverageIgnoreStart
            if (! is_string($this->signingKey)) {
                throw TokenException::unableToSignData(TokenException::MSG_UNKNOWN_ERROR);
            }
            // @codeCoverageIgnoreEnd

            return $this->encode(
                data: hash_hmac(
                    algo: 'sha256',
                    data: $data,
                    key: $this->signingKey,
                    binary: true
                ),
                json: false,
                segment: 'signature',
            );
        }

        // Otherwise, default to RS256, and use openssl_sign() to sign the data.
        $signature = '';
        $success = false;
        $failure = null;

        try {
            $success = openssl_sign($data, $signature, $this->signingKey, OPENSSL_ALGO_SHA256);
            // @codeCoverageIgnoreStart
        } catch (Throwable $th) {
            $failure = $th;
        }

        // If we were unable to sign the data, throw an exception.
        if (! $success) {
            $message = implode(', ', $this->openSslErrors());
            $message = (($failure instanceof Throwable) ? $failure->getMessage() : TokenException::MSG_UNKNOWN_ERROR) .  ' (' . $message . ')';
            throw TokenException::unableToSignData($message, $failure);
        }
        // @codeCoverageIgnoreEnd

        return $this->encode(
            data: $signature,
            segment: 'signature',
            json: false
        );
    }

    /**
     * Get the OpenSSL error stack.
     *
     * @return array<string> The OpenSSL error stack.
     */
    private function openSslErrors(): array
    {
        $openSslErrorStack = [];

        while ($error = openssl_error_string()) {
            $openSslErrorStack[] = $error;
        }

        return $openSslErrorStack;
    }
}
