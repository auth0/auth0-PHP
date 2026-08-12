<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class AttackProtectionCaptchaRecaptchaEnterpriseResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $siteKey The site key for the reCAPTCHA Enterprise provider.
     */
    #[JsonProperty('site_key')]
    private ?string $siteKey;

    /**
     * @var ?string $projectId The project ID for the reCAPTCHA Enterprise provider.
     */
    #[JsonProperty('project_id')]
    private ?string $projectId;

    /**
     * @param array{
     *   siteKey?: ?string,
     *   projectId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->siteKey = $values['siteKey'] ?? null;
        $this->projectId = $values['projectId'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getSiteKey(): ?string
    {
        return $this->siteKey;
    }

    /**
     * @param ?string $value
     */
    public function setSiteKey(?string $value = null): self
    {
        $this->siteKey = $value;
        $this->_setField('siteKey');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
