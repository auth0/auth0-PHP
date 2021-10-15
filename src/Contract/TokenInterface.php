<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract;

use Psr\Cache\CacheItemPoolInterface;

/**
 * Interface TokenInterface
 */
interface TokenInterface
{
    /**
     * Parses a provided JWT string and prepare for verification and validation.
     *
     * @param string $jwt The JWT string to process.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function parse(
        string $jwt
    ): self;

    /**
     * Verify the signature of the Token using either RS256 or HS256.
     *
     * @param string|null                 $tokenAlgorithm Optional. Algorithm to use for verification. Expects either RS256 or HS256.
     * @param string|null                 $tokenJwksUri   Optional. URI to the JWKS when verifying RS256 tokens.
     * @param string|null                 $clientSecret   Optional. Client Secret found in the Application settings for verifying HS256 tokens.
     * @param int|null                    $tokenCacheTtl  Optional. Time in seconds to keep JWKS records cached.
     * @param CacheItemPoolInterface|null $tokenCache     Optional. A PSR-6 CacheItemPoolInterface instance to cache JWKS results within.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token signature verification fails. See the exception message for further details.
     */
    public function verify(
        ?string $tokenAlgorithm = null,
        ?string $tokenJwksUri = null,
        ?string $clientSecret = null,
        ?int $tokenCacheTtl = null,
        ?CacheItemPoolInterface $tokenCache = null
    ): self;

    /**
     * Validate the claims of the token.
     *
     * @param string|null        $tokenIssuer       Optional. The value expected for the 'iss' claim.
     * @param array<string>|null $tokenAudience     Optional. An array of allowed values for the 'aud' claim. Successful if ANY match.
     * @param array<string>|null $tokenOrganization Optional. An array of allowed values for the 'org_id' claim. Successful if ANY match.
     * @param string|null        $tokenNonce        Optional. The value expected for the 'nonce' claim.
     * @param int|null           $tokenMaxAge       Optional. Maximum window of time in seconds since the 'auth_time' to accept the token.
     * @param int|null           $tokenLeeway       Optional. Leeway in seconds to allow during time calculations. Defaults to 60.
     * @param int|null           $tokenNow          Optional. Optional. Unix timestamp representing the current point in time to use for time calculations.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token validation fails. See the exception message for further details.
     */
    public function validate(
        ?string $tokenIssuer = null,
        ?array $tokenAudience = null,
        ?array $tokenOrganization = null,
        ?string $tokenNonce = null,
        ?int $tokenMaxAge = null,
        ?int $tokenLeeway = null,
        ?int $tokenNow = null
    ): self;

    /**
     * Get the contents of the 'aud' claim, always returned an array. Null if not present.
     *
     * @return array<string>|null
     */
    public function getAudience(): ?array;

    /**
     * Get the contents of the 'azp' claim. Null if not present.
     */
    public function getAuthorizedParty(): ?string;

    /**
     * Get the contents of the 'auth_time' claim. Null if not present.
     */
    public function getAuthTime(): ?int;

    /**
     * Get the contents of the 'exp' claim. Null if not present.
     */
    public function getExpiration(): ?int;

    /**
     * Get the contents of the 'iat' claim. Null if not present.
     */
    public function getIssued(): ?int;

    /**
     * Get the contents of the 'iss' claim. Null if not present.
     */
    public function getIssuer(): ?string;

    /**
     * Get the contents of the 'nonce' claim. Null if not present.
     */
    public function getNonce(): ?string;

    /**
     * Get the contents of the 'org_id' claim. Null if not present.
     */
    public function getOrganization(): ?string;

    /**
     * Get the contents of the 'sub' claim. Null if not present.
     */
    public function getSubject(): ?string;

    /**
     * Export the state of the Token object as a PHP array.
     *
     * @return array<mixed>
     */
    public function toArray(): array;

    /**
     * Export a JSON encoded object (as a string) representing the state of the Token object. Note that this is not itself an ID Token, but is useful for debugging your user state.
     */
    public function toJson(): string;
}
