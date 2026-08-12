<?php

namespace Auth0\SDK\API\Management\Organizations\ClientGrants\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class AssociateOrganizationClientGrantRequestContent extends JsonSerializableType
{
    /**
     * @var string $grantId A Client Grant ID to add to the organization.
     */
    #[JsonProperty('grant_id')]
    private string $grantId;

    /**
     * @param array{
     *   grantId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->grantId = $values['grantId'];
    }

    /**
     * @return string
     */
    public function getGrantId(): string
    {
        return $this->grantId;
    }

    /**
     * @param string $value
     */
    public function setGrantId(string $value): self
    {
        $this->grantId = $value;
        $this->_setField('grantId');
        return $this;
    }
}
