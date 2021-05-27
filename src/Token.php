<?php

declare(strict_types=1);

namespace Auth0\SDK;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token\Parser;
use Auth0\SDK\Utility\TransientStoreHandler;
use Psr\SimpleCache\CacheInterface;

/**
 * Class Token.
 */
final class Token
{
    public const TYPE_ID_TOKEN = 1;
    public const TYPE_TOKEN = 2;

    public const ALGO_RS256 = 'RS256';
    public const ALGO_HS256 = 'HS256';

    /**
     * A representation of the type of Token, to customize claim validations. See TYPE_ consts for options.
     */
    private int $type;

    /**
     * A unique, internal instance of \Auth0\SDK\Token\Parser
     */
    private Parser $parser;

    /**
     * Instance of SdkConfiguration
     */
    private SdkConfiguration $configuration;

    /**
     * Instance of TransientStoreHandler for storing ephemeral data.
     */
    private TransientStoreHandler $transient;

    /**
     * Constructor for Token handling class.
     *
     * @param string $jwt  A JWT string to parse, and prepare for verification and validation.
     * @param int    $type Specify the Token type to toggle specific claim validations. Defaults to 1 for ID Token. See TYPE_ consts for options.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function __construct(
        SdkConfiguration &$configuration,
        string $jwt,
        int $type = self::TYPE_ID_TOKEN
    ) {
        // Store the type of token we're working with.
        $this->type = $type;

        // Store the configuration internally.
        $this->configuration = & $configuration;

        // Create a transient storage handler using the configured transientStorage medium.
        $this->transient = new TransientStoreHandler($configuration->getTransientStorage());

        // Begin parsing the token.
        $this->parse($jwt);
    }

    /**
     * Parses a provided JWT string and prepare for verification and validation.
     *
     * @param string $jwt The JWT string to process.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function parse(
        string $jwt
    ): self {
        $this->parser = new Parser($jwt, $this->configuration);
        return $this;
    }

    /**
     * Verify the signature of the Token using either RS256 or HS256.
     *
     * @param string|null         $algorithm    Optional. Algorithm to use for verification. Expects either RS256 or HS256.
     * @param string|null         $jwksUri      Optional. URI to the JWKS when verifying RS256 tokens.
     * @param string|null         $clientSecret Optional. Client Secret found in the Application settings for verifying HS256 tokens.
     * @param int|null            $cacheExpires Optional. Time in seconds to keep JWKS records cached.
     * @param CacheInterface|null $cache        Optional. A PSR-6 ("SimpleCache") CacheInterface instance to cache JWKS results within.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token signature verification fails. See the exception message for further details.
     */
    public function verify(
        ?string $tokenAlgorithm = null,
        ?string $tokenJwksUri = null,
        ?string $clientSecret = null,
        ?int $tokenCacheTtl = null,
        ?CacheInterface $tokenCache = null
    ): self {
        $tokenAlgorithm = $tokenAlgorithm ?? $this->configuration->getTokenAlgorithm() ?? 'RS256';
        $tokenJwksUri = $tokenJwksUri ?? $this->configuration->getTokenJwksUri() ?? null;
        $clientSecret = $clientSecret ?? $this->configuration->getClientSecret() ?? null;
        $tokenCacheTtl = $tokenCacheTtl ?? $this->configuration->getTokenCacheTtl() ?? null;
        $tokenCache = $tokenCache ?? $this->configuration->getTokenCache() ?? null;

        $this->parser->verify($tokenAlgorithm, $tokenJwksUri, $clientSecret, $tokenCacheTtl, $tokenCache);

        return $this;
    }

    /**
     * Validate the claims of the token.
     *
     * @param string      $issuer       The value expected for the 'iss' claim.
     * @param array       $audience     An array of allowed values for the 'aud' claim. Successful if ANY match.
     * @param array|null  $organization Optional. An array of allowed values for the 'org_id' claim. Successful if ANY match.
     * @param string|null $nonce        Optional. The value expected for the 'nonce' claim.
     * @param int|null    $maxAge       Optional. Maximum window of time in seconds since the 'auth_time' to accept the token.
     * @param int|null    $leeway       Optional. Leeway in seconds to allow during time calculations. Defaults to 60.
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
    ): self {
        $tokenIssuer = $tokenIssuer ?? 'https://' . $this->configuration->getDomain() . '/';
        $tokenAudience = $tokenAudience ?? $this->configuration->getAudience() ?? null;
        $tokenOrganization = $tokenOrganization ?? $this->configuration->getOrganization() ?? null;
        $tokenNonce = $tokenNonce ?? $this->transient->getOnce('nonce') ?? null;
        $tokenMaxAge = $tokenMaxAge ?? $this->transient->getOnce('max_age') ?? $this->configuration->getTokenMaxAge() ?? null;
        $tokenLeeway = $tokenLeeway ?? $this->configuration->getTokenLeeway() ?? 60;

        // If 'aud' claim check isn't defined, fallback to client id.
        if ($tokenAudience === null) {
            $tokenAudience = [ $this->configuration->getClientId() ];
        }

        // If pulling from transient storage, $tokenMaxAge might be a string.
        if ($tokenMaxAge !== null && ! is_int($tokenMaxAge) && is_numeric($tokenMaxAge)) {
            $tokenMaxAge = (int) $tokenMaxAge;
        }

        // If pulling from transient storage, $tokenLeeway might be a string.
        if ($tokenLeeway !== null && ! is_int($tokenLeeway) && is_numeric($tokenLeeway)) {
            $tokenLeeway = (int) $tokenLeeway;
        }

        $validator = $this->parser->validate();
        $now = $tokenNow ?? time();

        $validator
            ->issuer($tokenIssuer)
            ->audience($tokenAudience)
            ->expiration($tokenLeeway, $now);

        if ($this->type === self::TYPE_ID_TOKEN) {
            $validator
                ->subject()
                ->issued()
                ->authorizedParty($tokenAudience);
        }

        if ($tokenNonce !== null) {
            $validator->nonce($tokenNonce);
        }

        if ($tokenMaxAge !== null) {
            $validator->authTime($tokenMaxAge, $tokenLeeway, $now);
        }

        if ($tokenOrganization) {
            $validator->organization($tokenOrganization);
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
