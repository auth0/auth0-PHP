<?php

namespace Auth0\SDK\API\Management\Prompts\CustomText;

use Auth0\SDK\API\Management\Types\PromptGroupNameEnum;
use Auth0\SDK\API\Management\Types\PromptLanguageEnum;

interface CustomTextClientInterface
{
    /**
     * Retrieve custom text for a specific prompt and language.
     *
     * @param value-of<PromptGroupNameEnum> $prompt Name of the prompt.
     * @param value-of<PromptLanguageEnum> $language Language to update.
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
    public function get(string $prompt, string $language, ?array $options = null): ?array;

    /**
     * Set custom text for a specific prompt. Existing texts will be overwritten.
     *
     * @param value-of<PromptGroupNameEnum> $prompt Name of the prompt.
     * @param value-of<PromptLanguageEnum> $language Language to update.
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
    public function set(string $prompt, string $language, array $request, ?array $options = null): void;
}
