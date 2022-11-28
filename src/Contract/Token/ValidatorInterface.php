<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\Token;

/**
 * Interface ValidatorInterface.
 */
interface ValidatorInterface
{
    /**
     * Validate the 'aud' claim.
     *
     * @param  array<string>  $expects  An array of allowed values for the 'aud' claim. Successful if ANY match.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when claim validation fails
     */
    public function audience(
        array $expects,
    ): self;

    /**
     * Validate the 'auth_time' claim.
     *
     * @param  int  $maxAge  maximum window of time in seconds since the 'auth_time' to accept the token
     * @param  int  $leeway  leeway in seconds to allow during time calculations
     * @param  int|null  $now  Optional. Unix timestamp representing the current point in time to use for time calculations.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when claim validation fails
     */
    public function authTime(
        int $maxAge,
        int $leeway = 60,
        ?int $now = null,
    ): self;

    /**
     * Validate the 'azp' claim.
     *
     * @param  array<string>  $expects  An array of allowed values for the 'azp' claim. Successful if ANY match.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when claim validation fails
     */
    public function authorizedParty(
        array $expects,
    ): self;

    /**
     * Validate the 'exp' claim.
     *
     * @param  int  $leeway  leeway in seconds to allow during time calculations
     * @param  int|null  $now  Optional. Unix timestamp representing the current point in time to use for time calculations.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when claim validation fails
     */
    public function expiration(
        int $leeway = 60,
        ?int $now = null,
    ): self;

    /**
     * Validate the 'iat' claim is present.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when claim validation fails
     */
    public function issued(): self;

    /**
     * Validate the 'iss' claim.
     *
     * @param  string  $expects  the value to compare with the claim
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when claim validation fails
     */
    public function issuer(
        string $expects,
    ): self;

    /**
     * Validate the 'nonce' claim.
     *
     * @param  string  $expects  the value to compare with the claim
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when claim validation fails
     */
    public function nonce(
        string $expects,
    ): self;

    /**
     * Validate the 'org_id' claim.
     *
     * @param  array<string>  $expects  An array of allowed values for the 'org_id' claim. Successful if ANY match.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when claim validation fails
     */
    public function organization(
        array $expects,
    ): self;

    /**
     * Validate the 'sub' claim is present.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException when claim validation fails
     */
    public function subject(): self;
}
