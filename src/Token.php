<?php

declare(strict_types=1);

namespace Auth0\SDK;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\TokenInterface;
use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Token\Parser;
use Psr\Cache\CacheItemPoolInterface;

use function is_array;
use function is_int;
use function is_string;

final class Token implements TokenInterface
{
    /**
     * @var string
     */
    public const ALGO_HS256 = 'HS256';

    /**
     * @var string
     */
    public const ALGO_HS384 = 'HS384';

    /**
     * @var string
     */
    public const ALGO_HS512 = 'HS512';

    /**
     * @var string
     */
    public const ALGO_RS256 = 'RS256';

    /**
     * @var string
     */
    public const ALGO_RS384 = 'RS384';

    /**
     * @var string
     */
    public const ALGO_RS512 = 'RS512';

    /**
     * @var int
     */
    public const TYPE_ACCESS_TOKEN = 2;

    /**
     * @var int
     */
    public const TYPE_ID_TOKEN = 1;

    /**
     * @var int
     */
    public const TYPE_LOGOUT_TOKEN = 3;

    /**
     * @deprecated Use TYPE_ACCESS_TOKEN instead.
     */
    public const TYPE_TOKEN = 2;

    private ?Parser $parser = null;

    /**
     * Constructor for Token handling class.
     *
     * @param SdkConfiguration $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     * @param string           $jwt           a JWT string to parse, and prepare for verification and validation
     * @param int              $type          Specify the Token type to toggle specific claim validations. Defaults to 1 for ID Token. See TYPE_ consts for options.
     *
     * @throws InvalidTokenException When Token parsing fails. See the exception message for further details.
     */
    public function __construct(
        private SdkConfiguration $configuration,
        private string $jwt,
        private int $type = self::TYPE_ID_TOKEN,
    ) {
    }

    public function getAudience(): ?array
    {
        $claim = $this->getParser()->getClaim('aud');
        $reshaped = [];

        if (is_string($claim) || is_int($claim)) {
            $claim = [$claim];
        }

        if (! is_array($claim)) {
            return null;
        }

        foreach ($claim as $k => $v) {
            if (is_string($v) && ctype_digit($v)) {
                $v = (int) $v;
            }

            if (is_string($v) || is_int($v)) {
                $reshaped[$k] = (string) $v;
            }
        }

        return $reshaped;
    }

    public function getAuthorizedParty(): ?string
    {
        if (is_string($claim = $this->getParser()->getClaim('azp'))) {
            return $claim;
        }

        return null;
    }

    public function getAuthTime(): ?int
    {
        $claim = $this->getParser()->getClaim('auth_time');

        if (is_int($claim) || is_string($claim) && ctype_digit($claim)) {
            return (int) $claim;
        }

        return null;
    }

    public function getEvents(): ?array
    {
        if (is_array($claim = $this->getParser()->getClaim('events'))) {
            return $claim;
        }

        return null;
    }

    public function getExpiration(): ?int
    {
        $claim = $this->getParser()->getClaim('exp');

        if (is_int($claim) || is_string($claim) && ctype_digit($claim)) {
            return (int) $claim;
        }

        return null;
    }

    public function getIdentifier(): ?string
    {
        if (is_string($claim = $this->getParser()->getClaim('sid'))) {
            return $claim;
        }

        return null;
    }

    public function getIssued(): ?int
    {
        $claim = $this->getParser()->getClaim('iat');

        if (is_int($claim) || is_string($claim) && ctype_digit($claim)) {
            return (int) $claim;
        }

        return null;
    }

    public function getIssuer(): ?string
    {
        if (is_string($claim = $this->getParser()->getClaim('iss'))) {
            return $claim;
        }

        return null;
    }

    public function getNonce(): ?string
    {
        if (is_string($claim = $this->getParser()->getClaim('nonce'))) {
            return $claim;
        }

        return null;
    }

    public function getOrganization(): ?string
    {
        if (null !== ($claim = $this->getOrganizationId())) {
            return $claim;
        }

        if (null !== ($claim = $this->getOrganizationName())) {
            return $claim;
        }

        return null;
    }

    public function getOrganizationId(): ?string
    {
        if (is_string($claim = $this->getParser()->getClaim('org_id'))) {
            return $claim;
        }

        return null;
    }

    public function getOrganizationName(): ?string
    {
        if (is_string($claim = $this->getParser()->getClaim('org_name'))) {
            return $claim;
        }

        return null;
    }

    public function getSubject(): ?string
    {
        if (is_string($claim = $this->getParser()->getClaim('sub'))) {
            return $claim;
        }

        return null;
    }

    public function parse(
    ): self {
        $this->getParser();

        return $this;
    }

    public function toArray(): array
    {
        return $this->getParser()->export();
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    }

    public function validate(
        ?string $tokenIssuer = null,
        ?array $tokenAudience = null,
        ?array $tokenOrganization = null,
        ?string $tokenNonce = null,
        ?int $tokenMaxAge = null,
        ?int $tokenLeeway = null,
        ?int $tokenNow = null,
    ): self {
        $tenantDomain = $this->configuration->formatDomain(true) . '/';
        $tokenIssuer ??= $this->configuration->formatDomain() . '/';
        $tokenAudience ??= $this->configuration->getAudience() ?? [];
        $tokenOrganization ??= $this->configuration->getOrganization() ?? null;
        $tokenMaxAge ??= $this->configuration->getTokenMaxAge() ?? null;
        $tokenLeeway ??= $this->configuration->getTokenLeeway() ?? 60;
        $tokenAudience[] = (string) $this->configuration->getClientId();
        $tokenAudience = array_unique($tokenAudience);

        $validator = $this->getParser()->validate();
        $tokenNow ??= time();

        if (self::TYPE_LOGOUT_TOKEN === $this->type) {
            if (null !== $this->getParser()->getClaim('nonce')) {
                throw InvalidTokenException::logoutTokenNoncePresent();
            }

            if (null === $this->getParser()->getClaim('events')) {
                throw InvalidTokenException::missingEventsClaim();
            }
        }

        try {
            $validator->issuer($tokenIssuer);
        } catch (InvalidTokenException $invalidTokenException) {
            if ($tenantDomain !== $tokenIssuer) {
                $validator->issuer($tenantDomain);
            } else {
                throw $invalidTokenException;
            }
        }

        $validator
            ->audience($tokenAudience)
            ->expiration($tokenLeeway, $tokenNow);

        if (self::TYPE_ID_TOKEN === $this->type) {
            $validator
                ->subject()
                ->issued()
                ->authorizedParty($tokenAudience);
        }

        if (self::TYPE_LOGOUT_TOKEN === $this->type) {
            $validator
                ->issued()
                ->authorizedParty($tokenAudience)
                ->events(['http://schemas.openid.net/event/backchannel-logout']);

            $events = $this->getEvents();

            if (! is_array($events['http://schemas.openid.net/event/backchannel-logout'] ?? null)) {
                throw InvalidTokenException::badEventClaim('http://schemas.openid.net/event/backchannel-logout', 'object');
            }

            if (null === $this->getSubject() && null === $this->getIdentifier()) {
                throw InvalidTokenException::missingSubAndSidClaims();
            }
        }

        if (null !== $tokenNonce) {
            $validator->nonce($tokenNonce);
        }

        if (null !== $tokenMaxAge) {
            $validator->authTime($tokenMaxAge, $tokenLeeway, $tokenNow);
        }

        if (null !== $tokenOrganization) {
            $validator->organization($tokenOrganization);
        }

        return $this;
    }

    public function verify(
        ?string $tokenAlgorithm = null,
        ?string $tokenJwksUri = null,
        ?string $clientSecret = null,
        ?int $tokenCacheTtl = null,
        ?CacheItemPoolInterface $tokenCache = null,
    ): self {
        $tokenAlgorithm ??= $this->configuration->getTokenAlgorithm();
        $tokenJwksUri ??= $this->configuration->getTokenJwksUri() ?? null;
        $clientSecret ??= $this->configuration->getClientSecret() ?? null;
        $tokenCacheTtl ??= $this->configuration->getTokenCacheTtl();
        $tokenCache ??= $this->configuration->getTokenCache() ?? null;

        if (null === $tokenJwksUri) {
            $tokenJwksUri = $this->configuration->formatDomain() . '/.well-known/jwks.json';
        }

        $this->getParser()->verify(
            $tokenAlgorithm,
            $tokenJwksUri,
            $clientSecret,
            $tokenCacheTtl,
            $tokenCache,
        );

        return $this;
    }

    private function getParser(): Parser
    {
        if (! $this->parser instanceof Parser) {
            $this->parser = new Parser($this->configuration, $this->jwt);
        }

        return $this->parser;
    }
}
