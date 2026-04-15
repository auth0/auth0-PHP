<?php

namespace Auth0\SDK\API\Management\RulesConfigs;

use Auth0\SDK\API\Management\Types\RulesConfig;
use Auth0\SDK\API\Management\RulesConfigs\Requests\SetRulesConfigRequestContent;
use Auth0\SDK\API\Management\Types\SetRulesConfigResponseContent;

interface RulesConfigsClientInterface
{
    /**
     * Retrieve rules config variable keys.
     *
     *     Note: For security, config variable values cannot be retrieved outside rule execution.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<RulesConfig>
     */
    public function list(?array $options = null): ?array;

    /**
     * Sets a rules config variable.
     *
     * @param string $key Key of the rules config variable to set (max length: 127 characters).
     * @param SetRulesConfigRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetRulesConfigResponseContent
     */
    public function set(string $key, SetRulesConfigRequestContent $request, ?array $options = null): ?SetRulesConfigResponseContent;

    /**
     * Delete a rules config variable identified by its key.
     *
     * @param string $key Key of the rules config variable to delete.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $key, ?array $options = null): void;
}
