<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\Contract\Token\ValidatorInterface;
use Auth0\SDK\Exception\InvalidTokenException;

use function in_array;
use function is_array;
use function is_string;

final class Validator implements ValidatorInterface
{
    /**
     * Constructor for the Token Validator class.
     *
     * @param array<string,array<int|string>|int|string> $claims array representing the claims of a JWT
     */
    public function __construct(
        private array $claims,
    ) {
    }

    /**
     * Validate the 'aud' claim.
     *
     * @param array<string> $expects An array of allowed values for the 'aud' claim. Successful if ANY match.
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function audience(
        array $expects,
    ): self {
        $audience = $this->getClaim('aud');

        if (null === $audience) {
            throw InvalidTokenException::missingAudienceClaim();
        }

        if (! is_array($audience)) {
            $audience = [$audience];
        }

        if ([] !== array_intersect($audience, $expects)) {
            return $this;
        }

        throw InvalidTokenException::mismatchedAudClaim(implode(', ', $expects), implode(', ', $audience));
    }

    /**
     * Validate the 'azp' claim.
     *
     * @param array<string> $expects An array of allowed values for the 'azp' claim. Successful if ANY match.
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function authorizedParty(
        array $expects,
    ): self {
        $audience = $this->getClaim('aud');

        if (null === $audience) {
            throw InvalidTokenException::missingAudienceClaim();
        }

        if (is_array($audience)) {
            $azp = $this->getClaim('azp');

            if (null === $azp || ! is_string($azp)) {
                throw InvalidTokenException::missingAzpClaim();
            }

            if (! in_array($azp, $expects, true)) {
                throw InvalidTokenException::mismatchedAzpClaim(implode(', ', $expects), $azp);
            }
        }

        return $this;
    }

    /**
     * Validate the 'auth_time' claim.
     *
     * @param int      $maxAge maximum window of time in seconds since the 'auth_time' to accept the token
     * @param int      $leeway leeway in seconds to allow during time calculations
     * @param null|int $now    Optional. Unix timestamp representing the current point in time to use for time calculations.
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function authTime(
        int $maxAge,
        int $leeway = 60,
        ?int $now = null,
    ): self {
        $authTime = $this->getClaim('auth_time');
        $now ??= time();

        if (null === $authTime || ! is_numeric($authTime)) {
            throw InvalidTokenException::missingAuthTimeClaim();
        }

        $validUntil = (int) $authTime + $maxAge + $leeway;

        if ($now > $validUntil) {
            throw InvalidTokenException::mismatchedAuthTimeClaim($now, $validUntil);
        }

        return $this;
    }

    /**
     * Validate the 'events' claim.
     *
     * @param array<string> $expects An array of allowed values for the 'events' claim. Successful if ANY match.
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function events(
        array $expects,
    ): self {
        $events = $this->getClaim('events');

        if (null === $events || ! is_array($events)) {
            throw InvalidTokenException::missingEventsClaim();
        }

        foreach ($expects as $expect) {
            if (! isset($events[$expect])) {
                throw InvalidTokenException::mismatchedEventsClaim(implode(', ', $expects), implode(', ', $events));
            }
        }

        return $this;
    }

    /**
     * Validate the 'exp' claim.
     *
     * @param int      $leeway leeway in seconds to allow during time calculations
     * @param null|int $now    Optional. Unix timestamp representing the current point in time to use for time calculations.
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function expiration(
        int $leeway = 60,
        ?int $now = null,
    ): self {
        $expires = $this->getClaim('exp');
        $now ??= time();

        if (null === $expires || ! is_numeric($expires)) {
            throw InvalidTokenException::missingExpClaim();
        }

        $expires = (int) $expires + $leeway;

        if ($now > $expires) {
            throw InvalidTokenException::mismatchedExpClaim($now, $expires);
        }

        return $this;
    }

    /**
     * Return a claim by it's key. Null if not present.
     *
     * @param string $key the claim key to search for
     *
     * @return null|array<mixed>|int|string
     */
    public function getClaim(
        string $key,
    ) {
        if (! isset($this->claims[$key])) {
            return null;
        }

        return $this->claims[$key];
    }

    /**
     * Validate the 'sid' claim is present.
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function identifier(): self
    {
        $sid = $this->getClaim('sid');

        if (null === $sid || ! is_string($sid)) {
            throw InvalidTokenException::missingSidClaim();
        }

        return $this;
    }

    /**
     * Validate the 'iat' claim is present.
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function issued(): self
    {
        $issued = $this->getClaim('iat');

        if (null === $issued) {
            throw InvalidTokenException::missingIatClaim();
        }

        return $this;
    }

    /**
     * Validate the 'iss' claim.
     *
     * @param string $expects the value to compare with the claim
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function issuer(
        string $expects,
    ): self {
        $claim = $this->getClaim('iss');

        if (null === $claim || ! is_string($claim)) {
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
     * @param string $expects the value to compare with the claim
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function nonce(
        string $expects,
    ): self {
        $claim = $this->getClaim('nonce');

        if (null === $claim || ! is_string($claim)) {
            throw InvalidTokenException::missingNonceClaim();
        }

        if ($claim !== $expects) {
            throw InvalidTokenException::mismatchedNonceClaim($expects, $claim);
        }

        return $this;
    }

    /**
     * Validate the 'org_id' and `org_name` claims.
     *
     * @param array<string> $expects An array of allowed values for the 'org_id' or `org_name` claim. Successful if ANY match.
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function organization(
        array $expects,
    ): self {
        $allowedOrganizations = array_filter(array_values($expects));
        $organizationId = $this->getClaim('org_id');
        $organizationName = $this->getClaim('org_name');

        // No claims or SDK allowlist configured, so skip validation. Pass.
        if (['*'] === $allowedOrganizations) {
            return $this;
        }

        // If a claim is present, ensure it is a string; otherwise throw.
        if ((null !== $organizationId && ! is_string($organizationId)) || (null !== $organizationName && ! is_string($organizationName))) {
            throw new InvalidTokenException(InvalidTokenException::MSG_ORGANIZATION_CLAIM_BAD);
        }

        // If an SDK allowlist has been configured, we need to run comparisons.
        if ([] !== $allowedOrganizations) {
            if (null === $organizationId && null === $organizationName) {
                throw new InvalidTokenException(InvalidTokenException::MSG_ORGANIZATION_CLAIM_MISSING);
            }

            if (null !== $organizationId) {
                $allowedOrganizationIds = array_filter($allowedOrganizations, static fn ($org): bool => str_starts_with($org, 'org_'));

                // org_id claim is present and in the allowlist. Success.
                if (in_array($organizationId, $allowedOrganizationIds, true)) {
                    return $this;
                }
            }

            if (null !== $organizationName) {
                $allowedOrganizationNames = array_map('strtolower', array_filter($allowedOrganizations, static fn ($org): bool => ! str_starts_with($org, 'org_')));

                // org_name claim is present and in the allowlist. Success.
                if (in_array($organizationName, $allowedOrganizationNames, true)) {
                    return $this;
                }
            }

            throw new InvalidTokenException(InvalidTokenException::MSG_ORGANIZATION_CLAIM_UNMATCHED);
        }

        // A claim is present, but there is no allowlist configured. Throw.
        if (null !== $organizationId || null !== $organizationName) {
            throw new InvalidTokenException(InvalidTokenException::MSG_ORGANIZATION_CLAIM_UNEXPECTED);
        }

        return $this;
    }

    /**
     * Validate the 'sub' claim is present.
     *
     * @throws InvalidTokenException when claim validation fails
     */
    public function subject(): self
    {
        $claim = $this->getClaim('sub');

        if (null === $claim) {
            throw InvalidTokenException::missingSubClaim();
        }

        return $this;
    }
}
