<?php

declare(strict_types=1);

namespace Auth0\SDK;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\TokenInterface;
use Auth0\SDK\Token\Parser;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class Token.
 */
final class Token implements TokenInterface
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

    public function parse(
        string $jwt
    ): self {
        $this->parser = new Parser($jwt, $this->configuration);
        return $this;
    }

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
        $tokenAudience[] = (string) $this->configuration->getClientId();
        $tokenAudience = array_unique($tokenAudience);

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

    public function getAudience(): ?array
    {
        $claim = $this->parser->getClaim('aud');

        if (is_string($claim)) {
            $claim = [ $claim ];
        }

        /** @var array<string>|null $claim */
        return $claim;
    }

    public function getAuthorizedParty(): ?string
    {
        $claim = $this->parser->getClaim('azp');

        /** @var string|null $claim */
        return $claim;
    }

    public function getAuthTime(): ?int
    {
        /** @var int|string|null $response */
        $response = $this->parser->getClaim('auth_time');
        return $response === null ? null : (int) $response;
    }

    public function getExpiration(): ?int
    {
        /** @var int|string|null $response */
        $response = $this->parser->getClaim('exp');
        return $response === null ? null : (int) $response;
    }

    public function getIssued(): ?int
    {
        /** @var int|string|null $response */
        $response = $this->parser->getClaim('iat');
        return $response === null ? null : (int) $response;
    }

    public function getIssuer(): ?string
    {
        $claim = $this->parser->getClaim('iss');

        /** @var string|null $claim */
        return $claim;
    }

    public function getNonce(): ?string
    {
        $claim = $this->parser->getClaim('nonce');

        /** @var string|null $claim */
        return $claim;
    }

    public function getOrganization(): ?string
    {
        $claim = $this->parser->getClaim('org_id');

        /** @var string|null $claim */
        return $claim;
    }

    public function getSubject(): ?string
    {
        $claim = $this->parser->getClaim('sub');

        /** @var string|null $claim */
        return $claim;
    }

    public function toArray(): array
    {
        return $this->parser->export();
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    }
}
