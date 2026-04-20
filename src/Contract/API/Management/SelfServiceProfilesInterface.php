<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

interface SelfServiceProfilesInterface
{
    /**
     * Create a Profile.
     * Required scopes:
     * - `create:self_service_profiles` for any call to this endpoint.
     *
     * @param string              $name    The name of the self-service profile
     * @param array<mixed>        $body    Configuration for the new Profile. See @see for supported options.
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2/self-service-profiles/post-self-service-profiles
     */
    public function create(
        string $name,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Creates an SSO access ticket to initiate the Self Service SSO Flow using a self-service profile.
     * Required scopes:
     * - `create:sso_access_tickets` for any call to this endpoint.
     *
     * @param string              $id      The id of the self-service profile
     * @param array<mixed>        $body    Configuration for the new Profile. See @see for supported options.
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2/self-service-profiles/post-sso-ticket
     */
    public function createSsoTicket(
        string $id,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete a Profile.
     * Required scopes:
     * - `delete:self_service_profiles` for any call to this endpoint.
     *
     * @param string              $id      The id of the self-service profile
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2/self-service-profiles/delete-self-service-profiles-by-id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get a Profile.
     * Required scopes:
     * - `read:self_service_profiles` for any call to this endpoint.
     *
     * @param string              $id      The id of the self-service profile
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2/self-service-profiles/get-self-service-profiles-by-id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Search all Profiles.
     * Required scopes:
     * - `read:self_service_profiles` for any call to this endpoint.
     *
     * @param null|array<null|int|string> $parameters Optional. Query parameters to pass with the API request. See @see for supported options.
     * @param null|RequestOptions         $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2/self-service-profiles/get-self-service-profiles
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get the custom text for a Self Service Profile.
     * Required scopes:
     * - `read:self_service_profile_custom_texts` for any call to this endpoint.
     *
     * @param string              $id       The id of the self-service profile
     * @param string              $language The language of the custom text
     * @param string              $page     The page where the custom text is shown
     * @param null|RequestOptions $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2/self-service-profiles/get-self-service-profile-custom-text
     */
    public function getCustomTextForProfile(
        string $id,
        string $language,
        string $page,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Revokes an SSO access ticket and invalidates associated sessions
     * Required scopes:
     * - `delete:sso_access_tickets` for any call to this endpoint.
     *
     * @param string              $profileId The id of the self-service profile
     * @param string              $id        The id of the ticket to revoke
     * @param null|RequestOptions $options   Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2/self-service-profiles/post-revoke
     */
    public function revokeSsoTicket(
        string $profileId,
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Set the custom text for a Self Service Profile.
     * Required scopes:
     * - `update:self_service_profile_custom_texts` for any call to this endpoint.
     *
     * @param string              $id       The id of the self-service profile
     * @param string              $language The language of the custom text
     * @param string              $page     The page where the custom text is shown
     * @param array<mixed>        $body     Configuration for the new Profile. See @see for supported options.
     * @param null|RequestOptions $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2/self-service-profiles/put-self-service-profile-custom-text
     */
    public function setCustomTextForProfile(
        string $id,
        string $language,
        string $page,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update a Profile.
     * Required scopes:
     * - `update:self_service_profiles` for any call to this endpoint.
     *
     * @param string              $id      The id of the self-service profile
     * @param array<mixed>        $body    Configuration for the new Profile. See @see for supported options.
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2/self-service-profiles/patch-self-service-profiles-by-id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
