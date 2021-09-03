<?php

declare(strict_types=1);

namespace Auth0\SDK;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token\Parser;
use Psr\Cache\CacheItemPoolInterface;

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
     * Constructor for Token handling class.
     *
     * @param SdkConfiguration $configuration   Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string           $jwt             A JWT string to parse, and prepare for verification and validation.
     * @param int              $type            Specify the Token type to toggle specific claim validations. Defaults to 1 for ID Token. See TYPE_ consts for options.
     *
     * @throws \Auth0\SDK\Exception\InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function __construct(
        SdkConfiguration $configuration,
        string $jwt,
        int $type = self::TYPE_ID_TOKEN
    ) {
        // Store the type of token we're working with.
        $this->type = $type;

        // Store the configuration internally.
        $this->configuration = $configuration;

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
    ): self {
        $tokenAlgorithm = $tokenAlgorithm ?? $this->configuration->getTokenAlgorithm();
        $tokenJwksUri = $tokenJwksUri ?? $this->configuration->getTokenJwksUri() ?? null;
        $clientSecret = $clientSecret ?? $this->configuration->getClientSecret() ?? null;
        $tokenCacheTtl = $tokenCacheTtl ?? $this->configuration->getTokenCacheTtl();
        $tokenCache = $tokenCache ?? $this->configuration->getTokenCache() ?? null;

        if ($tokenJwksUri === null) {
            $tokenJwksUri = $this->configuration->formatDomain() . '/.well-known/jwks.json';
        }

        $this->parser->verify(
            $tokenAlgorithm,
            $tokenJwksUri,
            $clientSecret,
            $tokenCacheTtl,
            $tokenCache,
        );

        return $this;
    }

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
    ): self {
        $tokenIssuer = $tokenIssuer ?? $this->configuration->formatDomain() . '/';
        $tokenAudience = $tokenAudience ?? $this->configuration->getAudience() ?? [];
        $tokenOrganization = $tokenOrganization ?? $this->configuration->getOrganization() ?? null;
        $tokenNonce = $tokenNonce ?? null;
        $tokenMaxAge = $tokenMaxAge ?? $this->configuration->getTokenMaxAge() ?? null;
        $tokenLeeway = $tokenLeeway ?? $this->configuration->getTokenLeeway() ?? 60;

        // If 'aud' claim check isn't defined, fallback to client id, if configured.
        if (count($tokenAudience) === 0 && $this->configuration->hasClientId()) {
            $tokenAudience[] = (string) $this->configuration->getClientId();
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

        if ($tokenOrganization !== null) {
            $validator->organization($tokenOrganization);
        }

        return $this;
    }

    /**
     * Get the contents of the 'aud' claim, always returned an array. Null if not present.
     *
     * @return array<string>|null
     */
    public function getAudience(): ?array
    {
        $claim = $this->parser->getClaim('aud');

        if (is_string($claim)) {
            $claim = [ $claim ];
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
    public function getAuthTime(): ?int
    {
        $response = $this->parser->getClaim('auth_time');
        return $response === null ? null : (int) $response;
    }

    /**
     * Get the contents of the 'exp' claim. Null if not present.
     */
    public function getExpiration(): ?int
    {
        $response = $this->parser->getClaim('exp');
        return $response === null ? null : (int) $response;
    }

    /**
     * Get the contents of the 'iat' claim. Null if not present.
     */
    public function getIssued(): ?int
    {
        $response = $this->parser->getClaim('iat');
        return $response === null ? null : (int) $response;
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
     * @return array<mixed>
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
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    }
}
