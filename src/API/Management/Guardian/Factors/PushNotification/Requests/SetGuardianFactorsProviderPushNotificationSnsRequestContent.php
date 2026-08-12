<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetGuardianFactorsProviderPushNotificationSnsRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $awsAccessKeyId
     */
    #[JsonProperty('aws_access_key_id')]
    private ?string $awsAccessKeyId;

    /**
     * @var ?string $awsSecretAccessKey
     */
    #[JsonProperty('aws_secret_access_key')]
    private ?string $awsSecretAccessKey;

    /**
     * @var ?string $awsRegion
     */
    #[JsonProperty('aws_region')]
    private ?string $awsRegion;

    /**
     * @var ?string $snsApnsPlatformApplicationArn
     */
    #[JsonProperty('sns_apns_platform_application_arn')]
    private ?string $snsApnsPlatformApplicationArn;

    /**
     * @var ?string $snsGcmPlatformApplicationArn
     */
    #[JsonProperty('sns_gcm_platform_application_arn')]
    private ?string $snsGcmPlatformApplicationArn;

    /**
     * @param array{
     *   awsAccessKeyId?: ?string,
     *   awsSecretAccessKey?: ?string,
     *   awsRegion?: ?string,
     *   snsApnsPlatformApplicationArn?: ?string,
     *   snsGcmPlatformApplicationArn?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->awsAccessKeyId = $values['awsAccessKeyId'] ?? null;
        $this->awsSecretAccessKey = $values['awsSecretAccessKey'] ?? null;
        $this->awsRegion = $values['awsRegion'] ?? null;
        $this->snsApnsPlatformApplicationArn = $values['snsApnsPlatformApplicationArn'] ?? null;
        $this->snsGcmPlatformApplicationArn = $values['snsGcmPlatformApplicationArn'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAwsAccessKeyId(): ?string
    {
        return $this->awsAccessKeyId;
    }

    /**
     * @param ?string $value
     */
    public function setAwsAccessKeyId(?string $value = null): self
    {
        $this->awsAccessKeyId = $value;
        $this->_setField('awsAccessKeyId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAwsSecretAccessKey(): ?string
    {
        return $this->awsSecretAccessKey;
    }

    /**
     * @param ?string $value
     */
    public function setAwsSecretAccessKey(?string $value = null): self
    {
        $this->awsSecretAccessKey = $value;
        $this->_setField('awsSecretAccessKey');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAwsRegion(): ?string
    {
        return $this->awsRegion;
    }

    /**
     * @param ?string $value
     */
    public function setAwsRegion(?string $value = null): self
    {
        $this->awsRegion = $value;
        $this->_setField('awsRegion');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSnsApnsPlatformApplicationArn(): ?string
    {
        return $this->snsApnsPlatformApplicationArn;
    }

    /**
     * @param ?string $value
     */
    public function setSnsApnsPlatformApplicationArn(?string $value = null): self
    {
        $this->snsApnsPlatformApplicationArn = $value;
        $this->_setField('snsApnsPlatformApplicationArn');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSnsGcmPlatformApplicationArn(): ?string
    {
        return $this->snsGcmPlatformApplicationArn;
    }

    /**
     * @param ?string $value
     */
    public function setSnsGcmPlatformApplicationArn(?string $value = null): self
    {
        $this->snsGcmPlatformApplicationArn = $value;
        $this->_setField('snsGcmPlatformApplicationArn');
        return $this;
    }
}
