<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * reCAPTCHA Enterprise provider configuration.
 */
class CaptchaPolicyActionRecaptchaEnterpriseInput extends JsonSerializableType
{
    /**
     * @var ?string $siteKey The reCAPTCHA Enterprise site key.
     */
    #[JsonProperty('site_key')]
    private ?string $siteKey;

    /**
     * @var ?string $projectId The Google Cloud project ID.
     */
    #[JsonProperty('project_id')]
    private ?string $projectId;

    /**
     * @var ?string $apiKey The reCAPTCHA Enterprise API key. Encrypted at rest.
     */
    #[JsonProperty('api_key')]
    private ?string $apiKey;

    /**
     * @param array{
     *   siteKey?: ?string,
     *   projectId?: ?string,
     *   apiKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->siteKey = $values['siteKey'] ?? null;
        $this->projectId = $values['projectId'] ?? null;
        $this->apiKey = $values['apiKey'] ?? null;
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
     * @return ?string
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @param ?string $value
     */
    public function setApiKey(?string $value = null): self
    {
        $this->apiKey = $value;
        $this->_setField('apiKey');
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
