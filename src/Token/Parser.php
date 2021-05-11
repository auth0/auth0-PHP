<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Token;
use Psr\SimpleCache\CacheInterface;

/**
 * Class Parser.
 */
class Parser
{
    protected array $token = [];

    public function __construct(
        string $jwt
    ) {
        $this->parse($jwt);
    }

    public function parse(
        string $jwt
    ) {
        $parts = explode('.', $jwt);

        if (count($parts) !== 3) {
            throw InvalidTokenException::badSeparators();
        }

        $decoded = [
            'raw' => $jwt,
            'parts' => $parts,
            'headers' => $this->decodeHeaders($parts[0]),
            'claims' => $this->decodeClaims($parts[1]),
            'signature' => $this->decodeSignature($parts[2]),
        ];

        if (! isset($decoded['headers']['typ'])) {
            $decoded['headers']['typ'] = 'JWT';
        }

        $this->token = $decoded;
        return $this->token;
    }

    public function validate(): Validator
    {
        return new Validator($this->token['claims']);
    }

    public function verify(
        ?string $algorithm = Token::ALGO_RS256,
        ?string $jwksUri = null,
        ?string $clientSecret = null,
        ?int $cacheExpires = null,
        ?CacheInterface $cache = null
    ): self {
        (new Verifier(join('.', [$this->token['parts'][0], $this->token['parts'][1]]), $this->token['signature'], $this->token['headers'], $algorithm, $jwksUri, $clientSecret, $cacheExpires, $cache))->verify();
        return $this;
    }

    public function export(): array
    {
        return $this->getClaims();
    }

    public function hasClaim(
        string $key
    ): bool {
        return ($this->getClaim($key) !== null);
    }

    public function getClaim(
        string $key
    ) {
        if (! isset($this->token['claims'][$key])) {
            return null;
        }

        return $this->token['claims'][$key];
    }

    public function getClaims(): array
    {
        return $this->token['claims'] ?? [];
    }

    public function hasHeader(
        string $key
    ): bool {
        return ($this->getHeader($key) !== null);
    }

    public function getHeader(
        string $key
    ): ?string {
        if (! isset($this->token['headers'][$key])) {
            return null;
        }

        return $this->token['headers'][$key];
    }

    public function getHeaders(): array
    {
        return $this->token['headers'] ?? [];
    }

    public function getRaw(): ?string
    {
        return $this->token['raw'] ?? null;
    }

    public function getSignature(): string
    {
        return $this->token['signature'] ?? '';
    }

    protected function decodeClaims(
        string $claims
    ): array {
        return json_decode(base64_decode(strtr($claims, '-_', '+/'), true), true, 512, JSON_THROW_ON_ERROR);
    }

    protected function decodeHeaders(
        string $headers
    ): array {
        return json_decode(base64_decode(strtr($headers, '-_', '+/'), true), true, 512, JSON_THROW_ON_ERROR);
    }

    protected function decodeSignature(
        string $signature
    ): string {
        return base64_decode(strtr($signature, '-_', '+/'), true);
    }
}
