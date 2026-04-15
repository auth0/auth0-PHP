<?php

namespace Auth0\SDK\API\Management\AttackProtection\Captcha;

use Auth0\SDK\API\Management\Types\GetAttackProtectionCaptchaResponseContent;
use Auth0\SDK\API\Management\AttackProtection\Captcha\Requests\UpdateAttackProtectionCaptchaRequestContent;
use Auth0\SDK\API\Management\Types\UpdateAttackProtectionCaptchaResponseContent;

interface CaptchaClientInterface
{
    /**
     * Get the CAPTCHA configuration for your client.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetAttackProtectionCaptchaResponseContent
     */
    public function get(?array $options = null): ?GetAttackProtectionCaptchaResponseContent;

    /**
     * Update existing CAPTCHA configuration for your client.
     *
     * @param UpdateAttackProtectionCaptchaRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateAttackProtectionCaptchaResponseContent
     */
    public function update(UpdateAttackProtectionCaptchaRequestContent $request = new UpdateAttackProtectionCaptchaRequestContent(), ?array $options = null): ?UpdateAttackProtectionCaptchaResponseContent;
}
