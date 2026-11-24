<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\Webtask;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * A webtask in the tenant's container, as returned by the webtask platform's GET. Code and decrypted secrets are only included when requested.
 */
class GetWebtaskResponseContent extends JsonSerializableType
{
    use Webtask;

    /**
     * @var ?string $code JavaScript code of the webtask. Only returned with <code>fetch_code=true</code>.
     */
    #[JsonProperty('code')]
    private ?string $code;

    /**
     * @var ?array<string, string> $secrets
     */
    #[JsonProperty('secrets'), ArrayType(['string' => 'string'])]
    private ?array $secrets;

    /**
     * @param array{
     *   container: string,
     *   name: string,
     *   meta: array<string, string>,
     *   token?: ?string,
     *   webtaskUrl?: ?string,
     *   code?: ?string,
     *   secrets?: ?array<string, string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->container = $values['container'];
        $this->name = $values['name'];
        $this->token = $values['token'] ?? null;
        $this->meta = $values['meta'];
        $this->webtaskUrl = $values['webtaskUrl'] ?? null;
        $this->code = $values['code'] ?? null;
        $this->secrets = $values['secrets'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param ?string $value
     */
    public function setCode(?string $value = null): self
    {
        $this->code = $value;
        $this->_setField('code');
        return $this;
    }

    /**
     * @return ?array<string, string>
     */
    public function getSecrets(): ?array
    {
        return $this->secrets;
    }

    /**
     * @param ?array<string, string> $value
     */
    public function setSecrets(?array $value = null): self
    {
        $this->secrets = $value;
        $this->_setField('secrets');
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
