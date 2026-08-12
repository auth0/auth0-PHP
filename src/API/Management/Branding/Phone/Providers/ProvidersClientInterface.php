<?php

namespace Auth0\SDK\API\Management\Branding\Phone\Providers;

use Auth0\SDK\API\Management\Branding\Phone\Providers\Requests\ListBrandingPhoneProvidersRequestParameters;
use Auth0\SDK\API\Management\Types\ListBrandingPhoneProvidersResponseContent;
use Auth0\SDK\API\Management\Branding\Phone\Providers\Requests\CreateBrandingPhoneProviderRequestContent;
use Auth0\SDK\API\Management\Types\CreateBrandingPhoneProviderResponseContent;
use Auth0\SDK\API\Management\Types\GetBrandingPhoneProviderResponseContent;
use Auth0\SDK\API\Management\Branding\Phone\Providers\Requests\UpdateBrandingPhoneProviderRequestContent;
use Auth0\SDK\API\Management\Types\UpdateBrandingPhoneProviderResponseContent;
use Auth0\SDK\API\Management\Branding\Phone\Providers\Requests\CreatePhoneProviderSendTestRequestContent;
use Auth0\SDK\API\Management\Types\CreatePhoneProviderSendTestResponseContent;

interface ProvidersClientInterface
{
    /**
     * Retrieve a list of [phone providers](https://auth0.com/docs/customize/phone-messages/configure-phone-messaging-providers) details set for a Tenant. A list of fields to include or exclude may also be specified.
     *
     * Example:
     * ```php
     * $client->branding->phone->providers->list(
     *     new ListBrandingPhoneProvidersRequestParameters([
     *         'disabled' => true,
     *     ]),
     * );
     * ```
     *
     * @param ListBrandingPhoneProvidersRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListBrandingPhoneProvidersResponseContent
     */
    public function list(ListBrandingPhoneProvidersRequestParameters $request = new ListBrandingPhoneProvidersRequestParameters(), ?array $options = null): ?ListBrandingPhoneProvidersResponseContent;

    /**
     * Create a [phone provider](https://auth0.com/docs/customize/phone-messages/configure-phone-messaging-providers).
     * The `credentials` object requires different properties depending on the phone provider (which is specified using the `name` property).
     *
     * Example:
     * ```php
     * $client->branding->phone->providers->create(
     *     new CreateBrandingPhoneProviderRequestContent([
     *         'name' => PhoneProviderNameEnum::Twilio->value,
     *         'credentials' => new TwilioProviderCredentials([
     *             'authToken' => 'auth_token',
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param CreateBrandingPhoneProviderRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateBrandingPhoneProviderResponseContent
     */
    public function create(CreateBrandingPhoneProviderRequestContent $request, ?array $options = null): ?CreateBrandingPhoneProviderResponseContent;

    /**
     * Retrieve [phone provider](https://auth0.com/docs/customize/phone-messages/configure-phone-messaging-providers) details. A list of fields to include or exclude may also be specified.
     *
     * Example:
     * ```php
     * $client->branding->phone->providers->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetBrandingPhoneProviderResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetBrandingPhoneProviderResponseContent;

    /**
     * Delete the configured phone provider.
     *
     * Example:
     * ```php
     * $client->branding->phone->providers->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, ?array $options = null): void;

    /**
     * Update a [phone provider](https://auth0.com/docs/customize/phone-messages/configure-phone-messaging-providers).
     * The `credentials` object requires different properties depending on the phone provider (which is specified using the `name` property).
     *
     * Example:
     * ```php
     * $client->branding->phone->providers->update(
     *     'id',
     *     new UpdateBrandingPhoneProviderRequestContent([]),
     * );
     * ```
     *
     * @param string $id
     * @param UpdateBrandingPhoneProviderRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateBrandingPhoneProviderResponseContent
     */
    public function update(string $id, UpdateBrandingPhoneProviderRequestContent $request = new UpdateBrandingPhoneProviderRequestContent(), ?array $options = null): ?UpdateBrandingPhoneProviderResponseContent;

    /**
     * Example:
     * ```php
     * $client->branding->phone->providers->test(
     *     'id',
     *     new CreatePhoneProviderSendTestRequestContent([
     *         'to' => 'to',
     *     ]),
     * );
     * ```
     *
     * @param string $id
     * @param CreatePhoneProviderSendTestRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreatePhoneProviderSendTestResponseContent
     */
    public function test(string $id, CreatePhoneProviderSendTestRequestContent $request, ?array $options = null): ?CreatePhoneProviderSendTestResponseContent;
}
