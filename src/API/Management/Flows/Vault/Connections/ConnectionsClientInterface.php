<?php

namespace Auth0\SDK\API\Management\Flows\Vault\Connections;

use Auth0\SDK\API\Management\Flows\Vault\Connections\Requests\ListFlowsVaultConnectionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectionSummary;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionActivecampaignApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionActivecampaignUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionAirtableApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionAirtableUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionAuth0OauthApp;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionAuth0Uninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionBigqueryJwt;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionBigqueryUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionClearbitApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionClearbitUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionDocusignOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionDocusignUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionGoogleSheetsOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionGoogleSheetsUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHttpBearer;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHttpBasicAuth;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHttpApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHttpOauthClientCredentials;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHttpUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHubspotApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHubspotOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionHubspotUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionJwtJwt;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionJwtUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionMailchimpApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionMailchimpOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionMailchimpUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionMailjetApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionMailjetUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionPipedriveToken;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionPipedriveOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionPipedriveUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSalesforceOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSalesforceUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSendgridApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSendgridUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSlackWebhook;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSlackOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionSlackUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionStripeKeyPair;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionStripeOauthCode;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionStripeUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionTelegramToken;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionTelegramUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionTwilioApiKey;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionTwilioUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionWhatsappToken;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionWhatsappUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionZapierWebhook;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionZapierUninitialized;
use Auth0\SDK\API\Management\Types\CreateFlowsVaultConnectionResponseContent;
use Auth0\SDK\API\Management\Types\GetFlowsVaultConnectionResponseContent;
use Auth0\SDK\API\Management\Flows\Vault\Connections\Requests\UpdateFlowsVaultConnectionRequestContent;
use Auth0\SDK\API\Management\Types\UpdateFlowsVaultConnectionResponseContent;

interface ConnectionsClientInterface
{
    /**
     * @param ListFlowsVaultConnectionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<FlowsVaultConnectionSummary>
     */
    public function list(ListFlowsVaultConnectionsRequestParameters $request = new ListFlowsVaultConnectionsRequestParameters(), ?array $options = null): Pager;

    /**
     * @param (
     *    CreateFlowsVaultConnectionActivecampaignApiKey
     *   |CreateFlowsVaultConnectionActivecampaignUninitialized
     *   |CreateFlowsVaultConnectionAirtableApiKey
     *   |CreateFlowsVaultConnectionAirtableUninitialized
     *   |CreateFlowsVaultConnectionAuth0OauthApp
     *   |CreateFlowsVaultConnectionAuth0Uninitialized
     *   |CreateFlowsVaultConnectionBigqueryJwt
     *   |CreateFlowsVaultConnectionBigqueryUninitialized
     *   |CreateFlowsVaultConnectionClearbitApiKey
     *   |CreateFlowsVaultConnectionClearbitUninitialized
     *   |CreateFlowsVaultConnectionDocusignOauthCode
     *   |CreateFlowsVaultConnectionDocusignUninitialized
     *   |CreateFlowsVaultConnectionGoogleSheetsOauthCode
     *   |CreateFlowsVaultConnectionGoogleSheetsUninitialized
     *   |CreateFlowsVaultConnectionHttpBearer
     *   |CreateFlowsVaultConnectionHttpBasicAuth
     *   |CreateFlowsVaultConnectionHttpApiKey
     *   |CreateFlowsVaultConnectionHttpOauthClientCredentials
     *   |CreateFlowsVaultConnectionHttpUninitialized
     *   |CreateFlowsVaultConnectionHubspotApiKey
     *   |CreateFlowsVaultConnectionHubspotOauthCode
     *   |CreateFlowsVaultConnectionHubspotUninitialized
     *   |CreateFlowsVaultConnectionJwtJwt
     *   |CreateFlowsVaultConnectionJwtUninitialized
     *   |CreateFlowsVaultConnectionMailchimpApiKey
     *   |CreateFlowsVaultConnectionMailchimpOauthCode
     *   |CreateFlowsVaultConnectionMailchimpUninitialized
     *   |CreateFlowsVaultConnectionMailjetApiKey
     *   |CreateFlowsVaultConnectionMailjetUninitialized
     *   |CreateFlowsVaultConnectionPipedriveToken
     *   |CreateFlowsVaultConnectionPipedriveOauthCode
     *   |CreateFlowsVaultConnectionPipedriveUninitialized
     *   |CreateFlowsVaultConnectionSalesforceOauthCode
     *   |CreateFlowsVaultConnectionSalesforceUninitialized
     *   |CreateFlowsVaultConnectionSendgridApiKey
     *   |CreateFlowsVaultConnectionSendgridUninitialized
     *   |CreateFlowsVaultConnectionSlackWebhook
     *   |CreateFlowsVaultConnectionSlackOauthCode
     *   |CreateFlowsVaultConnectionSlackUninitialized
     *   |CreateFlowsVaultConnectionStripeKeyPair
     *   |CreateFlowsVaultConnectionStripeOauthCode
     *   |CreateFlowsVaultConnectionStripeUninitialized
     *   |CreateFlowsVaultConnectionTelegramToken
     *   |CreateFlowsVaultConnectionTelegramUninitialized
     *   |CreateFlowsVaultConnectionTwilioApiKey
     *   |CreateFlowsVaultConnectionTwilioUninitialized
     *   |CreateFlowsVaultConnectionWhatsappToken
     *   |CreateFlowsVaultConnectionWhatsappUninitialized
     *   |CreateFlowsVaultConnectionZapierWebhook
     *   |CreateFlowsVaultConnectionZapierUninitialized
     * ) $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateFlowsVaultConnectionResponseContent
     */
    public function create(CreateFlowsVaultConnectionActivecampaignApiKey|CreateFlowsVaultConnectionActivecampaignUninitialized|CreateFlowsVaultConnectionAirtableApiKey|CreateFlowsVaultConnectionAirtableUninitialized|CreateFlowsVaultConnectionAuth0OauthApp|CreateFlowsVaultConnectionAuth0Uninitialized|CreateFlowsVaultConnectionBigqueryJwt|CreateFlowsVaultConnectionBigqueryUninitialized|CreateFlowsVaultConnectionClearbitApiKey|CreateFlowsVaultConnectionClearbitUninitialized|CreateFlowsVaultConnectionDocusignOauthCode|CreateFlowsVaultConnectionDocusignUninitialized|CreateFlowsVaultConnectionGoogleSheetsOauthCode|CreateFlowsVaultConnectionGoogleSheetsUninitialized|CreateFlowsVaultConnectionHttpBearer|CreateFlowsVaultConnectionHttpBasicAuth|CreateFlowsVaultConnectionHttpApiKey|CreateFlowsVaultConnectionHttpOauthClientCredentials|CreateFlowsVaultConnectionHttpUninitialized|CreateFlowsVaultConnectionHubspotApiKey|CreateFlowsVaultConnectionHubspotOauthCode|CreateFlowsVaultConnectionHubspotUninitialized|CreateFlowsVaultConnectionJwtJwt|CreateFlowsVaultConnectionJwtUninitialized|CreateFlowsVaultConnectionMailchimpApiKey|CreateFlowsVaultConnectionMailchimpOauthCode|CreateFlowsVaultConnectionMailchimpUninitialized|CreateFlowsVaultConnectionMailjetApiKey|CreateFlowsVaultConnectionMailjetUninitialized|CreateFlowsVaultConnectionPipedriveToken|CreateFlowsVaultConnectionPipedriveOauthCode|CreateFlowsVaultConnectionPipedriveUninitialized|CreateFlowsVaultConnectionSalesforceOauthCode|CreateFlowsVaultConnectionSalesforceUninitialized|CreateFlowsVaultConnectionSendgridApiKey|CreateFlowsVaultConnectionSendgridUninitialized|CreateFlowsVaultConnectionSlackWebhook|CreateFlowsVaultConnectionSlackOauthCode|CreateFlowsVaultConnectionSlackUninitialized|CreateFlowsVaultConnectionStripeKeyPair|CreateFlowsVaultConnectionStripeOauthCode|CreateFlowsVaultConnectionStripeUninitialized|CreateFlowsVaultConnectionTelegramToken|CreateFlowsVaultConnectionTelegramUninitialized|CreateFlowsVaultConnectionTwilioApiKey|CreateFlowsVaultConnectionTwilioUninitialized|CreateFlowsVaultConnectionWhatsappToken|CreateFlowsVaultConnectionWhatsappUninitialized|CreateFlowsVaultConnectionZapierWebhook|CreateFlowsVaultConnectionZapierUninitialized $request, ?array $options = null): ?CreateFlowsVaultConnectionResponseContent;

    /**
     * @param string $id Flows Vault connection ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetFlowsVaultConnectionResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetFlowsVaultConnectionResponseContent;

    /**
     * @param string $id Vault connection id
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
     * @param string $id Flows Vault connection ID
     * @param UpdateFlowsVaultConnectionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateFlowsVaultConnectionResponseContent
     */
    public function update(string $id, UpdateFlowsVaultConnectionRequestContent $request = new UpdateFlowsVaultConnectionRequestContent(), ?array $options = null): ?UpdateFlowsVaultConnectionResponseContent;
}
