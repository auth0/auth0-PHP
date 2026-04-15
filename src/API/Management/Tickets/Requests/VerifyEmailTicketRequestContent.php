<?php

namespace Auth0\SDK\API\Management\Tickets\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\Identity;

class VerifyEmailTicketRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $resultUrl URL the user will be redirected to in the classic Universal Login experience once the ticket is used. Cannot be specified when using client_id or organization_id.
     */
    #[JsonProperty('result_url')]
    private ?string $resultUrl;

    /**
     * @var string $userId user_id of for whom the ticket should be created.
     */
    #[JsonProperty('user_id')]
    private string $userId;

    /**
     * @var ?string $clientId ID of the client (application). If provided for tenants using the New Universal Login experience, the email template and UI displays application details, and the user is prompted to redirect to the application's <a target='' href='https://auth0.com/docs/authenticate/login/auth0-universal-login/configure-default-login-routes#completing-the-password-reset-flow'>default login route</a> after the ticket is used. client_id is required to use the <a target='' href='https://auth0.com/docs/customize/actions/flows-and-triggers/post-change-password-flow'>Password Reset Post Challenge</a> trigger.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $organizationId (Optional) Organization ID – the ID of the Organization. If provided, organization parameters will be made available to the email template and organization branding will be applied to the prompt. In addition, the redirect link in the prompt will include organization_id and organization_name query string parameters.
     */
    #[JsonProperty('organization_id')]
    private ?string $organizationId;

    /**
     * @var ?int $ttlSec Number of seconds for which the ticket is valid before expiration. If unspecified or set to 0, this value defaults to 432000 seconds (5 days).
     */
    #[JsonProperty('ttl_sec')]
    private ?int $ttlSec;

    /**
     * @var ?bool $includeEmailInRedirect Whether to include the email address as part of the returnUrl in the reset_email (true), or not (false).
     */
    #[JsonProperty('includeEmailInRedirect')]
    private ?bool $includeEmailInRedirect;

    /**
     * @var ?Identity $identity
     */
    #[JsonProperty('identity')]
    private ?Identity $identity;

    /**
     * @param array{
     *   userId: string,
     *   resultUrl?: ?string,
     *   clientId?: ?string,
     *   organizationId?: ?string,
     *   ttlSec?: ?int,
     *   includeEmailInRedirect?: ?bool,
     *   identity?: ?Identity,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->resultUrl = $values['resultUrl'] ?? null;
        $this->userId = $values['userId'];
        $this->clientId = $values['clientId'] ?? null;
        $this->organizationId = $values['organizationId'] ?? null;
        $this->ttlSec = $values['ttlSec'] ?? null;
        $this->includeEmailInRedirect = $values['includeEmailInRedirect'] ?? null;
        $this->identity = $values['identity'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getResultUrl(): ?string
    {
        return $this->resultUrl;
    }

    /**
     * @param ?string $value
     */
    public function setResultUrl(?string $value = null): self
    {
        $this->resultUrl = $value;
        $this->_setField('resultUrl');
        return $this;
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

    /**
     * @return ?int
     */
    public function getTtlSec(): ?int
    {
        return $this->ttlSec;
    }

    /**
     * @param ?int $value
     */
    public function setTtlSec(?int $value = null): self
    {
        $this->ttlSec = $value;
        $this->_setField('ttlSec');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIncludeEmailInRedirect(): ?bool
    {
        return $this->includeEmailInRedirect;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeEmailInRedirect(?bool $value = null): self
    {
        $this->includeEmailInRedirect = $value;
        $this->_setField('includeEmailInRedirect');
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
}
