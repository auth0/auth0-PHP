<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API;

use Auth0\SDK\Contract\API\Management\{ActionsInterface, BlacklistsInterface, ClientGrantsInterface, ClientsInterface, ConnectionsInterface, DeviceCredentialsInterface, EmailTemplatesInterface, EmailsInterface, GrantsInterface, GuardianInterface, JobsInterface, LogStreamsInterface, LogsInterface, OrganizationsInterface, ResourceServersInterface, RolesInterface, RulesInterface, StatsInterface, TenantsInterface, TicketsInterface, UserBlocksInterface, UsersByEmailInterface, UsersInterface};
use Auth0\SDK\Utility\HttpResponsePaginator;

interface ManagementInterface extends ClientInterface
{
    public function actions(): ActionsInterface;

    public function blacklists(): BlacklistsInterface;

    public function clientGrants(): ClientGrantsInterface;

    public function clients(): ClientsInterface;

    public function connections(): ConnectionsInterface;

    public function deviceCredentials(): DeviceCredentialsInterface;

    public function emails(): EmailsInterface;

    public function emailTemplates(): EmailTemplatesInterface;

    /**
     * Return a ResponsePaginator instance configured for the last HttpRequest.
     */
    public function getResponsePaginator(): HttpResponsePaginator;

    public function grants(): GrantsInterface;

    public function guardian(): GuardianInterface;

    public function jobs(): JobsInterface;

    public function logs(): LogsInterface;

    public function logStreams(): LogStreamsInterface;

    public function organizations(): OrganizationsInterface;

    public function resourceServers(): ResourceServersInterface;

    public function roles(): RolesInterface;

    public function rules(): RulesInterface;

    public function stats(): StatsInterface;

    public function tenants(): TenantsInterface;

    public function tickets(): TicketsInterface;

    public function userBlocks(): UserBlocksInterface;

    public function users(): UsersInterface;

    public function usersByEmail(): UsersByEmailInterface;
}
