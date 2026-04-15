<?php

namespace Auth0\SDK\API\Management\Prompts\Partials;

use Auth0\SDK\API\Management\Types\PartialGroupsEnum;

interface PartialsClientInterface
{
    /**
     * Get template partials for a prompt
     *
     * @param value-of<PartialGroupsEnum> $prompt Name of the prompt.
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
    public function get(string $prompt, ?array $options = null): ?array;

    /**
     * Set template partials for a prompt
     *
     * @param value-of<PartialGroupsEnum> $prompt Name of the prompt.
     * @param array<string, mixed> $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function set(string $prompt, array $request, ?array $options = null): void;
}
