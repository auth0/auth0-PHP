<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CimdMappedPrivateKeyJwtCredential extends JsonSerializableType
{
    /**
     * @var string $credentialType Type of credential (e.g., public_key)
     */
    #[JsonProperty('credential_type')]
    private string $credentialType;

    /**
     * @var string $kid Key identifier from JWKS or calculated thumbprint
     */
    #[JsonProperty('kid')]
    private string $kid;

    /**
     * @var string $alg Algorithm (e.g., RS256, RS384, PS256)
     */
    #[JsonProperty('alg')]
    private string $alg;

    /**
     * @param array{
     *   credentialType: string,
     *   kid: string,
     *   alg: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->credentialType = $values['credentialType'];
        $this->kid = $values['kid'];
        $this->alg = $values['alg'];
    }

    /**
     * @return string
     */
    public function getCredentialType(): string
    {
        return $this->credentialType;
    }

    /**
     * @param string $value
     */
    public function setCredentialType(string $value): self
    {
        $this->credentialType = $value;
        $this->_setField('credentialType');
        return $this;
    }

    /**
     * @return string
     */
    public function getKid(): string
    {
        return $this->kid;
    }

    /**
     * @param string $value
     */
    public function setKid(string $value): self
    {
        $this->kid = $value;
        $this->_setField('kid');
        return $this;
    }

    /**
     * @return string
     */
    public function getAlg(): string
    {
        return $this->alg;
    }

    /**
     * @param string $value
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
    public function __toString(): string
    {
        return $this->toJson();
    }
}
