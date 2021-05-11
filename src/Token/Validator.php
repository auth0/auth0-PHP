<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\Exception\InvalidTokenException;

/**
 * Class Validator.
 */
class Validator
{
    /**
     * Array representing the claims of a JWT.
     */
    protected array $claims;

    /**
     * Constructor for the Token Validator class.
     *
     * @param array $claims Array representing the claims of a JWT.
     */
    public function __construct(
        array $claims
    ) {
        $this->claims = $claims;
    }

    /**
     * Validate the 'aud' claim.
     *
     * @param array $expects An array of allowed values for the 'aud' claim. Successful if ANY match.
     *
     * @throws InvalidTokenException When claim validation fails.
     */
    public function audience(
        array $expects
    ): self {
        $audience = $this->getClaim('aud');

        if ($audience === null) {
            throw InvalidTokenException::missingAudienceClaim();
        }

        if (is_string($audience)) {
            $audience = [ $audience ];
        }

        if (count(array_intersect($audience, $expects))) {
            return $this;
        }

        throw InvalidTokenException::mismatchedAudClaim(implode(', ', $expects), implode(', ', $audience));
    }

    /**
     * Validate the 'auth_time' claim.
     *
     * @param int $maxAge Maximum window of time in seconds since the 'auth_time' to accept the token.
     * @param int $leeway Leeway in seconds to allow during time calculations.
     * @param int|null $now Optional. Unix timestamp representing the current point in time to use for time calculations.
     *
     * @throws InvalidTokenException When claim validation fails.
     */
    public function authTime(
        int $maxAge,
        int $leeway = 60,
        ?int $now = null
    ): self {
        $authTime = $this->getClaim('auth_time');
        $now = $now ?? time();

        if ($authTime === null) {
            throw InvalidTokenException::missingAuthTimeClaim();
        }

        $validUntil = $authTime + $maxAge + $leeway;

        if ($now > $validUntil) {
            throw InvalidTokenException::mismatchedAuthTimeClaim($now, $validUntil);
        }

        return $this;
    }

    /**
     * Validate the 'azp' claim.
     *
     * @param array $expects An array of allowed values for the 'azp' claim. Successful if ANY match.
     *
     * @throws InvalidTokenException When claim validation fails.
     */
    public function authorizedParty(
        array $expects
    ): self {
        $audience = $this->getClaim('aud');

        if ($audience === null) {
            throw InvalidTokenException::missingAudienceClaim();
        }

        if (is_array($audience)) {
            $azp = $this->getClaim('azp');

            if ($azp === null) {
                throw InvalidTokenException::missingAzpClaim();
            }

            if (! array_key_exists($azp, $expects)) {
                throw InvalidTokenException::mismatchedAzpClaim(implode(', ', $expects), $azp);
            }
        }

        return $this;
    }

    /**
     * Validate the 'exp' claim.
     *
     * @param int $leeway Leeway in seconds to allow during time calculations.
     * @param int|null $now Optional. Unix timestamp representing the current point in time to use for time calculations.
     *
     * @throws InvalidTokenException When claim validation fails.
     */
    public function expiration(
        int $leeway = 60,
        ?int $now = null
    ): self {
        $expires = $this->getClaim('exp');
        $now = $now ?? time();

        if ($expires === null) {
            throw InvalidTokenException::missingExpClaim();
        }

        $expires += $leeway;

        if ($now > $expires) {
            throw InvalidTokenException::mismatchedExpClaim($now, $expires);
        }

        return $this;
    }

    /**
     * Validate the 'iat' claim is present.
     *
     * @throws InvalidTokenException When claim validation fails.
     */
    public function issued(): self
    {
        $issued = $this->getClaim('iat');

        if ($issued === null) {
            throw InvalidTokenException::missingIatClaim();
        }

        return $this;
    }

    /**
     * Validate the 'iss' claim.
     *
     * @param array $expects The value to compare with the claim.
     *
     * @throws InvalidTokenException When claim validation fails.
     */
    public function issuer(
        string $expects
    ): self {
        $claim = $this->getClaim('iss');

        if ($claim === null) {
            throw InvalidTokenException::missingIssClaim();
        }

        if ($claim !== $expects) {
            throw InvalidTokenException::mismatchedIssClaim($expects, $claim);
        }

        return $this;
    }

    /**
     * Validate the 'nonce' claim.
     *
     * @param array $expects The value to compare with the claim.
     *
     * @throws InvalidTokenException When claim validation fails.
     */
    public function nonce(
        string $expects
    ): self {
        $claim = $this->getClaim('nonce');

        if ($claim === null) {
            throw InvalidTokenException::missingNonceClaim();
        }

        if ($claim !== $expects) {
            throw InvalidTokenException::mismatchedNonceClaim($expects, $claim);
        }

        return $this;
    }

    /**
     * Validate the 'org_id' claim.
     *
     * @param array $expects An array of allowed values for the 'org_id' claim. Successful if ANY match.
     *
     * @throws InvalidTokenException When claim validation fails.
     */
    public function organization(
        array $expects
    ): self {
        $claim = $this->getClaim('org_id');

        if ($claim === null) {
            throw InvalidTokenException::missingOrgIdClaim();
        }

        if (! in_array($claim, $expects)) {
            throw InvalidTokenException::mismatchedOrgIdClaim(implode(', ', $expects), $claim);
        }

        return $this;
    }

    /**
     * Validate the 'sub' claim is present.
     *
     * @throws InvalidTokenException When claim validation fails.
     */
    public function subject(): self
    {
        $claim = $this->getClaim('sub');

        if ($claim === null) {
            throw InvalidTokenException::missingSubClaim();
        }

        return $this;
    }

    /**
     * Return a claim by it's key. Null if not present.
     *
     * @param array $key The claim key to search for.
     */
    protected function getClaim(
        string $key
    ) {
        if (! isset($this->claims[$key])) {
            return null;
        }

        return $this->claims[$key];
    }
}
