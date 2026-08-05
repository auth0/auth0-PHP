<?php

namespace Auth0\SDK\API\Management\Emails\Provider;

use Auth0\SDK\API\Management\Emails\Provider\Requests\GetEmailProviderRequestParameters;
use Auth0\SDK\API\Management\Types\GetEmailProviderResponseContent;
use Auth0\SDK\API\Management\Emails\Provider\Requests\CreateEmailProviderRequestContent;
use Auth0\SDK\API\Management\Types\CreateEmailProviderResponseContent;
use Auth0\SDK\API\Management\Emails\Provider\Requests\UpdateEmailProviderRequestContent;
use Auth0\SDK\API\Management\Types\UpdateEmailProviderResponseContent;

interface ProviderClientInterface
{
    /**
     * Retrieve details of the [email provider configuration](https://auth0.com/docs/customize/email/smtp-email-providers) in your tenant. A list of fields to include or exclude may also be specified.
     *
     * Example:
     * ```php
     * $client->emails->provider->get(
     *     new GetEmailProviderRequestParameters([
     *         'fields' => 'fields',
     *         'includeFields' => true,
     *     ]),
     * );
     * ```
     *
     * @param GetEmailProviderRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetEmailProviderResponseContent
     */
    public function get(GetEmailProviderRequestParameters $request = new GetEmailProviderRequestParameters(), ?array $options = null): ?GetEmailProviderResponseContent;

    /**
     * Create an [email provider](https://auth0.com/docs/email/providers). The `credentials` object
     * requires different properties depending on the email provider (which is specified using the `name` property):
     *
     * - `mandrill` requires `api_key`
     * - `sendgrid` requires `api_key`
     * - `sparkpost` requires `api_key`. Optionally, set `region` to `eu` to use
     *     the SparkPost service hosted in Western Europe; set to `null` to use the SparkPost service hosted in
     *     North America. `eu` or `null` are the only valid values for `region`.
     * - `mailgun` requires `api_key` and `domain`. Optionally, set `region` to
     *     `eu` to use the Mailgun service hosted in Europe; set to `null` otherwise. `eu` or
     *     `null` are the only valid values for `region`.
     * - `ses` requires `accessKeyId`, `secretAccessKey`, and `region`
     * - `smtp` requires `smtp_host`, `smtp_port`, `smtp_user`, and
     *     `smtp_pass`
     *
     * Depending on the type of provider it is possible to specify `settings` object with different configuration
     * options, which will be used when sending an email:
     *
     * - `smtp` provider, `settings` may contain `headers` object.
     *     - When using AWS SES SMTP host, you may provide a name of configuration set in
     *       `X-SES-Configuration-Set` header. Value must be a string.
     *     - When using Sparkpost host, you may provide value for
     *       `X-MSYS_API` header. Value must be an object.
     * - For `ses` provider, `settings` may contain `message` object, where you can provide
     *   a name of configuration set in `configuration_set_name` property. Value must be a string.
     *
     * Example:
     * ```php
     * $client->emails->provider->create(
     *     new CreateEmailProviderRequestContent([
     *         'name' => EmailProviderNameEnum::Mailgun->value,
     *         'credentials' => new EmailProviderCredentialsSchemaZero([
     *             'apiKey' => 'api_key',
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param CreateEmailProviderRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateEmailProviderResponseContent
     */
    public function create(CreateEmailProviderRequestContent $request, ?array $options = null): ?CreateEmailProviderResponseContent;

    /**
     * Delete the email provider.
     *
     * Example:
     * ```php
     * $client->emails->provider->delete();
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
     */
    public function delete(?array $options = null): void;

    /**
     * Update an [email provider](https://auth0.com/docs/email/providers). The `credentials` object
     * requires different properties depending on the email provider (which is specified using the `name` property):
     *
     * - `mandrill` requires `api_key`
     * - `sendgrid` requires `api_key`
     * - `sparkpost` requires `api_key`. Optionally, set `region` to `eu` to use
     *     the SparkPost service hosted in Western Europe; set to `null` to use the SparkPost service hosted in
     *     North America. `eu` or `null` are the only valid values for `region`.
     * - `mailgun` requires `api_key` and `domain`. Optionally, set `region` to
     *     `eu` to use the Mailgun service hosted in Europe; set to `null` otherwise. `eu` or
     *     `null` are the only valid values for `region`.
     * - `ses` requires `accessKeyId`, `secretAccessKey`, and `region`
     * - `smtp` requires `smtp_host`, `smtp_port`, `smtp_user`, and
     *     `smtp_pass`
     *
     * Depending on the type of provider it is possible to specify `settings` object with different configuration
     * options, which will be used when sending an email:
     *
     * - `smtp` provider, `settings` may contain `headers` object.
     *     - When using AWS SES SMTP host, you may provide a name of configuration set in
     *       `X-SES-Configuration-Set` header. Value must be a string.
     *     - When using Sparkpost host, you may provide value for
     *       `X-MSYS_API` header. Value must be an object.
     *
     *   For `ses` provider, `settings` may contain `message` object, where you can provide
     *   a name of configuration set in `configuration_set_name` property. Value must be a string.
     *
     * Example:
     * ```php
     * $client->emails->provider->update(
     *     new UpdateEmailProviderRequestContent([]),
     * );
     * ```
     *
     * @param UpdateEmailProviderRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateEmailProviderResponseContent
     */
    public function update(UpdateEmailProviderRequestContent $request = new UpdateEmailProviderRequestContent(), ?array $options = null): ?UpdateEmailProviderResponseContent;
}
