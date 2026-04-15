<?php

namespace Auth0\SDK\API\Management\Prompts;

use Auth0\SDK\API\Management\Types\GetSettingsResponseContent;
use Auth0\SDK\API\Management\Prompts\Requests\UpdateSettingsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateSettingsResponseContent;
use Auth0\SDK\API\Management\Prompts\Rendering\RenderingClientInterface;
use Auth0\SDK\API\Management\Prompts\CustomText\CustomTextClientInterface;
use Auth0\SDK\API\Management\Prompts\Partials\PartialsClientInterface;

interface PromptsClientInterface
{
    /**
     * Retrieve details of the Universal Login configuration of your tenant. This includes the <a href="https://auth0.com/docs/authenticate/login/auth0-universal-login/identifier-first">Identifier First Authentication</a> and <a href="https://auth0.com/docs/secure/multi-factor-authentication/fido-authentication-with-webauthn/configure-webauthn-device-biometrics-for-mfa">WebAuthn with Device Biometrics for MFA</a> features.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetSettingsResponseContent
     */
    public function getSettings(?array $options = null): ?GetSettingsResponseContent;

    /**
     * Update the Universal Login configuration of your tenant. This includes the <a href="https://auth0.com/docs/authenticate/login/auth0-universal-login/identifier-first">Identifier First Authentication</a> and <a href="https://auth0.com/docs/secure/multi-factor-authentication/fido-authentication-with-webauthn/configure-webauthn-device-biometrics-for-mfa">WebAuthn with Device Biometrics for MFA</a> features.
     *
     * @param UpdateSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateSettingsResponseContent
     */
    public function updateSettings(UpdateSettingsRequestContent $request = new UpdateSettingsRequestContent(), ?array $options = null): ?UpdateSettingsResponseContent;

    /**
     * @return RenderingClientInterface
     */
    public function getRendering(): RenderingClientInterface;

    /**
     * @return CustomTextClientInterface
     */
    public function getCustomText(): CustomTextClientInterface;

    /**
     * @return PartialsClientInterface
     */
    public function getPartials(): PartialsClientInterface;
}
