<?php

namespace Auth0\SDK\API\Management\SelfServiceProfiles;

use Auth0\SDK\API\Management\SelfServiceProfiles\Requests\ListSelfServiceProfilesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\SelfServiceProfile;
use Auth0\SDK\API\Management\SelfServiceProfiles\Requests\CreateSelfServiceProfileRequestContent;
use Auth0\SDK\API\Management\Types\CreateSelfServiceProfileResponseContent;
use Auth0\SDK\API\Management\Types\GetSelfServiceProfileResponseContent;
use Auth0\SDK\API\Management\SelfServiceProfiles\Requests\UpdateSelfServiceProfileRequestContent;
use Auth0\SDK\API\Management\Types\UpdateSelfServiceProfileResponseContent;
use Auth0\SDK\API\Management\SelfServiceProfiles\CustomText\CustomTextClientInterface;
use Auth0\SDK\API\Management\SelfServiceProfiles\SsoTicket\SsoTicketClientInterface;

interface SelfServiceProfilesClientInterface
{
    /**
     * Retrieves self-service profiles.
     *
     * @param ListSelfServiceProfilesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<SelfServiceProfile>
     */
    public function list(ListSelfServiceProfilesRequestParameters $request = new ListSelfServiceProfilesRequestParameters(), ?array $options = null): Pager;

    /**
     * Creates a self-service profile.
     *
     * @param CreateSelfServiceProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateSelfServiceProfileResponseContent
     */
    public function create(CreateSelfServiceProfileRequestContent $request, ?array $options = null): ?CreateSelfServiceProfileResponseContent;

    /**
     * Retrieves a self-service profile by Id.
     *
     * @param string $id The id of the self-service profile to retrieve
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetSelfServiceProfileResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetSelfServiceProfileResponseContent;

    /**
     * Deletes a self-service profile by Id.
     *
     * @param string $id The id of the self-service profile to delete
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
     * Updates a self-service profile.
     *
     * @param string $id The id of the self-service profile to update
     * @param UpdateSelfServiceProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateSelfServiceProfileResponseContent
     */
    public function update(string $id, UpdateSelfServiceProfileRequestContent $request = new UpdateSelfServiceProfileRequestContent(), ?array $options = null): ?UpdateSelfServiceProfileResponseContent;

    /**
     * @return CustomTextClientInterface
     */
    public function getCustomText(): CustomTextClientInterface;

    /**
     * @return SsoTicketClientInterface
     */
    public function getSsoTicket(): SsoTicketClientInterface;
}
