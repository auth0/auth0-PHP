<?php

namespace Auth0\SDK\API\Management\UserAttributeProfiles;

use Auth0\SDK\API\Management\UserAttributeProfiles\Requests\ListUserAttributeProfileRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\UserAttributeProfile;
use Auth0\SDK\API\Management\UserAttributeProfiles\Requests\CreateUserAttributeProfileRequestContent;
use Auth0\SDK\API\Management\Types\CreateUserAttributeProfileResponseContent;
use Auth0\SDK\API\Management\Types\ListUserAttributeProfileTemplateResponseContent;
use Auth0\SDK\API\Management\Types\GetUserAttributeProfileTemplateResponseContent;
use Auth0\SDK\API\Management\Types\GetUserAttributeProfileResponseContent;
use Auth0\SDK\API\Management\UserAttributeProfiles\Requests\UpdateUserAttributeProfileRequestContent;
use Auth0\SDK\API\Management\Types\UpdateUserAttributeProfileResponseContent;

interface UserAttributeProfilesClientInterface
{
    /**
     * Retrieve a list of User Attribute Profiles. This endpoint supports Checkpoint pagination.
     *
     * @param ListUserAttributeProfileRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<UserAttributeProfile>
     */
    public function list(ListUserAttributeProfileRequestParameters $request = new ListUserAttributeProfileRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a User Attribute Profile.
     *
     * @param CreateUserAttributeProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateUserAttributeProfileResponseContent
     */
    public function create(CreateUserAttributeProfileRequestContent $request, ?array $options = null): ?CreateUserAttributeProfileResponseContent;

    /**
     * Retrieve a list of User Attribute Profile Templates.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListUserAttributeProfileTemplateResponseContent
     */
    public function listTemplates(?array $options = null): ?ListUserAttributeProfileTemplateResponseContent;

    /**
     * Retrieve a User Attribute Profile Template.
     *
     * @param string $id ID of the user-attribute-profile-template to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetUserAttributeProfileTemplateResponseContent
     */
    public function getTemplate(string $id, ?array $options = null): ?GetUserAttributeProfileTemplateResponseContent;

    /**
     * Retrieve details about a single User Attribute Profile specified by ID.
     *
     * @param string $id ID of the user-attribute-profile to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetUserAttributeProfileResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetUserAttributeProfileResponseContent;

    /**
     * Delete a single User Attribute Profile specified by ID.
     *
     * @param string $id ID of the user-attribute-profile to delete.
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
     * Update the details of a specific User attribute profile, such as name, user_id and user_attributes.
     *
     * @param string $id ID of the user attribute profile to update.
     * @param UpdateUserAttributeProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateUserAttributeProfileResponseContent
     */
    public function update(string $id, UpdateUserAttributeProfileRequestContent $request = new UpdateUserAttributeProfileRequestContent(), ?array $options = null): ?UpdateUserAttributeProfileResponseContent;
}
