<?php

declare(strict_types=1);

namespace Auth0\SDK\Configuration;

use Auth0\SDK\Contract\ConfigurableContract;
use Auth0\SDK\Mixins\ConfigurableMixin;
use Throwable;

use function is_array;
use function is_int;
use function is_string;

final class SdkState implements ConfigurableContract
{
    use ConfigurableMixin;

    /**
     * SdkState Constructor.
     *
     * @param null|array<mixed>  $configuration         Optional. Pass an array of parameter keys and values to define the internal state of the SDK.
     * @param null|string        $idToken               Optional. The id token currently in use for the session, if available.
     * @param null|string        $accessToken           Optional. The access token currently in use for the session, if available.
     * @param null|array<string> $accessTokenScope      Optional. The scopes from the access token for the session, if available.
     * @param null|string        $refreshToken          Optional. The refresh token currently in use for the session, if available.
     * @param null|array<mixed>  $user                  Optional. An array representing the user data, if available.
     * @param null|int           $accessTokenExpiration Optional. When the $accessToken is expected to expire, if available.
     * @param ?string            $backchannel           Optional. The backchannel logout token assigned for the session, if available.
     */
    public function __construct(
        ?array $configuration = null,
        public ?string $idToken = null,
        public ?string $accessToken = null,
        public ?array $accessTokenScope = null,
        public ?string $refreshToken = null,
        public ?array $user = null,
        public ?int $accessTokenExpiration = null,
        public ?string $backchannel = null,
    ) {
        if (null !== $configuration && [] !== $configuration) {
            $this->applyConfiguration($configuration);
        }

        $this->validateProperties();
    }

    public function getAccessToken(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->accessToken, $exceptionIfNull);

        return $this->accessToken;
    }

    public function getAccessTokenExpiration(?Throwable $exceptionIfNull = null): ?int
    {
        $this->exceptionIfNull($this->accessTokenExpiration, $exceptionIfNull);

        return $this->accessTokenExpiration;
    }

    /**
     * @param ?Throwable $exceptionIfNull
     *
     * @return null|array<string>
     */
    public function getAccessTokenScope(?Throwable $exceptionIfNull = null): ?array
    {
        $this->exceptionIfNull($this->accessTokenScope, $exceptionIfNull);

        return $this->accessTokenScope;
    }

    public function getBackchannel(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->backchannel, $exceptionIfNull);

        return $this->backchannel;
    }

    public function getIdToken(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->idToken, $exceptionIfNull);

        return $this->idToken;
    }

    public function getRefreshToken(?Throwable $exceptionIfNull = null): ?string
    {
        $this->exceptionIfNull($this->refreshToken, $exceptionIfNull);

        return $this->refreshToken;
    }

    /**
     * @param ?Throwable $exceptionIfNull
     *
     * @return null|array<mixed> $user an array representing user data
     */
    public function getUser(?Throwable $exceptionIfNull = null): ?array
    {
        $this->exceptionIfNull($this->user, $exceptionIfNull);

        return $this->user;
    }

    public function hasAccessToken(): bool
    {
        return null !== $this->accessToken;
    }

    public function hasAccessTokenExpiration(): bool
    {
        return null !== $this->accessTokenExpiration;
    }

    public function hasAccessTokenScope(): bool
    {
        return null !== $this->accessTokenScope;
    }

    public function hasBackchannel(): bool
    {
        return null !== $this->backchannel;
    }

    public function hasIdToken(): bool
    {
        return null !== $this->idToken;
    }

    public function hasRefreshToken(): bool
    {
        return null !== $this->refreshToken;
    }

    public function hasUser(): bool
    {
        return null !== $this->user;
    }

    /**
     * @param array<string>|string $scopes a string (or array of strings) representing the scopes to add for the access token
     *
     * @return null|array<string>
     */
    public function pushAccessTokenScope(array | string $scopes): ?array
    {
        if (is_string($scopes)) {
            $scopes = [$scopes];
        }

        $this->setAccessTokenScope(array_merge($this->accessTokenScope ?? [], $scopes));

        return $this->accessTokenScope;
    }

    public function setAccessToken(?string $accessToken = null): self
    {
        $accessToken = trim($accessToken ?? '');

        if ('' === $accessToken) {
            $accessToken = null;
        }

        $this->accessToken = $accessToken;

        return $this;
    }

    public function setAccessTokenExpiration(?int $accessTokenExpiration = null): self
    {
        if (null !== $accessTokenExpiration && $accessTokenExpiration < 0) {
            throw \Auth0\SDK\Exception\ConfigurationException::validationFailed('accessTokenExpiration');
        }

        $this->accessTokenExpiration = $accessTokenExpiration;

        return $this;
    }

    /**
     * @param null|array<string> $accessTokenScope an array of strings representing the scopes for the access token
     */
    public function setAccessTokenScope(?array $accessTokenScope): self
    {
        $this->accessTokenScope = $this->filterArray($accessTokenScope);

        return $this;
    }

    public function setBackchannel(?string $backchannel = null): self
    {
        if (null !== $backchannel && '' === trim($backchannel)) {
            $backchannel = null;
        }

        $this->backchannel = $backchannel;

        return $this;
    }

    public function setIdToken(?string $idToken = null): self
    {
        $idToken = trim($idToken ?? '');

        if ('' === $idToken) {
            $idToken = null;
        }

        $this->idToken = $idToken;

        return $this;
    }

    public function setRefreshToken(?string $refreshToken = null): self
    {
        $refreshToken = trim($refreshToken ?? '');

        if ('' === $refreshToken) {
            $refreshToken = null;
        }

        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * @param null|array<mixed> $user an array representing user data
     */
    public function setUser(?array $user): self
    {
        if (null !== $user && [] === $user) {
            $user = null;
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return array{idToken: null, accessToken: null, accessTokenScope: null, refreshToken: null, user: null, accessTokenExpiration: null}
     */
    private function getPropertyDefaults(): array
    {
        return [
            'idToken' => null,
            'accessToken' => null,
            'accessTokenScope' => null,
            'refreshToken' => null,
            'user' => null,
            'accessTokenExpiration' => null,
        ];
    }

    /**
     * @return array<callable>
     *
     * @psalm-suppress MissingClosureParamType
     */
    private function getPropertyValidators(): array
    {
        return [
            'idToken' => static fn ($value): bool => is_string($value) || null === $value,
            'accessToken' => static fn ($value): bool => is_string($value) || null === $value,
            'accessTokenScope' => static fn ($value): bool => is_array($value) || null === $value,
            'refreshToken' => static fn ($value): bool => is_string($value) || null === $value,
            'user' => static fn ($value): bool => is_array($value) || null === $value,
            'accessTokenExpiration' => static fn ($value): bool => is_int($value) || null === $value,
        ];
    }
}
