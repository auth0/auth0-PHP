<?php

namespace Auth0\SDK\API\Management\ConnectionProfiles;

use Auth0\SDK\API\Management\ConnectionProfiles\Requests\ListConnectionProfileRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ConnectionProfile;
use Auth0\SDK\API\Management\ConnectionProfiles\Requests\CreateConnectionProfileRequestContent;
use Auth0\SDK\API\Management\Types\CreateConnectionProfileResponseContent;
use Auth0\SDK\API\Management\Types\ListConnectionProfileTemplateResponseContent;
use Auth0\SDK\API\Management\Types\GetConnectionProfileTemplateResponseContent;
use Auth0\SDK\API\Management\Types\GetConnectionProfileResponseContent;
use Auth0\SDK\API\Management\ConnectionProfiles\Requests\UpdateConnectionProfileRequestContent;
use Auth0\SDK\API\Management\Types\UpdateConnectionProfileResponseContent;

interface ConnectionProfilesClientInterface
{
    /**
     * Retrieve a list of Connection Profiles. This endpoint supports Checkpoint pagination.
     *
     * @param ListConnectionProfileRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ConnectionProfile>
     */
    public function list(ListConnectionProfileRequestParameters $request = new ListConnectionProfileRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a Connection Profile.
     *
     * @param CreateConnectionProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateConnectionProfileResponseContent
     */
    public function create(CreateConnectionProfileRequestContent $request, ?array $options = null): ?CreateConnectionProfileResponseContent;

    /**
     * Retrieve a list of Connection Profile Templates.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListConnectionProfileTemplateResponseContent
     */
    public function listTemplates(?array $options = null): ?ListConnectionProfileTemplateResponseContent;

    /**
     * Retrieve a Connection Profile Template.
     *
     * @param string $id ID of the connection-profile-template to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetConnectionProfileTemplateResponseContent
     */
    public function getTemplate(string $id, ?array $options = null): ?GetConnectionProfileTemplateResponseContent;

    /**
     * Retrieve details about a single Connection Profile specified by ID.
     *
     * @param string $id ID of the connection-profile to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetConnectionProfileResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetConnectionProfileResponseContent;

    /**
     * Delete a single Connection Profile specified by ID.
     *
     * @param string $id ID of the connection-profile to delete.
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
     * Update the details of a specific Connection Profile.
     *
     * @param string $id ID of the connection profile to update.
     * @param UpdateConnectionProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateConnectionProfileResponseContent
     */
    public function update(string $id, UpdateConnectionProfileRequestContent $request = new UpdateConnectionProfileRequestContent(), ?array $options = null): ?UpdateConnectionProfileResponseContent;
}
