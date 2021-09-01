<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class Parser.
 */
final class Parser
{
    /**
     * Instance of SdkConfiguration
     */
    private SdkConfiguration $configuration;

    /**
     * The unaltered JWT string that was passed to the class constructor.
     */
    private ?string $tokenRaw = null;

    /**
     * Each of the 3 sections of the JWT separated for easier processing.
     *
     * @var array<int,string>
     */
    private ?array $tokenParts = null;

    /**
     * Decoded headers contained within the JWT.
     *
     * @var array<string,int|string>
     */
    private ?array $tokenHeaders = null;

    /**
     * Decoded claims contained within the JWT.
     *
     * @var array<string,array|int|string>
     */
    private ?array $tokenClaims = null;

    /**
     * The decoded signature hash for the JWT.
     */
    private ?string $tokenSignature = null;

    /**
     * Constructor for Token Parser class.
     *
     * @param string           $jwt             A JWT string to parse.
     * @param SdkConfiguration $configuration   Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function __construct(
        string $jwt,
        SdkConfiguration $configuration
    ) {
        $this->configuration = $configuration;
        $this->parse($jwt);
    }

    /**
     * Process a JWT string, breaking up it's header, claims and signature for processing, and ensures values are properly decoded.
     *
     * @param string $jwt A JWT string to parse.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function parse(
        string $jwt
    ): void {
        $parts = explode('.', $jwt);

        if (count($parts) !== 3) {
            throw \Auth0\SDK\Exception\InvalidTokenException::badSeparators();
        }

        $this->tokenRaw = $jwt;
        $this->tokenParts = $parts;
        $this->tokenHeaders = $this->decodeHeaders($parts[0]);
        $this->tokenClaims = $this->decodeClaims($parts[1]);
        $this->tokenSignature = $this->decodeSignature($parts[2]);

        // @codeCoverageIgnoreStart
        // This is not currently testable using our JWT encoding test libraries.
        if (! isset($this->tokenHeaders['typ'])) {
            $this->tokenHeaders['typ'] = 'JWT';
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * Returns a new instance of the Token claims Validator class using the parsed token's claims.
     */
    public function validate(): Validator
    {
        return new Validator($this->getClaims());
    }

    /**
     * Verify the signature of the Token using either RS256 or HS256.
     *
     * @param string|null                 $algorithm    Optional. Algorithm to use for verification. Expects either RS256 or HS256. Defaults to RS256.
     * @param string|null                 $jwksUri      Optional. URI to the JWKS when verifying RS256 tokens.
     * @param string|null                 $clientSecret Optional. Client Secret found in the Application settings for verifying HS256 tokens.
     * @param int|null                    $cacheExpires Optional. Time in seconds to keep JWKS records cached.
     * @param CacheItemPoolInterface|null $cache        Optional. A PSR-6 CacheItemPoolInterface instance to cache JWKS results within.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token signature verification fails. See the exception message for further details.
     */
    public function verify(
        ?string $algorithm = Token::ALGO_RS256,
        ?string $jwksUri = null,
        ?string $clientSecret = null,
        ?int $cacheExpires = null,
        ?CacheItemPoolInterface $cache = null
    ): self {
        $parts = $this->getParts();
        $signature = $this->getSignature() ?? '';
        $headers = $this->getHeaders();

        new Verifier(
            $this->configuration,
            join('.', [$parts[0], $parts[1]]),
            $signature,
            $headers,
            $algorithm,
            $jwksUri,
            $clientSecret,
            $cacheExpires,
            $cache,
        );

        return $this;
    }

    /**
     * Return an array representing the Token's claims.
     *
     * @return array<mixed>
     */
    public function export(): array
    {
        return $this->getClaims();
    }

    /**
     * Returns whether a claim is present on a Token.
     *
     * @param string $key Claim key to search for.
     */
    public function hasClaim(
        string $key
    ): bool {
        return $this->getClaim($key) !== null;
    }

    /**
     * Return the value of a claim on a Token, or null if it is not present.
     *
     * @param string $key Claim key to search for.
     *
     * @return mixed
     */
    public function getClaim(
        string $key
    ) {
        $claims = $this->getClaims();
        return $claims[$key] ?? null;
    }

    /**
     * Return an array representing the Token's claims.
     *
     * @return array<string,array|int|string>
     */
    public function getClaims(): array
    {
        $claims = $this->tokenClaims;

        // @codeCoverageIgnoreStart
        // This is not currently testable using our JWT encoding test libraries.
        if (! is_array($claims)) {
            return [];
        }
        // @codeCoverageIgnoreEnd

        return $claims;
    }

    /**
     * Returns whether a header is present on a Token.
     *
     * @param string $key Header key to search for.
     */
    public function hasHeader(
        string $key
    ): bool {
        return $this->getHeader($key) !== null;
    }

    /**
     * Return the value of a header on a Token, or null if it is not present.
     *
     * @param string $key Header key to search for.
     */
    public function getHeader(
        string $key
    ): ?string {
        $headers = $this->getHeaders();

        if (isset($headers[$key])) {
            return (string) $headers[$key];
        }

        return null;
    }

    /**
     * Return an array representing the Token's headers.
     *
     * @return array<int|string>
     */
    public function getHeaders(): array
    {
        return $this->tokenHeaders ?? [];
    }

    /**
     * Return an array representing the Token's decoded parts.
     *
     * @return array<string>
     */
    public function getParts(): array
    {
        return $this->tokenParts ?? [];
    }

    /**
     * Returns the unaltered, encoded JWT as it was originally passed to the class.
     */
    public function getRaw(): ?string
    {
        return $this->tokenRaw;
    }

    /**
     * Return the signature portion of the JWT.
     */
    public function getSignature(): ?string
    {
        return $this->tokenSignature;
    }

    /**
     * Decodes and returns the claims portion of a JWT as an array.
     *
     * @param string $claims String representing the claims portion of the JWT.
     *
     * @return array<array|int|string>|null
     *
     * @throws \JsonException When claims portion cannot be decoded properly.
     *
     * @codeCoverageIgnore
     */
    private function decodeClaims(
        string $claims
    ): ?array {
        $decoded = base64_decode(strtr($claims, '-_', '+/'), true);

        if ($decoded !== false) {
            return json_decode($decoded, true, 512, JSON_THROW_ON_ERROR);
        }

        return null;
    }

    /**
     * Decodes and returns the headers portion of a JWT as an array.
     *
     * @param string $headers String representing the headers portion of the JWT.
     *
     * @return array<int|string>|null
     *
     * @throws \JsonException When headers portion cannot be decoded properly.
     *
     * @codeCoverageIgnore
     */
    private function decodeHeaders(
        string $headers
    ): ?array {
        $decoded = base64_decode(strtr($headers, '-_', '+/'), true);

        if ($decoded !== false) {
            return json_decode($decoded, true, 512, JSON_THROW_ON_ERROR);
        }

        return null;
    }

    /**
     * Decodes and returns the signature portion of a JWT as a string.
     *
     * @param string $signature String representing the signature portion of the JWT.
     *
     * @codeCoverageIgnore
     */
    private function decodeSignature(
        string $signature
    ): ?string {
        $decoded = base64_decode(strtr($signature, '-_', '+/'), true);

        if ($decoded !== false) {
            return $decoded;
        }

        return null;
    }
}
