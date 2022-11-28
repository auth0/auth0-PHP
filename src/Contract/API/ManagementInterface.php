<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\Contract\API\Management\ActionsInterface;
use Auth0\SDK\Contract\API\Management\BlacklistsInterface;
use Auth0\SDK\Contract\API\Management\ClientGrantsInterface;
use Auth0\SDK\Contract\API\Management\ClientsInterface;
use Auth0\SDK\Contract\API\Management\ConnectionsInterface;
use Auth0\SDK\Contract\API\Management\DeviceCredentialsInterface;
use Auth0\SDK\Contract\API\Management\EmailsInterface;
use Auth0\SDK\Contract\API\Management\EmailTemplatesInterface;
use Auth0\SDK\Contract\API\Management\GrantsInterface;
use Auth0\SDK\Contract\API\Management\GuardianInterface;
use Auth0\SDK\Contract\API\Management\JobsInterface;
use Auth0\SDK\Contract\API\Management\LogsInterface;
use Auth0\SDK\Contract\API\Management\LogStreamsInterface;
use Auth0\SDK\Contract\API\Management\OrganizationsInterface;
use Auth0\SDK\Contract\API\Management\ResourceServersInterface;
use Auth0\SDK\Contract\API\Management\RolesInterface;
use Auth0\SDK\Contract\API\Management\RulesInterface;
use Auth0\SDK\Contract\API\Management\StatsInterface;
use Auth0\SDK\Contract\API\Management\TenantsInterface;
use Auth0\SDK\Contract\API\Management\TicketsInterface;
use Auth0\SDK\Contract\API\Management\UserBlocksInterface;
use Auth0\SDK\Contract\API\Management\UsersByEmailInterface;
use Auth0\SDK\Contract\API\Management\UsersInterface;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\SDK\Utility\HttpResponsePaginator;

/**
 * Interface ManagementInterface.
 */
interface ManagementInterface
{
    /**
     * Return the HttpClient instance being used for management API requests.
     *
     * @param  Authentication|null  $authentication  Optional. An Instance of Authentication for use during client credential exchange. One will be created, when necessary, if not provided.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Management Token is not able to be obtained
     */
    public function getHttpClient(
        ?Authentication $authentication = null,
    ): HttpClient;

    /**
     * Return an instance of HttpRequest representing the last issued request.
     */
    public function getLastRequest(): ?HttpRequest;

    /**
     * Return a ResponsePaginator instance configured for the last HttpRequest.
     */
    public function getResponsePaginator(): HttpResponsePaginator;

    public function actions(): ActionsInterface;

    public function blacklists(): BlacklistsInterface;

    public function clients(): ClientsInterface;

    public function connections(): ConnectionsInterface;

    public function clientGrants(): ClientGrantsInterface;

    public function deviceCredentials(): DeviceCredentialsInterface;

    public function emails(): EmailsInterface;

    public function emailTemplates(): EmailTemplatesInterface;

    public function grants(): GrantsInterface;

    public function guardian(): GuardianInterface;

    public function jobs(): JobsInterface;

    public function logs(): LogsInterface;

    public function logStreams(): LogStreamsInterface;

    public function organizations(): OrganizationsInterface;

    public function roles(): RolesInterface;

    public function rules(): RulesInterface;

    public function resourceServers(): ResourceServersInterface;

    public function stats(): StatsInterface;

    public function tenants(): TenantsInterface;

    public function tickets(): TicketsInterface;

    public function userBlocks(): UserBlocksInterface;

    public function users(): UsersInterface;

    public function usersByEmail(): UsersByEmailInterface;
}
