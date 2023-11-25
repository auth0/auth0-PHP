<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token;
use JsonException;
use Psr\Cache\CacheItemPoolInterface;

use function count;
use function is_array;

final class Parser
{
    /**
     * State.
     */
    private bool $parsed = false;

    /**
     * Decoded claims contained within the JWT.
     *
     * @var array<string,array<int|string>|int|string>
     */
    private ?array $tokenClaims = null;

    /**
     * Decoded headers contained within the JWT.
     *
     * @var null|int[]|string[]
     */
    private ?array $tokenHeaders = null;

    /**
     * Each of the 3 sections of the JWT separated for easier processing.
     *
     * @var null|string[]
     */
    private ?array $tokenParts = null;

    /**
     * The unaltered JWT string that was passed to the class constructor.
     */
    private ?string $tokenRaw = null;

    /**
     * The decoded signature hash for the JWT.
     */
    private ?string $tokenSignature = null;

    /**
     * Constructor for Token Parser class.
     *
     * @param SdkConfiguration $configuration Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string           $token         JSON Web Token to work with
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function __construct(
        private SdkConfiguration $configuration,
        private string $token,
    ) {
        $this->parse();
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
     * Return the value of a claim on a Token, or null if it is not present.
     *
     * @param string $key claim key to search for
     *
     * @return mixed
     */
    public function getClaim(
        string $key,
    ) {
        $claims = $this->getClaims();

        return $claims[$key] ?? null;
    }

    /**
     * Return an array representing the Token's claims.
     *
     * @return array<string,array<int|string>|int|string>
     */
    public function getClaims(): array
    {
        $this->parse();

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
     * Return the value of a header on a Token, or null if it is not present.
     *
     * @param string $key header key to search for
     */
    public function getHeader(
        string $key,
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
        $this->parse();

        return $this->tokenHeaders ?? [];
    }

    /**
     * Return an array representing the Token's decoded parts.
     *
     * @return array<string>
     */
    public function getParts(): array
    {
        $this->parse();

        return $this->tokenParts ?? [];
    }

    /**
     * Returns the unaltered, encoded JWT as it was originally passed to the class.
     */
    public function getRaw(): ?string
    {
        $this->parse();

        return $this->tokenRaw;
    }

    /**
     * Return the signature portion of the JWT.
     */
    public function getSignature(): ?string
    {
        $this->parse();

        return $this->tokenSignature;
    }

    /**
     * Returns whether a claim is present on a Token.
     *
     * @param string $key claim key to search for
     */
    public function hasClaim(
        string $key,
    ): bool {
        return null !== $this->getClaim($key);
    }

    /**
     * Returns whether a header is present on a Token.
     *
     * @param string $key header key to search for
     */
    public function hasHeader(
        string $key,
    ): bool {
        return null !== $this->getHeader($key);
    }

    /**
     * Process a JWT string, breaking up it's header, claims and signature for processing, and ensures values are properly decoded.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function parse(
    ): void {
        if (! $this->parsed) {
            $parts = explode('.', $this->token);

            if (3 !== count($parts)) {
                throw \Auth0\SDK\Exception\InvalidTokenException::badSeparators();
            }

            $this->tokenRaw = $this->token;
            $this->tokenParts = $parts;

            try {
                $this->tokenHeaders = $this->decodeHeaders($parts[0]);
                $this->tokenClaims = $this->decodeClaims($parts[1]);
            } catch (JsonException $jsonException) {
                throw \Auth0\SDK\Exception\InvalidTokenException::jsonError($jsonException->getMessage());
            }

            $this->tokenSignature = $this->decodeSignature($parts[2]);

            // @codeCoverageIgnoreStart
            // This is not currently testable using our JWT encoding test libraries.
            if (! isset($this->tokenHeaders['typ'])) {
                $this->tokenHeaders['typ'] = 'JWT';
            }
            // @codeCoverageIgnoreEnd
        }

        $this->parsed = true;
    }

    /**
     * Returns a new instance of the Token claims Validator class using the parsed token's claims.
     */
    public function validate(): Validator
    {
        $this->parse();

        return new Validator($this->getClaims());
    }

    /**
     * Verify the signature of the Token using either RS256 or HS256.
     *
     * @param null|string                 $algorithm    Optional. Algorithm to use for verification. Expects either RS256 or HS256. Defaults to RS256.
     * @param null|string                 $jwksUri      Optional. URI to the JWKS when verifying RS256 tokens.
     * @param null|string                 $clientSecret Optional. Client Secret found in the Application settings for verifying HS256 tokens.
     * @param null|int                    $cacheExpires Optional. Time in seconds to keep JWKS records cached.
     * @param null|CacheItemPoolInterface $cache        Optional. A PSR-6 CacheItemPoolInterface instance to cache JWKS results within.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token signature verification fails. See the exception message for further details.
     */
    public function verify(
        ?string $algorithm = Token::ALGO_RS256,
        ?string $jwksUri = null,
        ?string $clientSecret = null,
        ?int $cacheExpires = null,
        ?CacheItemPoolInterface $cache = null,
    ): self {
        $this->parse();

        $parts = $this->getParts();
        $signature = $this->getSignature() ?? '';
        $headers = $this->getHeaders();

        new Verifier(
            $this->configuration,
            implode('.', [$parts[0], $parts[1]]),
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
     * Decodes and returns the claims portion of a JWT as an array.
     *
     * @param string $claims string representing the claims portion of the JWT
     *
     * @throws JsonException when claims portion cannot be decoded properly
     *
     * @return null|array<array<int|string>|int|string>
     *
     * @codeCoverageIgnore
     */
    private function decodeClaims(
        string $claims,
    ): ?array {
        $decoded = base64_decode(strtr($claims, '-_', '+/'), true);
        $response = null;

        if (false !== $decoded) {
            /** @var null|array<array<int|string>|int|string> $response */
            $response = json_decode($decoded, true, 512, JSON_THROW_ON_ERROR);
        }

        return $response;
    }

    /**
     * Decodes and returns the headers portion of a JWT as an array.
     *
     * @param string $headers string representing the headers portion of the JWT
     *
     * @throws JsonException when headers portion cannot be decoded properly
     *
     * @return null|array<int|string>
     *
     * @codeCoverageIgnore
     */
    private function decodeHeaders(
        string $headers,
    ): ?array {
        $decoded = base64_decode(strtr($headers, '-_', '+/'), true);
        $response = null;

        if (false !== $decoded) {
            /** @var null|array<int|string> $response */
            $response = json_decode($decoded, true, 512, JSON_THROW_ON_ERROR);
        }

        return $response;
    }

    /**
     * Decodes and returns the signature portion of a JWT as a string.
     *
     * @param string $signature string representing the signature portion of the JWT
     *
     * @codeCoverageIgnore
     */
    private function decodeSignature(
        string $signature,
    ): ?string {
        $decoded = base64_decode(strtr($signature, '-_', '+/'), true);

        if (false !== $decoded) {
            return $decoded;
        }

        return null;
    }
}
