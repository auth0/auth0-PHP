<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\Exception\InvalidTokenException;

/**
 * Class Validator.
 */
class Validator
{
    protected array $claims;

    public function __construct(
        array $claims
    ) {
        $this->claims = $claims;
    }

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

    public function expiration(
        int $leeway = 60,
        ?int $now = null
    ): self {
        $expires = $this->getClaim('exp');
        $now = $now ?? time();

        if ($expires === null) {
            throw InvalidTokenException::missingExpClaim();
        }

        $expires = $expires + $leeway;

        if ($now > $expires) {
            throw InvalidTokenException::mismatchedExpClaim($now, $expires);
        }

        return $this;
    }

    public function issued(): self
    {
        $issued = $this->getClaim('iat');

        if ($issued === null) {
            throw InvalidTokenException::missingIatClaim();
        }

        return $this;
    }

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

    public function subject(): self
    {
        $claim = $this->getClaim('sub');

        if ($claim === null) {
            throw InvalidTokenException::missingSubClaim();
        }

        return $this;
    }

    protected function getClaim(
        string $key
    ) {
        if (! isset($this->claims[$key])) {
            return null;
        }

        return $this->claims[$key];
    }
}
