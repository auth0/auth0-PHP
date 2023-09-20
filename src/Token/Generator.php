<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use const JSON_THROW_ON_ERROR;
use const JSON_UNESCAPED_SLASHES;
use const OPENSSL_ALGO_SHA256;
use const OPENSSL_ALGO_SHA384;
use const OPENSSL_ALGO_SHA512;

use Auth0\SDK\Contract\Token\GeneratorInterface;
use Auth0\SDK\Exception\TokenException;
use Auth0\SDK\Token;
use OpenSSLAsymmetricKey;
use Stringable;
use Throwable;

use function extension_loaded;
use function in_array;
use function is_array;
use function is_string;

final class Generator implements GeneratorInterface, Stringable
{
    // Lookup table for supported digest algorithms as strings.
    /**
     * @var array<int, string>
     */
    public const CONST_DIGEST_STRING = [
        OPENSSL_ALGO_SHA256 => 'sha256',
        OPENSSL_ALGO_SHA384 => 'sha384',
        OPENSSL_ALGO_SHA512 => 'sha512',
    ];

    // Lookup table for supported key types as strings.
    /**
     * @var string[]
     */
    public const CONST_KEYTYPE_STRING = [
        \OPENSSL_KEYTYPE_RSA => 'RSA',
    ];

    // Supported algorithms for token generation.
    /**
     * @var string[]
     */
    public const CONST_SUPPORTED_ALGORITHMS = [
        Token::ALGO_HS256,
        Token::ALGO_HS384,
        Token::ALGO_HS512,
        Token::ALGO_RS256,
        Token::ALGO_RS384,
        Token::ALGO_RS512,
    ];

    /**
     * Create a new token generator instance.
     *
     * @param OpenSSLAsymmetricKey|string $signingKey           Signing key to use for signing the token. This MUST be a string for HS256. MUST be either a string or OpenSSLAsymmetricKey for RS256.
     * @param string                      $algorithm            Algorithm to use for signing the token. Defaults to RS256.
     * @param array<mixed>                $claims               Claims to include in the token. Defaults to an empty array.
     * @param array<string>               $headers              Headers to include in the token. Defaults to an empty array. The the "alg" header will be set to represent $algorithm appropriately.
     * @param null|string                 $signingKeyPassphrase Optional. Passphrase to use for signing key if it is encrypted. Defaults to null.
     *
     * @throws TokenException When an unsupported algorithm is provided.
     * @throws TokenException When a non-string $signingKey is provided for HS256.
     * @throws TokenException When a string $signingKey is used with RS256.
     * @throws TokenException When using RS256 and openssl_pkey_get_private() is unable to load the provided signing key.
     */
    private function __construct(
        private OpenSSLAsymmetricKey | string $signingKey,
        private string $algorithm = Token::ALGO_RS256,
        private array $claims = [],
        private array $headers = [],
        private null | string $signingKeyPassphrase = null,
    ) {
        // @codeCoverageIgnoreStart
        if (! extension_loaded('openssl')) {
            throw TokenException::openSslMissing();
        }
        // @codeCoverageIgnoreEnd

        // Ensure the provided algorithm is supported.
        if (! in_array($this->algorithm, self::CONST_SUPPORTED_ALGORITHMS, true)) {
            throw TokenException::unsupportedAlgorithm($this->algorithm, implode(',', self::CONST_SUPPORTED_ALGORITHMS));
        }

        // Merge any provided headers with the defaults.
        $this->headers = array_merge($this->headers, ['typ' => 'JWT', 'alg' => $this->algorithm]);

        // Convert the provided signing key to the appropriate type.
        $this->signingKey = $this->loadSigningKey($this->signingKey, $this->signingKeyPassphrase);
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toArray(
        $encodeSegments = true,
    ): array {
        // Build token from headers and claims.
        $segments = [
            self::encode(data: $this->headers, segment: 'headers', skip: ! $encodeSegments),
            self::encode(data: $this->claims, segment: 'claims', skip: ! $encodeSegments),
        ];

        // Sign the token.
        $signature = $this->sign(
            data: $this->glue($segments),
        );

        // Attach the signature to the token.
        $segments[] = $signature;

        if (! $encodeSegments) {
            return [
                'headers' => $this->headers,
                'claims' => $this->claims,
                'signature' => $signature,
            ];
        }

        // Return the token with encoded segments.
        return $segments;
    }

    public function toString(): string
    {
        return $this->glue(array_values($this->toArray()));
    }

    public static function create(
        OpenSSLAsymmetricKey | string $signingKey,
        string $algorithm = Token::ALGO_RS256,
        array $claims = [],
        array $headers = [],
        null | string $signingKeyPassphrase = null,
    ): static {
        return new self(
            signingKey: $signingKey,
            algorithm: $algorithm,
            claims: $claims,
            headers: $headers,
            signingKeyPassphrase: $signingKeyPassphrase,
        );
    }

    /**
     * Encode the provided data segment as a base64-encoded string. Optionally, encode the data as JSON.
     *
     * @param array<mixed>|string $data    Data to encode.
     * @param string              $segment Segment name to use for error messages.
     * @param bool                $json    Whether to encode the data as JSON. Defaults to true.
     * @param bool                $skip    Whether to skip encoding the data. Defaults to false.
     *
     * @throws TokenException When unable to encode the data segment.
     */
    private function encode(string | array $data, string $segment, bool $json = true, bool $skip = false): string
    {
        // If $skip is true, return the data as-is.
        if ($skip) {
            $data = json_encode($data);

            if (false !== $data) {
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
                    flags: JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR,
                );
                // @codeCoverageIgnoreStart
            } catch (Throwable $throwable) {
                throw TokenException::unableToEncodeSegment($segment, $throwable->getMessage());
            }
            // @codeCoverageIgnoreEnd
        }

        // Return the sanitized base64-encoded data.
        return str_replace(
            search: '=',
            replace: '',
            subject: strtr(base64_encode($data), '+/', '-_'),
        );
    }

    /**
     * Get the digest algorithm to use for the provided algorithm.
     *
     * @return int The digest algorithm to use.
     */
    private function getDigestAlgorithm(): int
    {
        return match ($this->algorithm) {
            Token::ALGO_HS256, Token::ALGO_RS256 => OPENSSL_ALGO_SHA256,
            Token::ALGO_HS384, Token::ALGO_RS384 => OPENSSL_ALGO_SHA384,
            Token::ALGO_HS512, Token::ALGO_RS512 => OPENSSL_ALGO_SHA512,
            default => throw TokenException::unsupportedAlgorithm($this->algorithm, implode(', ', self::CONST_SUPPORTED_ALGORITHMS)),
        };
    }

    /**
     * Get the OpenSSL key type to use for the provided algorithm.
     *
     * @return null|int The OpenSSL key type to use.
     */
    private function getOpenSslKeyType(): ?int
    {
        return match ($this->algorithm) {
            Token::ALGO_RS256, Token::ALGO_RS384, Token::ALGO_RS512 => \OPENSSL_KEYTYPE_RSA,
            default => null,
        };
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
            array: $data,
        );
    }

    /**
     * Load the provided signing key and return as an appropriate object type.
     *
     * @param OpenSSLAsymmetricKey|string $signingKey           Signing key to use for signing the token. This MUST be a string for HS256. MUST be either a string or OpenSSLAsymmetricKey for RS256.
     * @param null|string                 $signingKeyPassphrase Optional. Passphrase to use for signing key if it is encrypted. Defaults to null.
     *
     * @throws TokenException When a non-string $signingKey is provided for HS256.
     * @throws TokenException When a string $signingKey is used with RS256.
     * @throws TokenException When using RS256 and openssl_pkey_get_private() is unable to load the provided signing key.
     */
    private function loadSigningKey(OpenSSLAsymmetricKey | string $signingKey, null | string $signingKeyPassphrase = null): OpenSSLAsymmetricKey | string
    {
        if (null === $this->getOpenSslKeyType()) {
            if (! is_string($signingKey)) {
                throw TokenException::requireKeyAsStringHs256();
            }

            return $signingKey;
        }

        // Otherwise, process with OpenSSL...
        $failure = null;
        $details = null;

        try {
            // Attempt to load signing key with openssl_pkey_get_private(). This returns an OpenSSLAsymmetricKey.
            $signingKey = openssl_pkey_get_private(
                private_key: $signingKey,
                passphrase: $signingKeyPassphrase,
            );

            // Get the key details from the OpenSSLAsymmetricKey.
            if ($signingKey instanceof OpenSSLAsymmetricKey) {
                $details = openssl_pkey_get_details($signingKey);
            }
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            $failure = $throwable;
        }

        // If we were unable to load the key, throw an exception.
        if (! $signingKey instanceof OpenSSLAsymmetricKey || false === $details) {
            $message = (($failure instanceof Throwable) ? $failure->getMessage() : TokenException::MSG_UNKNOWN_ERROR) . $this->openSslErrors();

            throw TokenException::unableToProcessSigningKey($message, $failure);
        }

        if (! is_array($details) || ! isset($details['type'])) {
            throw TokenException::unidentifiableKeyType();
        }
        // @codeCoverageIgnoreEnd

        $keyType = $details['type'];

        if ($keyType !== $this->getOpenSslKeyType()) {
            throw TokenException::keyTypeMismatch((string) $keyType, $this->algorithm);
        }

        // @codeCoverageIgnoreStart
        if (OPENSSL_KEYTYPE_RSA === $keyType && ! isset($details['rsa'])) {
            throw TokenException::unidentifiableKeyType();
        }
        // @codeCoverageIgnoreEnd

        return $signingKey;
    }

    /**
     * Retrieve and format the OpenSSL error stack as a string suitable for logging.
     *
     * @return string The OpenSSL error stack.
     *
     * @codeCoverageIgnore
     */
    private function openSslErrors(): string
    {
        $errors = [];

        while ($error = openssl_error_string()) {
            $errors[] = $error;
        }

        if ([] !== $errors) {
            return "\n" . implode("\n* ", $errors);
        }

        return '';
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
        if (null === $this->getOpenSslKeyType()) {
            // @codeCoverageIgnoreStart
            if (! is_string($this->signingKey)) {
                throw TokenException::unableToSignData(TokenException::MSG_UNKNOWN_ERROR);
            }
            // @codeCoverageIgnoreEnd

            return $this->encode(
                data: hash_hmac(
                    algo: self::CONST_DIGEST_STRING[$this->getDigestAlgorithm()],
                    data: $data,
                    key: $this->signingKey,
                    binary: true,
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
            $success = openssl_sign($data, $signature, $this->signingKey, $this->getDigestAlgorithm());
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            $failure = $throwable;
        }

        // If we were unable to sign the data, throw an exception.
        if (! $success) {
            $message = $this->openSslErrors();
            $message = (($failure instanceof Throwable) ? $failure->getMessage() : TokenException::MSG_UNKNOWN_ERROR) . $message;

            throw TokenException::unableToSignData($message, $failure);
        }
        // @codeCoverageIgnoreEnd

        return $this->encode(
            data: $signature,
            segment: 'signature',
            json: false,
        );
    }
}
