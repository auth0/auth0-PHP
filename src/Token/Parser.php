<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\Token;
use Psr\SimpleCache\CacheInterface;

/**
 * Class Parser.
 */
class Parser
{
    /**
     * Decoded representation of a JWT.
     */
    protected array $token = [];

    /**
     * Constructor for Token Parser class.
     *
     * @param string $jwt A JWT string to parse.
     *
     * @throws InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function __construct(
        string $jwt
    ) {
        $this->parse($jwt);
    }

    /**
     * Process a JWT string, breaking up it's header, claims and signature for processing, and ensures values are properly decoded.
     *
     * @param string $jwt A JWT string to parse.
     *
     * @throws InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function parse(
        string $jwt
    ): array {
        $parts = explode('.', $jwt);

        if (count($parts) !== 3) {
            throw \Auth0\SDK\Exception\InvalidTokenException::badSeparators();
        }

        $decoded = [
            'raw' => $jwt,
            'parts' => $parts,
            'headers' => $this->decodeHeaders($parts[0]),
            'claims' => $this->decodeClaims($parts[1]),
            'signature' => $this->decodeSignature($parts[2]),
        ];

        if (! isset($decoded['headers']['typ'])) {
            $decoded['headers']['typ'] = 'JWT';
        }

        $this->token = $decoded;
        return $this->token;
    }

    /**
     * Returns a new instance of the Token claims Validator class using the parsed token's claims.
     */
    public function validate(): Validator
    {
        return new Validator($this->token['claims']);
    }

    /**
     * Verify the signature of the Token using either RS256 or HS256.
     *
     * @param string|null $algorithm Optional. Algorithm to use for verification. Expects either RS256 or HS256. Defaults to RS256.
     * @param string|null $jwksUri Optional. URI to the JWKS when verifying RS256 tokens.
     * @param string|null $clientSecret Optional. Client Secret found in the Application settings for verifying HS256 tokens.
     * @param int|null $cacheExpires Optional. Time in seconds to keep JWKS records cached.
     * @param CacheInterface|null $cache Optional. A PSR-6 ("SimpleCache") CacheInterface instance to cache JWKS results within.
     *
     * @throws InvalidTokenException When Token signature verification fails. See the exception message for further details.
     */
    public function verify(
        ?string $algorithm = Token::ALGO_RS256,
        ?string $jwksUri = null,
        ?string $clientSecret = null,
        ?int $cacheExpires = null,
        ?CacheInterface $cache = null
    ): self {
        new Verifier(join('.', [$this->token['parts'][0], $this->token['parts'][1]]), $this->token['signature'], $this->token['headers'], $algorithm, $jwksUri, $clientSecret, $cacheExpires, $cache);
        return $this;
    }

    /**
     * Return an array representing the Token's claims.
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
        if (! isset($this->token['claims'][$key])) {
            return null;
        }

        return $this->token['claims'][$key];
    }

    /**
     * Return an array representing the Token's claims.
     */
    public function getClaims(): array
    {
        return $this->token['claims'] ?? [];
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
        if (! isset($this->token['headers'][$key])) {
            return null;
        }

        return (string) $this->token['headers'][$key];
    }

    /**
     * Return an array representing the Token's headers.
     */
    public function getHeaders(): array
    {
        return $this->token['headers'] ?? [];
    }

    /**
     * Returns the unaltered, encoded JWT as it was originally passed to the class.
     */
    public function getRaw(): ?string
    {
        return $this->token['raw'] ?? null;
    }

    /**
     * Return the signature portion of the JWT.
     */
    public function getSignature(): string
    {
        return $this->token['signature'] ?? '';
    }

    /**
     * Decodes and returns the claims portion of a JWT as an array.
     *
     * @param string $claims String representing the claims portion of the JWT.
     *
     * @throws JsonException When claims portion cannot be decoded properly.
     */
    protected function decodeClaims(
        string $claims
    ): array {
        return json_decode(base64_decode(strtr($claims, '-_', '+/'), true), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Decodes and returns the headers portion of a JWT as an array.
     *
     * @param string $headers String representing the headers portion of the JWT.
     *
     * @throws JsonException When headers portion cannot be decoded properly.
     */
    protected function decodeHeaders(
        string $headers
    ): array {
        return json_decode(base64_decode(strtr($headers, '-_', '+/'), true), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Decodes and returns the signature portion of a JWT as a string.
     *
     * @param string $signature String representing the signature portion of the JWT.
     */
    protected function decodeSignature(
        string $signature
    ): string {
        return base64_decode(strtr($signature, '-_', '+/'), true);
    }
}
