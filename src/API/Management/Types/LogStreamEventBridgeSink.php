<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class LogStreamEventBridgeSink extends JsonSerializableType
{
    /**
     * @var string $awsAccountId AWS account ID
     */
    #[JsonProperty('awsAccountId')]
    private string $awsAccountId;

    /**
     * @var value-of<LogStreamEventBridgeSinkRegionEnum> $awsRegion
     */
    #[JsonProperty('awsRegion')]
    private string $awsRegion;

    /**
     * @var ?string $awsPartnerEventSource AWS EventBridge partner event source
     */
    #[JsonProperty('awsPartnerEventSource')]
    private ?string $awsPartnerEventSource;

    /**
     * @param array{
     *   awsAccountId: string,
     *   awsRegion: value-of<LogStreamEventBridgeSinkRegionEnum>,
     *   awsPartnerEventSource?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->awsAccountId = $values['awsAccountId'];
        $this->awsRegion = $values['awsRegion'];
        $this->awsPartnerEventSource = $values['awsPartnerEventSource'] ?? null;
    }

    /**
     * @return string
     */
    public function getAwsAccountId(): string
    {
        return $this->awsAccountId;
    }

    /**
     * @param string $value
     */
    public function setAwsAccountId(string $value): self
    {
        $this->awsAccountId = $value;
        $this->_setField('awsAccountId');
        return $this;
    }

    /**
     * @return value-of<LogStreamEventBridgeSinkRegionEnum>
     */
    public function getAwsRegion(): string
    {
        return $this->awsRegion;
    }

    /**
     * @param value-of<LogStreamEventBridgeSinkRegionEnum> $value
     */
    public function setAwsRegion(string $value): self
    {
        $this->awsRegion = $value;
        $this->_setField('awsRegion');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAwsPartnerEventSource(): ?string
    {
        return $this->awsPartnerEventSource;
    }

    /**
     * @param ?string $value
     */
    public function setAwsPartnerEventSource(?string $value = null): self
    {
        $this->awsPartnerEventSource = $value;
        $this->_setField('awsPartnerEventSource');
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
