<?php

namespace Auth0\SDK\API\Management\Branding\Phone\Templates;

use Auth0\SDK\API\Management\Branding\Phone\Templates\Requests\ListPhoneTemplatesRequestParameters;
use Auth0\SDK\API\Management\Types\ListPhoneTemplatesResponseContent;
use Auth0\SDK\API\Management\Branding\Phone\Templates\Requests\CreatePhoneTemplateRequestContent;
use Auth0\SDK\API\Management\Types\CreatePhoneTemplateResponseContent;
use Auth0\SDK\API\Management\Types\GetPhoneTemplateResponseContent;
use Auth0\SDK\API\Management\Branding\Phone\Templates\Requests\UpdatePhoneTemplateRequestContent;
use Auth0\SDK\API\Management\Types\UpdatePhoneTemplateResponseContent;
use Auth0\SDK\API\Management\Types\ResetPhoneTemplateResponseContent;
use Auth0\SDK\API\Management\Branding\Phone\Templates\Requests\CreatePhoneTemplateTestNotificationRequestContent;
use Auth0\SDK\API\Management\Types\CreatePhoneTemplateTestNotificationResponseContent;

interface TemplatesClientInterface
{
    /**
     * Example:
     * ```php
     * $client->branding->phone->templates->list(
     *     new ListPhoneTemplatesRequestParameters([
     *         'disabled' => true,
     *     ]),
     * );
     * ```
     *
     * @param ListPhoneTemplatesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListPhoneTemplatesResponseContent
     */
    public function list(ListPhoneTemplatesRequestParameters $request = new ListPhoneTemplatesRequestParameters(), ?array $options = null): ?ListPhoneTemplatesResponseContent;

    /**
     * Example:
     * ```php
     * $client->branding->phone->templates->create(
     *     new CreatePhoneTemplateRequestContent([]),
     * );
     * ```
     *
     * @param CreatePhoneTemplateRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreatePhoneTemplateResponseContent
     */
    public function create(CreatePhoneTemplateRequestContent $request = new CreatePhoneTemplateRequestContent(), ?array $options = null): ?CreatePhoneTemplateResponseContent;

    /**
     * Example:
     * ```php
     * $client->branding->phone->templates->get(
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
     * @return ?GetPhoneTemplateResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetPhoneTemplateResponseContent;

    /**
     * Example:
     * ```php
     * $client->branding->phone->templates->delete(
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
     * Example:
     * ```php
     * $client->branding->phone->templates->update(
     *     'id',
     *     new UpdatePhoneTemplateRequestContent([]),
     * );
     * ```
     *
     * @param string $id
     * @param UpdatePhoneTemplateRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdatePhoneTemplateResponseContent
     */
    public function update(string $id, UpdatePhoneTemplateRequestContent $request = new UpdatePhoneTemplateRequestContent(), ?array $options = null): ?UpdatePhoneTemplateResponseContent;

    /**
     * Example:
     * ```php
     * $client->branding->phone->templates->reset(
     *     'id',
     *     [
     *         'key' => "value",
     *     ],
     * );
     * ```
     *
     * @param string $id
     * @param mixed $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ResetPhoneTemplateResponseContent
     */
    public function reset(string $id, mixed $request, ?array $options = null): ?ResetPhoneTemplateResponseContent;

    /**
     * Example:
     * ```php
     * $client->branding->phone->templates->test(
     *     'id',
     *     new CreatePhoneTemplateTestNotificationRequestContent([
     *         'to' => 'to',
     *     ]),
     * );
     * ```
     *
     * @param string $id
     * @param CreatePhoneTemplateTestNotificationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreatePhoneTemplateTestNotificationResponseContent
     */
    public function test(string $id, CreatePhoneTemplateTestNotificationRequestContent $request, ?array $options = null): ?CreatePhoneTemplateTestNotificationResponseContent;
}
