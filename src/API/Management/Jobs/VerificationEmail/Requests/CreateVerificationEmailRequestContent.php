<?php

namespace Auth0\SDK\API\Management\Jobs\VerificationEmail\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\Identity;

class CreateVerificationEmailRequestContent extends JsonSerializableType
{
    /**
     * @var string $userId user_id of the user to send the verification email to.
     */
    #[JsonProperty('user_id')]
    private string $userId;

    /**
     * @var ?string $clientId client_id of the client (application). If no value provided, the global Client ID will be used.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?Identity $identity
     */
    #[JsonProperty('identity')]
    private ?Identity $identity;

    /**
     * @var ?string $organizationId (Optional) Organization ID – the ID of the Organization. If provided, organization parameters will be made available to the email template and organization branding will be applied to the prompt. In addition, the redirect link in the prompt will include organization_id and organization_name query string parameters.
     */
    #[JsonProperty('organization_id')]
    private ?string $organizationId;

    /**
     * @param array{
     *   userId: string,
     *   clientId?: ?string,
     *   identity?: ?Identity,
     *   organizationId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
        $this->clientId = $values['clientId'] ?? null;
        $this->identity = $values['identity'] ?? null;
        $this->organizationId = $values['organizationId'] ?? null;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $value
     */
    public function setUserId(string $value): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?Identity
     */
    public function getIdentity(): ?Identity
    {
        return $this->identity;
    }

    /**
     * @param ?Identity $value
     */
    public function setIdentity(?Identity $value = null): self
    {
        $this->identity = $value;
        $this->_setField('identity');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getOrganizationId(): ?string
    {
        return $this->organizationId;
    }

    /**
     * @param ?string $value
     */
    public function setOrganizationId(?string $value = null): self
    {
        $this->organizationId = $value;
        $this->_setField('organizationId');
        return $this;
    }
}
