<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class AttackProtectionUpdateCaptchaRecaptchaEnterprise extends JsonSerializableType
{
    /**
     * @var string $siteKey The site key for the reCAPTCHA Enterprise provider.
     */
    #[JsonProperty('site_key')]
    private string $siteKey;

    /**
     * @var string $apiKey The API key for the reCAPTCHA Enterprise provider.
     */
    #[JsonProperty('api_key')]
    private string $apiKey;

    /**
     * @var string $projectId The project ID for the reCAPTCHA Enterprise provider.
     */
    #[JsonProperty('project_id')]
    private string $projectId;

    /**
     * @param array{
     *   siteKey: string,
     *   apiKey: string,
     *   projectId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->siteKey = $values['siteKey'];
        $this->apiKey = $values['apiKey'];
        $this->projectId = $values['projectId'];
    }

    /**
     * @return string
     */
    public function getSiteKey(): string
    {
        return $this->siteKey;
    }

    /**
     * @param string $value
     */
    public function setSiteKey(string $value): self
    {
        $this->siteKey = $value;
        $this->_setField('siteKey');
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $value
     */
    public function setApiKey(string $value): self
    {
        $this->apiKey = $value;
        $this->_setField('apiKey');
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @param string $value
     */
    public function setProjectId(string $value): self
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
