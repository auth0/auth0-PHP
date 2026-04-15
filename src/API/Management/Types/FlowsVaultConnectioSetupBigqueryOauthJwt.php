<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectioSetupBigqueryOauthJwt extends JsonSerializableType
{
    /**
     * @var ?value-of<FlowsVaultConnectioSetupTypeOauthJwtEnum> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?string $projectId
     */
    #[JsonProperty('project_id')]
    private ?string $projectId;

    /**
     * @var ?string $privateKey
     */
    #[JsonProperty('private_key')]
    private ?string $privateKey;

    /**
     * @var ?string $clientEmail
     */
    #[JsonProperty('client_email')]
    private ?string $clientEmail;

    /**
     * @param array{
     *   type?: ?value-of<FlowsVaultConnectioSetupTypeOauthJwtEnum>,
     *   projectId?: ?string,
     *   privateKey?: ?string,
     *   clientEmail?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
        $this->projectId = $values['projectId'] ?? null;
        $this->privateKey = $values['privateKey'] ?? null;
        $this->clientEmail = $values['clientEmail'] ?? null;
    }

    /**
     * @return ?value-of<FlowsVaultConnectioSetupTypeOauthJwtEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<FlowsVaultConnectioSetupTypeOauthJwtEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getProjectId(): ?string
    {
        return $this->projectId;
    }

    /**
     * @param ?string $value
     */
    public function setProjectId(?string $value = null): self
    {
        $this->projectId = $value;
        $this->_setField('projectId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPrivateKey(): ?string
    {
        return $this->privateKey;
    }

    /**
     * @param ?string $value
     */
    public function setPrivateKey(?string $value = null): self
    {
        $this->privateKey = $value;
        $this->_setField('privateKey');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    /**
     * @param ?string $value
     */
    public function setClientEmail(?string $value = null): self
    {
        $this->clientEmail = $value;
        $this->_setField('clientEmail');
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
