<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class LogStreamEventGridSink extends JsonSerializableType
{
    /**
     * @var string $azureSubscriptionId Subscription ID
     */
    #[JsonProperty('azureSubscriptionId')]
    private string $azureSubscriptionId;

    /**
     * @var value-of<LogStreamEventGridRegionEnum> $azureRegion
     */
    #[JsonProperty('azureRegion')]
    private string $azureRegion;

    /**
     * @var string $azureResourceGroup Resource Group
     */
    #[JsonProperty('azureResourceGroup')]
    private string $azureResourceGroup;

    /**
     * @var ?string $azurePartnerTopic Partner Topic
     */
    #[JsonProperty('azurePartnerTopic')]
    private ?string $azurePartnerTopic;

    /**
     * @param array{
     *   azureSubscriptionId: string,
     *   azureRegion: value-of<LogStreamEventGridRegionEnum>,
     *   azureResourceGroup: string,
     *   azurePartnerTopic?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->azureSubscriptionId = $values['azureSubscriptionId'];
        $this->azureRegion = $values['azureRegion'];
        $this->azureResourceGroup = $values['azureResourceGroup'];
        $this->azurePartnerTopic = $values['azurePartnerTopic'] ?? null;
    }

    /**
     * @return string
     */
    public function getAzureSubscriptionId(): string
    {
        return $this->azureSubscriptionId;
    }

    /**
     * @param string $value
     */
    public function setAzureSubscriptionId(string $value): self
    {
        $this->azureSubscriptionId = $value;
        $this->_setField('azureSubscriptionId');
        return $this;
    }

    /**
     * @return value-of<LogStreamEventGridRegionEnum>
     */
    public function getAzureRegion(): string
    {
        return $this->azureRegion;
    }

    /**
     * @param value-of<LogStreamEventGridRegionEnum> $value
     */
    public function setAzureRegion(string $value): self
    {
        $this->azureRegion = $value;
        $this->_setField('azureRegion');
        return $this;
    }

    /**
     * @return string
     */
    public function getAzureResourceGroup(): string
    {
        return $this->azureResourceGroup;
    }

    /**
     * @param string $value
     */
    public function setAzureResourceGroup(string $value): self
    {
        $this->azureResourceGroup = $value;
        $this->_setField('azureResourceGroup');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAzurePartnerTopic(): ?string
    {
        return $this->azurePartnerTopic;
    }

    /**
     * @param ?string $value
     */
    public function setAzurePartnerTopic(?string $value = null): self
    {
        $this->azurePartnerTopic = $value;
        $this->_setField('azurePartnerTopic');
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
