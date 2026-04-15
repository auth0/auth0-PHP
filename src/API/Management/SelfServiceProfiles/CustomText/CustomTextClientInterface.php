<?php

namespace Auth0\SDK\API\Management\SelfServiceProfiles\CustomText;

use Auth0\SDK\API\Management\Types\SelfServiceProfileCustomTextLanguageEnum;
use Auth0\SDK\API\Management\Types\SelfServiceProfileCustomTextPageEnum;

interface CustomTextClientInterface
{
    /**
     * Retrieves text customizations for a given self-service profile, language and Self Service SSO Flow page.
     *
     * @param string $id The id of the self-service profile.
     * @param value-of<SelfServiceProfileCustomTextLanguageEnum> $language The language of the custom text.
     * @param value-of<SelfServiceProfileCustomTextPageEnum> $page The page where the custom text is shown.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, string>
     */
    public function list(string $id, string $language, string $page, ?array $options = null): ?array;

    /**
     * Updates text customizations for a given self-service profile, language and Self Service SSO Flow page.
     *
     * @param string $id The id of the self-service profile.
     * @param value-of<SelfServiceProfileCustomTextLanguageEnum> $language The language of the custom text.
     * @param value-of<SelfServiceProfileCustomTextPageEnum> $page The page where the custom text is shown.
     * @param array<string, string> $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<string, string>
     */
    public function set(string $id, string $language, string $page, array $request, ?array $options = null): ?array;
}
