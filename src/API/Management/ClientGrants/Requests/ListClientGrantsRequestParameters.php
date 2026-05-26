<?php

namespace Auth0\SDK\API\Management\ClientGrants\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\ClientGrantSubjectTypeEnum;
use Auth0\SDK\API\Management\Types\ClientGrantDefaultForEnum;

class ListClientGrantsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @var ?string $audience Optional filter on audience.
     */
    private ?string $audience;

    /**
     * @var ?string $clientId Optional filter on client_id.
     */
    private ?string $clientId;

    /**
     * @var ?bool $allowAnyOrganization Optional filter on allow_any_organization.
     */
    private ?bool $allowAnyOrganization;

    /**
     * @var ?value-of<ClientGrantSubjectTypeEnum> $subjectType The type of application access the client grant allows.
     */
    private ?string $subjectType;

    /**
     * @var ?value-of<ClientGrantDefaultForEnum> $defaultFor Applies this client grant as the default for all clients in the specified group. The only accepted value is <a href="https://auth0.com/docs/get-started/applications/application-access-to-apis-client-grants#default-permissions-for-third-party-applications">`third_party_clients`</a>, which applies the grant to all third-party clients. Per-client grants for the same audience take precedence. Mutually exclusive with `client_id`.
     */
    private ?string $defaultFor;

    /**
     * @param array{
     *   from?: ?string,
     *   take?: ?int,
     *   audience?: ?string,
     *   clientId?: ?string,
     *   allowAnyOrganization?: ?bool,
     *   subjectType?: ?value-of<ClientGrantSubjectTypeEnum>,
     *   defaultFor?: ?value-of<ClientGrantDefaultForEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->audience = $values['audience'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->allowAnyOrganization = $values['allowAnyOrganization'] ?? null;
        $this->subjectType = $values['subjectType'] ?? null;
        $this->defaultFor = $values['defaultFor'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTake(): ?int
    {
        return $this->take;
    }

    /**
     * @param ?int $value
     */
    public function setTake(?int $value = null): self
    {
        $this->take = $value;
        $this->_setField('take');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAudience(): ?string
    {
        return $this->audience;
    }

    /**
     * @param ?string $value
     */
    public function setAudience(?string $value = null): self
    {
        $this->audience = $value;
        $this->_setField('audience');
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
     * @return ?bool
     */
    public function getAllowAnyOrganization(): ?bool
    {
        return $this->allowAnyOrganization;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowAnyOrganization(?bool $value = null): self
    {
        $this->allowAnyOrganization = $value;
        $this->_setField('allowAnyOrganization');
        return $this;
    }

    /**
     * @return ?value-of<ClientGrantSubjectTypeEnum>
     */
    public function getSubjectType(): ?string
    {
        return $this->subjectType;
    }

    /**
     * @param ?value-of<ClientGrantSubjectTypeEnum> $value
     */
    public function setSubjectType(?string $value = null): self
    {
        $this->subjectType = $value;
        $this->_setField('subjectType');
        return $this;
    }

    /**
     * @return ?value-of<ClientGrantDefaultForEnum>
     */
    public function getDefaultFor(): ?string
    {
        return $this->defaultFor;
    }

    /**
     * @param ?value-of<ClientGrantDefaultForEnum> $value
     */
    public function setDefaultFor(?string $value = null): self
    {
        $this->defaultFor = $value;
        $this->_setField('defaultFor');
        return $this;
    }
}
