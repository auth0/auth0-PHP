<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\PushNotification;

use Auth0\SDK\API\Management\Types\GetGuardianFactorsProviderApnsResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests\SetGuardianFactorsProviderPushNotificationApnsRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorsProviderPushNotificationApnsResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests\UpdateGuardianFactorsProviderPushNotificationApnsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateGuardianFactorsProviderPushNotificationApnsResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests\SetGuardianFactorsProviderPushNotificationFcmRequestContent;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests\UpdateGuardianFactorsProviderPushNotificationFcmRequestContent;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests\SetGuardianFactorsProviderPushNotificationFcmv1RequestContent;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests\UpdateGuardianFactorsProviderPushNotificationFcmv1RequestContent;
use Auth0\SDK\API\Management\Types\GetGuardianFactorsProviderSnsResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests\SetGuardianFactorsProviderPushNotificationSnsRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorsProviderPushNotificationSnsResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests\UpdateGuardianFactorsProviderPushNotificationSnsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateGuardianFactorsProviderPushNotificationSnsResponseContent;
use Auth0\SDK\API\Management\Types\GetGuardianFactorsProviderPushNotificationResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\PushNotification\Requests\SetGuardianFactorsProviderPushNotificationRequestContent;
use Auth0\SDK\API\Management\Types\SetGuardianFactorsProviderPushNotificationResponseContent;

interface PushNotificationClientInterface
{
    /**
     * Retrieve configuration details for the multi-factor authentication APNS provider associated with your tenant.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorsProviderApnsResponseContent
     */
    public function getApnsProvider(?array $options = null): ?GetGuardianFactorsProviderApnsResponseContent;

    /**
     * Overwrite all configuration details of the multi-factor authentication APNS provider associated with your tenant.
     *
     * @param SetGuardianFactorsProviderPushNotificationApnsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorsProviderPushNotificationApnsResponseContent
     */
    public function setApnsProvider(SetGuardianFactorsProviderPushNotificationApnsRequestContent $request = new SetGuardianFactorsProviderPushNotificationApnsRequestContent(), ?array $options = null): ?SetGuardianFactorsProviderPushNotificationApnsResponseContent;

    /**
     * Modify configuration details of the multi-factor authentication APNS provider associated with your tenant.
     *
     * @param UpdateGuardianFactorsProviderPushNotificationApnsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateGuardianFactorsProviderPushNotificationApnsResponseContent
     */
    public function updateApnsProvider(UpdateGuardianFactorsProviderPushNotificationApnsRequestContent $request = new UpdateGuardianFactorsProviderPushNotificationApnsRequestContent(), ?array $options = null): ?UpdateGuardianFactorsProviderPushNotificationApnsResponseContent;

    /**
     * Overwrite all configuration details of the multi-factor authentication FCM provider associated with your tenant.
     *
     * @param SetGuardianFactorsProviderPushNotificationFcmRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     */
    public function setFcmProvider(SetGuardianFactorsProviderPushNotificationFcmRequestContent $request = new SetGuardianFactorsProviderPushNotificationFcmRequestContent(), ?array $options = null): ?array;

    /**
     * Modify configuration details of the multi-factor authentication FCM provider associated with your tenant.
     *
     * @param UpdateGuardianFactorsProviderPushNotificationFcmRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     */
    public function updateFcmProvider(UpdateGuardianFactorsProviderPushNotificationFcmRequestContent $request = new UpdateGuardianFactorsProviderPushNotificationFcmRequestContent(), ?array $options = null): ?array;

    /**
     * Overwrite all configuration details of the multi-factor authentication FCMV1 provider associated with your tenant.
     *
     * @param SetGuardianFactorsProviderPushNotificationFcmv1RequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     */
    public function setFcmv1Provider(SetGuardianFactorsProviderPushNotificationFcmv1RequestContent $request = new SetGuardianFactorsProviderPushNotificationFcmv1RequestContent(), ?array $options = null): ?array;

    /**
     * Modify configuration details of the multi-factor authentication FCMV1 provider associated with your tenant.
     *
     * @param UpdateGuardianFactorsProviderPushNotificationFcmv1RequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, mixed>
     */
    public function updateFcmv1Provider(UpdateGuardianFactorsProviderPushNotificationFcmv1RequestContent $request = new UpdateGuardianFactorsProviderPushNotificationFcmv1RequestContent(), ?array $options = null): ?array;

    /**
     * Retrieve configuration details for an AWS SNS push notification provider that has been enabled for MFA. To learn more, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-push-notifications-for-mfa">Configure Push Notifications for MFA</a>.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorsProviderSnsResponseContent
     */
    public function getSnsProvider(?array $options = null): ?GetGuardianFactorsProviderSnsResponseContent;

    /**
     * Configure the <a href="https://auth0.com/docs/multifactor-authentication/developer/sns-configuration">AWS SNS push notification provider configuration</a> (subscription required).
     *
     * @param SetGuardianFactorsProviderPushNotificationSnsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorsProviderPushNotificationSnsResponseContent
     */
    public function setSnsProvider(SetGuardianFactorsProviderPushNotificationSnsRequestContent $request = new SetGuardianFactorsProviderPushNotificationSnsRequestContent(), ?array $options = null): ?SetGuardianFactorsProviderPushNotificationSnsResponseContent;

    /**
     * Configure the <a href="https://auth0.com/docs/multifactor-authentication/developer/sns-configuration">AWS SNS push notification provider configuration</a> (subscription required).
     *
     * @param UpdateGuardianFactorsProviderPushNotificationSnsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateGuardianFactorsProviderPushNotificationSnsResponseContent
     */
    public function updateSnsProvider(UpdateGuardianFactorsProviderPushNotificationSnsRequestContent $request = new UpdateGuardianFactorsProviderPushNotificationSnsRequestContent(), ?array $options = null): ?UpdateGuardianFactorsProviderPushNotificationSnsResponseContent;

    /**
     * Modify the push notification provider configured for your tenant. For more information, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-push-notifications-for-mfa">Configure Push Notifications for MFA</a>.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianFactorsProviderPushNotificationResponseContent
     */
    public function getSelectedProvider(?array $options = null): ?GetGuardianFactorsProviderPushNotificationResponseContent;

    /**
     * Modify the push notification provider configured for your tenant. For more information, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-push-notifications-for-mfa">Configure Push Notifications for MFA</a>.
     *
     * @param SetGuardianFactorsProviderPushNotificationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetGuardianFactorsProviderPushNotificationResponseContent
     */
    public function setProvider(SetGuardianFactorsProviderPushNotificationRequestContent $request, ?array $options = null): ?SetGuardianFactorsProviderPushNotificationResponseContent;
}
