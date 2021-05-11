<?php

declare(strict_types=1);

namespace Auth0\SDK;

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

    protected int $type;
    protected Parser $parser;

    public function __construct(
        string $jwt,
        int $type = self::TYPE_ID_TOKEN
    ) {
        $this->type = $type;
        $this->parse($jwt);
    }

    public function parse(
        string $jwt
    ): void {
        $this->parser = (new Parser($jwt));
    }

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

    public function validate(
        string $issuer,
        array $audience,
        ?string $organization = null,
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
            $validator->organization([$organization]);
        }

        return $this;
    }

    public function getAudience(): ?array
    {
        $claim = $this->parser->getClaim('aud');

        if (is_string($claim)) {
            return [ $claim ];
        }

        return $claim;
    }

    public function getAuthorizedParty(): ?string
    {
        return $this->parser->getClaim('azp');
    }

    public function getAuthTime(): ?string
    {
        return $this->parser->getClaim('auth_time');
    }

    public function getExpiration(): ?int
    {
        return $this->parser->getClaim('exp');
    }

    public function getIssued(): ?int
    {
        return $this->parser->getClaim('iat');
    }

    public function getIssuer(): ?string
    {
        return $this->parser->getClaim('iss');
    }

    public function getNonce(): ?string
    {
        return $this->parser->getClaim('nonce');
    }

    public function getOrganization(): ?string
    {
        return $this->parser->getClaim('org_id');
    }

    public function getSubject(): ?string
    {
        return $this->parser->getClaim('sub');
    }

    public function toArray(): array
    {
        return $this->parser->export();
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
}
