<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Application specific configuration for use with the OIN Express Configuration feature.
 */
class ExpressConfigurationOrNull extends JsonSerializableType
{
    /**
     * @var string $initiateLoginUriTemplate The URI users should bookmark to log in to this application. Variable substitution is permitted for the following properties: organization_name, organization_id, and connection_name.
     */
    #[JsonProperty('initiate_login_uri_template')]
    private string $initiateLoginUriTemplate;

    /**
     * @var string $userAttributeProfileId The ID of the user attribute profile to use for this application.
     */
    #[JsonProperty('user_attribute_profile_id')]
    private string $userAttributeProfileId;

    /**
     * @var string $connectionProfileId The ID of the connection profile to use for this application.
     */
    #[JsonProperty('connection_profile_id')]
    private string $connectionProfileId;

    /**
     * @var bool $enableClient When true, all connections made via express configuration will be enabled for this application.
     */
    #[JsonProperty('enable_client')]
    private bool $enableClient;

    /**
     * @var bool $enableOrganization When true, all connections made via express configuration will have the associated organization enabled.
     */
    #[JsonProperty('enable_organization')]
    private bool $enableOrganization;

    /**
     * @var ?array<LinkedClientConfiguration> $linkedClients List of client IDs that are linked to this express configuration (e.g. web or mobile clients).
     */
    #[JsonProperty('linked_clients'), ArrayType([LinkedClientConfiguration::class])]
    private ?array $linkedClients;

    /**
     * @var string $oktaOinClientId This is the unique identifier for the Okta OIN Express Configuration Client, which Okta will use for this application.
     */
    #[JsonProperty('okta_oin_client_id')]
    private string $oktaOinClientId;

    /**
     * @var string $adminLoginDomain This is the domain that admins are expected to log in via for authenticating for express configuration. It can be either the canonical domain or a registered custom domain.
     */
    #[JsonProperty('admin_login_domain')]
    private string $adminLoginDomain;

    /**
     * @var ?string $oinSubmissionId The identifier of the published application in the OKTA OIN.
     */
    #[JsonProperty('oin_submission_id')]
    private ?string $oinSubmissionId;

    /**
     * @param array{
     *   initiateLoginUriTemplate: string,
     *   userAttributeProfileId: string,
     *   connectionProfileId: string,
     *   enableClient: bool,
     *   enableOrganization: bool,
     *   oktaOinClientId: string,
     *   adminLoginDomain: string,
     *   linkedClients?: ?array<LinkedClientConfiguration>,
     *   oinSubmissionId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->initiateLoginUriTemplate = $values['initiateLoginUriTemplate'];
        $this->userAttributeProfileId = $values['userAttributeProfileId'];
        $this->connectionProfileId = $values['connectionProfileId'];
        $this->enableClient = $values['enableClient'];
        $this->enableOrganization = $values['enableOrganization'];
        $this->linkedClients = $values['linkedClients'] ?? null;
        $this->oktaOinClientId = $values['oktaOinClientId'];
        $this->adminLoginDomain = $values['adminLoginDomain'];
        $this->oinSubmissionId = $values['oinSubmissionId'] ?? null;
    }

    /**
     * @return string
     */
    public function getInitiateLoginUriTemplate(): string
    {
        return $this->initiateLoginUriTemplate;
    }

    /**
     * @param string $value
     */
    public function setInitiateLoginUriTemplate(string $value): self
    {
        $this->initiateLoginUriTemplate = $value;
        $this->_setField('initiateLoginUriTemplate');
        return $this;
    }

    /**
     * @return string
     */
    public function getUserAttributeProfileId(): string
    {
        return $this->userAttributeProfileId;
    }

    /**
     * @param string $value
     */
    public function setUserAttributeProfileId(string $value): self
    {
        $this->userAttributeProfileId = $value;
        $this->_setField('userAttributeProfileId');
        return $this;
    }

    /**
     * @return string
     */
    public function getConnectionProfileId(): string
    {
        return $this->connectionProfileId;
    }

    /**
     * @param string $value
     */
    public function setConnectionProfileId(string $value): self
    {
        $this->connectionProfileId = $value;
        $this->_setField('connectionProfileId');
        return $this;
    }

    /**
     * @return bool
     */
    public function getEnableClient(): bool
    {
        return $this->enableClient;
    }

    /**
     * @param bool $value
     */
    public function setEnableClient(bool $value): self
    {
        $this->enableClient = $value;
        $this->_setField('enableClient');
        return $this;
    }

    /**
     * @return bool
     */
    public function getEnableOrganization(): bool
    {
        return $this->enableOrganization;
    }

    /**
     * @param bool $value
     */
    public function setEnableOrganization(bool $value): self
    {
        $this->enableOrganization = $value;
        $this->_setField('enableOrganization');
        return $this;
    }

    /**
     * @return ?array<LinkedClientConfiguration>
     */
    public function getLinkedClients(): ?array
    {
        return $this->linkedClients;
    }

    /**
     * @param ?array<LinkedClientConfiguration> $value
     */
    public function setLinkedClients(?array $value = null): self
    {
        $this->linkedClients = $value;
        $this->_setField('linkedClients');
        return $this;
    }

    /**
     * @return string
     */
    public function getOktaOinClientId(): string
    {
        return $this->oktaOinClientId;
    }

    /**
     * @param string $value
     */
    public function setOktaOinClientId(string $value): self
    {
        $this->oktaOinClientId = $value;
        $this->_setField('oktaOinClientId');
        return $this;
    }

    /**
     * @return string
     */
    public function getAdminLoginDomain(): string
    {
        return $this->adminLoginDomain;
    }

    /**
     * @param string $value
     */
    public function setAdminLoginDomain(string $value): self
    {
        $this->adminLoginDomain = $value;
        $this->_setField('adminLoginDomain');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getOinSubmissionId(): ?string
    {
        return $this->oinSubmissionId;
    }

    /**
     * @param ?string $value
     */
    public function setOinSubmissionId(?string $value = null): self
    {
        $this->oinSubmissionId = $value;
        $this->_setField('oinSubmissionId');
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
