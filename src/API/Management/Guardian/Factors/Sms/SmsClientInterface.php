<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\Sms;

use Auth0\SDK\API\Management\Types\GetGuardianFactorsProviderSmsTwilioResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Sms\Requests\SetGuardianFactorsProviderSmsTwilioRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorsProviderSmsTwilioResponseContent;
use Auth0\SDK\API\Management\Types\GetGuardianFactorsProviderSmsResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Sms\Requests\SetGuardianFactorsProviderSmsRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorsProviderSmsResponseContent;
use Auth0\SDK\API\Management\Types\GetGuardianFactorSmsTemplatesResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Sms\Requests\SetGuardianFactorSmsTemplatesRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorSmsTemplatesResponseContent;

interface SmsClientInterface
{
    /**
     * Retrieve the <a href="https://auth0.com/docs/multifactor-authentication/twilio-configuration">Twilio SMS provider configuration</a> (subscription required).
     *
     *     A new endpoint is available to retrieve the Twilio configuration related to phone factors (<a href='https://auth0.com/docs/api/management/v2/#!/Guardian/get_twilio'>phone Twilio configuration</a>). It has the same payload as this one. Please use it instead.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorsProviderSmsTwilioResponseContent
     */
    public function getTwilioProvider(?array $options = null): ?GetGuardianFactorsProviderSmsTwilioResponseContent;

    /**
     * This endpoint has been deprecated. To complete this action, use the <a href="https://auth0.com/docs/api/management/v2/guardian/put-twilio">Update Twilio phone configuration</a> endpoint.
     *
     *     <b>Previous functionality</b>: Update the Twilio SMS provider configuration.
     *
     * @param SetGuardianFactorsProviderSmsTwilioRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorsProviderSmsTwilioResponseContent
     */
    public function setTwilioProvider(SetGuardianFactorsProviderSmsTwilioRequestContent $request = new SetGuardianFactorsProviderSmsTwilioRequestContent(), ?array $options = null): ?SetGuardianFactorsProviderSmsTwilioResponseContent;

    /**
     * This endpoint has been deprecated. To complete this action, use the <a href="https://auth0.com/docs/api/management/v2/guardian/get-phone-providers">Retrieve phone configuration</a> endpoint instead.
     *
     *     <b>Previous functionality</b>: Retrieve details for the multi-factor authentication SMS provider configured for your tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorsProviderSmsResponseContent
     */
    public function getSelectedProvider(?array $options = null): ?GetGuardianFactorsProviderSmsResponseContent;

    /**
     * This endpoint has been deprecated. To complete this action, use the <a href="https://auth0.com/docs/api/management/v2/guardian/put-phone-providers">Update phone configuration</a> endpoint instead.
     *
     *     <b>Previous functionality</b>: Update the multi-factor authentication SMS provider configuration in your tenant.
     *
     * @param SetGuardianFactorsProviderSmsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorsProviderSmsResponseContent
     */
    public function setProvider(SetGuardianFactorsProviderSmsRequestContent $request, ?array $options = null): ?SetGuardianFactorsProviderSmsResponseContent;

    /**
     * This endpoint has been deprecated. To complete this action, use the <a href="https://auth0.com/docs/api/management/v2/guardian/get-factor-phone-templates">Retrieve enrollment and verification phone templates</a> endpoint instead.
     *
     *     <b>Previous function</b>: Retrieve details of SMS enrollment and verification templates configured for your tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorSmsTemplatesResponseContent
     */
    public function getTemplates(?array $options = null): ?GetGuardianFactorSmsTemplatesResponseContent;

    /**
     * This endpoint has been deprecated. To complete this action, use the <a href="https://auth0.com/docs/api/management/v2/guardian/put-factor-phone-templates">Update enrollment and verification phone templates</a> endpoint instead.
     *
     *     <b>Previous functionality</b>: Customize the messages sent to complete SMS enrollment and verification.
     *
     * @param SetGuardianFactorSmsTemplatesRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorSmsTemplatesResponseContent
     */
    public function setTemplates(SetGuardianFactorSmsTemplatesRequestContent $request, ?array $options = null): ?SetGuardianFactorSmsTemplatesResponseContent;
}
