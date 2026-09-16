<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\Email;

use Auth0\SDK\API\Management\Types\GetEmailFactorSettingsResponseContent;
use Auth0\SDK\API\Management\Guardian\Factors\Email\Requests\SetEmailFactorSettingsRequestContent;
use Auth0\SDK\API\Management\Types\SetEmailFactorSettingsResponseContent;

interface EmailClientInterface
{
    /**
     * TODO: Link this endpoint to relevant documentation when available.
     *
     * Example:
     * ```php
     * $client->guardian->factors->email->get();
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
     * @return ?GetEmailFactorSettingsResponseContent
     */
    public function get(?array $options = null): ?GetEmailFactorSettingsResponseContent;

    /**
     * TODO: Link this endpoint to relevant documentation when available.
     *
     * Example:
     * ```php
     * $client->guardian->factors->email->set(
     *     new SetEmailFactorSettingsRequestContent([
     *         'otpLength' => 1,
     *         'otpExpirationTime' => 1,
     *     ]),
     * );
     * ```
     *
     * @param SetEmailFactorSettingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetEmailFactorSettingsResponseContent
     */
    public function set(SetEmailFactorSettingsRequestContent $request, ?array $options = null): ?SetEmailFactorSettingsResponseContent;
}
