<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Security headers configuration for tenant responses.
 */
class TenantSettingsNullableSecurityHeaders extends JsonSerializableType
{
    /**
     * @var ?ContentSecurityPolicyConfig $contentSecurityPolicy
     */
    #[JsonProperty('content_security_policy')]
    private ?ContentSecurityPolicyConfig $contentSecurityPolicy;

    /**
     * @var ?XssProtectionConfig $xXssProtection
     */
    #[JsonProperty('x_xss_protection')]
    private ?XssProtectionConfig $xXssProtection;

    /**
     * @param array{
     *   contentSecurityPolicy?: ?ContentSecurityPolicyConfig,
     *   xXssProtection?: ?XssProtectionConfig,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->contentSecurityPolicy = $values['contentSecurityPolicy'] ?? null;
        $this->xXssProtection = $values['xXssProtection'] ?? null;
    }

    /**
     * @return ?ContentSecurityPolicyConfig
     */
    public function getContentSecurityPolicy(): ?ContentSecurityPolicyConfig
    {
        return $this->contentSecurityPolicy;
    }

    /**
     * @param ?ContentSecurityPolicyConfig $value
     */
    public function setContentSecurityPolicy(?ContentSecurityPolicyConfig $value = null): self
    {
        $this->contentSecurityPolicy = $value;
        $this->_setField('contentSecurityPolicy');
        return $this;
    }

    /**
     * @return ?XssProtectionConfig
     */
    public function getXXssProtection(): ?XssProtectionConfig
    {
        return $this->xXssProtection;
    }

    /**
     * @param ?XssProtectionConfig $value
     */
    public function setXXssProtection(?XssProtectionConfig $value = null): self
    {
        $this->xXssProtection = $value;
        $this->_setField('xXssProtection');
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
