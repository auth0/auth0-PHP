<?php

namespace Auth0\SDK\API\Management\Keys\NetworkAcls\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\NetworkAclKeyAlgorithmEnum;

class CreateKeysNetworkAclsRequestContent extends JsonSerializableType
{
    /**
     * @var string $name Customer-supplied label with no cryptographic meaning. Must be unique across all Network ACL keys for the tenant.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var value-of<NetworkAclKeyAlgorithmEnum> $alg
     */
    #[JsonProperty('alg')]
    private string $alg;

    /**
     * @var string $value Base64-encoded raw key material. Constraints on the decoded value depend on the algorithm specified. Currently only HMAC-SHA256 is supported.
     */
    #[JsonProperty('value')]
    private string $value;

    /**
     * @param array{
     *   name: string,
     *   alg: value-of<NetworkAclKeyAlgorithmEnum>,
     *   value: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->alg = $values['alg'];
        $this->value = $values['value'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return value-of<NetworkAclKeyAlgorithmEnum>
     */
    public function getAlg(): string
    {
        return $this->alg;
    }

    /**
     * @param value-of<NetworkAclKeyAlgorithmEnum> $value
     */
    public function setAlg(string $value): self
    {
        $this->alg = $value;
        $this->_setField('alg');
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        $this->_setField('value');
        return $this;
    }
}
