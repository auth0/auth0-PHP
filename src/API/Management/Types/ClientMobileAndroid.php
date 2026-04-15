<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Android native app configuration.
 */
class ClientMobileAndroid extends JsonSerializableType
{
    /**
     * @var ?string $appPackageName App package name found in AndroidManifest.xml.
     */
    #[JsonProperty('app_package_name')]
    private ?string $appPackageName;

    /**
     * @var ?array<string> $sha256CertFingerprints SHA256 fingerprints of the app's signing certificate. Multiple fingerprints can be used to support different versions of your app, such as debug and production builds.
     */
    #[JsonProperty('sha256_cert_fingerprints'), ArrayType(['string'])]
    private ?array $sha256CertFingerprints;

    /**
     * @param array{
     *   appPackageName?: ?string,
     *   sha256CertFingerprints?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->appPackageName = $values['appPackageName'] ?? null;
        $this->sha256CertFingerprints = $values['sha256CertFingerprints'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAppPackageName(): ?string
    {
        return $this->appPackageName;
    }

    /**
     * @param ?string $value
     */
    public function setAppPackageName(?string $value = null): self
    {
        $this->appPackageName = $value;
        $this->_setField('appPackageName');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getSha256CertFingerprints(): ?array
    {
        return $this->sha256CertFingerprints;
    }

    /**
     * @param ?array<string> $value
     */
    public function setSha256CertFingerprints(?array $value = null): self
    {
        $this->sha256CertFingerprints = $value;
        $this->_setField('sha256CertFingerprints');
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
