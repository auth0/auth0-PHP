<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\Phone;

use Auth0\SDK\API\Management\Types\GetGuardianFactorPhoneMessageTypesResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Phone\Requests\SetGuardianFactorPhoneMessageTypesRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorPhoneMessageTypesResponseContent;
use Auth0\SDK\API\Management\Types\GetGuardianFactorsProviderPhoneTwilioResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Phone\Requests\SetGuardianFactorsProviderPhoneTwilioRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorsProviderPhoneTwilioResponseContent;
use Auth0\SDK\API\Management\Types\GetGuardianFactorsProviderPhoneResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Phone\Requests\SetGuardianFactorsProviderPhoneRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorsProviderPhoneResponseContent;
use Auth0\SDK\API\Management\Types\GetGuardianFactorPhoneTemplatesResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Phone\Requests\SetGuardianFactorPhoneTemplatesRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorPhoneTemplatesResponseContent;

interface PhoneClientInterface
{
    /**
     * Retrieve list of <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-sms-voice-notifications-mfa">phone-type MFA factors</a> (i.e., sms and voice) that are enabled for your tenant.
     *
     * Example:
     * ```php
     * $client->guardian->factors->phone->getMessageTypes();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorPhoneMessageTypesResponseContent
     */
    public function getMessageTypes(?array $options = null): ?GetGuardianFactorPhoneMessageTypesResponseContent;

    /**
     * Replace the list of <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-sms-voice-notifications-mfa">phone-type MFA factors</a> (i.e., sms and voice) that are enabled for your tenant.
     *
     * Example:
     * ```php
     * $client->guardian->factors->phone->setMessageTypes(
     *     new SetGuardianFactorPhoneMessageTypesRequestContent([
     *         'messageTypes' => [
     *             GuardianFactorPhoneFactorMessageTypeEnum::Sms->value,
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param SetGuardianFactorPhoneMessageTypesRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorPhoneMessageTypesResponseContent
     */
    public function setMessageTypes(SetGuardianFactorPhoneMessageTypesRequestContent $request, ?array $options = null): ?SetGuardianFactorPhoneMessageTypesResponseContent;

    /**
     * Retrieve configuration details for a Twilio phone provider that has been set up in your tenant. To learn more, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-sms-voice-notifications-mfa">Configure SMS and Voice Notifications for MFA</a>.
     *
     * Example:
     * ```php
     * $client->guardian->factors->phone->getTwilioProvider();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorsProviderPhoneTwilioResponseContent
     */
    public function getTwilioProvider(?array $options = null): ?GetGuardianFactorsProviderPhoneTwilioResponseContent;

    /**
     * Update the configuration of a Twilio phone provider that has been set up in your tenant. To learn more, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-sms-voice-notifications-mfa">Configure SMS and Voice Notifications for MFA</a>.
     *
     * Example:
     * ```php
     * $client->guardian->factors->phone->setTwilioProvider(
     *     new SetGuardianFactorsProviderPhoneTwilioRequestContent([]),
     * );
     * ```
     *
     * @param SetGuardianFactorsProviderPhoneTwilioRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorsProviderPhoneTwilioResponseContent
     */
    public function setTwilioProvider(SetGuardianFactorsProviderPhoneTwilioRequestContent $request = new SetGuardianFactorsProviderPhoneTwilioRequestContent(), ?array $options = null): ?SetGuardianFactorsProviderPhoneTwilioResponseContent;

    /**
     * Retrieve details of the multi-factor authentication phone provider configured for your tenant.
     *
     * Example:
     * ```php
     * $client->guardian->factors->phone->getSelectedProvider();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorsProviderPhoneResponseContent
     */
    public function getSelectedProvider(?array $options = null): ?GetGuardianFactorsProviderPhoneResponseContent;

    /**
     * Example:
     * ```php
     * $client->guardian->factors->phone->setProvider(
     *     new SetGuardianFactorsProviderPhoneRequestContent([
     *         'provider' => GuardianFactorsProviderSmsProviderEnum::Auth0->value,
     *     ]),
     * );
     * ```
     *
     * @param SetGuardianFactorsProviderPhoneRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorsProviderPhoneResponseContent
     */
    public function setProvider(SetGuardianFactorsProviderPhoneRequestContent $request, ?array $options = null): ?SetGuardianFactorsProviderPhoneResponseContent;

    /**
     * Retrieve details of the multi-factor authentication enrollment and verification templates for phone-type factors available in your tenant.
     *
     * Example:
     * ```php
     * $client->guardian->factors->phone->getTemplates();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorPhoneTemplatesResponseContent
     */
    public function getTemplates(?array $options = null): ?GetGuardianFactorPhoneTemplatesResponseContent;

    /**
     * Customize the messages sent to complete phone enrollment and verification (subscription required).
     *
     * Example:
     * ```php
     * $client->guardian->factors->phone->setTemplates(
     *     new SetGuardianFactorPhoneTemplatesRequestContent([
     *         'enrollmentMessage' => 'enrollment_message',
     *         'verificationMessage' => 'verification_message',
     *     ]),
     * );
     * ```
     *
     * @param SetGuardianFactorPhoneTemplatesRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorPhoneTemplatesResponseContent
     */
    public function setTemplates(SetGuardianFactorPhoneTemplatesRequestContent $request, ?array $options = null): ?SetGuardianFactorPhoneTemplatesResponseContent;
}
