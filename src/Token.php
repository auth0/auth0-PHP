<?php

declare(strict_types=1);

namespace Auth0\SDK;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Token\Parser;
use Psr\SimpleCache\CacheInterface;

/**
 * Class Token.
 */
class Token
{
    public const TYPE_ID_TOKEN = 1;
    public const TYPE_TOKEN = 2;

    public const ALGO_RS256 = 'RS256';
    public const ALGO_HS256 = 'HS256';

    /**
     * A representation of the type of Token, to customize claim validations. See TYPE_ consts for options.
     */
    protected int $type;

    /**
     * A unique, internal instance of \Auth0\SDK\Token\Parser
     */
    protected Parser $parser;

    /**
     * Constructor for Token handling class.
     *
     * @param string $jwt A JWT string to parse, and prepare for verification and validation.
     * @param int $type Specify the Token type to toggle specific claim validations. Defaults to 1 for ID Token. See TYPE_ consts for options.
     *
     * @throws InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function __construct(
        string $jwt,
        int $type = self::TYPE_ID_TOKEN
    ) {
        $this->type = $type;
        $this->parse($jwt);
    }

    /**
     * Parses a provided JWT string and prepare for verification and validation.
     *
     * @param string $jwt The JWT string to process.
     *
     * @throws InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function parse(
        string $jwt
    ): self {
        $this->parser = (new Parser($jwt));
        return $this;
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
        ?string $algorithm = self::ALGO_RS256,
        ?string $jwksUri = null,
        ?string $clientSecret = null,
        ?int $cacheExpires = null,
        ?CacheInterface $cache = null
    ): self {
        $this->parser->verify($algorithm, $jwksUri, $clientSecret, $cacheExpires, $cache);
        return $this;
    }

    /**
     * Validate the claims of the token.
     *
     * @param string $issuer The value expected for the 'iss' claim.
     * @param array $audience An array of allowed values for the 'aud' claim. Successful if ANY match.
     * @param array|null $organization Optional. An array of allowed values for the 'org_id' claim. Successful if ANY match.
     * @param string|null $nonce Optional. The value expected for the 'nonce' claim.
     * @param int|null $maxAge Optional. Maximum window of time in seconds since the 'auth_time' to accept the token.
     * @param int|null $leeway Optional. Leeway in seconds to allow during time calculations. Defaults to 60.
     *
     * @throws InvalidTokenException When Token validation fails. See the exception message for further details.
     */
    public function validate(
        string $issuer,
        array $audience,
        ?array $organization = null,
        ?string $nonce = null,
        ?int $maxAge = null,
        ?int $leeway = null
    ): self {
        $validator = $this->parser->validate();
        $now = time();
        $leeway = $leeway ?? 60;

        $validator
            ->issuer($issuer)
            ->audience($audience)
            ->expiration($leeway, $now);

        if ($this->type === self::TYPE_ID_TOKEN) {
            $validator
                ->subject()
                ->issued()
                ->authorizedParty($audience);
        }

        if ($nonce !== null) {
            $validator->nonce($nonce);
        }

        if ($maxAge !== null) {
            $validator->authTime($maxAge, $leeway, $now);
        }

        if ($organization !== null) {
            $validator->organization($organization);
        }

        return $this;
    }

    /**
     * Get the contents of the 'aud' claim, always returned an array. Null if not present.
     *
     * @return array|null
     */
    public function getAudience(): ?array
    {
        $claim = $this->parser->getClaim('aud');

        if (is_string($claim)) {
            return [ $claim ];
        }

        return $claim;
    }

    /**
     * Get the contents of the 'azp' claim. Null if not present.
     */
    public function getAuthorizedParty(): ?string
    {
        return $this->parser->getClaim('azp');
    }

    /**
     * Get the contents of the 'auth_time' claim. Null if not present.
     */
    public function getAuthTime(): ?string
    {
        return $this->parser->getClaim('auth_time');
    }

    /**
     * Get the contents of the 'exp' claim. Null if not present.
     */
    public function getExpiration(): ?int
    {
        return $this->parser->getClaim('exp');
    }

    /**
     * Get the contents of the 'iat' claim. Null if not present.
     */
    public function getIssued(): ?int
    {
        return $this->parser->getClaim('iat');
    }

    /**
     * Get the contents of the 'iss' claim. Null if not present.
     */
    public function getIssuer(): ?string
    {
        return $this->parser->getClaim('iss');
    }

    /**
     * Get the contents of the 'nonce' claim. Null if not present.
     */
    public function getNonce(): ?string
    {
        return $this->parser->getClaim('nonce');
    }

    /**
     * Get the contents of the 'org_id' claim. Null if not present.
     */
    public function getOrganization(): ?string
    {
        return $this->parser->getClaim('org_id');
    }

    /**
     * Get the contents of the 'sub' claim. Null if not present.
     */
    public function getSubject(): ?string
    {
        return $this->parser->getClaim('sub');
    }

    /**
     * Export the state of the Token object as a PHP array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->parser->export();
    }

    /**
     * Export a JSON encoded object (as a string) representing the state of the Token object. Note that this is not itself an ID Token, but is useful for debugging your user state.
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
}
