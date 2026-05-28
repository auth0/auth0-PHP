# Reference
## Actions
<details><summary><code>$client-&gt;actions-&gt;list($request) -> ?ListActionsPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve all actions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->list(
    new ListActionsRequestParameters([
        'triggerId' => ActionTriggerTypeEnum::PostLogin->value,
        'actionName' => 'actionName',
        'deployed' => true,
        'page' => 1,
        'perPage' => 1,
        'installed' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$triggerId:** `?string` — An actions extensibility point.
    
</dd>
</dl>

<dl>
<dd>

**$actionName:** `?string` — The name of the action to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$deployed:** `?bool` — Optional filter to only retrieve actions that are deployed.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Use this field to request a specific page of the list results.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — The maximum number of results to be returned by the server in single response. 20 by default
    
</dd>
</dl>

<dl>
<dd>

**$installed:** `?bool` — Optional. When true, return only installed actions. When false, return only custom actions. Returns all actions by default.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;create($request) -> ?CreateActionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create an action. Once an action is created, it must be deployed, and then bound to a trigger before it will be executed as part of a flow.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->create(
    new CreateActionRequestContent([
        'name' => 'name',
        'supportedTriggers' => [
            new ActionTrigger([
                'id' => ActionTriggerTypeEnum::PostLogin->value,
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — The name of an action.
    
</dd>
</dl>

<dl>
<dd>

**$supportedTriggers:** `array` — The list of triggers that this action supports. At this time, an action can only target a single trigger at a time.
    
</dd>
</dl>

<dl>
<dd>

**$code:** `?string` — The source code of the action.
    
</dd>
</dl>

<dl>
<dd>

**$dependencies:** `?array` — The list of third party npm modules, and their versions, that this action depends on.
    
</dd>
</dl>

<dl>
<dd>

**$runtime:** `?string` — The Node runtime. For example: `node22`, defaults to `node22`
    
</dd>
</dl>

<dl>
<dd>

**$secrets:** `?array` — The list of secrets that are included in an action or a version of an action.
    
</dd>
</dl>

<dl>
<dd>

**$modules:** `?array` — The list of action modules and their versions used by this action.
    
</dd>
</dl>

<dl>
<dd>

**$deploy:** `?bool` — True if the action should be deployed after creation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;get($id) -> ?GetActionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve an action by its ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the action to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;delete($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes an action and all of its associated versions. An action must be unbound from all triggers before it can be deleted.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->delete(
    'id',
    new DeleteActionRequestParameters([
        'force' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the action to delete.
    
</dd>
</dl>

<dl>
<dd>

**$force:** `?bool` — Force action deletion detaching bindings
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;update($id, $request) -> ?UpdateActionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update an existing action. If this action is currently bound to a trigger, updating it will **not** affect any user flows until the action is deployed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->update(
    'id',
    new UpdateActionRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the action to update.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — The name of an action.
    
</dd>
</dl>

<dl>
<dd>

**$supportedTriggers:** `?array` — The list of triggers that this action supports. At this time, an action can only target a single trigger at a time.
    
</dd>
</dl>

<dl>
<dd>

**$code:** `?string` — The source code of the action.
    
</dd>
</dl>

<dl>
<dd>

**$dependencies:** `?array` — The list of third party npm modules, and their versions, that this action depends on.
    
</dd>
</dl>

<dl>
<dd>

**$runtime:** `?string` — The Node runtime. For example: `node22`, defaults to `node22`
    
</dd>
</dl>

<dl>
<dd>

**$secrets:** `?array` — The list of secrets that are included in an action or a version of an action.
    
</dd>
</dl>

<dl>
<dd>

**$modules:** `?array` — The list of action modules and their versions used by this action.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;deploy($id) -> ?DeployActionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deploy an action. Deploying an action will create a new immutable version of the action. If the action is currently bound to a trigger, then the system will begin executing the newly deployed version of the action immediately. Otherwise, the action will only be executed as a part of a flow once it is bound to that flow.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->deploy(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of an action.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;test($id, $request) -> ?TestActionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Test an action. After updating an action, it can be tested prior to being deployed to ensure it behaves as expected.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->test(
    'id',
    new TestActionRequestContent([
        'payload' => [
            'key' => "value",
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the action to test.
    
</dd>
</dl>

<dl>
<dd>

**$payload:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Branding
<details><summary><code>$client-&gt;branding-&gt;get() -> ?GetBrandingResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve branding settings.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;update($request) -> ?UpdateBrandingResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update branding settings.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->update(
    new UpdateBrandingRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$colors:** `?UpdateBrandingColors` 
    
</dd>
</dl>

<dl>
<dd>

**$faviconUrl:** `?string` — URL for the favicon. Must use HTTPS.
    
</dd>
</dl>

<dl>
<dd>

**$logoUrl:** `?string` — URL for the logo. Must use HTTPS.
    
</dd>
</dl>

<dl>
<dd>

**$identifiers:** `?UpdateBrandingIdentifiers` 
    
</dd>
</dl>

<dl>
<dd>

**$font:** `?UpdateBrandingFont` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ClientGrants
<details><summary><code>$client-&gt;clientGrants-&gt;list($request) -> ?ListClientGrantPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of <a href="https://auth0.com/docs/get-started/applications/application-access-to-apis-client-grants">client grants</a>, including the scopes associated with the application/API pair.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clientGrants->list(
    new ListClientGrantsRequestParameters([
        'from' => 'from',
        'take' => 1,
        'audience' => 'audience',
        'clientId' => 'client_id',
        'allowAnyOrganization' => true,
        'subjectType' => ClientGrantSubjectTypeEnum::Client->value,
        'defaultFor' => ClientGrantDefaultForEnum::ThirdPartyClients->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$audience:** `?string` — Optional filter on audience.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — Optional filter on client_id.
    
</dd>
</dl>

<dl>
<dd>

**$allowAnyOrganization:** `?bool` — Optional filter on allow_any_organization.
    
</dd>
</dl>

<dl>
<dd>

**$subjectType:** `?string` — The type of application access the client grant allows.
    
</dd>
</dl>

<dl>
<dd>

**$defaultFor:** `?string` — Applies this client grant as the default for all clients in the specified group. The only accepted value is <a href="https://auth0.com/docs/get-started/applications/application-access-to-apis-client-grants#default-permissions-for-third-party-applications">`third_party_clients`</a>, which applies the grant to all third-party clients. Per-client grants for the same audience take precedence. Mutually exclusive with `client_id`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clientGrants-&gt;create($request) -> ?CreateClientGrantResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a client grant for a machine-to-machine login flow. To learn more, read <a href="https://www.auth0.com/docs/get-started/authentication-and-authorization-flow/client-credentials-flow">Client Credential Flow</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clientGrants->create(
    new CreateClientGrantRequestContent([
        'audience' => 'audience',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$clientId:** `?string` — ID of the client.
    
</dd>
</dl>

<dl>
<dd>

**$audience:** `string` — The audience (API identifier) of this client grant
    
</dd>
</dl>

<dl>
<dd>

**$defaultFor:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$organizationUsage:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$allowAnyOrganization:** `?bool` — If enabled, any organization can be used with this grant. If disabled (default), the grant must be explicitly assigned to the desired organizations.
    
</dd>
</dl>

<dl>
<dd>

**$scope:** `?array` — Scopes allowed for this client grant.
    
</dd>
</dl>

<dl>
<dd>

**$subjectType:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$authorizationDetailsTypes:** `?array` — Types of authorization_details allowed for this client grant.
    
</dd>
</dl>

<dl>
<dd>

**$allowAllScopes:** `?bool` — If enabled, all scopes configured on the resource server are allowed for this grant.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clientGrants-&gt;get($id) -> ?GetClientGrantResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a single <a href="https://auth0.com/docs/get-started/applications/application-access-to-apis-client-grants">client grant</a>, including the
scopes associated with the application/API pair.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clientGrants->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the client grant to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clientGrants-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete the <a href="https://www.auth0.com/docs/get-started/authentication-and-authorization-flow/client-credentials-flow">Client Credential Flow</a> from your machine-to-machine application.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clientGrants->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the client grant to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clientGrants-&gt;update($id, $request) -> ?UpdateClientGrantResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a client grant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clientGrants->update(
    'id',
    new UpdateClientGrantRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the client grant to update.
    
</dd>
</dl>

<dl>
<dd>

**$scope:** `?array` — Scopes allowed for this client grant.
    
</dd>
</dl>

<dl>
<dd>

**$organizationUsage:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$allowAnyOrganization:** `?bool` — Controls allowing any organization to be used with this grant
    
</dd>
</dl>

<dl>
<dd>

**$authorizationDetailsTypes:** `?array` — Types of authorization_details allowed for this client grant.
    
</dd>
</dl>

<dl>
<dd>

**$allowAllScopes:** `?bool` — If enabled, all scopes configured on the resource server are allowed for this grant.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Clients
<details><summary><code>$client-&gt;clients-&gt;list($request) -> ?ListClientsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve clients (applications and SSO integrations) matching provided filters. A list of fields to include or exclude may also be specified.
For more information, read <a href="https://www.auth0.com/docs/get-started/applications"> Applications in Auth0</a> and <a href="https://www.auth0.com/docs/authenticate/single-sign-on"> Single Sign-On</a>.

<ul>
  <li>
    The following can be retrieved with any scope:
    <code>client_id</code>, <code>app_type</code>, <code>name</code>, and <code>description</code>.
  </li>
  <li>
    The following properties can only be retrieved with the <code>read:clients</code> or
    <code>read:client_keys</code> scope:
    <code>callbacks</code>, <code>oidc_logout</code>, <code>allowed_origins</code>,
    <code>web_origins</code>, <code>tenant</code>, <code>global</code>, <code>config_route</code>,
    <code>callback_url_template</code>, <code>jwt_configuration</code>,
    <code>jwt_configuration.lifetime_in_seconds</code>, <code>jwt_configuration.secret_encoded</code>,
    <code>jwt_configuration.scopes</code>, <code>jwt_configuration.alg</code>, <code>api_type</code>,
    <code>logo_uri</code>, <code>allowed_clients</code>, <code>owners</code>, <code>custom_login_page</code>,
    <code>custom_login_page_off</code>, <code>sso</code>, <code>addons</code>, <code>form_template</code>,
    <code>custom_login_page_codeview</code>, <code>resource_servers</code>, <code>client_metadata</code>,
    <code>mobile</code>, <code>mobile.android</code>, <code>mobile.ios</code>, <code>allowed_logout_urls</code>,
    <code>token_endpoint_auth_method</code>, <code>is_first_party</code>, <code>oidc_conformant</code>,
    <code>is_token_endpoint_ip_header_trusted</code>, <code>initiate_login_uri</code>, <code>grant_types</code>,
    <code>refresh_token</code>, <code>refresh_token.rotation_type</code>, <code>refresh_token.expiration_type</code>,
    <code>refresh_token.leeway</code>, <code>refresh_token.token_lifetime</code>, <code>refresh_token.policies</code>, <code>organization_usage</code>,
    <code>organization_require_behavior</code>.
  </li>
  <li>
    The following properties can only be retrieved with the
    <code>read:client_keys</code> or <code>read:client_credentials</code> scope:
    <code>encryption_key</code>, <code>encryption_key.pub</code>, <code>encryption_key.cert</code>,
    <code>client_secret</code>, <code>client_authentication_methods</code> and <code>signing_key</code>.
  </li>
</ul>
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->list(
    new ListClientsRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'isGlobal' => true,
        'isFirstParty' => true,
        'appType' => 'app_type',
        'externalClientId' => 'external_client_id',
        'q' => 'q',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Default value is 50, maximum value is 100
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$isGlobal:** `?bool` — Optional filter on the global client parameter.
    
</dd>
</dl>

<dl>
<dd>

**$isFirstParty:** `?bool` — Optional filter on whether or not a client is a first-party client.
    
</dd>
</dl>

<dl>
<dd>

**$appType:** `?string` — Optional filter by a comma-separated list of application types.
    
</dd>
</dl>

<dl>
<dd>

**$externalClientId:** `?string` — Optional filter by the <a href="https://www.ietf.org/archive/id/draft-ietf-oauth-client-id-metadata-document-04.html">Client ID Metadata Document</a> URI for CIMD-registered clients.
    
</dd>
</dl>

<dl>
<dd>

**$q:** `?string` — Advanced Query in <a href="https://lucene.apache.org/core/2_9_4/queryparsersyntax.html">Lucene</a> syntax.<br /><b>Permitted Queries</b>:<br /><ul><li><i>client_grant.organization_id:{organization_id}</i></li><li><i>client_grant.allow_any_organization:true</i></li></ul><b>Additional Restrictions</b>:<br /><ul><li>Cannot be used in combination with other filters</li><li>Requires use of the <i>from</i> and <i>take</i> paging parameters (checkpoint paginatinon)</li><li>Reduced rate limits apply. See <a href="https://auth0.com/docs/troubleshoot/customer-support/operational-policies/rate-limit-policy/rate-limit-configurations/enterprise-public">Rate Limit Configurations</a></li></ul><i><b>Note</b>: Recent updates may not be immediately reflected in query results</i>
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;create($request) -> ?CreateClientResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new client (application or SSO integration). For more information, read <a href="https://www.auth0.com/docs/get-started/auth0-overview/create-applications">Create Applications</a>
<a href="https://www.auth0.com/docs/authenticate/single-sign-on/api-endpoints-for-single-sign-on>">API Endpoints for Single Sign-On</a>. 

Notes: 
- We recommend leaving the `client_secret` parameter unspecified to allow the generation of a safe secret.
- The <code>client_authentication_methods</code> and <code>token_endpoint_auth_method</code> properties are mutually exclusive. Use 
<code>client_authentication_methods</code> to configure the client with Private Key JWT authentication method. Otherwise, use <code>token_endpoint_auth_method</code>
to configure the client with client secret (basic or post) or with no authentication method (none).
- When using <code>client_authentication_methods</code> to configure the client with Private Key JWT authentication method, specify fully defined credentials. 
These credentials will be automatically enabled for Private Key JWT authentication on the client. 
- To configure <code>client_authentication_methods</code>, the <code>create:client_credentials</code> scope is required.
- To configure <code>client_authentication_methods</code>, the property <code>jwt_configuration.alg</code> must be set to RS256.

<div class="alert alert-warning">SSO Integrations created via this endpoint will accept login requests and share user profile information.</div>
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->create(
    new CreateClientRequestContent([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — Name of this client (min length: 1 character, does not allow `<` or `>`).
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Free text description of this client (max length: 140 characters).
    
</dd>
</dl>

<dl>
<dd>

**$logoUri:** `?string` — URL of the logo to display for this client. Recommended size is 150x150 pixels.
    
</dd>
</dl>

<dl>
<dd>

**$callbacks:** `?array` — Comma-separated list of URLs whitelisted for Auth0 to use as a callback to the client after authentication.
    
</dd>
</dl>

<dl>
<dd>

**$oidcLogout:** `?ClientOidcBackchannelLogoutSettings` 
    
</dd>
</dl>

<dl>
<dd>

**$oidcBackchannelLogout:** `?ClientOidcBackchannelLogoutSettings` — Configuration for OIDC backchannel logout (deprecated, in favor of oidc_logout)
    
</dd>
</dl>

<dl>
<dd>

**$sessionTransfer:** `?ClientSessionTransferConfiguration` 
    
</dd>
</dl>

<dl>
<dd>

**$allowedOrigins:** `?array` — Comma-separated list of URLs allowed to make requests from JavaScript to Auth0 API (typically used with CORS). By default, all your callback URLs will be allowed. This field allows you to enter other origins if necessary. You can also use wildcards at the subdomain level (e.g., https://*.contoso.com). Query strings and hash information are not taken into account when validating these URLs.
    
</dd>
</dl>

<dl>
<dd>

**$webOrigins:** `?array` — Comma-separated list of allowed origins for use with <a href='https://auth0.com/docs/cross-origin-authentication'>Cross-Origin Authentication</a>, <a href='https://auth0.com/docs/flows/concepts/device-auth'>Device Flow</a>, and <a href='https://auth0.com/docs/protocols/oauth2#how-response-mode-works'>web message response mode</a>.
    
</dd>
</dl>

<dl>
<dd>

**$clientAliases:** `?array` — List of audiences/realms for SAML protocol. Used by the wsfed addon.
    
</dd>
</dl>

<dl>
<dd>

**$allowedClients:** `?array` — List of allow clients and API ids that are allowed to make delegation requests. Empty means all all your clients are allowed.
    
</dd>
</dl>

<dl>
<dd>

**$allowedLogoutUrls:** `?array` — Comma-separated list of URLs that are valid to redirect to after logout from Auth0. Wildcards are allowed for subdomains.
    
</dd>
</dl>

<dl>
<dd>

**$grantTypes:** `?array` — List of grant types supported for this application. Can include `authorization_code`, `implicit`, `refresh_token`, `client_credentials`, `password`, `http://auth0.com/oauth/grant-type/password-realm`, `http://auth0.com/oauth/grant-type/mfa-oob`, `http://auth0.com/oauth/grant-type/mfa-otp`, `http://auth0.com/oauth/grant-type/mfa-recovery-code`, `urn:openid:params:grant-type:ciba`, `urn:ietf:params:oauth:grant-type:device_code`, and `urn:auth0:params:oauth:grant-type:token-exchange:federated-connection-access-token`.
    
</dd>
</dl>

<dl>
<dd>

**$tokenEndpointAuthMethod:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$isTokenEndpointIpHeaderTrusted:** `?bool` — If true, trust that the IP specified in the `auth0-forwarded-for` header is the end-user's IP for brute-force-protection on token endpoint.
    
</dd>
</dl>

<dl>
<dd>

**$appType:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$isFirstParty:** `?bool` — Whether this client a first party client or not
    
</dd>
</dl>

<dl>
<dd>

**$oidcConformant:** `?bool` — Whether this client conforms to <a href='https://auth0.com/docs/api-auth/tutorials/adoption'>strict OIDC specifications</a> (true) or uses legacy features (false).
    
</dd>
</dl>

<dl>
<dd>

**$jwtConfiguration:** `?ClientJwtConfiguration` 
    
</dd>
</dl>

<dl>
<dd>

**$encryptionKey:** `?ClientEncryptionKey` 
    
</dd>
</dl>

<dl>
<dd>

**$sso:** `?bool` — Applies only to SSO clients and determines whether Auth0 will handle Single Sign On (true) or whether the Identity Provider will (false).
    
</dd>
</dl>

<dl>
<dd>

**$crossOriginAuthentication:** `?bool` — Whether this client can be used to make cross-origin authentication requests (true) or it is not allowed to make such requests (false).
    
</dd>
</dl>

<dl>
<dd>

**$crossOriginLoc:** `?string` — URL of the location in your site where the cross origin verification takes place for the cross-origin auth flow when performing Auth in your own domain instead of Auth0 hosted login page.
    
</dd>
</dl>

<dl>
<dd>

**$ssoDisabled:** `?bool` — <code>true</code> to disable Single Sign On, <code>false</code> otherwise (default: <code>false</code>)
    
</dd>
</dl>

<dl>
<dd>

**$customLoginPageOn:** `?bool` — <code>true</code> if the custom login page is to be used, <code>false</code> otherwise. Defaults to <code>true</code>
    
</dd>
</dl>

<dl>
<dd>

**$customLoginPage:** `?string` — The content (HTML, CSS, JS) of the custom login page.
    
</dd>
</dl>

<dl>
<dd>

**$customLoginPagePreview:** `?string` — The content (HTML, CSS, JS) of the custom login page. (Used on Previews)
    
</dd>
</dl>

<dl>
<dd>

**$formTemplate:** `?string` — HTML form template to be used for WS-Federation.
    
</dd>
</dl>

<dl>
<dd>

**$addons:** `?ClientAddons` 
    
</dd>
</dl>

<dl>
<dd>

**$clientMetadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$mobile:** `?ClientMobile` 
    
</dd>
</dl>

<dl>
<dd>

**$initiateLoginUri:** `?string` — Initiate login uri, must be https
    
</dd>
</dl>

<dl>
<dd>

**$nativeSocialLogin:** `?NativeSocialLogin` 
    
</dd>
</dl>

<dl>
<dd>

**$fedcmLogin:** `?FedCmLogin` 
    
</dd>
</dl>

<dl>
<dd>

**$refreshToken:** `?ClientRefreshTokenConfiguration` 
    
</dd>
</dl>

<dl>
<dd>

**$defaultOrganization:** `?ClientDefaultOrganization` 
    
</dd>
</dl>

<dl>
<dd>

**$organizationUsage:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$organizationRequireBehavior:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$organizationDiscoveryMethods:** `?array` — Defines the available methods for organization discovery during the `pre_login_prompt`. Users can discover their organization either by `email`, `organization_name` or both.
    
</dd>
</dl>

<dl>
<dd>

**$clientAuthenticationMethods:** `?ClientCreateAuthenticationMethod` 
    
</dd>
</dl>

<dl>
<dd>

**$requirePushedAuthorizationRequests:** `?bool` — Makes the use of Pushed Authorization Requests mandatory for this client
    
</dd>
</dl>

<dl>
<dd>

**$requireProofOfPossession:** `?bool` — Makes the use of Proof-of-Possession mandatory for this client
    
</dd>
</dl>

<dl>
<dd>

**$signedRequestObject:** `?ClientSignedRequestObjectWithPublicKey` 
    
</dd>
</dl>

<dl>
<dd>

**$complianceLevel:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$skipNonVerifiableCallbackUriConfirmationPrompt:** `?bool` 

Controls whether a confirmation prompt is shown during login flows when the redirect URI uses non-verifiable callback URIs (for example, a custom URI schema such as `myapp://`, or `localhost`).
If set to true, a confirmation prompt will not be shown. We recommend that this is set to false for improved protection from malicious apps.
See https://auth0.com/docs/secure/security-guidance/measures-against-app-impersonation for more information.
    
</dd>
</dl>

<dl>
<dd>

**$tokenExchange:** `?ClientTokenExchangeConfiguration` 
    
</dd>
</dl>

<dl>
<dd>

**$parRequestExpiry:** `?int` — Specifies how long, in seconds, a Pushed Authorization Request URI remains valid
    
</dd>
</dl>

<dl>
<dd>

**$tokenQuota:** `?CreateTokenQuota` 
    
</dd>
</dl>

<dl>
<dd>

**$resourceServerIdentifier:** `?string` — The identifier of the resource server that this client is linked to.
    
</dd>
</dl>

<dl>
<dd>

**$thirdPartySecurityMode:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$redirectionPolicy:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$expressConfiguration:** `?ExpressConfiguration` 
    
</dd>
</dl>

<dl>
<dd>

**$myOrganizationConfiguration:** `?ClientMyOrganizationPostConfiguration` 
    
</dd>
</dl>

<dl>
<dd>

**$asyncApprovalNotificationChannels:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;previewCimdMetadata($request) -> ?PreviewCimdMetadataResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>


      Fetches and validates a Client ID Metadata Document without creating a client.
      Returns the raw metadata and how it would be mapped to Auth0 client fields.
      This endpoint is useful for testing metadata URIs before creating CIMD clients.
    
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->previewCimdMetadata(
    new PreviewCimdMetadataRequestContent([
        'externalClientId' => 'external_client_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$externalClientId:** `string` — URL to the Client ID Metadata Document
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;registerCimdClient($request) -> ?RegisterCimdClientResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Idempotent registration for Client ID Metadata Document (CIMD) clients.
Uses external_client_id as the unique identifier for upsert operations.

<strong>Create:</strong> Returns 201 when a new client is created (requires <code>create:clients</code> scope).
<strong>Update:</strong> Returns 200 when an existing client is updated (requires <code>update:clients</code> scope).

This endpoint automatically:
<ul>
  <li>Fetches and validates the metadata document</li>
  <li>Maps CIMD fields to Auth0 client configuration</li>
  <li>Creates/rotates credentials from the JWKS</li>
  <li>Enforces CIMD security policies (HTTPS-only, no shared secrets)</li>
</ul>
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->registerCimdClient(
    new RegisterCimdClientRequestContent([
        'externalClientId' => 'external_client_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$externalClientId:** `string` — URL to the Client ID Metadata Document. Acts as the unique identifier for upsert operations.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;get($id, $request) -> ?GetClientResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve client details by ID. Clients are SSO connections or Applications linked with your Auth0 tenant. A list of fields to include or exclude may also be specified. 
For more information, read <a href="https://www.auth0.com/docs/get-started/applications"> Applications in Auth0</a> and <a href="https://www.auth0.com/docs/authenticate/single-sign-on"> Single Sign-On</a>.
<ul>
  <li>
    The following properties can be retrieved with any of the scopes:
    <code>client_id</code>, <code>app_type</code>, <code>name</code>, and <code>description</code>.
  </li>
  <li>
    The following properties can only be retrieved with the <code>read:clients</code> or
    <code>read:client_keys</code> scopes:
    <code>callbacks</code>, <code>oidc_logout</code>, <code>allowed_origins</code>,
    <code>web_origins</code>, <code>tenant</code>, <code>global</code>, <code>config_route</code>,
    <code>callback_url_template</code>, <code>jwt_configuration</code>,
    <code>jwt_configuration.lifetime_in_seconds</code>, <code>jwt_configuration.secret_encoded</code>,
    <code>jwt_configuration.scopes</code>, <code>jwt_configuration.alg</code>, <code>api_type</code>,
    <code>logo_uri</code>, <code>allowed_clients</code>, <code>owners</code>, <code>custom_login_page</code>,
    <code>custom_login_page_off</code>, <code>sso</code>, <code>addons</code>, <code>form_template</code>,
    <code>custom_login_page_codeview</code>, <code>resource_servers</code>, <code>client_metadata</code>,
    <code>mobile</code>, <code>mobile.android</code>, <code>mobile.ios</code>, <code>allowed_logout_urls</code>,
    <code>token_endpoint_auth_method</code>, <code>is_first_party</code>, <code>oidc_conformant</code>,
    <code>is_token_endpoint_ip_header_trusted</code>, <code>initiate_login_uri</code>, <code>grant_types</code>,
    <code>refresh_token</code>, <code>refresh_token.rotation_type</code>, <code>refresh_token.expiration_type</code>,
    <code>refresh_token.leeway</code>, <code>refresh_token.token_lifetime</code>, <code>refresh_token.policies</code>, <code>organization_usage</code>,
    <code>organization_require_behavior</code>.
  </li>
  <li>
    The following properties can only be retrieved with the <code>read:client_keys</code> or <code>read:client_credentials</code> scopes:
    <code>encryption_key</code>, <code>encryption_key.pub</code>, <code>encryption_key.cert</code>,
    <code>client_secret</code>, <code>client_authentication_methods</code> and <code>signing_key</code>.
  </li>
</ul>
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->get(
    'id',
    new GetClientRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the client to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a client and related configuration (rules, connections, etc).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the client to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;update($id, $request) -> ?UpdateClientResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a client's settings. For more information, read <a href="https://www.auth0.com/docs/get-started/applications"> Applications in Auth0</a> and <a href="https://www.auth0.com/docs/authenticate/single-sign-on"> Single Sign-On</a>.

Notes:
- The `client_secret` and `signing_key` attributes can only be updated with the `update:client_keys` scope.
- The <code>client_authentication_methods</code> and <code>token_endpoint_auth_method</code> properties are mutually exclusive. Use <code>client_authentication_methods</code> to configure the client with Private Key JWT authentication method. Otherwise, use <code>token_endpoint_auth_method</code> to configure the client with client secret (basic or post) or with no authentication method (none).
- When using <code>client_authentication_methods</code> to configure the client with Private Key JWT authentication method, only specify the credential IDs that were generated when creating the credentials on the client.
- To configure <code>client_authentication_methods</code>, the <code>update:client_credentials</code> scope is required.
- To configure <code>client_authentication_methods</code>, the property <code>jwt_configuration.alg</code> must be set to RS256.
- To change a client's <code>is_first_party</code> property to <code>false</code>, the <code>organization_usage</code> and <code>organization_require_behavior</code> properties must be unset.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->update(
    'id',
    new UpdateClientRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the client to update.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — The name of the client. Must contain at least one character. Does not allow '<' or '>'.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Free text description of the purpose of the Client. (Max character length: <code>140</code>)
    
</dd>
</dl>

<dl>
<dd>

**$clientSecret:** `?string` — The secret used to sign tokens for the client
    
</dd>
</dl>

<dl>
<dd>

**$logoUri:** `?string` — The URL of the client logo (recommended size: 150x150)
    
</dd>
</dl>

<dl>
<dd>

**$callbacks:** `?array` — A set of URLs that are valid to call back from Auth0 when authenticating users
    
</dd>
</dl>

<dl>
<dd>

**$oidcLogout:** `?ClientOidcBackchannelLogoutSettings` 
    
</dd>
</dl>

<dl>
<dd>

**$oidcBackchannelLogout:** `?ClientOidcBackchannelLogoutSettings` — Configuration for OIDC backchannel logout (deprecated, in favor of oidc_logout)
    
</dd>
</dl>

<dl>
<dd>

**$sessionTransfer:** `?ClientSessionTransferConfiguration` 
    
</dd>
</dl>

<dl>
<dd>

**$allowedOrigins:** `?array` — A set of URLs that represents valid origins for CORS
    
</dd>
</dl>

<dl>
<dd>

**$webOrigins:** `?array` — A set of URLs that represents valid web origins for use with web message response mode
    
</dd>
</dl>

<dl>
<dd>

**$grantTypes:** `?array` — A set of grant types that the client is authorized to use. Can include `authorization_code`, `implicit`, `refresh_token`, `client_credentials`, `password`, `http://auth0.com/oauth/grant-type/password-realm`, `http://auth0.com/oauth/grant-type/mfa-oob`, `http://auth0.com/oauth/grant-type/mfa-otp`, `http://auth0.com/oauth/grant-type/mfa-recovery-code`, `urn:openid:params:grant-type:ciba`, `urn:ietf:params:oauth:grant-type:device_code`, and `urn:auth0:params:oauth:grant-type:token-exchange:federated-connection-access-token`.
    
</dd>
</dl>

<dl>
<dd>

**$clientAliases:** `?array` — List of audiences for SAML protocol
    
</dd>
</dl>

<dl>
<dd>

**$allowedClients:** `?array` — Ids of clients that will be allowed to perform delegation requests. Clients that will be allowed to make delegation request. By default, all your clients will be allowed. This field allows you to specify specific clients
    
</dd>
</dl>

<dl>
<dd>

**$allowedLogoutUrls:** `?array` — URLs that are valid to redirect to after logout from Auth0
    
</dd>
</dl>

<dl>
<dd>

**$jwtConfiguration:** `?ClientJwtConfiguration` — An object that holds settings related to how JWTs are created
    
</dd>
</dl>

<dl>
<dd>

**$encryptionKey:** `?ClientEncryptionKey` — The client's encryption key
    
</dd>
</dl>

<dl>
<dd>

**$sso:** `?bool` — <code>true</code> to use Auth0 instead of the IdP to do Single Sign On, <code>false</code> otherwise (default: <code>false</code>)
    
</dd>
</dl>

<dl>
<dd>

**$crossOriginAuthentication:** `?bool` — <code>true</code> if this client can be used to make cross-origin authentication requests, <code>false</code> otherwise if cross origin is disabled
    
</dd>
</dl>

<dl>
<dd>

**$crossOriginLoc:** `?string` — URL for the location in your site where the cross origin verification takes place for the cross-origin auth flow when performing Auth in your own domain instead of Auth0 hosted login page.
    
</dd>
</dl>

<dl>
<dd>

**$ssoDisabled:** `?bool` — <code>true</code> to disable Single Sign On, <code>false</code> otherwise (default: <code>false</code>)
    
</dd>
</dl>

<dl>
<dd>

**$customLoginPageOn:** `?bool` — <code>true</code> if the custom login page is to be used, <code>false</code> otherwise.
    
</dd>
</dl>

<dl>
<dd>

**$tokenEndpointAuthMethod:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$isTokenEndpointIpHeaderTrusted:** `?bool` — If true, trust that the IP specified in the `auth0-forwarded-for` header is the end-user's IP for brute-force-protection on token endpoint.
    
</dd>
</dl>

<dl>
<dd>

**$appType:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$isFirstParty:** `?bool` — Whether this client a first party client or not
    
</dd>
</dl>

<dl>
<dd>

**$oidcConformant:** `?bool` — Whether this client will conform to strict OIDC specifications
    
</dd>
</dl>

<dl>
<dd>

**$customLoginPage:** `?string` — The content (HTML, CSS, JS) of the custom login page
    
</dd>
</dl>

<dl>
<dd>

**$customLoginPagePreview:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$tokenQuota:** `?UpdateTokenQuota` 
    
</dd>
</dl>

<dl>
<dd>

**$formTemplate:** `?string` — Form template for WS-Federation protocol
    
</dd>
</dl>

<dl>
<dd>

**$addons:** `?ClientAddons` 
    
</dd>
</dl>

<dl>
<dd>

**$clientMetadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$mobile:** `?ClientMobile` — Configuration related to native mobile apps
    
</dd>
</dl>

<dl>
<dd>

**$initiateLoginUri:** `?string` — Initiate login uri, must be https
    
</dd>
</dl>

<dl>
<dd>

**$nativeSocialLogin:** `?NativeSocialLogin` 
    
</dd>
</dl>

<dl>
<dd>

**$fedcmLogin:** `?FedCmLogin` 
    
</dd>
</dl>

<dl>
<dd>

**$refreshToken:** `?ClientRefreshTokenConfiguration` 
    
</dd>
</dl>

<dl>
<dd>

**$defaultOrganization:** `?ClientDefaultOrganization` 
    
</dd>
</dl>

<dl>
<dd>

**$organizationUsage:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$organizationRequireBehavior:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$organizationDiscoveryMethods:** `?array` — Defines the available methods for organization discovery during the `pre_login_prompt`. Users can discover their organization either by `email`, `organization_name` or both.
    
</dd>
</dl>

<dl>
<dd>

**$clientAuthenticationMethods:** `?ClientAuthenticationMethod` 
    
</dd>
</dl>

<dl>
<dd>

**$requirePushedAuthorizationRequests:** `?bool` — Makes the use of Pushed Authorization Requests mandatory for this client
    
</dd>
</dl>

<dl>
<dd>

**$requireProofOfPossession:** `?bool` — Makes the use of Proof-of-Possession mandatory for this client
    
</dd>
</dl>

<dl>
<dd>

**$signedRequestObject:** `?ClientSignedRequestObjectWithCredentialId` 
    
</dd>
</dl>

<dl>
<dd>

**$complianceLevel:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$skipNonVerifiableCallbackUriConfirmationPrompt:** `?bool` 

Controls whether a confirmation prompt is shown during login flows when the redirect URI uses non-verifiable callback URIs (for example, a custom URI schema such as `myapp://`, or `localhost`).
If set to true, a confirmation prompt will not be shown. We recommend that this is set to false for improved protection from malicious apps.
See https://auth0.com/docs/secure/security-guidance/measures-against-app-impersonation for more information.
    
</dd>
</dl>

<dl>
<dd>

**$tokenExchange:** `?ClientTokenExchangeConfigurationOrNull` 
    
</dd>
</dl>

<dl>
<dd>

**$parRequestExpiry:** `?int` — Specifies how long, in seconds, a Pushed Authorization Request URI remains valid
    
</dd>
</dl>

<dl>
<dd>

**$expressConfiguration:** `?ExpressConfigurationOrNull` 
    
</dd>
</dl>

<dl>
<dd>

**$myOrganizationConfiguration:** `?ClientMyOrganizationPatchConfiguration` 
    
</dd>
</dl>

<dl>
<dd>

**$asyncApprovalNotificationChannels:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$thirdPartySecurityMode:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$redirectionPolicy:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;rotateSecret($id) -> ?RotateClientSecretResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Rotate a client secret.

This endpoint cannot be used with clients configured with Private Key JWT authentication method (client_authentication_methods configured with private_key_jwt). The generated secret is NOT base64 encoded.

For more information, read <a href="https://www.auth0.com/docs/get-started/applications/rotate-client-secret">Rotate Client Secrets</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->rotateSecret(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the client that will rotate secrets.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ConnectionProfiles
<details><summary><code>$client-&gt;connectionProfiles-&gt;list($request) -> ?ListConnectionProfilesPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of Connection Profiles. This endpoint supports Checkpoint pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connectionProfiles->list(
    new ListConnectionProfileRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 5.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connectionProfiles-&gt;create($request) -> ?CreateConnectionProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a Connection Profile.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connectionProfiles->create(
    new CreateConnectionProfileRequestContent([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$organization:** `?ConnectionProfileOrganization` 
    
</dd>
</dl>

<dl>
<dd>

**$connectionNamePrefixTemplate:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$enabledFeatures:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$connectionConfig:** `?ConnectionProfileConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$strategyOverrides:** `?ConnectionProfileStrategyOverrides` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connectionProfiles-&gt;listTemplates() -> ?ListConnectionProfileTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of Connection Profile Templates.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connectionProfiles->listTemplates();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connectionProfiles-&gt;getTemplate($id) -> ?GetConnectionProfileTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a Connection Profile Template.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connectionProfiles->getTemplate(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the connection-profile-template to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connectionProfiles-&gt;get($id) -> ?GetConnectionProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details about a single Connection Profile specified by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connectionProfiles->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the connection-profile to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connectionProfiles-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a single Connection Profile specified by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connectionProfiles->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the connection-profile to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connectionProfiles-&gt;update($id, $request) -> ?UpdateConnectionProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the details of a specific Connection Profile.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connectionProfiles->update(
    'id',
    new UpdateConnectionProfileRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the connection profile to update.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$organization:** `?ConnectionProfileOrganization` 
    
</dd>
</dl>

<dl>
<dd>

**$connectionNamePrefixTemplate:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$enabledFeatures:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$connectionConfig:** `?ConnectionProfileConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$strategyOverrides:** `?ConnectionProfileStrategyOverrides` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Connections
<details><summary><code>$client-&gt;connections-&gt;list($request) -> ?ListConnectionsCheckpointPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves detailed list of all [connections](https://auth0.com/docs/authenticate/identity-providers) that match the specified strategy. If no strategy is provided, all connections within your tenant are retrieved. This action can accept a list of fields to include or exclude from the resulting list of connections. 

This endpoint supports two types of pagination:

- Offset pagination
- Checkpoint pagination

Checkpoint pagination must be used if you need to retrieve more than 1000 connections.

**Checkpoint Pagination**

To search by checkpoint, use the following parameters:

- `from`: Optional id from which to start selection.
- `take`: The total amount of entries to retrieve when using the from parameter. Defaults to 50.

**Note**: The first time you call this endpoint using checkpoint pagination, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no pages are remaining.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->list(
    new ListConnectionsQueryParameters([
        'from' => 'from',
        'take' => 1,
        'strategy' => [
            ConnectionStrategyEnum::Ad->value,
        ],
        'name' => 'name',
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$strategy:** `?string` — Provide strategies to only retrieve connections with such strategies
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Provide the name of the connection to retrieve
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — A comma separated list of fields to include or exclude (depending on include_fields) from the result, empty to retrieve all fields
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — <code>true</code> if the fields specified are to be included in the result, <code>false</code> otherwise (defaults to <code>true</code>)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;create($request) -> ?CreateConnectionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a new connection according to the JSON object received in `body`.

**Note:** If a connection with the same name was recently deleted and had a large number of associated users, the deletion may still be processing. Creating a new connection with that name before the deletion completes may fail or produce unexpected results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->create(
    new CreateConnectionRequestContent([
        'name' => 'name',
        'strategy' => ConnectionIdentityProviderEnum::Ad->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — The name of the connection. Must start and end with an alphanumeric character and can only contain alphanumeric characters and '-'. Max length 128
    
</dd>
</dl>

<dl>
<dd>

**$displayName:** `?string` — Connection name used in the new universal login experience
    
</dd>
</dl>

<dl>
<dd>

**$strategy:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$options:** `?ConnectionPropertiesOptions` 
    
</dd>
</dl>

<dl>
<dd>

**$enabledClients:** `?array` — Use of this property is NOT RECOMMENDED. Use the PATCH /v2/connections/{id}/clients endpoint to enable the connection for a set of clients.
    
</dd>
</dl>

<dl>
<dd>

**$isDomainConnection:** `?bool` — <code>true</code> promotes to a domain-level connection so that third-party applications can use it. <code>false</code> does not promote the connection, so only first-party applications with the connection enabled can use it. (Defaults to <code>false</code>.)
    
</dd>
</dl>

<dl>
<dd>

**$showAsButton:** `?bool` — Enables showing a button for the connection in the login page (new experience only). If false, it will be usable only by HRD. (Defaults to <code>false</code>.)
    
</dd>
</dl>

<dl>
<dd>

**$realms:** `?array` — Defines the realms for which the connection will be used (ie: email domains). If the array is empty or the property is not specified, the connection name will be added as realm.
    
</dd>
</dl>

<dl>
<dd>

**$metadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$authentication:** `?ConnectionAuthenticationPurpose` 
    
</dd>
</dl>

<dl>
<dd>

**$connectedAccounts:** `?ConnectionConnectedAccountsPurpose` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;get($id, $request) -> ?GetConnectionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details for a specified [connection](https://auth0.com/docs/authenticate/identity-providers) along with options that can be used for identity provider configuration.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->get(
    'id',
    new GetConnectionRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to retrieve
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — A comma separated list of fields to include or exclude (depending on include_fields) from the result, empty to retrieve all fields
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — <code>true</code> if the fields specified are to be included in the result, <code>false</code> otherwise (defaults to <code>true</code>)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes a specific [connection](https://auth0.com/docs/authenticate/identity-providers) from your tenant. This action cannot be undone. Once removed, users can no longer use this connection to authenticate.

**Note:** If your connection has a large amount of users associated with it, please be aware that this operation can be long running after the response is returned and may impact concurrent [create connection](https://auth0.com/docs/api/management/v2/connections/post-connections) requests, if they use an identical connection name.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to delete
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;update($id, $request) -> ?UpdateConnectionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update details for a specific [connection](https://auth0.com/docs/authenticate/identity-providers), including option properties for identity provider configuration.

**Note**: If you use the `options` parameter, the entire `options` object is overridden. To avoid partial data or other issues, ensure all parameters are present when using this option.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->update(
    'id',
    new UpdateConnectionRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to update
    
</dd>
</dl>

<dl>
<dd>

**$displayName:** `?string` — The connection name used in the new universal login experience. If display_name is not included in the request, the field will be overwritten with the name value.
    
</dd>
</dl>

<dl>
<dd>

**$options:** `?UpdateConnectionOptions` 
    
</dd>
</dl>

<dl>
<dd>

**$enabledClients:** `?array` — DEPRECATED property. Use the PATCH /v2/connections/{id}/clients endpoint to enable or disable the connection for any clients.
    
</dd>
</dl>

<dl>
<dd>

**$isDomainConnection:** `?bool` — <code>true</code> promotes to a domain-level connection so that third-party applications can use it. <code>false</code> does not promote the connection, so only first-party applications with the connection enabled can use it. (Defaults to <code>false</code>.)
    
</dd>
</dl>

<dl>
<dd>

**$showAsButton:** `?bool` — Enables showing a button for the connection in the login page (new experience only). If false, it will be usable only by HRD. (Defaults to <code>false</code>.)
    
</dd>
</dl>

<dl>
<dd>

**$realms:** `?array` — Defines the realms for which the connection will be used (ie: email domains). If the array is empty or the property is not specified, the connection name will be added as realm.
    
</dd>
</dl>

<dl>
<dd>

**$metadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$authentication:** `?ConnectionAuthenticationPurpose` 
    
</dd>
</dl>

<dl>
<dd>

**$connectedAccounts:** `?ConnectionConnectedAccountsPurpose` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;checkStatus($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the status of an ad/ldap connection referenced by its `ID`. `200 OK` http status code response is returned  when the connection is online, otherwise a `404` status code is returned along with an error message
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->checkStatus(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the connection to check
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## CustomDomains
<details><summary><code>$client-&gt;customDomains-&gt;list($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details on [custom domains](https://auth0.com/docs/custom-domains).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customDomains->list(
    new ListCustomDomainsRequestParameters([
        'q' => 'q',
        'fields' => 'fields',
        'includeFields' => true,
        'sort' => 'sort',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$q:** `?string` — Query in <a href ="https://lucene.apache.org/core/2_9_4/queryparsersyntax.html">Lucene query string syntax</a>.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?string` — Field to sort by. Only <code>domain:1</code> (ascending order by domain) is supported at this time.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customDomains-&gt;create($request) -> ?CreateCustomDomainResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new custom domain.

Note: The custom domain will need to be verified before it will accept
requests.

Optional attributes that can be updated:

- custom_client_ip_header
- tls_policy

TLS Policies:

- recommended - for modern usage this includes TLS 1.2 only
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customDomains->create(
    new CreateCustomDomainRequestContent([
        'domain' => 'domain',
        'type' => CustomDomainProvisioningTypeEnum::Auth0ManagedCerts->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$domain:** `string` — Domain name.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$verificationMethod:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$tlsPolicy:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$customClientIpHeader:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$domainMetadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$relyingPartyIdentifier:** `?string` — Relying Party ID (rpId) to be used for Passkeys on this custom domain. If not provided, the full domain will be used.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customDomains-&gt;getDefault() -> GetDefaultCustomDomainResponseContent|GetDefaultCanonicalDomainResponseContent|null</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the tenant's default domain.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customDomains->getDefault();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customDomains-&gt;setDefault($request) -> UpdateDefaultCustomDomainResponseContent|UpdateDefaultCanonicalDomainResponseContent|null</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Set the default custom domain for the tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customDomains->setDefault(
    new SetDefaultCustomDomainRequestContent([
        'domain' => 'domain',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$domain:** `string` — The domain to set as the default custom domain. Must be a verified custom domain or the canonical domain.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customDomains-&gt;get($id) -> ?GetCustomDomainResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a custom domain configuration and status.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customDomains->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the custom domain to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customDomains-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a custom domain and stop serving requests for it.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customDomains->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the custom domain to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customDomains-&gt;update($id, $request) -> ?UpdateCustomDomainResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a custom domain.

These are the attributes that can be updated:

- custom_client_ip_header
- tls_policy

**Updating CUSTOM_CLIENT_IP_HEADER for a custom domain**

To update the `custom_client_ip_header` for a domain, the body to
send should be:

```json
{ "custom_client_ip_header": "cf-connecting-ip" }
```

**Updating TLS_POLICY for a custom domain**

To update the `tls_policy` for a domain, the body to send should be:

```json
{ "tls_policy": "recommended" }
```

TLS Policies:

- recommended - for modern usage this includes TLS 1.2 only

Some considerations:

- The TLS ciphers and protocols available in each TLS policy follow industry recommendations, and may be updated occasionally.
- The `compatible` TLS policy is no longer supported.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customDomains->update(
    'id',
    new UpdateCustomDomainRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the custom domain to update
    
</dd>
</dl>

<dl>
<dd>

**$tlsPolicy:** `?string` — recommended includes TLS 1.2
    
</dd>
</dl>

<dl>
<dd>

**$customClientIpHeader:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$domainMetadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$relyingPartyIdentifier:** `?string` — Relying Party ID (rpId) to be used for Passkeys on this custom domain. Set to null to remove the rpId and fall back to using the full domain.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customDomains-&gt;test($id) -> ?TestCustomDomainResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Run the test process on a custom domain.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customDomains->test(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the custom domain to test.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customDomains-&gt;verify($id) -> ?VerifyCustomDomainResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Run the verification process on a custom domain.

Note: Check the `status` field to see its verification status. Once verification is complete, it may take up to 10 minutes before the custom domain can start accepting requests.

For `self_managed_certs`, when the custom domain is verified for the first time, the response will also include the `cname_api_key` which you will need to configure your proxy. This key must be kept secret, and is used to validate the proxy requests.

[Learn more](https://auth0.com/docs/custom-domains#step-2-verify-ownership) about verifying custom domains that use Auth0 Managed certificates.
[Learn more](https://auth0.com/docs/custom-domains/self-managed-certificates#step-2-verify-ownership) about verifying custom domains that use Self Managed certificates.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customDomains->verify(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the custom domain to verify.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## DeviceCredentials
<details><summary><code>$client-&gt;deviceCredentials-&gt;list($request) -> ?ListDeviceCredentialsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve device credential information (<code>public_key</code>, <code>refresh_token</code>, or <code>rotating_refresh_token</code>) associated with a specific user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->deviceCredentials->list(
    new ListDeviceCredentialsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'fields' => 'fields',
        'includeFields' => true,
        'userId' => 'user_id',
        'clientId' => 'client_id',
        'type' => DeviceCredentialTypeEnum::PublicKey->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page.  There is a maximum of 1000 results allowed from this endpoint.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `?string` — user_id of the devices to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — client_id of the devices to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?string` — Type of credentials to retrieve. Must be `public_key`, `refresh_token` or `rotating_refresh_token`. The property will default to `refresh_token` when paging is requested
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;deviceCredentials-&gt;createPublicKey($request) -> ?CreatePublicKeyDeviceCredentialResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a device credential public key to manage refresh token rotation for a given <code>user_id</code>. Device Credentials APIs are designed for ad-hoc administrative use only and paging is by default enabled for GET requests.

When refresh token rotation is enabled, the endpoint becomes consistent. For more information, read <a href="https://auth0.com/docs/get-started/tenant-settings/signing-keys"> Signing Keys</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->deviceCredentials->createPublicKey(
    new CreatePublicKeyDeviceCredentialRequestContent([
        'deviceName' => 'device_name',
        'type' => DeviceCredentialPublicKeyTypeEnum::PublicKey->value,
        'value' => 'value',
        'deviceId' => 'device_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$deviceName:** `string` — Name for this device easily recognized by owner.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$value:** `string` — Base64 encoded string containing the credential.
    
</dd>
</dl>

<dl>
<dd>

**$deviceId:** `string` — Unique identifier for the device. Recommend using <a href="http://developer.android.com/reference/android/provider/Settings.Secure.html#ANDROID_ID">Android_ID</a> on Android and <a href="https://developer.apple.com/library/ios/documentation/UIKit/Reference/UIDevice_Class/index.html#//apple_ref/occ/instp/UIDevice/identifierForVendor">identifierForVendor</a>.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — client_id of the client (application) this credential is for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;deviceCredentials-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Permanently delete a device credential (such as a refresh token or public key) with the given ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->deviceCredentials->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the credential to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## EmailTemplates
<details><summary><code>$client-&gt;emailTemplates-&gt;create($request) -> ?CreateEmailTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create an email template.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->emailTemplates->create(
    new CreateEmailTemplateRequestContent([
        'template' => EmailTemplateNameEnum::VerifyEmail->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$template:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$body:** `?string` — Body of the email template.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Senders `from` email address.
    
</dd>
</dl>

<dl>
<dd>

**$resultUrl:** `?string` — URL to redirect the user to after a successful action.
    
</dd>
</dl>

<dl>
<dd>

**$subject:** `?string` — Subject line of the email.
    
</dd>
</dl>

<dl>
<dd>

**$syntax:** `?string` — Syntax of the template body.
    
</dd>
</dl>

<dl>
<dd>

**$urlLifetimeInSeconds:** `?float` — Lifetime in seconds that the link within the email will be valid for.
    
</dd>
</dl>

<dl>
<dd>

**$includeEmailInRedirect:** `?bool` — Whether the `reset_email` and `verify_email` templates should include the user's email address as the `email` parameter in the returnUrl (true) or whether no email address should be included in the redirect (false). Defaults to true.
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Whether the template is enabled (true) or disabled (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;emailTemplates-&gt;get($templateName) -> ?GetEmailTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve an email template by pre-defined name. These names are `verify_email`, `verify_email_by_code`, `reset_email`, `reset_email_by_code`, `welcome_email`, `blocked_account`, `stolen_credentials`, `enrollment_email`, `mfa_oob_code`, `user_invitation`, and `async_approval`. The names `change_password`, and `password_reset` are also supported for legacy scenarios.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->emailTemplates->get(
    EmailTemplateNameEnum::VerifyEmail->value,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateName:** `string` — Template name. Can be `verify_email`, `verify_email_by_code`, `reset_email`, `reset_email_by_code`, `welcome_email`, `blocked_account`, `stolen_credentials`, `enrollment_email`, `mfa_oob_code`, `user_invitation`, `async_approval`, `change_password` (legacy), or `password_reset` (legacy).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;emailTemplates-&gt;set($templateName, $request) -> ?SetEmailTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update an email template.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->emailTemplates->set(
    EmailTemplateNameEnum::VerifyEmail->value,
    new SetEmailTemplateRequestContent([
        'template' => EmailTemplateNameEnum::VerifyEmail->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateName:** `string` — Template name. Can be `verify_email`, `verify_email_by_code`, `reset_email`, `reset_email_by_code`, `welcome_email`, `blocked_account`, `stolen_credentials`, `enrollment_email`, `mfa_oob_code`, `user_invitation`, `async_approval`, `change_password` (legacy), or `password_reset` (legacy).
    
</dd>
</dl>

<dl>
<dd>

**$template:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$body:** `?string` — Body of the email template.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Senders `from` email address.
    
</dd>
</dl>

<dl>
<dd>

**$resultUrl:** `?string` — URL to redirect the user to after a successful action.
    
</dd>
</dl>

<dl>
<dd>

**$subject:** `?string` — Subject line of the email.
    
</dd>
</dl>

<dl>
<dd>

**$syntax:** `?string` — Syntax of the template body.
    
</dd>
</dl>

<dl>
<dd>

**$urlLifetimeInSeconds:** `?float` — Lifetime in seconds that the link within the email will be valid for.
    
</dd>
</dl>

<dl>
<dd>

**$includeEmailInRedirect:** `?bool` — Whether the `reset_email` and `verify_email` templates should include the user's email address as the `email` parameter in the returnUrl (true) or whether no email address should be included in the redirect (false). Defaults to true.
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Whether the template is enabled (true) or disabled (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;emailTemplates-&gt;update($templateName, $request) -> ?UpdateEmailTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Modify an email template.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->emailTemplates->update(
    EmailTemplateNameEnum::VerifyEmail->value,
    new UpdateEmailTemplateRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateName:** `string` — Template name. Can be `verify_email`, `verify_email_by_code`, `reset_email`, `reset_email_by_code`, `welcome_email`, `blocked_account`, `stolen_credentials`, `enrollment_email`, `mfa_oob_code`, `user_invitation`, `async_approval`, `change_password` (legacy), or `password_reset` (legacy).
    
</dd>
</dl>

<dl>
<dd>

**$template:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$body:** `?string` — Body of the email template.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Senders `from` email address.
    
</dd>
</dl>

<dl>
<dd>

**$resultUrl:** `?string` — URL to redirect the user to after a successful action.
    
</dd>
</dl>

<dl>
<dd>

**$subject:** `?string` — Subject line of the email.
    
</dd>
</dl>

<dl>
<dd>

**$syntax:** `?string` — Syntax of the template body.
    
</dd>
</dl>

<dl>
<dd>

**$urlLifetimeInSeconds:** `?float` — Lifetime in seconds that the link within the email will be valid for.
    
</dd>
</dl>

<dl>
<dd>

**$includeEmailInRedirect:** `?bool` — Whether the `reset_email` and `verify_email` templates should include the user's email address as the `email` parameter in the returnUrl (true) or whether no email address should be included in the redirect (false). Defaults to true.
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Whether the template is enabled (true) or disabled (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## EventStreams
<details><summary><code>$client-&gt;eventStreams-&gt;list($request) -> ?ListEventStreamsResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->eventStreams->list(
    new ListEventStreamsRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;eventStreams-&gt;create($request) -> EventStreamWebhookResponseContent|EventStreamEventBridgeResponseContent|EventStreamActionResponseContent|null</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->eventStreams->create(
    new CreateEventStreamWebHookRequestContent([
        'destination' => new EventStreamWebhookDestination([
            'type' => EventStreamWebhookDestinationTypeEnum::Webhook->value,
            'configuration' => new EventStreamWebhookConfiguration([
                'webhookEndpoint' => 'webhook_endpoint',
                'webhookAuthorization' => new EventStreamWebhookBasicAuth([
                    'method' => EventStreamWebhookBasicAuthMethodEnum::Basic->value,
                    'username' => 'username',
                ]),
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `CreateEventStreamWebHookRequestContent|CreateEventStreamEventBridgeRequestContent|CreateEventStreamActionRequestContent` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;eventStreams-&gt;get($id) -> EventStreamWebhookResponseContent|EventStreamEventBridgeResponseContent|EventStreamActionResponseContent|null</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->eventStreams->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the event stream.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;eventStreams-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->eventStreams->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the event stream.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;eventStreams-&gt;update($id, $request) -> EventStreamWebhookResponseContent|EventStreamEventBridgeResponseContent|EventStreamActionResponseContent|null</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->eventStreams->update(
    'id',
    new UpdateEventStreamRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the event stream.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Name of the event stream.
    
</dd>
</dl>

<dl>
<dd>

**$subscriptions:** `?array` — List of event types subscribed to in this stream.
    
</dd>
</dl>

<dl>
<dd>

**$destination:** `EventStreamWebhookDestination|EventStreamActionDestination|null` 
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;eventStreams-&gt;test($id, $request) -> ?CreateEventStreamTestEventResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->eventStreams->test(
    'id',
    new CreateEventStreamTestEventRequestContent([
        'eventType' => EventStreamTestEventTypeEnum::GroupCreated->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the event stream.
    
</dd>
</dl>

<dl>
<dd>

**$eventType:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$data:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Events
<details><summary><code>$client-&gt;events-&gt;subscribe($request) -> SseStream</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Subscribe to events via Server-Sent Events (SSE)
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->events->subscribe(
    new SubscribeEventsRequestParameters([
        'from' => 'from',
        'fromTimestamp' => 'from_timestamp',
        'eventType' => [
            EventStreamSubscribeEventsEventTypeEnum::GroupCreated->value,
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Opaque token representing position in the stream. If not provided, stream will start from the latest events.
    
</dd>
</dl>

<dl>
<dd>

**$fromTimestamp:** `?string` — RFC-3339 timestamp indicating where to start streaming events from. This should only be used on the initial query when a cursor may not be available. Subsequent requests should use the cursor (from) as it will be more accurate.
    
</dd>
</dl>

<dl>
<dd>

**$eventType:** `?string` — Event type(s) to listen for. Specify multiple times for multiple types (e.g., ?event_type=user.created&event_type=user.updated). If not provided, all event types will be streamed.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Flows
<details><summary><code>$client-&gt;flows-&gt;list($request) -> ?ListFlowsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->list(
    new ListFlowsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'hydrate' => [
            ListFlowsRequestParametersHydrateEnum::FormCount->value,
        ],
        'synchronous' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$hydrate:** `?string` — hydration param
    
</dd>
</dl>

<dl>
<dd>

**$synchronous:** `?bool` — flag to filter by sync/async flows
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;create($request) -> ?CreateFlowResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->create(
    new CreateFlowRequestContent([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$actions:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;get($id, $request) -> ?GetFlowResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->get(
    'id',
    new GetFlowRequestParameters([
        'hydrate' => [
            GetFlowRequestParametersHydrateEnum::FormCount->value,
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Flow identifier
    
</dd>
</dl>

<dl>
<dd>

**$hydrate:** `?string` — hydration param
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Flow id
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;update($id, $request) -> ?UpdateFlowResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->update(
    'id',
    new UpdateFlowRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Flow identifier
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$actions:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Forms
<details><summary><code>$client-&gt;forms-&gt;list($request) -> ?ListFormsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->forms->list(
    new ListFormsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'hydrate' => [
            FormsRequestParametersHydrateEnum::FlowCount->value,
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$hydrate:** `?string` — Query parameter to hydrate the response with additional data
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;forms-&gt;create($request) -> ?CreateFormResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->forms->create(
    new CreateFormRequestContent([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$messages:** `?FormMessages` 
    
</dd>
</dl>

<dl>
<dd>

**$languages:** `?FormLanguages` 
    
</dd>
</dl>

<dl>
<dd>

**$translations:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$nodes:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$start:** `?FormStartNode` 
    
</dd>
</dl>

<dl>
<dd>

**$ending:** `?FormEndingNode` 
    
</dd>
</dl>

<dl>
<dd>

**$style:** `?FormStyle` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;forms-&gt;get($id, $request) -> ?GetFormResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->forms->get(
    'id',
    new GetFormRequestParameters([
        'hydrate' => [
            FormsRequestParametersHydrateEnum::FlowCount->value,
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the form to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$hydrate:** `?string` — Query parameter to hydrate the response with additional data
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;forms-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->forms->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the form to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;forms-&gt;update($id, $request) -> ?UpdateFormResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->forms->update(
    'id',
    new UpdateFormRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the form to update.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$messages:** `?FormMessages` 
    
</dd>
</dl>

<dl>
<dd>

**$languages:** `?FormLanguages` 
    
</dd>
</dl>

<dl>
<dd>

**$translations:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$nodes:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$start:** `?FormStartNode` 
    
</dd>
</dl>

<dl>
<dd>

**$ending:** `?FormEndingNode` 
    
</dd>
</dl>

<dl>
<dd>

**$style:** `?FormStyle` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## UserGrants
<details><summary><code>$client-&gt;userGrants-&gt;list($request) -> ?ListUserGrantsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the <a href="https://auth0.com/docs/api-auth/which-oauth-flow-to-use">grants</a> associated with your account. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userGrants->list(
    new ListUserGrantsRequestParameters([
        'perPage' => 1,
        'page' => 1,
        'includeTotals' => true,
        'userId' => 'user_id',
        'clientId' => 'client_id',
        'audience' => 'audience',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `?string` — user_id of the grants to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — client_id of the grants to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$audience:** `?string` — audience of the grants to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userGrants-&gt;deleteByUserId($request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a grant associated with your account. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userGrants->deleteByUserId(
    new DeleteUserGrantByUserIdRequestParameters([
        'userId' => 'user_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `string` — user_id of the grant to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userGrants-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a grant associated with your account. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userGrants->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the grant to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Groups
<details><summary><code>$client-&gt;groups-&gt;list($request) -> ?ListGroupsPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List all groups in your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->groups->list(
    new ListGroupsRequestParameters([
        'connectionId' => 'connection_id',
        'name' => 'name',
        'externalId' => 'external_id',
        'search' => 'search',
        'fields' => 'fields',
        'includeFields' => true,
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$connectionId:** `?string` — Filter groups by connection ID.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Filter groups by name.
    
</dd>
</dl>

<dl>
<dd>

**$externalId:** `?string` — Filter groups by external ID.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Search for groups by name or external ID.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — A comma separated list of fields to include or exclude (depending on include_fields) from the result, empty to retrieve all fields
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;groups-&gt;get($id) -> ?GetGroupResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a group by its ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->groups->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the group (service-generated).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;groups-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a group by its ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->groups->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the group (service-generated).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Hooks
<details><summary><code>$client-&gt;hooks-&gt;list($request) -> ?ListHooksOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve all [hooks](https://auth0.com/docs/hooks). Accepts a list of fields to include or exclude in the result.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hooks->list(
    new ListHooksRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'enabled' => true,
        'fields' => 'fields',
        'triggerId' => HookTriggerIdEnum::CredentialsExchange->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Optional filter on whether a hook is enabled (true) or disabled (false).
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$triggerId:** `?string` — Retrieves hooks that match the trigger
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;hooks-&gt;create($request) -> ?CreateHookResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new hook.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hooks->create(
    new CreateHookRequestContent([
        'name' => 'name',
        'script' => 'script',
        'triggerId' => HookTriggerIdEnum::CredentialsExchange->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — Name of this hook.
    
</dd>
</dl>

<dl>
<dd>

**$script:** `string` — Code to be executed when this hook runs.
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Whether this hook will be executed (true) or ignored (false).
    
</dd>
</dl>

<dl>
<dd>

**$dependencies:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$triggerId:** `string` — Execution stage of this rule. Can be `credentials-exchange`, `pre-user-registration`, `post-user-registration`, `post-change-password`, or `send-phone-message`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;hooks-&gt;get($id, $request) -> ?GetHookResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve [a hook](https://auth0.com/docs/hooks) by its ID. Accepts a list of fields to include in the result.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hooks->get(
    'id',
    new GetHookRequestParameters([
        'fields' => 'fields',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the hook to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;hooks-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a hook.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hooks->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the hook to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;hooks-&gt;update($id, $request) -> ?UpdateHookResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update an existing hook.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hooks->update(
    'id',
    new UpdateHookRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the hook to update.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Name of this hook.
    
</dd>
</dl>

<dl>
<dd>

**$script:** `?string` — Code to be executed when this hook runs.
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Whether this hook will be executed (true) or ignored (false).
    
</dd>
</dl>

<dl>
<dd>

**$dependencies:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Jobs
<details><summary><code>$client-&gt;jobs-&gt;get($id) -> ?GetJobResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a job. Useful to check its status.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->jobs->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the job.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## LogStreams
<details><summary><code>$client-&gt;logStreams-&gt;list() -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details on [log streams](https://auth0.com/docs/logs/streams).

**Sample Response**

```json
[{
  "id": "string",
  "name": "string",
  "type": "eventbridge",
  "status": "active|paused|suspended",
  "sink": {
    "awsAccountId": "string",
    "awsRegion": "string",
    "awsPartnerEventSource": "string"
  }
}, {
  "id": "string",
  "name": "string",
  "type": "http",
  "status": "active|paused|suspended",
  "sink": {
    "httpContentFormat": "JSONLINES|JSONARRAY",
    "httpContentType": "string",
    "httpEndpoint": "string",
    "httpAuthorization": "string"
  }
},
{
  "id": "string",
  "name": "string",
  "type": "eventgrid",
  "status": "active|paused|suspended",
  "sink": {
    "azureSubscriptionId": "string",
    "azureResourceGroup": "string",
    "azureRegion": "string",
    "azurePartnerTopic": "string"
  }
},
{
  "id": "string",
  "name": "string",
  "type": "splunk",
  "status": "active|paused|suspended",
  "sink": {
    "splunkDomain": "string",
    "splunkToken": "string",
    "splunkPort": "string",
    "splunkSecure": "boolean"
  }
},
{
  "id": "string",
  "name": "string",
  "type": "sumo",
  "status": "active|paused|suspended",
  "sink": {
    "sumoSourceAddress": "string"
  }
},
{
  "id": "string",
  "name": "string",
  "type": "datadog",
  "status": "active|paused|suspended",
  "sink": {
    "datadogRegion": "string",
    "datadogApiKey": "string"
  }
}]
```
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->logStreams->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;logStreams-&gt;create($request) -> LogStreamHttpResponseSchema|LogStreamEventBridgeResponseSchema|LogStreamEventGridResponseSchema|LogStreamDatadogResponseSchema|LogStreamSplunkResponseSchema|LogStreamSumoResponseSchema|LogStreamSegmentResponseSchema|LogStreamMixpanelResponseSchema|null</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a log stream.

**Log Stream Types**

The `type` of log stream being created determines the properties required in the `sink` payload.

**HTTP Stream**

For an `http` Stream, the `sink` properties are listed in the payload below.

**Request:**
```json
{
  "name": "string",
  "type": "http",
  "sink": {
    "httpEndpoint": "string",
    "httpContentType": "string",
    "httpContentFormat": "JSONLINES|JSONARRAY",
    "httpAuthorization": "string"
  }
}
```

**Response:**
```json
{
  "id": "string",
  "name": "string",
  "type": "http",
  "status": "active",
  "sink": {
    "httpEndpoint": "string",
    "httpContentType": "string",
    "httpContentFormat": "JSONLINES|JSONARRAY",
    "httpAuthorization": "string"
  }
}
```

**Amazon EventBridge Stream**

For an `eventbridge` Stream, the `sink` properties are listed in the payload below.

**Request:**
```json
{
  "name": "string",
  "type": "eventbridge",
  "sink": {
    "awsRegion": "string",
    "awsAccountId": "string"
  }
}
```

The response will include an additional field `awsPartnerEventSource` in the `sink`:

**Response:**
```json
{
  "id": "string",
  "name": "string",
  "type": "eventbridge",
  "status": "active",
  "sink": {
    "awsAccountId": "string",
    "awsRegion": "string",
    "awsPartnerEventSource": "string"
  }
}
```

**Azure Event Grid Stream**

For an `Azure Event Grid` Stream, the `sink` properties are listed in the payload below.

**Request:**
```json
{
  "name": "string",
  "type": "eventgrid",
  "sink": {
    "azureSubscriptionId": "string",
    "azureResourceGroup": "string",
    "azureRegion": "string"
  }
}
```

**Response:**
```json
{
  "id": "string",
  "name": "string",
  "type": "http",
  "status": "active",
  "sink": {
    "azureSubscriptionId": "string",
    "azureResourceGroup": "string",
    "azureRegion": "string",
    "azurePartnerTopic": "string"
  }
}
```

**Datadog Stream**

For a `Datadog` Stream, the `sink` properties are listed in the payload below.

**Request:**
```json
{
  "name": "string",
  "type": "datadog",
  "sink": {
    "datadogRegion": "string",
    "datadogApiKey": "string"
  }
}
```

**Response:**
```json
{
  "id": "string",
  "name": "string",
  "type": "datadog",
  "status": "active",
  "sink": {
    "datadogRegion": "string",
    "datadogApiKey": "string"
  }
}
```

**Splunk Stream**

For a `Splunk` Stream, the `sink` properties are listed in the payload below.

**Request:**
```json
{
  "name": "string",
  "type": "splunk",
  "sink": {
    "splunkDomain": "string",
    "splunkToken": "string",
    "splunkPort": "string",
    "splunkSecure": "boolean"
  }
}
```

**Response:**
```json
{
  "id": "string",
  "name": "string",
  "type": "splunk",
  "status": "active",
  "sink": {
    "splunkDomain": "string",
    "splunkToken": "string",
    "splunkPort": "string",
    "splunkSecure": "boolean"
  }
}
```

**Sumo Logic Stream**

For a `Sumo Logic` Stream, the `sink` properties are listed in the payload below.

**Request:**
```json
{
  "name": "string",
  "type": "sumo",
  "sink": {
    "sumoSourceAddress": "string"
  }
}
```

**Response:**
```json
{
  "id": "string",
  "name": "string",
  "type": "sumo",
  "status": "active",
  "sink": {
    "sumoSourceAddress": "string"
  }
}
```
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->logStreams->create(
    new CreateLogStreamHttpRequestBody([
        'type' => LogStreamHttpEnum::Http->value,
        'sink' => new LogStreamHttpSink([
            'httpEndpoint' => 'httpEndpoint',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `CreateLogStreamHttpRequestBody|CreateLogStreamEventBridgeRequestBody|CreateLogStreamEventGridRequestBody|CreateLogStreamDatadogRequestBody|CreateLogStreamSplunkRequestBody|CreateLogStreamSumoRequestBody|CreateLogStreamSegmentRequestBody|CreateLogStreamMixpanelRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;logStreams-&gt;get($id) -> LogStreamHttpResponseSchema|LogStreamEventBridgeResponseSchema|LogStreamEventGridResponseSchema|LogStreamDatadogResponseSchema|LogStreamSplunkResponseSchema|LogStreamSumoResponseSchema|LogStreamSegmentResponseSchema|LogStreamMixpanelResponseSchema|null</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a log stream configuration and status.

**Sample responses**

**Amazon EventBridge Log Stream**

```json
{
  "id": "string",
  "name": "string",
  "type": "eventbridge",
  "status": "active|paused|suspended",
  "sink": {
    "awsAccountId": "string",
    "awsRegion": "string",
    "awsPartnerEventSource": "string"
  }
}
```

**HTTP Log Stream**

```json
{
  "id": "string",
  "name": "string",
  "type": "http",
  "status": "active|paused|suspended",
  "sink": {
    "httpContentFormat": "JSONLINES|JSONARRAY",
    "httpContentType": "string",
    "httpEndpoint": "string",
    "httpAuthorization": "string"
  }
}
```

**Datadog Log Stream**

```json
{
  "id": "string",
  "name": "string",
  "type": "datadog",
  "status": "active|paused|suspended",
  "sink": {
    "datadogRegion": "string",
    "datadogApiKey": "string"
  }
}
```

**Mixpanel**

**Request:**

```json
{
  "name": "string",
  "type": "mixpanel",
  "sink": {
    "mixpanelRegion": "string",
    "mixpanelProjectId": "string",
    "mixpanelServiceAccountUsername": "string",
    "mixpanelServiceAccountPassword": "string"
  }
}
```

**Response:**

```json
{
  "id": "string",
  "name": "string",
  "type": "mixpanel",
  "status": "active",
  "sink": {
    "mixpanelRegion": "string",
    "mixpanelProjectId": "string",
    "mixpanelServiceAccountUsername": "string",
    "mixpanelServiceAccountPassword": "string"
  }
}
```

**Segment**

**Request:**

```json
{
  "name": "string",
  "type": "segment",
  "sink": {
    "segmentWriteKey": "string"
  }
}
```

**Response:**

```json
{
  "id": "string",
  "name": "string",
  "type": "segment",
  "status": "active",
  "sink": {
    "segmentWriteKey": "string"
  }
}
```

**Splunk Log Stream**

```json
{
  "id": "string",
  "name": "string",
  "type": "splunk",
  "status": "active|paused|suspended",
  "sink": {
    "splunkDomain": "string",
    "splunkToken": "string",
    "splunkPort": "string",
    "splunkSecure": "boolean"
  }
}
```

**Sumo Logic Log Stream**

```json
{
  "id": "string",
  "name": "string",
  "type": "sumo",
  "status": "active|paused|suspended",
  "sink": {
    "sumoSourceAddress": "string"
  }
}
```

**Status**

The `status` of a log stream maybe any of the following:

1. `active` - Stream is currently enabled.
2. `paused` - Stream is currently user disabled and will not attempt log delivery.
3. `suspended` - Stream is currently disabled because of errors and will not attempt log delivery.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->logStreams->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the log stream to get
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;logStreams-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a log stream.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->logStreams->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the log stream to delete
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;logStreams-&gt;update($id, $request) -> LogStreamHttpResponseSchema|LogStreamEventBridgeResponseSchema|LogStreamEventGridResponseSchema|LogStreamDatadogResponseSchema|LogStreamSplunkResponseSchema|LogStreamSumoResponseSchema|LogStreamSegmentResponseSchema|LogStreamMixpanelResponseSchema|null</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a log stream.

**Examples of how to use the PATCH endpoint.**

The following fields may be updated in a PATCH operation:

- name
- status
- sink

Note: For log streams of type `eventbridge` and `eventgrid`, updating the `sink` is not permitted.

**Update the status of a log stream**

```json
{
  "status": "active|paused"
}
```

**Update the name of a log stream**

```json
{
  "name": "string"
}
```

**Update the sink properties of a stream of type `http`**

```json
{
  "sink": {
    "httpEndpoint": "string",
    "httpContentType": "string",
    "httpContentFormat": "JSONARRAY|JSONLINES",
    "httpAuthorization": "string"
  }
}
```

**Update the sink properties of a stream of type `datadog`**

```json
{
  "sink": {
    "datadogRegion": "string",
    "datadogApiKey": "string"
  }
}
```

**Update the sink properties of a stream of type `splunk`**

```json
{
  "sink": {
    "splunkDomain": "string",
    "splunkToken": "string",
    "splunkPort": "string",
    "splunkSecure": "boolean"
  }
}
```

**Update the sink properties of a stream of type `sumo`**

```json
{
  "sink": {
    "sumoSourceAddress": "string"
  }
}
```
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->logStreams->update(
    'id',
    new UpdateLogStreamRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the log stream to get
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — log stream name
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$isPriority:** `?bool` — True for priority log streams, false for non-priority
    
</dd>
</dl>

<dl>
<dd>

**$filters:** `?array` — Only logs events matching these filters will be delivered by the stream. If omitted or empty, all events will be delivered.
    
</dd>
</dl>

<dl>
<dd>

**$piiConfig:** `?LogStreamPiiConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$sink:** `LogStreamHttpSink|LogStreamDatadogSink|LogStreamSplunkSink|LogStreamSumoSink|LogStreamSegmentSink|LogStreamMixpanelSinkPatch|null` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Logs
<details><summary><code>$client-&gt;logs-&gt;list($request) -> ?ListLogOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve log entries that match the specified search criteria (or all log entries if no criteria specified).

Set custom search criteria using the `q` parameter, or search from a specific log ID (_"search from checkpoint"_).

For more information on all possible event types, their respective acronyms, and descriptions, see [Log Event Type Codes](https://auth0.com/docs/logs/log-event-type-codes).

**To set custom search criteria, use the following parameters:**

- **q:** Search Criteria using [Query String Syntax](https://auth0.com/docs/logs/log-search-query-syntax)
- **page:** Page index of the results to return. First page is 0.
- **per_page:** Number of results per page.
- **sort:** Field to use for sorting appended with `:1` for ascending and `:-1` for descending. e.g. `date:-1`
- **fields:** Comma-separated list of fields to include or exclude (depending on include_fields) from the result, empty to retrieve all fields.
- **include_fields:** Whether specified fields are to be included (true) or excluded (false).
- **include_totals:** Return results inside an object that contains the total result count (true) or as a direct array of results (false, default). **Deprecated:** this field is deprecated and should be removed from use. See [Search Engine V3 Breaking Changes](https://auth0.com/docs/product-lifecycle/deprecations-and-migrations/migrate-to-tenant-log-search-v3#pagination)

For more information on the list of fields that can be used in `fields` and `sort`, see [Searchable Fields](https://auth0.com/docs/logs/log-search-query-syntax#searchable-fields).

Auth0 [limits the number of logs](https://auth0.com/docs/logs/retrieve-log-events-using-mgmt-api#limitations) you can return by search criteria to 100 logs per request. Furthermore, you may paginate only through 1,000 search results. If you exceed this threshold, please redefine your search or use the [get logs by checkpoint method](https://auth0.com/docs/logs/retrieve-log-events-using-mgmt-api#retrieve-logs-by-checkpoint).

**To search from a checkpoint log ID, use the following parameters:**

- **from:** Log Event ID from which to start retrieving logs. You can limit the number of logs returned using the `take` parameter. If you use `from` at the same time as `q`, `from` takes precedence and `q` is ignored.
- **take:** Number of entries to retrieve when using the `from` parameter.

**Important:** When fetching logs from a checkpoint log ID, any parameter other than `from` and `take` will be ignored, and date ordering is not guaranteed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->logs->list(
    new ListLogsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'sort' => 'sort',
        'fields' => 'fields',
        'includeFields' => true,
        'includeTotals' => true,
        'search' => 'search',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` —  Number of results per page. Paging is disabled if parameter not sent. Default: <code>50</code>. Max value: <code>100</code>
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?string` — Field to use for sorting appended with <code>:1</code>  for ascending and <code>:-1</code> for descending. e.g. <code>date:-1</code>
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for <code>include_fields</code>) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (<code>true</code>) or excluded (<code>false</code>)
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results as an array when false (default). Return results inside an object that also contains a total result count when true.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` 

Retrieves logs that match the specified search criteria. This parameter can be combined with all the others in the /api/logs endpoint but is specified separately for clarity.
If no fields are provided a case insensitive 'starts with' search is performed on all of the following fields: client_name, connection, user_name. Otherwise, you can specify multiple fields and specify the search using the %field%:%search%, for example: application:node user:"John@contoso.com".
Values specified without quotes are matched using a case insensitive 'starts with' search. If quotes are used a case insensitve exact search is used. If multiple fields are used, the AND operator is used to join the clauses.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;logs-&gt;get($id) -> ?GetLogResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve an individual log event.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->logs->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — log_id of the log to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## NetworkAcls
<details><summary><code>$client-&gt;networkAcls-&gt;list($request) -> ?ListNetworkAclsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get all access control list entries for your client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->networkAcls->list(
    new ListNetworkAclsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Use this field to request a specific page of the list results.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — The amount of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;networkAcls-&gt;create($request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new access control list for your client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->networkAcls->create(
    new CreateNetworkAclRequestContent([
        'description' => 'description',
        'active' => true,
        'rule' => new NetworkAclRule([
            'action' => new NetworkAclAction([]),
            'scope' => NetworkAclRuleScopeEnum::Management->value,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$description:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$active:** `bool` — Indicates whether or not this access control list is actively being used
    
</dd>
</dl>

<dl>
<dd>

**$priority:** `?float` — Indicates the order in which the ACL will be evaluated relative to other ACL rules.
    
</dd>
</dl>

<dl>
<dd>

**$rule:** `NetworkAclRule` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;networkAcls-&gt;get($id) -> ?GetNetworkAclsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a specific access control list entry for your client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->networkAcls->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the access control list to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;networkAcls-&gt;set($id, $request) -> ?SetNetworkAclsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update existing access control list for your client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->networkAcls->set(
    'id',
    new SetNetworkAclRequestContent([
        'description' => 'description',
        'active' => true,
        'rule' => new NetworkAclRule([
            'action' => new NetworkAclAction([]),
            'scope' => NetworkAclRuleScopeEnum::Management->value,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the ACL to update.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$active:** `bool` — Indicates whether or not this access control list is actively being used
    
</dd>
</dl>

<dl>
<dd>

**$priority:** `?float` — Indicates the order in which the ACL will be evaluated relative to other ACL rules.
    
</dd>
</dl>

<dl>
<dd>

**$rule:** `NetworkAclRule` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;networkAcls-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete existing access control list for your client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->networkAcls->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the ACL to delete
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;networkAcls-&gt;update($id, $request) -> ?UpdateNetworkAclResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update existing access control list for your client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->networkAcls->update(
    'id',
    new UpdateNetworkAclRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the ACL to update.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$active:** `?bool` — Indicates whether or not this access control list is actively being used
    
</dd>
</dl>

<dl>
<dd>

**$priority:** `?float` — Indicates the order in which the ACL will be evaluated relative to other ACL rules.
    
</dd>
</dl>

<dl>
<dd>

**$rule:** `?NetworkAclRule` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Organizations
<details><summary><code>$client-&gt;organizations-&gt;list($request) -> ?ListOrganizationsPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve detailed list of all Organizations available in your tenant. For more information, see Auth0 Organizations.

This endpoint supports two types of pagination:
<ul>
<li>Offset pagination</li>
<li>Checkpoint pagination</li>
</ul>

Checkpoint pagination must be used if you need to retrieve more than 1000 organizations.

<h2>Checkpoint Pagination</h2>

To search by checkpoint, use the following parameters:
<ul>
<li><code>from</code>: Optional id from which to start selection.</li>
<li><code>take</code>: The total number of entries to retrieve when using the <code>from</code> parameter. Defaults to 50.</li>
</ul>

<b>Note</b>: The first time you call this endpoint using checkpoint pagination, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no pages are remaining.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->list(
    new ListOrganizationsRequestParameters([
        'from' => 'from',
        'take' => 1,
        'sort' => 'sort',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?string` — Field to sort by. Use <code>field:order</code> where order is <code>1</code> for ascending and <code>-1</code> for descending. e.g. <code>created_at:1</code>. We currently support sorting by the following fields: <code>name</code>, <code>display_name</code> and <code>created_at</code>.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;create($request) -> ?CreateOrganizationResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new Organization within your tenant.  To learn more about Organization settings, behavior, and configuration options, review <a href="https://auth0.com/docs/manage-users/organizations/create-first-organization">Create Your First Organization</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->create(
    new CreateOrganizationRequestContent([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — The name of this organization.
    
</dd>
</dl>

<dl>
<dd>

**$displayName:** `?string` — Friendly name of this organization.
    
</dd>
</dl>

<dl>
<dd>

**$branding:** `?OrganizationBranding` 
    
</dd>
</dl>

<dl>
<dd>

**$metadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$enabledConnections:** `?array` — Connections that will be enabled for this organization. See POST enabled_connections endpoint for the object format. (Max of 10 connections allowed)
    
</dd>
</dl>

<dl>
<dd>

**$tokenQuota:** `?CreateTokenQuota` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;getByName($name) -> ?GetOrganizationByNameResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details about a single Organization specified by name.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->getByName(
    'name',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — name of the organization to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;get($id) -> ?GetOrganizationResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details about a single Organization specified by ID. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the organization to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove an Organization from your tenant.  This action cannot be undone. 

<b>Note</b>: Members are automatically disassociated from an Organization when it is deleted. However, this action does <b>not</b> delete these users from your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;update($id, $request) -> ?UpdateOrganizationResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the details of a specific <a href="https://auth0.com/docs/manage-users/organizations/configure-organizations/create-organizations">Organization</a>, such as name and display name, branding options, and metadata.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->update(
    'id',
    new UpdateOrganizationRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the organization to update.
    
</dd>
</dl>

<dl>
<dd>

**$displayName:** `?string` — Friendly name of this organization.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — The name of this organization.
    
</dd>
</dl>

<dl>
<dd>

**$branding:** `?OrganizationBranding` 
    
</dd>
</dl>

<dl>
<dd>

**$metadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$tokenQuota:** `?UpdateTokenQuota` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Prompts
<details><summary><code>$client-&gt;prompts-&gt;getSettings() -> ?GetSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of the Universal Login configuration of your tenant. This includes the <a href="https://auth0.com/docs/authenticate/login/auth0-universal-login/identifier-first">Identifier First Authentication</a> and <a href="https://auth0.com/docs/secure/multi-factor-authentication/fido-authentication-with-webauthn/configure-webauthn-device-biometrics-for-mfa">WebAuthn with Device Biometrics for MFA</a> features.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->prompts->getSettings();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;prompts-&gt;updateSettings($request) -> ?UpdateSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the Universal Login configuration of your tenant. This includes the <a href="https://auth0.com/docs/authenticate/login/auth0-universal-login/identifier-first">Identifier First Authentication</a> and <a href="https://auth0.com/docs/secure/multi-factor-authentication/fido-authentication-with-webauthn/configure-webauthn-device-biometrics-for-mfa">WebAuthn with Device Biometrics for MFA</a> features.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->prompts->updateSettings(
    new UpdateSettingsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$universalLoginExperience:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$identifierFirst:** `?bool` — Whether identifier first is enabled or not
    
</dd>
</dl>

<dl>
<dd>

**$webauthnPlatformFirstFactor:** `?bool` — Use WebAuthn with Device Biometrics as the first authentication factor
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## RateLimitPolicies
<details><summary><code>$client-&gt;rateLimitPolicies-&gt;list($request) -> ?ListRateLimitPoliciesPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rateLimitPolicies->list(
    new ListRateLimitPoliciesRequestParameters([
        'resource' => RateLimitPolicyResourceEnum::OauthAuthenticationApi->value,
        'consumer' => RateLimitPolicyConsumerEnum::Client->value,
        'consumerSelector' => 'consumer_selector',
        'take' => 1,
        'from' => 'from',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$resource:** `?string` — The API protected by the Rate Limit Policy.
    
</dd>
</dl>

<dl>
<dd>

**$consumer:** `?string` — The consumer to which the rate limit policy applies.
    
</dd>
</dl>

<dl>
<dd>

**$consumerSelector:** `?string` — Identifier or category within the consumer to which the policy applies. Supported values: `client_id:<client_id>` to target a specific client by ID, `client_id:<cimd_uri>` to target a CIMD client by URI, `cimd_clients` to target all CIMD clients, `third_party_clients` to target all third-party clients, or `default` to apply the policy to any consumer identifier not otherwise explicitly targeted.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Cursor for pagination.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;rateLimitPolicies-&gt;create($request) -> ?CreateRateLimitPolicyResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rateLimitPolicies->create(
    new CreateRateLimitPolicyRequestContent([
        'resource' => RateLimitPolicyResourceEnum::OauthAuthenticationApi->value,
        'consumer' => RateLimitPolicyConsumerEnum::Client->value,
        'consumerSelector' => 'consumer_selector',
        'configuration' => new RateLimitPolicyConfigurationZero([
            'action' => RateLimitPolicyConfigurationZeroAction::Allow->value,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$resource:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$consumer:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$consumerSelector:** `string` — Identifier or category within the consumer to which the policy applies. Supported values: `client_id:<client_id>` to target a specific client by ID, `client_id:<cimd_uri>` to target a CIMD client by URI, `cimd_clients` to target all CIMD clients, `third_party_clients` to target all third-party clients, or `default` to apply the policy to any consumer identifier not otherwise explicitly targeted.
    
</dd>
</dl>

<dl>
<dd>

**$configuration:** `RateLimitPolicyConfigurationZero|RateLimitPolicyConfigurationOne|RateLimitPolicyConfigurationAction` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;rateLimitPolicies-&gt;get($id) -> ?GetRateLimitPolicyResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rateLimitPolicies->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the Rate Limit Policy.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;rateLimitPolicies-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rateLimitPolicies->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the Rate Limit Policy.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;rateLimitPolicies-&gt;update($id, $request) -> ?UpdateRateLimitPolicyResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rateLimitPolicies->update(
    'id',
    new PatchRateLimitPolicyRequestContent([
        'configuration' => new PatchRateLimitPolicyConfigurationRequestContentZero([
            'action' => PatchRateLimitPolicyConfigurationRequestContentZeroAction::Allow->value,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the Rate Limit Policy.
    
</dd>
</dl>

<dl>
<dd>

**$configuration:** `PatchRateLimitPolicyConfigurationRequestContentZero|PatchRateLimitPolicyConfigurationRequestContentOne|PatchRateLimitPolicyConfigurationRequestContentAction` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## RefreshTokens
<details><summary><code>$client-&gt;refreshTokens-&gt;list($request) -> ?GetRefreshTokensPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a paginated list of refresh tokens for a specific user, with optional filtering by client ID. Results are sorted by credential_id ascending.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->refreshTokens->list(
    new GetRefreshTokensRequestParameters([
        'userId' => 'user_id',
        'clientId' => 'client_id',
        'from' => 'from',
        'take' => 1,
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `string` — ID of the user whose refresh tokens to retrieve. Required.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — Filter results by client ID. Only valid when user_id is provided.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — An opaque cursor from which to start the selection (exclusive). Expires after 24 hours. Obtained from the next property of a previous response.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;refreshTokens-&gt;revoke($request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Revoke refresh tokens in bulk by ID list, user, user+client, or client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->refreshTokens->revoke(
    new RevokeRefreshTokensRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$ids:** `?array` — Array of refresh token IDs to revoke. Limited to 100 at a time.
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `?string` — Revoke all refresh tokens for this user.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — Revoke all refresh tokens for this client.
    
</dd>
</dl>

<dl>
<dd>

**$audience:** `?string` — Resource server identifier (audience) to scope the revocation. Must be used with both `user_id` and `client_id`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;refreshTokens-&gt;get($id) -> ?GetRefreshTokenResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve refresh token information.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->refreshTokens->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID refresh token to retrieve
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;refreshTokens-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a refresh token by its ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->refreshTokens->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the refresh token to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;refreshTokens-&gt;update($id, $request) -> ?UpdateRefreshTokenResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a refresh token by its ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->refreshTokens->update(
    'id',
    new UpdateRefreshTokenRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the refresh token to update.
    
</dd>
</dl>

<dl>
<dd>

**$refreshTokenMetadata:** `?array` — Metadata associated with the refresh token. Pass null or {} to remove all metadata.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ResourceServers
<details><summary><code>$client-&gt;resourceServers-&gt;list($request) -> ?ListResourceServerOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of all APIs associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->resourceServers->list(
    new ListResourceServerRequestParameters([
        'identifiers' => [
            'identifiers',
        ],
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$identifiers:** `?string` — An optional filter on the resource server identifier. Must be URL encoded and may be specified multiple times (max 10).<br /><b>e.g.</b> <i>../resource-servers?identifiers=id1&identifiers=id2</i>
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;resourceServers-&gt;create($request) -> ?CreateResourceServerResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new API associated with your tenant. Note that all new APIs must be registered with Auth0. For more information, read <a href="https://www.auth0.com/docs/get-started/apis"> APIs</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->resourceServers->create(
    new CreateResourceServerRequestContent([
        'identifier' => 'identifier',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `?string` — Friendly name for this resource server. Can not contain `<` or `>` characters.
    
</dd>
</dl>

<dl>
<dd>

**$identifier:** `string` — Unique identifier for the API used as the audience parameter on authorization calls. Can not be changed once set.
    
</dd>
</dl>

<dl>
<dd>

**$scopes:** `?array` — List of permissions (scopes) that this API uses.
    
</dd>
</dl>

<dl>
<dd>

**$signingAlg:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$signingSecret:** `?string` — Secret used to sign tokens when using symmetric algorithms (HS256).
    
</dd>
</dl>

<dl>
<dd>

**$allowOfflineAccess:** `?bool` — Whether refresh tokens can be issued for this API (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$allowOnlineAccess:** `?bool` — Whether Online Refresh Tokens can be issued for this API (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$allowOnlineAccessWithEphemeralSessions:** `?bool` — Whether Online Refresh Tokens can be issued even when sessions are configured as ephemeral (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$tokenLifetime:** `?int` — Expiration value (in seconds) for access tokens issued for this API from the token endpoint.
    
</dd>
</dl>

<dl>
<dd>

**$tokenDialect:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$skipConsentForVerifiableFirstPartyClients:** `?bool` — Whether to skip user consent for applications flagged as first party (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$enforcePolicies:** `?bool` — Whether to enforce authorization policies (true) or to ignore them (false).
    
</dd>
</dl>

<dl>
<dd>

**$tokenEncryption:** `?ResourceServerTokenEncryption` 
    
</dd>
</dl>

<dl>
<dd>

**$consentPolicy:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$authorizationDetails:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$proofOfPossession:** `?ResourceServerProofOfPossession` 
    
</dd>
</dl>

<dl>
<dd>

**$subjectTypeAuthorization:** `?ResourceServerSubjectTypeAuthorization` 
    
</dd>
</dl>

<dl>
<dd>

**$authorizationPolicy:** `?ResourceServerAuthorizationPolicy` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;resourceServers-&gt;get($id, $request) -> ?GetResourceServerResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve <a href="https://auth0.com/docs/apis">API</a> details with the given ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->resourceServers->get(
    'id',
    new GetResourceServerRequestParameters([
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID or audience of the resource server to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;resourceServers-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete an existing API by ID. For more information, read <a href="https://www.auth0.com/docs/get-started/apis/api-settings">API Settings</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->resourceServers->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID or the audience of the resource server to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;resourceServers-&gt;update($id, $request) -> ?UpdateResourceServerResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Change an existing API setting by resource server ID. For more information, read <a href="https://www.auth0.com/docs/get-started/apis/api-settings">API Settings</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->resourceServers->update(
    'id',
    new UpdateResourceServerRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID or audience of the resource server to update.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Friendly name for this resource server. Can not contain `<` or `>` characters.
    
</dd>
</dl>

<dl>
<dd>

**$scopes:** `?array` — List of permissions (scopes) that this API uses.
    
</dd>
</dl>

<dl>
<dd>

**$signingAlg:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$signingSecret:** `?string` — Secret used to sign tokens when using symmetric algorithms (HS256).
    
</dd>
</dl>

<dl>
<dd>

**$skipConsentForVerifiableFirstPartyClients:** `?bool` — Whether to skip user consent for applications flagged as first party (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$allowOfflineAccess:** `?bool` — Whether refresh tokens can be issued for this API (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$allowOnlineAccess:** `?bool` — Whether Online Refresh Tokens can be issued for this API (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$allowOnlineAccessWithEphemeralSessions:** `?bool` — Whether Online Refresh Tokens can be issued even when sessions are configured as ephemeral (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$tokenLifetime:** `?int` — Expiration value (in seconds) for access tokens issued for this API from the token endpoint.
    
</dd>
</dl>

<dl>
<dd>

**$tokenDialect:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$enforcePolicies:** `?bool` — Whether authorization policies are enforced (true) or not enforced (false).
    
</dd>
</dl>

<dl>
<dd>

**$tokenEncryption:** `?ResourceServerTokenEncryption` 
    
</dd>
</dl>

<dl>
<dd>

**$consentPolicy:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$authorizationDetails:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$proofOfPossession:** `?ResourceServerProofOfPossession` 
    
</dd>
</dl>

<dl>
<dd>

**$subjectTypeAuthorization:** `?ResourceServerSubjectTypeAuthorization` 
    
</dd>
</dl>

<dl>
<dd>

**$authorizationPolicy:** `?ResourceServerAuthorizationPolicy` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Roles
<details><summary><code>$client-&gt;roles-&gt;list($request) -> ?ListRolesOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve detailed list of user roles created in your tenant.

**Note**: The returned list does not include standard roles available for tenant members, such as Admin or Support Access.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->roles->list(
    new ListRolesRequestParameters([
        'perPage' => 1,
        'page' => 1,
        'includeTotals' => true,
        'nameFilter' => 'name_filter',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$nameFilter:** `?string` — Optional filter on name (case-insensitive).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;roles-&gt;create($request) -> ?CreateRoleResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a user role for [Role-Based Access Control](https://auth0.com/docs/manage-users/access-control/rbac).

**Note**: New roles are not associated with any permissions by default. To assign existing permissions to your role, review Associate Permissions with a Role. To create new permissions, review Add API Permissions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->roles->create(
    new CreateRoleRequestContent([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — Name of the role.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Description of the role.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;roles-&gt;get($id) -> ?GetRoleResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details about a specific [user role](https://auth0.com/docs/manage-users/access-control/rbac) specified by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->roles->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the role to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;roles-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a specific [user role](https://auth0.com/docs/manage-users/access-control/rbac) from your tenant. Once deleted, it is removed from any user who was previously assigned that role. This action cannot be undone.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->roles->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the role to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;roles-&gt;update($id, $request) -> ?UpdateRoleResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Modify the details of a specific [user role](https://auth0.com/docs/manage-users/access-control/rbac) specified by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->roles->update(
    'id',
    new UpdateRoleRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the role to update.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Name of this role.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Description of this role.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Rules
<details><summary><code>$client-&gt;rules-&gt;list($request) -> ?ListRulesOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a filtered list of [rules](https://auth0.com/docs/rules). Accepts a list of fields to include or exclude.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rules->list(
    new ListRulesRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'enabled' => true,
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Optional filter on whether a rule is enabled (true) or disabled (false).
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;rules-&gt;create($request) -> ?CreateRuleResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a [new rule](https://auth0.com/docs/rules#create-a-new-rule-using-the-management-api).

Note: Changing a rule's stage of execution from the default `login_success` can change the rule's function signature to have user omitted.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rules->create(
    new CreateRuleRequestContent([
        'name' => 'name',
        'script' => 'script',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — Name of this rule.
    
</dd>
</dl>

<dl>
<dd>

**$script:** `string` — Code to be executed when this rule runs.
    
</dd>
</dl>

<dl>
<dd>

**$order:** `?float` — Order that this rule should execute in relative to other rules. Lower-valued rules execute first.
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Whether the rule is enabled (true), or disabled (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;rules-&gt;get($id, $request) -> ?GetRuleResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve [rule](https://auth0.com/docs/rules) details. Accepts a list of fields to include or exclude in the result.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rules->get(
    'id',
    new GetRuleRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the rule to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;rules-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a rule.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rules->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the rule to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;rules-&gt;update($id, $request) -> ?UpdateRuleResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update an existing rule.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rules->update(
    'id',
    new UpdateRuleRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the rule to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$script:** `?string` — Code to be executed when this rule runs.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Name of this rule.
    
</dd>
</dl>

<dl>
<dd>

**$order:** `?float` — Order that this rule should execute in relative to other rules. Lower-valued rules execute first.
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Whether the rule is enabled (true), or disabled (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## RulesConfigs
<details><summary><code>$client-&gt;rulesConfigs-&gt;list() -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve rules config variable keys.

    Note: For security, config variable values cannot be retrieved outside rule execution.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rulesConfigs->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;rulesConfigs-&gt;set($key, $request) -> ?SetRulesConfigResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Sets a rules config variable.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rulesConfigs->set(
    'key',
    new SetRulesConfigRequestContent([
        'value' => 'value',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$key:** `string` — Key of the rules config variable to set (max length: 127 characters).
    
</dd>
</dl>

<dl>
<dd>

**$value:** `string` — Value for a rules config variable.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;rulesConfigs-&gt;delete($key)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a rules config variable identified by its key.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->rulesConfigs->delete(
    'key',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$key:** `string` — Key of the rules config variable to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## SelfServiceProfiles
<details><summary><code>$client-&gt;selfServiceProfiles-&gt;list($request) -> ?ListSelfServiceProfilesPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves self-service profiles.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->selfServiceProfiles->list(
    new ListSelfServiceProfilesRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;selfServiceProfiles-&gt;create($request) -> ?CreateSelfServiceProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a self-service profile.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->selfServiceProfiles->create(
    new CreateSelfServiceProfileRequestContent([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — The name of the self-service Profile.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — The description of the self-service Profile.
    
</dd>
</dl>

<dl>
<dd>

**$branding:** `?SelfServiceProfileBrandingProperties` 
    
</dd>
</dl>

<dl>
<dd>

**$allowedStrategies:** `?array` — List of IdP strategies that will be shown to users during the Self-Service Enterprise Configuration flow. Possible values: [`oidc`, `samlp`, `waad`, `google-apps`, `adfs`, `okta`, `auth0-samlp`, `okta-samlp`, `keycloak-samlp`, `pingfederate`]
    
</dd>
</dl>

<dl>
<dd>

**$userAttributes:** `?array` — List of attributes to be mapped that will be shown to the user during the Self-Service Enterprise Configuration flow.
    
</dd>
</dl>

<dl>
<dd>

**$userAttributeProfileId:** `?string` — ID of the user-attribute-profile to associate with this self-service profile.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;selfServiceProfiles-&gt;get($id) -> ?GetSelfServiceProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a self-service profile by Id.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->selfServiceProfiles->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the self-service profile to retrieve
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;selfServiceProfiles-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a self-service profile by Id.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->selfServiceProfiles->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the self-service profile to delete
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;selfServiceProfiles-&gt;update($id, $request) -> ?UpdateSelfServiceProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a self-service profile.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->selfServiceProfiles->update(
    'id',
    new UpdateSelfServiceProfileRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the self-service profile to update
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — The name of the self-service Profile.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$branding:** `?SelfServiceProfileBrandingProperties` 
    
</dd>
</dl>

<dl>
<dd>

**$allowedStrategies:** `?array` — List of IdP strategies that will be shown to users during the Self-Service Enterprise Configuration flow. Possible values: [`oidc`, `samlp`, `waad`, `google-apps`, `adfs`, `okta`, `auth0-samlp`, `okta-samlp`, `keycloak-samlp`, `pingfederate`]
    
</dd>
</dl>

<dl>
<dd>

**$userAttributes:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$userAttributeProfileId:** `?string` — ID of the user-attribute-profile to associate with this self-service profile.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Sessions
<details><summary><code>$client-&gt;sessions-&gt;get($id) -> ?GetSessionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve session information.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->sessions->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of session to retrieve
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;sessions-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a session by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->sessions->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the session to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;sessions-&gt;update($id, $request) -> ?UpdateSessionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update session information.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->sessions->update(
    'id',
    new UpdateSessionRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the session to update.
    
</dd>
</dl>

<dl>
<dd>

**$sessionMetadata:** `?array` — Metadata associated with the session. Pass null or {} to remove all session_metadata.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;sessions-&gt;revoke($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Revokes a session by ID and all associated refresh tokens.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->sessions->revoke(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the session to revoke.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Stats
<details><summary><code>$client-&gt;stats-&gt;getActiveUsersCount() -> ?float</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the number of active users that logged in during the last 30 days.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stats->getActiveUsersCount();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stats-&gt;getDaily($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the number of logins, signups and breached-password detections (subscription required) that occurred each day within a specified date range.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stats->getDaily(
    new GetDailyStatsRequestParameters([
        'from' => 'from',
        'to' => 'to',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional first day of the date range (inclusive) in YYYYMMDD format.
    
</dd>
</dl>

<dl>
<dd>

**$to:** `?string` — Optional last day of the date range (inclusive) in YYYYMMDD format.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## SupplementalSignals
<details><summary><code>$client-&gt;supplementalSignals-&gt;get() -> ?GetSupplementalSignalsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the supplemental signals configuration for a tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->supplementalSignals->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;supplementalSignals-&gt;patch($request) -> ?PatchSupplementalSignalsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the supplemental signals configuration for a tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->supplementalSignals->patch(
    new UpdateSupplementalSignalsRequestContent([
        'akamaiEnabled' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$akamaiEnabled:** `bool` — Indicates if incoming Akamai Headers should be processed
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Tickets
<details><summary><code>$client-&gt;tickets-&gt;verifyEmail($request) -> ?VerifyEmailTicketResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create an email verification ticket for a given user. An email verification ticket is a generated URL that the user can consume to verify their email address.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tickets->verifyEmail(
    new VerifyEmailTicketRequestContent([
        'userId' => 'user_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$resultUrl:** `?string` — URL the user will be redirected to in the classic Universal Login experience once the ticket is used. Cannot be specified when using client_id or organization_id.
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `string` — user_id of for whom the ticket should be created.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — ID of the client (application). If provided for tenants using the New Universal Login experience, the email template and UI displays application details, and the user is prompted to redirect to the application's <a target='' href='https://auth0.com/docs/authenticate/login/auth0-universal-login/configure-default-login-routes#completing-the-password-reset-flow'>default login route</a> after the ticket is used. client_id is required to use the <a target='' href='https://auth0.com/docs/customize/actions/flows-and-triggers/post-change-password-flow'>Password Reset Post Challenge</a> trigger.
    
</dd>
</dl>

<dl>
<dd>

**$organizationId:** `?string` — (Optional) Organization ID – the ID of the Organization. If provided, organization parameters will be made available to the email template and organization branding will be applied to the prompt. In addition, the redirect link in the prompt will include organization_id and organization_name query string parameters.
    
</dd>
</dl>

<dl>
<dd>

**$ttlSec:** `?int` — Number of seconds for which the ticket is valid before expiration. If unspecified or set to 0, this value defaults to 432000 seconds (5 days).
    
</dd>
</dl>

<dl>
<dd>

**$includeEmailInRedirect:** `?bool` — Whether to include the email address as part of the returnUrl in the reset_email (true), or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$identity:** `?Identity` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;tickets-&gt;changePassword($request) -> ?ChangePasswordTicketResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a password change ticket for a given user. A password change ticket is a generated URL that the user can consume to start a reset password flow.

Note: This endpoint does not verify the given user’s identity. If you call this endpoint within your application, you must design your application to verify the user’s identity.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tickets->changePassword(
    new ChangePasswordTicketRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$resultUrl:** `?string` — URL the user will be redirected to in the classic Universal Login experience once the ticket is used. Cannot be specified when using organization_id. May be specified together with client_id when the tenant has a custom password reset page enabled and a password-reset-post-challenge Action bound.
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `?string` — user_id of for whom the ticket should be created.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — ID of the client (application). If provided for tenants using the New Universal Login experience, the email template and UI displays application details, and the user is prompted to redirect to the application's <a target='' href='https://auth0.com/docs/authenticate/login/auth0-universal-login/configure-default-login-routes#completing-the-password-reset-flow'>default login route</a> after the ticket is used. client_id is required to use the <a target='' href='https://auth0.com/docs/customize/actions/flows-and-triggers/post-change-password-flow'>Password Reset Post Challenge</a> trigger.
    
</dd>
</dl>

<dl>
<dd>

**$organizationId:** `?string` — (Optional) Organization ID – the ID of the Organization. If provided, organization parameters will be made available to the email template and organization branding will be applied to the prompt. In addition, the redirect link in the prompt will include organization_id and organization_name query string parameters.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `?string` — ID of the connection. If provided, allows the user to be specified using email instead of user_id. If you set this value, you must also send the email parameter. You cannot send user_id when specifying a connection_id.
    
</dd>
</dl>

<dl>
<dd>

**$email:** `?string` — Email address of the user for whom the tickets should be created. Requires the connection_id parameter. Cannot be specified when using user_id.
    
</dd>
</dl>

<dl>
<dd>

**$ttlSec:** `?int` — Number of seconds for which the ticket is valid before expiration. If unspecified or set to 0, this value defaults to 432000 seconds (5 days).
    
</dd>
</dl>

<dl>
<dd>

**$markEmailAsVerified:** `?bool` — Whether to set the email_verified attribute to true (true) or whether it should not be updated (false).
    
</dd>
</dl>

<dl>
<dd>

**$includeEmailInRedirect:** `?bool` — Whether to include the email address as part of the returnUrl in the reset_email (true), or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$identity:** `?ChangePasswordTicketIdentity` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## TokenExchangeProfiles
<details><summary><code>$client-&gt;tokenExchangeProfiles-&gt;list($request) -> ?ListTokenExchangeProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of all Token Exchange Profiles available in your tenant.

By using this feature, you agree to the applicable Free Trial terms in <a href="https://www.okta.com/legal/">Okta’s Master Subscription Agreement</a>. It is your responsibility to securely validate the user’s subject_token. See <a href="https://auth0.com/docs/authenticate/custom-token-exchange">User Guide</a> for more details.

This endpoint supports Checkpoint pagination. To search by checkpoint, use the following parameters:
<ul>
<li><code>from</code>: Optional id from which to start selection.</li>
<li><code>take</code>: The total amount of entries to retrieve when using the from parameter. Defaults to 50.</li>
</ul>

<b>Note</b>: The first time you call this endpoint using checkpoint pagination, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no pages are remaining.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tokenExchangeProfiles->list(
    new TokenExchangeProfilesListRequest([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;tokenExchangeProfiles-&gt;create($request) -> ?CreateTokenExchangeProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new Token Exchange Profile within your tenant.

By using this feature, you agree to the applicable Free Trial terms in <a href="https://www.okta.com/legal/">Okta’s Master Subscription Agreement</a>. It is your responsibility to securely validate the user’s subject_token. See <a href="https://auth0.com/docs/authenticate/custom-token-exchange">User Guide</a> for more details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tokenExchangeProfiles->create(
    new CreateTokenExchangeProfileRequestContent([
        'name' => 'name',
        'subjectTokenType' => 'subject_token_type',
        'actionId' => 'action_id',
        'type' => TokenExchangeProfileTypeEnum::CustomAuthentication->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — Friendly name of this profile.
    
</dd>
</dl>

<dl>
<dd>

**$subjectTokenType:** `string` — Subject token type for this profile. When receiving a token exchange request on the Authentication API, the corresponding token exchange profile with a matching subject_token_type will be executed. This must be a URI.
    
</dd>
</dl>

<dl>
<dd>

**$actionId:** `string` — The ID of the Custom Token Exchange action to execute for this profile, in order to validate the subject_token. The action must use the custom-token-exchange trigger.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;tokenExchangeProfiles-&gt;get($id) -> ?GetTokenExchangeProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details about a single Token Exchange Profile specified by ID.

By using this feature, you agree to the applicable Free Trial terms in <a href="https://www.okta.com/legal/">Okta’s Master Subscription Agreement</a>. It is your responsibility to securely validate the user’s subject_token. See <a href="https://auth0.com/docs/authenticate/custom-token-exchange">User Guide</a> for more details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tokenExchangeProfiles->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the Token Exchange Profile to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;tokenExchangeProfiles-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a Token Exchange Profile within your tenant.

By using this feature, you agree to the applicable Free Trial terms in <a href="https://www.okta.com/legal/">Okta's Master Subscription Agreement</a>. It is your responsibility to securely validate the user's subject_token. See <a href="https://auth0.com/docs/authenticate/custom-token-exchange">User Guide</a> for more details.

</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tokenExchangeProfiles->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the Token Exchange Profile to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;tokenExchangeProfiles-&gt;update($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a Token Exchange Profile within your tenant.

By using this feature, you agree to the applicable Free Trial terms in <a href="https://www.okta.com/legal/">Okta's Master Subscription Agreement</a>. It is your responsibility to securely validate the user's subject_token. See <a href="https://auth0.com/docs/authenticate/custom-token-exchange">User Guide</a> for more details.

</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tokenExchangeProfiles->update(
    'id',
    new UpdateTokenExchangeProfileRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the Token Exchange Profile to update.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Friendly name of this profile.
    
</dd>
</dl>

<dl>
<dd>

**$subjectTokenType:** `?string` — Subject token type for this profile. When receiving a token exchange request on the Authentication API, the corresponding token exchange profile with a matching subject_token_type will be executed. This must be a URI.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## UserAttributeProfiles
<details><summary><code>$client-&gt;userAttributeProfiles-&gt;list($request) -> ?ListUserAttributeProfilesPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of User Attribute Profiles. This endpoint supports Checkpoint pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userAttributeProfiles->list(
    new ListUserAttributeProfileRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 5.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userAttributeProfiles-&gt;create($request) -> ?CreateUserAttributeProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a User Attribute Profile.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userAttributeProfiles->create(
    new CreateUserAttributeProfileRequestContent([
        'name' => 'name',
        'userAttributes' => [
            'key' => new UserAttributeProfileUserAttributeAdditionalProperties([
                'description' => 'description',
                'label' => 'label',
                'profileRequired' => true,
                'auth0Mapping' => 'auth0_mapping',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `?UserAttributeProfileUserId` 
    
</dd>
</dl>

<dl>
<dd>

**$userAttributes:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userAttributeProfiles-&gt;listTemplates() -> ?ListUserAttributeProfileTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of User Attribute Profile Templates.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userAttributeProfiles->listTemplates();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userAttributeProfiles-&gt;getTemplate($id) -> ?GetUserAttributeProfileTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a User Attribute Profile Template.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userAttributeProfiles->getTemplate(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user-attribute-profile-template to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userAttributeProfiles-&gt;get($id) -> ?GetUserAttributeProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details about a single User Attribute Profile specified by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userAttributeProfiles->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user-attribute-profile to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userAttributeProfiles-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a single User Attribute Profile specified by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userAttributeProfiles->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user-attribute-profile to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userAttributeProfiles-&gt;update($id, $request) -> ?UpdateUserAttributeProfileResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the details of a specific User attribute profile, such as name, user_id and user_attributes.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userAttributeProfiles->update(
    'id',
    new UpdateUserAttributeProfileRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user attribute profile to update.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `?UserAttributeProfileUserId` 
    
</dd>
</dl>

<dl>
<dd>

**$userAttributes:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## UserBlocks
<details><summary><code>$client-&gt;userBlocks-&gt;listByIdentifier($request) -> ?ListUserBlocksByIdentifierResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of all <a href="https://auth0.com/docs/secure/attack-protection/brute-force-protection">Brute-force Protection</a> blocks for a user with the given identifier (username, phone number, or email).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userBlocks->listByIdentifier(
    new ListUserBlocksByIdentifierRequestParameters([
        'identifier' => 'identifier',
        'considerBruteForceEnablement' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$identifier:** `string` — Should be any of a username, phone number, or email.
    
</dd>
</dl>

<dl>
<dd>

**$considerBruteForceEnablement:** `?bool` 


          If true and Brute Force Protection is enabled and configured to block logins, will return a list of blocked IP addresses.
          If true and Brute Force Protection is disabled, will return an empty list.
        
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userBlocks-&gt;deleteByIdentifier($request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove all <a href="https://auth0.com/docs/secure/attack-protection/brute-force-protection">Brute-force Protection</a> blocks for the user with the given identifier (username, phone number, or email).

Note: This endpoint does not unblock users that were <a href="https://auth0.com/docs/user-profile#block-and-unblock-a-user">blocked by a tenant administrator</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userBlocks->deleteByIdentifier(
    new DeleteUserBlocksByIdentifierRequestParameters([
        'identifier' => 'identifier',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$identifier:** `string` — Should be any of a username, phone number, or email.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userBlocks-&gt;list($id, $request) -> ?ListUserBlocksResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of all <a href="https://auth0.com/docs/secure/attack-protection/brute-force-protection">Brute-force Protection</a> blocks for the user with the given ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userBlocks->list(
    'id',
    new ListUserBlocksRequestParameters([
        'considerBruteForceEnablement' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — user_id of the user blocks to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$considerBruteForceEnablement:** `?bool` 


          If true and Brute Force Protection is enabled and configured to block logins, will return a list of blocked IP addresses.
          If true and Brute Force Protection is disabled, will return an empty list.
        
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;userBlocks-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove all <a href="https://auth0.com/docs/secure/attack-protection/brute-force-protection">Brute-force Protection</a> blocks for the user with the given ID.

Note: This endpoint does not unblock users that were <a href="https://auth0.com/docs/user-profile#block-and-unblock-a-user">blocked by a tenant administrator</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->userBlocks->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The user_id of the user to update.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users
<details><summary><code>$client-&gt;users-&gt;list($request) -> ?ListUsersOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of users. It is possible to:

- Specify a search criteria for users
- Sort the users to be returned
- Select the fields to be returned
- Specify the number of users to retrieve per page and the page index



The `q` query parameter can be used to get users that match the specified criteria [using query string syntax.](https://auth0.com/docs/users/search/v3/query-syntax)

[Learn more about searching for users.](https://auth0.com/docs/users/search/v3)

Read about [best practices](https://auth0.com/docs/users/search/best-practices) when working with the API endpoints for retrieving users.



Auth0 limits the number of users you can return. If you exceed this threshold, please redefine your search, use the [export job](https://auth0.com/docs/api/management/v2#!/Jobs/post_users_exports), or the [User Import / Export](https://auth0.com/docs/extensions/user-import-export) extension.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->list(
    new ListUsersRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'sort' => 'sort',
        'connection' => 'connection',
        'fields' => 'fields',
        'includeFields' => true,
        'q' => 'q',
        'searchEngine' => SearchEngineVersionsEnum::V1->value,
        'primaryOrder' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?string` — Field to sort by. Use <code>field:order</code> where order is <code>1</code> for ascending and <code>-1</code> for descending. e.g. <code>created_at:1</code>
    
</dd>
</dl>

<dl>
<dd>

**$connection:** `?string` — Connection filter. Only applies when using <code>search_engine=v1</code>. To filter by connection with <code>search_engine=v2|v3</code>, use <code>q=identities.connection:"connection_name"</code>
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>

<dl>
<dd>

**$q:** `?string` — Query in <a target='_new' href ='https://lucene.apache.org/core/2_9_4/queryparsersyntax.html'>Lucene query string syntax</a>. Some query types cannot be used on metadata fields, for details see <a href='https://auth0.com/docs/users/search/v3/query-syntax#searchable-fields'>Searchable Fields</a>.
    
</dd>
</dl>

<dl>
<dd>

**$searchEngine:** `?string` — The version of the search engine
    
</dd>
</dl>

<dl>
<dd>

**$primaryOrder:** `?bool` — If true (default), results are returned in a deterministic order. If false, results may be returned in a non-deterministic order, which can enhance performance for complex queries targeting a small number of users. Set to false only when consistent ordering and pagination is not required.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;create($request) -> ?CreateUserResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new user for a given [database](https://auth0.com/docs/connections/database) or [passwordless](https://auth0.com/docs/connections/passwordless) connection.

Note: `connection` is required but other parameters such as `email` and `password` are dependent upon the type of connection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->create(
    new CreateUserRequestContent([
        'connection' => 'connection',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$email:** `?string` — The user's email.
    
</dd>
</dl>

<dl>
<dd>

**$phoneNumber:** `?string` — The user's phone number (following the E.164 recommendation).
    
</dd>
</dl>

<dl>
<dd>

**$userMetadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$blocked:** `?bool` — Whether this user was blocked by an administrator (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$emailVerified:** `?bool` — Whether this email address is verified (true) or unverified (false). User will receive a verification email after creation if `email_verified` is false or not specified
    
</dd>
</dl>

<dl>
<dd>

**$phoneVerified:** `?bool` — Whether this phone number has been verified (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$appMetadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$givenName:** `?string` — The user's given name(s).
    
</dd>
</dl>

<dl>
<dd>

**$familyName:** `?string` — The user's family name(s).
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — The user's full name.
    
</dd>
</dl>

<dl>
<dd>

**$nickname:** `?string` — The user's nickname.
    
</dd>
</dl>

<dl>
<dd>

**$picture:** `?string` — A URI pointing to the user's picture.
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `?string` — The external user's id provided by the identity provider.
    
</dd>
</dl>

<dl>
<dd>

**$connection:** `string` — Name of the connection this user should be created in.
    
</dd>
</dl>

<dl>
<dd>

**$password:** `?string` — Initial password for this user. Only valid for auth0 connection strategy.
    
</dd>
</dl>

<dl>
<dd>

**$verifyEmail:** `?bool` — Whether the user will receive a verification email after creation (true) or no email (false). Overrides behavior of `email_verified` parameter.
    
</dd>
</dl>

<dl>
<dd>

**$username:** `?string` — The user's username. Only valid if the connection requires a username.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;listUsersByEmail($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Find users by email. If Auth0 is the identity provider (idP), the email address associated with a user is saved in lower case, regardless of how you initially provided it. 

For example, if you register a user as JohnSmith@example.com, Auth0 saves the user's email as johnsmith@example.com. 

Therefore, when using this endpoint, make sure that you are searching for users via email addresses using the correct case.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->listUsersByEmail(
    new ListUsersByEmailRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
        'email' => 'email',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false). Defaults to true.
    
</dd>
</dl>

<dl>
<dd>

**$email:** `string` — Email address to search for (case-sensitive).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;get($id, $request) -> ?GetUserResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve user details. A list of fields to include or exclude may also be specified. For more information, see [Retrieve Users with the Get Users Endpoint](https://auth0.com/docs/manage-users/user-search/retrieve-users-with-get-users-endpoint).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->get(
    'id',
    new GetUserRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a user by user ID. This action cannot be undone. For Auth0 Dashboard instructions, see [Delete Users](https://auth0.com/docs/manage-users/user-accounts/delete-users).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;update($id, $request) -> ?UpdateUserResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a user.

These are the attributes that can be updated at the root level:

- app_metadata
- blocked
- email
- email_verified
- family_name
- given_name
- name
- nickname
- password
- phone_number
- phone_verified
- picture
- username
- user_metadata
- verify_email

Some considerations:

- The properties of the new object will replace the old ones.
- The metadata fields are an exception to this rule (`user_metadata` and `app_metadata`). These properties are merged instead of being replaced but be careful, the merge only occurs on the first level.
- If you are updating `email`, `email_verified`, `phone_number`, `phone_verified`, `username` or `password` of a secondary identity, you need to specify the `connection` property too.
- If you are updating `email` or `phone_number` you can specify, optionally, the `client_id` property.
- Updating `email_verified` is not supported for enterprise and passwordless sms connections.
- Updating the `blocked` to `false` does not affect the user's blocked state from an excessive amount of incorrectly provided credentials. Use the "Unblock a user" endpoint from the "User Blocks" API to change the user's state.
- Supported attributes can be unset by supplying `null` as the value.

**Updating a field (non-metadata property)**

To mark the email address of a user as verified, the body to send should be:

```json
{ "email_verified": true }
```

**Updating a user metadata root property**

Let's assume that our test user has the following `user_metadata`:

```json
{ "user_metadata" : { "profileCode": 1479 } }
```

To add the field `addresses` the body to send should be:

```json
{ "user_metadata" : { "addresses": {"work_address": "100 Industrial Way"} }}
```

The modified object ends up with the following `user_metadata` property:

```json
{
  "user_metadata": {
    "profileCode": 1479,
    "addresses": { "work_address": "100 Industrial Way" }
  }
}
```

**Updating an inner user metadata property**

If there's existing user metadata to which we want to add  `"home_address": "742 Evergreen Terrace"` (using the `addresses` property) we should send the whole `addresses` object. Since this is a first-level object, the object will be merged in, but its own properties will not be. The body to send should be:

```json
{
  "user_metadata": {
    "addresses": {
      "work_address": "100 Industrial Way",
      "home_address": "742 Evergreen Terrace"
    }
  }
}
```

The modified object ends up with the following `user_metadata` property:

```json
{
  "user_metadata": {
    "profileCode": 1479,
    "addresses": {
      "work_address": "100 Industrial Way",
      "home_address": "742 Evergreen Terrace"
    }
  }
}
```
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->update(
    'id',
    new UpdateUserRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to update.
    
</dd>
</dl>

<dl>
<dd>

**$blocked:** `?bool` — Whether this user was blocked by an administrator (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$emailVerified:** `?bool` — Whether this email address is verified (true) or unverified (false). If set to false the user will not receive a verification email unless `verify_email` is set to true.
    
</dd>
</dl>

<dl>
<dd>

**$email:** `?string` — Email address of this user.
    
</dd>
</dl>

<dl>
<dd>

**$phoneNumber:** `?string` — The user's phone number (following the E.164 recommendation).
    
</dd>
</dl>

<dl>
<dd>

**$phoneVerified:** `?bool` — Whether this phone number has been verified (true) or not (false).
    
</dd>
</dl>

<dl>
<dd>

**$userMetadata:** `?array` — User metadata to which this user has read/write access.
    
</dd>
</dl>

<dl>
<dd>

**$appMetadata:** `?array` — User metadata to which this user has read-only access.
    
</dd>
</dl>

<dl>
<dd>

**$givenName:** `?string` — Given name/first name/forename of this user.
    
</dd>
</dl>

<dl>
<dd>

**$familyName:** `?string` — Family name/last name/surname of this user.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Name of this user.
    
</dd>
</dl>

<dl>
<dd>

**$nickname:** `?string` — Preferred nickname or alias of this user.
    
</dd>
</dl>

<dl>
<dd>

**$picture:** `?string` — URL to picture, photo, or avatar of this user.
    
</dd>
</dl>

<dl>
<dd>

**$verifyEmail:** `?bool` — Whether this user will receive a verification email after creation (true) or no email (false). Overrides behavior of `email_verified` parameter.
    
</dd>
</dl>

<dl>
<dd>

**$verifyPhoneNumber:** `?bool` — Whether this user will receive a text after changing the phone number (true) or no text (false). Only valid when changing phone number for SMS connections.
    
</dd>
</dl>

<dl>
<dd>

**$password:** `?string` — New password for this user. Only valid for database connections.
    
</dd>
</dl>

<dl>
<dd>

**$connection:** `?string` — Name of the connection to target for this user update.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — Auth0 client ID. Only valid when updating email address.
    
</dd>
</dl>

<dl>
<dd>

**$username:** `?string` — The user's username. Only valid if the connection requires a username.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;regenerateRecoveryCode($id) -> ?RegenerateUsersRecoveryCodeResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove an existing multi-factor authentication (MFA) [recovery code](https://auth0.com/docs/secure/multi-factor-authentication/reset-user-mfa) and generate a new one. If a user cannot access the original device or account used for MFA enrollment, they can use a recovery code to authenticate.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->regenerateRecoveryCode(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to regenerate a multi-factor authentication recovery code for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;revokeAccess($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Revokes selected resources related to a user (sessions, refresh tokens, ...).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->revokeAccess(
    'id',
    new RevokeUserAccessRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user.
    
</dd>
</dl>

<dl>
<dd>

**$sessionId:** `?string` — ID of the session to revoke.
    
</dd>
</dl>

<dl>
<dd>

**$preserveRefreshTokens:** `?bool` — Whether to preserve the refresh tokens associated with the session.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Actions Versions
<details><summary><code>$client-&gt;actions-&gt;versions-&gt;list($actionId, $request) -> ?ListActionVersionsPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve all of an action's versions. An action version is created whenever an action is deployed. An action version is immutable, once created.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->versions->list(
    'actionId',
    new ListActionVersionsRequestParameters([
        'page' => 1,
        'perPage' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$actionId:** `string` — The ID of the action.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Use this field to request a specific page of the list results.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — This field specify the maximum number of results to be returned by the server. 20 by default
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;versions-&gt;get($actionId, $id) -> ?GetActionVersionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a specific version of an action. An action version is created whenever an action is deployed. An action version is immutable, once created.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->versions->get(
    'actionId',
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$actionId:** `string` — The ID of the action.
    
</dd>
</dl>

<dl>
<dd>

**$id:** `string` — The ID of the action version.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;versions-&gt;deploy($actionId, $id, $request) -> ?DeployActionVersionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Performs the equivalent of a roll-back of an action to an earlier, specified version. Creates a new, deployed action version that is identical to the specified version. If this action is currently bound to a trigger, the system will begin executing the newly-created version immediately.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->versions->deploy(
    'actionId',
    'id',
    new DeployActionVersionRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$actionId:** `string` — The ID of an action.
    
</dd>
</dl>

<dl>
<dd>

**$id:** `string` — The ID of an action version.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `?DeployActionVersionRequestContent` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Actions Executions
<details><summary><code>$client-&gt;actions-&gt;executions-&gt;get($id) -> ?GetActionExecutionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve information about a specific execution of a trigger. Relevant execution IDs will be included in tenant logs generated as part of that authentication flow. Executions will only be stored for 10 days after their creation.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->executions->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the execution to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Actions Modules
<details><summary><code>$client-&gt;actions-&gt;modules-&gt;list($request) -> ?GetActionModulesResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a paginated list of all Actions Modules with optional filtering and totals.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->modules->list(
    new GetActionModulesRequestParameters([
        'page' => 1,
        'perPage' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Paging is disabled if parameter not sent.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;modules-&gt;create($request) -> ?CreateActionModuleResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new Actions Module for reusable code across actions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->modules->create(
    new CreateActionModuleRequestContent([
        'name' => 'name',
        'code' => 'code',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — The name of the action module.
    
</dd>
</dl>

<dl>
<dd>

**$code:** `string` — The source code of the action module.
    
</dd>
</dl>

<dl>
<dd>

**$secrets:** `?array` — The secrets to associate with the action module.
    
</dd>
</dl>

<dl>
<dd>

**$dependencies:** `?array` — The npm dependencies of the action module.
    
</dd>
</dl>

<dl>
<dd>

**$apiVersion:** `?string` — The API version of the module.
    
</dd>
</dl>

<dl>
<dd>

**$publish:** `?bool` — Whether to publish the module immediately after creation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;modules-&gt;get($id) -> ?GetActionModuleResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of a specific Actions Module by its unique identifier.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->modules->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the action module to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;modules-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Permanently delete an Actions Module. This will fail if the module is still in use by any actions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->modules->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the Actions Module to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;modules-&gt;update($id, $request) -> ?UpdateActionModuleResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update properties of an existing Actions Module, such as code, dependencies, or secrets.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->modules->update(
    'id',
    new UpdateActionModuleRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the action module to update.
    
</dd>
</dl>

<dl>
<dd>

**$code:** `?string` — The source code of the action module.
    
</dd>
</dl>

<dl>
<dd>

**$secrets:** `?array` — The secrets to associate with the action module.
    
</dd>
</dl>

<dl>
<dd>

**$dependencies:** `?array` — The npm dependencies of the action module.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;modules-&gt;listActions($id, $request) -> ?GetActionModuleActionsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists all actions that are using a specific Actions Module, showing which deployed action versions reference this Actions Module.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->modules->listActions(
    'id',
    new GetActionModuleActionsRequestParameters([
        'page' => 1,
        'perPage' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The unique ID of the module.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;modules-&gt;rollback($id, $request) -> ?RollbackActionModuleResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Rolls back an Actions Module's draft to a previously created version. This action copies the code, dependencies, and secrets from the specified version into the current draft.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->modules->rollback(
    'id',
    new RollbackActionModuleRequestParameters([
        'moduleVersionId' => 'module_version_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The unique ID of the module to roll back.
    
</dd>
</dl>

<dl>
<dd>

**$moduleVersionId:** `string` — The unique ID of the module version to roll back to.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Actions Triggers
<details><summary><code>$client-&gt;actions-&gt;triggers-&gt;list() -> ?ListActionTriggersResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the set of triggers currently available within actions. A trigger is an extensibility point to which actions can be bound.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->triggers->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Actions Modules Versions
<details><summary><code>$client-&gt;actions-&gt;modules-&gt;versions-&gt;list($id, $request) -> ?GetActionModuleVersionsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List all published versions of a specific Actions Module.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->modules->versions->list(
    'id',
    new GetActionModuleVersionsRequestParameters([
        'page' => 1,
        'perPage' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The unique ID of the module.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Use this field to request a specific page of the list results.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — The maximum number of results to be returned by the server in a single response. 20 by default.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;modules-&gt;versions-&gt;create($id) -> ?CreateActionModuleVersionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a new immutable version of an Actions Module from the current draft version. This publishes the draft as a new version that can be referenced by actions, while maintaining the existing draft for continued development.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->modules->versions->create(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the action module to create a version for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;modules-&gt;versions-&gt;get($id, $versionId) -> ?GetActionModuleVersionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the details of a specific, immutable version of an Actions Module.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->modules->versions->get(
    'id',
    'versionId',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The unique ID of the module.
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `string` — The unique ID of the module version to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Actions Triggers Bindings
<details><summary><code>$client-&gt;actions-&gt;triggers-&gt;bindings-&gt;list($triggerId, $request) -> ?ListActionBindingsPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the actions that are bound to a trigger. Once an action is created and deployed, it must be attached (i.e. bound) to a trigger so that it will be executed as part of a flow. The list of actions returned reflects the order in which they will be executed during the appropriate flow.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->triggers->bindings->list(
    ActionTriggerTypeEnum::PostLogin->value,
    new ListActionTriggerBindingsRequestParameters([
        'page' => 1,
        'perPage' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$triggerId:** `string` — An actions extensibility point.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Use this field to request a specific page of the list results.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — The maximum number of results to be returned in a single request. 20 by default
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;actions-&gt;triggers-&gt;bindings-&gt;updateMany($triggerId, $request) -> ?UpdateActionBindingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the actions that are bound (i.e. attached) to a trigger. Once an action is created and deployed, it must be attached (i.e. bound) to a trigger so that it will be executed as part of a flow. The order in which the actions are provided will determine the order in which they are executed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->actions->triggers->bindings->updateMany(
    ActionTriggerTypeEnum::PostLogin->value,
    new UpdateActionBindingsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$triggerId:** `string` — An actions extensibility point.
    
</dd>
</dl>

<dl>
<dd>

**$bindings:** `?array` — The actions that will be bound to this trigger. The order in which they are included will be the order in which they are executed.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Anomaly Blocks
<details><summary><code>$client-&gt;anomaly-&gt;blocks-&gt;checkIp($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Check if the given IP address is blocked via the <a href="https://auth0.com/docs/configure/attack-protection/suspicious-ip-throttling">Suspicious IP Throttling</a> due to multiple suspicious attempts.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->anomaly->blocks->checkIp(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — IP address to check.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;anomaly-&gt;blocks-&gt;unblockIp($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove a block imposed by <a href="https://auth0.com/docs/configure/attack-protection/suspicious-ip-throttling">Suspicious IP Throttling</a> for the given IP address.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->anomaly->blocks->unblockIp(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — IP address to unblock.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AttackProtection BotDetection
<details><summary><code>$client-&gt;attackProtection-&gt;botDetection-&gt;get() -> ?GetBotDetectionSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the Bot Detection configuration of your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->attackProtection->botDetection->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;attackProtection-&gt;botDetection-&gt;update($request) -> ?UpdateBotDetectionSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the Bot Detection configuration of your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->attackProtection->botDetection->update(
    new UpdateBotDetectionSettingsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$botDetectionLevel:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$challengePasswordPolicy:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$challengePasswordlessPolicy:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$challengePasswordResetPolicy:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$allowlist:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$monitoringModeEnabled:** `?bool` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AttackProtection BreachedPasswordDetection
<details><summary><code>$client-&gt;attackProtection-&gt;breachedPasswordDetection-&gt;get() -> ?GetBreachedPasswordDetectionSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of the Breached Password Detection configuration of your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->attackProtection->breachedPasswordDetection->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;attackProtection-&gt;breachedPasswordDetection-&gt;update($request) -> ?UpdateBreachedPasswordDetectionSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update details of the Breached Password Detection configuration of your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->attackProtection->breachedPasswordDetection->update(
    new UpdateBreachedPasswordDetectionSettingsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$enabled:** `?bool` — Whether or not breached password detection is active.
    
</dd>
</dl>

<dl>
<dd>

**$shields:** `?array` 

Action to take when a breached password is detected during a login.
      Possible values: <code>block</code>, <code>user_notification</code>, <code>admin_notification</code>.
    
</dd>
</dl>

<dl>
<dd>

**$adminNotificationFrequency:** `?array` 

When "admin_notification" is enabled, determines how often email notifications are sent.
        Possible values: <code>immediately</code>, <code>daily</code>, <code>weekly</code>, <code>monthly</code>.
    
</dd>
</dl>

<dl>
<dd>

**$method:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$stage:** `?BreachedPasswordDetectionStage` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AttackProtection BruteForceProtection
<details><summary><code>$client-&gt;attackProtection-&gt;bruteForceProtection-&gt;get() -> ?GetBruteForceSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of the Brute-force Protection configuration of your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->attackProtection->bruteForceProtection->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;attackProtection-&gt;bruteForceProtection-&gt;update($request) -> ?UpdateBruteForceSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the Brute-force Protection configuration of your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->attackProtection->bruteForceProtection->update(
    new UpdateBruteForceSettingsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$enabled:** `?bool` — Whether or not brute force attack protections are active.
    
</dd>
</dl>

<dl>
<dd>

**$shields:** `?array` 

Action to take when a brute force protection threshold is violated.
        Possible values: <code>block</code>, <code>user_notification</code>.
    
</dd>
</dl>

<dl>
<dd>

**$allowlist:** `?array` — List of trusted IP addresses that will not have attack protection enforced against them.
    
</dd>
</dl>

<dl>
<dd>

**$mode:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$maxAttempts:** `?int` — Maximum number of unsuccessful attempts.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AttackProtection Captcha
<details><summary><code>$client-&gt;attackProtection-&gt;captcha-&gt;get() -> ?GetAttackProtectionCaptchaResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the CAPTCHA configuration for your client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->attackProtection->captcha->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;attackProtection-&gt;captcha-&gt;update($request) -> ?UpdateAttackProtectionCaptchaResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update existing CAPTCHA configuration for your client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->attackProtection->captcha->update(
    new UpdateAttackProtectionCaptchaRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$activeProviderId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$arkose:** `?AttackProtectionUpdateCaptchaArkose` 
    
</dd>
</dl>

<dl>
<dd>

**$authChallenge:** `?AttackProtectionCaptchaAuthChallengeRequest` 
    
</dd>
</dl>

<dl>
<dd>

**$hcaptcha:** `?AttackProtectionUpdateCaptchaHcaptcha` 
    
</dd>
</dl>

<dl>
<dd>

**$friendlyCaptcha:** `?AttackProtectionUpdateCaptchaFriendlyCaptcha` 
    
</dd>
</dl>

<dl>
<dd>

**$recaptchaEnterprise:** `?AttackProtectionUpdateCaptchaRecaptchaEnterprise` 
    
</dd>
</dl>

<dl>
<dd>

**$recaptchaV2:** `?AttackProtectionUpdateCaptchaRecaptchaV2` 
    
</dd>
</dl>

<dl>
<dd>

**$simpleCaptcha:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AttackProtection SuspiciousIpThrottling
<details><summary><code>$client-&gt;attackProtection-&gt;suspiciousIpThrottling-&gt;get() -> ?GetSuspiciousIpThrottlingSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of the Suspicious IP Throttling configuration of your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->attackProtection->suspiciousIpThrottling->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;attackProtection-&gt;suspiciousIpThrottling-&gt;update($request) -> ?UpdateSuspiciousIpThrottlingSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the details of the Suspicious IP Throttling configuration of your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->attackProtection->suspiciousIpThrottling->update(
    new UpdateSuspiciousIpThrottlingSettingsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$enabled:** `?bool` — Whether or not suspicious IP throttling attack protections are active.
    
</dd>
</dl>

<dl>
<dd>

**$shields:** `?array` 

Action to take when a suspicious IP throttling threshold is violated.
          Possible values: <code>block</code>, <code>admin_notification</code>.
    
</dd>
</dl>

<dl>
<dd>

**$allowlist:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$stage:** `?SuspiciousIpThrottlingStage` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Branding Templates
<details><summary><code>$client-&gt;branding-&gt;templates-&gt;getUniversalLogin() -> GetUniversalLoginTemplate|string|null</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->templates->getUniversalLogin();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;templates-&gt;updateUniversalLogin($request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the Universal Login branding template.

When `content-type` header is set to `application/json`:

```json
{
  "template": "<!DOCTYPE html>{% assign resolved_dir = dir | default: \"auto\" %}<html lang=\"{{locale}}\" dir=\"{{resolved_dir}}\"><head>{%- auth0:head -%}</head><body class=\"_widget-auto-layout\">{%- auth0:widget -%}</body></html>"
}
```

When `content-type` header is set to `text/html`:

```html
<!DOCTYPE html>
{% assign resolved_dir = dir | default: "auto" %}
<html lang="{{locale}}" dir="{{resolved_dir}}">
  <head>
    {%- auth0:head -%}
  </head>
  <body class="_widget-auto-layout">
    {%- auth0:widget -%}
  </body>
</html>
```
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->templates->updateUniversalLogin(
    'string',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `string|UpdateUniversalLoginTemplateRequestContentTemplate` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;templates-&gt;deleteUniversalLogin()</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->templates->deleteUniversalLogin();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Branding Themes
<details><summary><code>$client-&gt;branding-&gt;themes-&gt;create($request) -> ?CreateBrandingThemeResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create branding theme.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->themes->create(
    new CreateBrandingThemeRequestContent([
        'borders' => new BrandingThemeBorders([
            'buttonBorderRadius' => 1.1,
            'buttonBorderWeight' => 1.1,
            'buttonsStyle' => BrandingThemeBordersButtonsStyleEnum::Pill->value,
            'inputBorderRadius' => 1.1,
            'inputBorderWeight' => 1.1,
            'inputsStyle' => BrandingThemeBordersInputsStyleEnum::Pill->value,
            'showWidgetShadow' => true,
            'widgetBorderWeight' => 1.1,
            'widgetCornerRadius' => 1.1,
        ]),
        'colors' => new BrandingThemeColors([
            'bodyText' => 'body_text',
            'error' => 'error',
            'header' => 'header',
            'icons' => 'icons',
            'inputBackground' => 'input_background',
            'inputBorder' => 'input_border',
            'inputFilledText' => 'input_filled_text',
            'inputLabelsPlaceholders' => 'input_labels_placeholders',
            'linksFocusedComponents' => 'links_focused_components',
            'primaryButton' => 'primary_button',
            'primaryButtonLabel' => 'primary_button_label',
            'secondaryButtonBorder' => 'secondary_button_border',
            'secondaryButtonLabel' => 'secondary_button_label',
            'success' => 'success',
            'widgetBackground' => 'widget_background',
            'widgetBorder' => 'widget_border',
        ]),
        'fonts' => new BrandingThemeFonts([
            'bodyText' => new BrandingThemeFontBodyText([
                'bold' => true,
                'size' => 1.1,
            ]),
            'buttonsText' => new BrandingThemeFontButtonsText([
                'bold' => true,
                'size' => 1.1,
            ]),
            'fontUrl' => 'font_url',
            'inputLabels' => new BrandingThemeFontInputLabels([
                'bold' => true,
                'size' => 1.1,
            ]),
            'links' => new BrandingThemeFontLinks([
                'bold' => true,
                'size' => 1.1,
            ]),
            'linksStyle' => BrandingThemeFontLinksStyleEnum::Normal->value,
            'referenceTextSize' => 1.1,
            'subtitle' => new BrandingThemeFontSubtitle([
                'bold' => true,
                'size' => 1.1,
            ]),
            'title' => new BrandingThemeFontTitle([
                'bold' => true,
                'size' => 1.1,
            ]),
        ]),
        'pageBackground' => new BrandingThemePageBackground([
            'backgroundColor' => 'background_color',
            'backgroundImageUrl' => 'background_image_url',
            'pageLayout' => BrandingThemePageBackgroundPageLayoutEnum::Center->value,
        ]),
        'widget' => new BrandingThemeWidget([
            'headerTextAlignment' => BrandingThemeWidgetHeaderTextAlignmentEnum::Center->value,
            'logoHeight' => 1.1,
            'logoPosition' => BrandingThemeWidgetLogoPositionEnum::Center->value,
            'logoUrl' => 'logo_url',
            'socialButtonsLayout' => BrandingThemeWidgetSocialButtonsLayoutEnum::Bottom->value,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$borders:** `BrandingThemeBorders` 
    
</dd>
</dl>

<dl>
<dd>

**$colors:** `BrandingThemeColors` 
    
</dd>
</dl>

<dl>
<dd>

**$displayName:** `?string` — Display Name
    
</dd>
</dl>

<dl>
<dd>

**$fonts:** `BrandingThemeFonts` 
    
</dd>
</dl>

<dl>
<dd>

**$pageBackground:** `BrandingThemePageBackground` 
    
</dd>
</dl>

<dl>
<dd>

**$widget:** `BrandingThemeWidget` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;themes-&gt;getDefault() -> ?GetBrandingDefaultThemeResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve default branding theme.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->themes->getDefault();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;themes-&gt;get($themeId) -> ?GetBrandingThemeResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve branding theme.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->themes->get(
    'themeId',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$themeId:** `string` — The ID of the theme
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;themes-&gt;delete($themeId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete branding theme.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->themes->delete(
    'themeId',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$themeId:** `string` — The ID of the theme
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;themes-&gt;update($themeId, $request) -> ?UpdateBrandingThemeResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update branding theme.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->themes->update(
    'themeId',
    new UpdateBrandingThemeRequestContent([
        'borders' => new BrandingThemeBorders([
            'buttonBorderRadius' => 1.1,
            'buttonBorderWeight' => 1.1,
            'buttonsStyle' => BrandingThemeBordersButtonsStyleEnum::Pill->value,
            'inputBorderRadius' => 1.1,
            'inputBorderWeight' => 1.1,
            'inputsStyle' => BrandingThemeBordersInputsStyleEnum::Pill->value,
            'showWidgetShadow' => true,
            'widgetBorderWeight' => 1.1,
            'widgetCornerRadius' => 1.1,
        ]),
        'colors' => new BrandingThemeColors([
            'bodyText' => 'body_text',
            'error' => 'error',
            'header' => 'header',
            'icons' => 'icons',
            'inputBackground' => 'input_background',
            'inputBorder' => 'input_border',
            'inputFilledText' => 'input_filled_text',
            'inputLabelsPlaceholders' => 'input_labels_placeholders',
            'linksFocusedComponents' => 'links_focused_components',
            'primaryButton' => 'primary_button',
            'primaryButtonLabel' => 'primary_button_label',
            'secondaryButtonBorder' => 'secondary_button_border',
            'secondaryButtonLabel' => 'secondary_button_label',
            'success' => 'success',
            'widgetBackground' => 'widget_background',
            'widgetBorder' => 'widget_border',
        ]),
        'fonts' => new BrandingThemeFonts([
            'bodyText' => new BrandingThemeFontBodyText([
                'bold' => true,
                'size' => 1.1,
            ]),
            'buttonsText' => new BrandingThemeFontButtonsText([
                'bold' => true,
                'size' => 1.1,
            ]),
            'fontUrl' => 'font_url',
            'inputLabels' => new BrandingThemeFontInputLabels([
                'bold' => true,
                'size' => 1.1,
            ]),
            'links' => new BrandingThemeFontLinks([
                'bold' => true,
                'size' => 1.1,
            ]),
            'linksStyle' => BrandingThemeFontLinksStyleEnum::Normal->value,
            'referenceTextSize' => 1.1,
            'subtitle' => new BrandingThemeFontSubtitle([
                'bold' => true,
                'size' => 1.1,
            ]),
            'title' => new BrandingThemeFontTitle([
                'bold' => true,
                'size' => 1.1,
            ]),
        ]),
        'pageBackground' => new BrandingThemePageBackground([
            'backgroundColor' => 'background_color',
            'backgroundImageUrl' => 'background_image_url',
            'pageLayout' => BrandingThemePageBackgroundPageLayoutEnum::Center->value,
        ]),
        'widget' => new BrandingThemeWidget([
            'headerTextAlignment' => BrandingThemeWidgetHeaderTextAlignmentEnum::Center->value,
            'logoHeight' => 1.1,
            'logoPosition' => BrandingThemeWidgetLogoPositionEnum::Center->value,
            'logoUrl' => 'logo_url',
            'socialButtonsLayout' => BrandingThemeWidgetSocialButtonsLayoutEnum::Bottom->value,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$themeId:** `string` — The ID of the theme
    
</dd>
</dl>

<dl>
<dd>

**$borders:** `BrandingThemeBorders` 
    
</dd>
</dl>

<dl>
<dd>

**$colors:** `BrandingThemeColors` 
    
</dd>
</dl>

<dl>
<dd>

**$displayName:** `?string` — Display Name
    
</dd>
</dl>

<dl>
<dd>

**$fonts:** `BrandingThemeFonts` 
    
</dd>
</dl>

<dl>
<dd>

**$pageBackground:** `BrandingThemePageBackground` 
    
</dd>
</dl>

<dl>
<dd>

**$widget:** `BrandingThemeWidget` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Branding Phone Providers
<details><summary><code>$client-&gt;branding-&gt;phone-&gt;providers-&gt;list($request) -> ?ListBrandingPhoneProvidersResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of <a href="https://auth0.com/docs/customize/phone-messages/configure-phone-messaging-providers">phone providers</a> details set for a Tenant. A list of fields to include or exclude may also be specified.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->providers->list(
    new ListBrandingPhoneProvidersRequestParameters([
        'disabled' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$disabled:** `?bool` — Whether the provider is enabled (false) or disabled (true).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;providers-&gt;create($request) -> ?CreateBrandingPhoneProviderResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a <a href="https://auth0.com/docs/customize/phone-messages/configure-phone-messaging-providers">phone provider</a>.
The <code>credentials</code> object requires different properties depending on the phone provider (which is specified using the <code>name</code> property).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->providers->create(
    new CreateBrandingPhoneProviderRequestContent([
        'name' => PhoneProviderNameEnum::Twilio->value,
        'credentials' => new TwilioProviderCredentials([
            'authToken' => 'auth_token',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$disabled:** `?bool` — Whether the provider is enabled (false) or disabled (true).
    
</dd>
</dl>

<dl>
<dd>

**$configuration:** `TwilioProviderConfiguration|CustomProviderConfiguration|null` 
    
</dd>
</dl>

<dl>
<dd>

**$credentials:** `TwilioProviderCredentials|CustomProviderCredentials` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;providers-&gt;get($id) -> ?GetBrandingPhoneProviderResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve <a href="https://auth0.com/docs/customize/phone-messages/configure-phone-messaging-providers">phone provider</a> details. A list of fields to include or exclude may also be specified.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->providers->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;providers-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete the configured phone provider.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->providers->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;providers-&gt;update($id, $request) -> ?UpdateBrandingPhoneProviderResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a <a href="https://auth0.com/docs/customize/phone-messages/configure-phone-messaging-providers">phone provider</a>.
The <code>credentials</code> object requires different properties depending on the phone provider (which is specified using the <code>name</code> property).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->providers->update(
    'id',
    new UpdateBrandingPhoneProviderRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$disabled:** `?bool` — Whether the provider is enabled (false) or disabled (true).
    
</dd>
</dl>

<dl>
<dd>

**$credentials:** `TwilioProviderCredentials|CustomProviderCredentials|null` 
    
</dd>
</dl>

<dl>
<dd>

**$configuration:** `TwilioProviderConfiguration|CustomProviderConfiguration|null` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;providers-&gt;test($id, $request) -> ?CreatePhoneProviderSendTestResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->providers->test(
    'id',
    new CreatePhoneProviderSendTestRequestContent([
        'to' => 'to',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$to:** `string` — The recipient phone number to receive a given notification.
    
</dd>
</dl>

<dl>
<dd>

**$deliveryMethod:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Branding Phone Templates
<details><summary><code>$client-&gt;branding-&gt;phone-&gt;templates-&gt;list($request) -> ?ListPhoneTemplatesResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->templates->list(
    new ListPhoneTemplatesRequestParameters([
        'disabled' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$disabled:** `?bool` — Whether the template is enabled (false) or disabled (true).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;templates-&gt;create($request) -> ?CreatePhoneTemplateResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->templates->create(
    new CreatePhoneTemplateRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$type:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$disabled:** `?bool` — Whether the template is enabled (false) or disabled (true).
    
</dd>
</dl>

<dl>
<dd>

**$content:** `?PhoneTemplateContent` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;templates-&gt;get($id) -> ?GetPhoneTemplateResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->templates->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;templates-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->templates->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;templates-&gt;update($id, $request) -> ?UpdatePhoneTemplateResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->templates->update(
    'id',
    new UpdatePhoneTemplateRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$content:** `?PartialPhoneTemplateContent` 
    
</dd>
</dl>

<dl>
<dd>

**$disabled:** `?bool` — Whether the template is enabled (false) or disabled (true).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;templates-&gt;reset($id, $request) -> ?ResetPhoneTemplateResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->templates->reset(
    'id',
    [
        'key' => "value",
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `mixed` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;branding-&gt;phone-&gt;templates-&gt;test($id, $request) -> ?CreatePhoneTemplateTestNotificationResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->branding->phone->templates->test(
    'id',
    new CreatePhoneTemplateTestNotificationRequestContent([
        'to' => 'to',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$to:** `string` — Destination of the testing phone notification
    
</dd>
</dl>

<dl>
<dd>

**$deliveryMethod:** `?string` — Medium to use to send the notification
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ClientGrants Organizations
<details><summary><code>$client-&gt;clientGrants-&gt;organizations-&gt;list($id, $request) -> ?ListClientGrantOrganizationsPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clientGrants->organizations->list(
    'id',
    new ListClientGrantOrganizationsRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the client grant
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Clients Credentials
<details><summary><code>$client-&gt;clients-&gt;credentials-&gt;list($clientId) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the details of a client credential.

<b>Important</b>: To enable credentials to be used for a client authentication method, set the <code>client_authentication_methods</code> property on the client. To enable credentials to be used for JWT-Secured Authorization requests set the <code>signed_request_object</code> property on the client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->credentials->list(
    'client_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$clientId:** `string` — ID of the client.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;credentials-&gt;create($clientId, $request) -> ?PostClientCredentialResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a client credential associated to your application. Credentials can be used to configure Private Key JWT and mTLS authentication methods, as well as for JWT-secured Authorization requests.

<h5>Public Key</h5>Public Key credentials can be used to set up Private Key JWT client authentication and JWT-secured Authorization requests.

Sample: <pre><code>{
  "credential_type": "public_key",
  "name": "string",
  "pem": "string",
  "alg": "RS256",
  "parse_expiry_from_cert": false,
  "expires_at": "2022-12-31T23:59:59Z"
}</code></pre>
<h5>Certificate (CA-signed & self-signed)</h5>Certificate credentials can be used to set up mTLS client authentication. CA-signed certificates can be configured either with a signed certificate or with just the certificate Subject DN.

CA-signed Certificate Sample (pem): <pre><code>{
  "credential_type": "x509_cert",
  "name": "string",
  "pem": "string"
}</code></pre>CA-signed Certificate Sample (subject_dn): <pre><code>{
  "credential_type": "cert_subject_dn",
  "name": "string",
  "subject_dn": "string"
}</code></pre>Self-signed Certificate Sample: <pre><code>{
  "credential_type": "cert_subject_dn",
  "name": "string",
  "pem": "string"
}</code></pre>

The credential will be created but not yet enabled for use until you set the corresponding properties in the client:
<ul>
  <li>To enable the credential for Private Key JWT or mTLS authentication methods, set the <code>client_authentication_methods</code> property on the client. For more information, read <a href="https://auth0.com/docs/get-started/applications/configure-private-key-jwt">Configure Private Key JWT Authentication</a> and <a href="https://auth0.com/docs/get-started/applications/configure-mtls">Configure mTLS Authentication</a></li>
  <li>To enable the credential for JWT-secured Authorization requests, set the <code>signed_request_object</code>property on the client. For more information, read <a href="https://auth0.com/docs/get-started/applications/configure-jar">Configure JWT-secured Authorization Requests (JAR)</a></li>
</ul>
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->credentials->create(
    'client_id',
    new PostClientCredentialRequestContent([
        'credentialType' => ClientCredentialTypeEnum::PublicKey->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$clientId:** `string` — ID of the client.
    
</dd>
</dl>

<dl>
<dd>

**$credentialType:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Friendly name for a credential.
    
</dd>
</dl>

<dl>
<dd>

**$subjectDn:** `?string` — Subject Distinguished Name. Mutually exclusive with `pem` property. Applies to `cert_subject_dn` credential type.
    
</dd>
</dl>

<dl>
<dd>

**$pem:** `?string` — PEM-formatted public key (SPKI and PKCS1) or X509 certificate. Must be JSON escaped.
    
</dd>
</dl>

<dl>
<dd>

**$alg:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$parseExpiryFromCert:** `?bool` — Parse expiry from x509 certificate. If true, attempts to parse the expiry date from the provided PEM. Applies to `public_key` credential type.
    
</dd>
</dl>

<dl>
<dd>

**$expiresAt:** `?DateTime` — The ISO 8601 formatted date representing the expiration of the credential. If not specified (not recommended), the credential never expires. Applies to `public_key` credential type.
    
</dd>
</dl>

<dl>
<dd>

**$kid:** `?string` — Optional kid (Key ID), used to uniquely identify the credential. If not specified, a kid value will be auto-generated. The kid header parameter in JWTs sent by your client should match this value. Valid format is [0-9a-zA-Z-_]{10,64}
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;credentials-&gt;get($clientId, $credentialId) -> ?GetClientCredentialResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the details of a client credential.

<b>Important</b>: To enable credentials to be used for a client authentication method, set the <code>client_authentication_methods</code> property on the client. To enable credentials to be used for JWT-Secured Authorization requests set the <code>signed_request_object</code> property on the client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->credentials->get(
    'client_id',
    'credential_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$clientId:** `string` — ID of the client.
    
</dd>
</dl>

<dl>
<dd>

**$credentialId:** `string` — ID of the credential.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;credentials-&gt;delete($clientId, $credentialId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a client credential you previously created. May be enabled or disabled. For more information, read <a href="https://www.auth0.com/docs/get-started/authentication-and-authorization-flow/client-credentials-flow">Client Credential Flow</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->credentials->delete(
    'client_id',
    'credential_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$clientId:** `string` — ID of the client.
    
</dd>
</dl>

<dl>
<dd>

**$credentialId:** `string` — ID of the credential to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;clients-&gt;credentials-&gt;update($clientId, $credentialId, $request) -> ?PatchClientCredentialResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Change a client credential you previously created. May be enabled or disabled. For more information, read <a href="https://www.auth0.com/docs/get-started/authentication-and-authorization-flow/client-credentials-flow">Client Credential Flow</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->credentials->update(
    'client_id',
    'credential_id',
    new PatchClientCredentialRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$clientId:** `string` — ID of the client.
    
</dd>
</dl>

<dl>
<dd>

**$credentialId:** `string` — ID of the credential.
    
</dd>
</dl>

<dl>
<dd>

**$expiresAt:** `?DateTime` — The ISO 8601 formatted date representing the expiration of the credential.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Clients Connections
<details><summary><code>$client-&gt;clients-&gt;connections-&gt;get($id, $request) -> ?ListClientConnectionsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve all connections that are enabled for the specified <a href="https://www.auth0.com/docs/get-started/applications"> Application</a>, using checkpoint pagination. A list of fields to include or exclude for each connection may also be specified.
<ul>
  <li>
    This endpoint requires the <code>read:connections</code> scope and any one of <code>read:clients</code> or <code>read:client_summary</code>.
  </li>
  <li>
    <b>Note</b>: The first time you call this endpoint, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no further results are remaining.
  </li>
</ul>
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->clients->connections->get(
    'id',
    new ConnectionsGetRequest([
        'strategy' => [
            ConnectionStrategyEnum::Ad->value,
        ],
        'from' => 'from',
        'take' => 1,
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the client for which to retrieve enabled connections.
    
</dd>
</dl>

<dl>
<dd>

**$strategy:** `?string` — Provide strategies to only retrieve connections with such strategies
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — A comma separated list of fields to include or exclude (depending on include_fields) from the result, empty to retrieve all fields
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — <code>true</code> if the fields specified are to be included in the result, <code>false</code> otherwise (defaults to <code>true</code>)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Connections DirectoryProvisioning
<details><summary><code>$client-&gt;connections-&gt;directoryProvisioning-&gt;list($request) -> ?ListDirectoryProvisioningsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of directory provisioning configurations of a tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->directoryProvisioning->list(
    new ListDirectoryProvisioningsRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;directoryProvisioning-&gt;get($id) -> ?GetDirectoryProvisioningResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the directory provisioning configuration of a connection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->directoryProvisioning->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to retrieve its directory provisioning configuration
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;directoryProvisioning-&gt;create($id, $request) -> ?CreateDirectoryProvisioningResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a directory provisioning configuration for a connection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->directoryProvisioning->create(
    'id',
    new CreateDirectoryProvisioningRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to create its directory provisioning configuration
    
</dd>
</dl>

<dl>
<dd>

**$request:** `?CreateDirectoryProvisioningRequestContent` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;directoryProvisioning-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete the directory provisioning configuration of a connection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->directoryProvisioning->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to delete its directory provisioning configuration
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;directoryProvisioning-&gt;update($id, $request) -> ?UpdateDirectoryProvisioningResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the directory provisioning configuration of a connection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->directoryProvisioning->update(
    'id',
    new UpdateDirectoryProvisioningRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to create its directory provisioning configuration
    
</dd>
</dl>

<dl>
<dd>

**$request:** `?UpdateDirectoryProvisioningRequestContent` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;directoryProvisioning-&gt;getDefaultMapping($id) -> ?GetDirectoryProvisioningDefaultMappingResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the directory provisioning default attribute mapping of a connection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->directoryProvisioning->getDefaultMapping(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to retrieve its directory provisioning configuration
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;directoryProvisioning-&gt;listSynchronizedGroups($id, $request) -> ?ListSynchronizedGroupsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the configured synchronized groups for a connection directory provisioning configuration.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->directoryProvisioning->listSynchronizedGroups(
    'id',
    new ListSynchronizedGroupsRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to list synchronized groups for.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;directoryProvisioning-&gt;set($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create or replace the selected groups for a connection directory provisioning configuration.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->directoryProvisioning->set(
    'id',
    new ReplaceSynchronizedGroupsRequestContent([
        'groups' => [
            new SynchronizedGroupPayload([
                'id' => 'id',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to create or replace synchronized groups for
    
</dd>
</dl>

<dl>
<dd>

**$groups:** `array` — Array of Google Workspace Directory group objects to synchronize.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Connections ScimConfiguration
<details><summary><code>$client-&gt;connections-&gt;scimConfiguration-&gt;list($request) -> ?ListScimConfigurationsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of SCIM configurations of a tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->scimConfiguration->list(
    new ListScimConfigurationsRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;scimConfiguration-&gt;get($id) -> ?GetScimConfigurationResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a scim configuration by its `connectionId`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->scimConfiguration->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to retrieve its SCIM configuration
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;scimConfiguration-&gt;create($id, $request) -> ?CreateScimConfigurationResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a scim configuration for a connection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->scimConfiguration->create(
    'id',
    new CreateScimConfigurationRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to create its SCIM configuration
    
</dd>
</dl>

<dl>
<dd>

**$request:** `?CreateScimConfigurationRequestContent` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;scimConfiguration-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a scim configuration by its `connectionId`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->scimConfiguration->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to delete its SCIM configuration
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;scimConfiguration-&gt;update($id, $request) -> ?UpdateScimConfigurationResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a scim configuration by its `connectionId`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->scimConfiguration->update(
    'id',
    new UpdateScimConfigurationRequestContent([
        'userIdAttribute' => 'user_id_attribute',
        'mapping' => [
            new ScimMappingItem([]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to update its SCIM configuration
    
</dd>
</dl>

<dl>
<dd>

**$userIdAttribute:** `string` — User ID attribute for generating unique user ids
    
</dd>
</dl>

<dl>
<dd>

**$mapping:** `array` — The mapping between auth0 and SCIM
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;scimConfiguration-&gt;getDefaultMapping($id) -> ?GetScimConfigurationDefaultMappingResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a scim configuration's default mapping by its `connectionId`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->scimConfiguration->getDefaultMapping(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to retrieve its default SCIM mapping
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Connections Clients
<details><summary><code>$client-&gt;connections-&gt;clients-&gt;get($id, $request) -> ?GetConnectionEnabledClientsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve all clients that have the specified [connection](https://auth0.com/docs/authenticate/identity-providers) enabled.

**Note**: The first time you call this endpoint, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no further results are remaining.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->clients->get(
    'id',
    new GetConnectionEnabledClientsRequestParameters([
        'take' => 1,
        'from' => 'from',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection for which enabled clients are to be retrieved
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;clients-&gt;update($id, $request)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->clients->update(
    'id',
    [
        new UpdateEnabledClientConnectionsRequestContentItem([
            'clientId' => 'client_id',
            'status' => true,
        ]),
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to modify
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Connections Keys
<details><summary><code>$client-&gt;connections-&gt;keys-&gt;get($id) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets the connection keys for the Okta or OIDC connection strategy.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->keys->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the connection
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;keys-&gt;create($id, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Provision initial connection keys for Okta or OIDC connection strategies. This endpoint allows you to create keys before configuring the connection to use Private Key JWT authentication, enabling zero-downtime transitions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->keys->create(
    'id',
    new PostConnectionKeysRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the connection
    
</dd>
</dl>

<dl>
<dd>

**$request:** `?PostConnectionKeysRequestContent` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;keys-&gt;rotate($id, $request) -> ?RotateConnectionsKeysResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Rotates the connection keys for the Okta or OIDC connection strategies.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->keys->rotate(
    'id',
    new RotateConnectionKeysRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the connection
    
</dd>
</dl>

<dl>
<dd>

**$request:** `?RotateConnectionKeysRequestContent` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Connections Users
<details><summary><code>$client-&gt;connections-&gt;users-&gt;deleteByEmail($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a specified connection user by its email (you cannot delete all users from specific connection). Currently, only Database Connections are supported.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->users->deleteByEmail(
    'id',
    new DeleteConnectionUsersByEmailQueryParameters([
        'email' => 'email',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection (currently only database connections are supported)
    
</dd>
</dl>

<dl>
<dd>

**$email:** `string` — The email of the user to delete
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Connections DirectoryProvisioning Synchronizations
<details><summary><code>$client-&gt;connections-&gt;directoryProvisioning-&gt;synchronizations-&gt;create($id) -> ?CreateDirectorySynchronizationResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Request an on-demand synchronization of the directory.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->directoryProvisioning->synchronizations->create(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to trigger synchronization for
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Connections ScimConfiguration Tokens
<details><summary><code>$client-&gt;connections-&gt;scimConfiguration-&gt;tokens-&gt;get($id) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves all scim tokens by its connection `id`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->scimConfiguration->tokens->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to retrieve its SCIM configuration
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;scimConfiguration-&gt;tokens-&gt;create($id, $request) -> ?CreateScimTokenResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a scim token for a scim client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->scimConfiguration->tokens->create(
    'id',
    new CreateScimTokenRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the connection to create its SCIM token
    
</dd>
</dl>

<dl>
<dd>

**$scopes:** `?array` — The scopes of the scim token
    
</dd>
</dl>

<dl>
<dd>

**$tokenLifetime:** `?int` — Lifetime of the token in seconds. Must be greater than 900
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;connections-&gt;scimConfiguration-&gt;tokens-&gt;delete($id, $tokenId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a scim token by its connection `id` and `tokenId`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->connections->scimConfiguration->tokens->delete(
    'id',
    'tokenId',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The connection id that owns the SCIM token to delete
    
</dd>
</dl>

<dl>
<dd>

**$tokenId:** `string` — The id of the scim token to delete
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Emails Provider
<details><summary><code>$client-&gt;emails-&gt;provider-&gt;get($request) -> ?GetEmailProviderResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of the <a href="https://auth0.com/docs/customize/email/smtp-email-providers">email provider configuration</a> in your tenant. A list of fields to include or exclude may also be specified.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->emails->provider->get(
    new GetEmailProviderRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (dependent upon include_fields) from the result. Leave empty to retrieve `name` and `enabled`. Additional fields available include `credentials`, `default_from_address`, and `settings`.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;emails-&gt;provider-&gt;create($request) -> ?CreateEmailProviderResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create an <a href="https://auth0.com/docs/email/providers">email provider</a>. The <code>credentials</code> object
requires different properties depending on the email provider (which is specified using the <code>name</code> property):
<ul>
  <li><code>mandrill</code> requires <code>api_key</code></li>
  <li><code>sendgrid</code> requires <code>api_key</code></li>
  <li>
    <code>sparkpost</code> requires <code>api_key</code>. Optionally, set <code>region</code> to <code>eu</code> to use
    the SparkPost service hosted in Western Europe; set to <code>null</code> to use the SparkPost service hosted in
    North America. <code>eu</code> or <code>null</code> are the only valid values for <code>region</code>.
  </li>
  <li>
    <code>mailgun</code> requires <code>api_key</code> and <code>domain</code>. Optionally, set <code>region</code> to
    <code>eu</code> to use the Mailgun service hosted in Europe; set to <code>null</code> otherwise. <code>eu</code> or
    <code>null</code> are the only valid values for <code>region</code>.
  </li>
  <li><code>ses</code> requires <code>accessKeyId</code>, <code>secretAccessKey</code>, and <code>region</code></li>
  <li>
    <code>smtp</code> requires <code>smtp_host</code>, <code>smtp_port</code>, <code>smtp_user</code>, and
    <code>smtp_pass</code>
  </li>
</ul>
Depending on the type of provider it is possible to specify <code>settings</code> object with different configuration
options, which will be used when sending an email:
<ul>
  <li>
    <code>smtp</code> provider, <code>settings</code> may contain <code>headers</code> object.
    <ul>
      <li>
        When using AWS SES SMTP host, you may provide a name of configuration set in
        <code>X-SES-Configuration-Set</code> header. Value must be a string.
      </li>
      <li>
        When using Sparkpost host, you may provide value for
        <code>X-MSYS_API</code> header. Value must be an object.
      </li>
    </ul>
  </li>
  <li>
    for <code>ses</code> provider, <code>settings</code> may contain <code>message</code> object, where you can provide
    a name of configuration set in <code>configuration_set_name</code> property. Value must be a string.
  </li>
</ul>
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->emails->provider->create(
    new CreateEmailProviderRequestContent([
        'name' => EmailProviderNameEnum::Mailgun->value,
        'credentials' => new EmailProviderCredentialsSchemaZero([
            'apiKey' => 'api_key',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Whether the provider is enabled (true) or disabled (false).
    
</dd>
</dl>

<dl>
<dd>

**$defaultFromAddress:** `?string` — Email address to use as "from" when no other address specified.
    
</dd>
</dl>

<dl>
<dd>

**$credentials:** `EmailProviderCredentialsSchemaZero|EmailProviderCredentialsSchemaAccessKeyId|EmailProviderCredentialsSchemaSmtpHost|EmailProviderCredentialsSchemaThree|EmailProviderCredentialsSchemaApiKey|EmailProviderCredentialsSchemaConnectionString|EmailProviderCredentialsSchemaClientId|ExtensibilityEmailProviderCredentials` 
    
</dd>
</dl>

<dl>
<dd>

**$settings:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;emails-&gt;provider-&gt;delete()</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete the email provider.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->emails->provider->delete();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;emails-&gt;provider-&gt;update($request) -> ?UpdateEmailProviderResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update an <a href="https://auth0.com/docs/email/providers">email provider</a>. The <code>credentials</code> object
requires different properties depending on the email provider (which is specified using the <code>name</code> property):
<ul>
  <li><code>mandrill</code> requires <code>api_key</code></li>
  <li><code>sendgrid</code> requires <code>api_key</code></li>
  <li>
    <code>sparkpost</code> requires <code>api_key</code>. Optionally, set <code>region</code> to <code>eu</code> to use
    the SparkPost service hosted in Western Europe; set to <code>null</code> to use the SparkPost service hosted in
    North America. <code>eu</code> or <code>null</code> are the only valid values for <code>region</code>.
  </li>
  <li>
    <code>mailgun</code> requires <code>api_key</code> and <code>domain</code>. Optionally, set <code>region</code> to
    <code>eu</code> to use the Mailgun service hosted in Europe; set to <code>null</code> otherwise. <code>eu</code> or
    <code>null</code> are the only valid values for <code>region</code>.
  </li>
  <li><code>ses</code> requires <code>accessKeyId</code>, <code>secretAccessKey</code>, and <code>region</code></li>
  <li>
    <code>smtp</code> requires <code>smtp_host</code>, <code>smtp_port</code>, <code>smtp_user</code>, and
    <code>smtp_pass</code>
  </li>
</ul>
Depending on the type of provider it is possible to specify <code>settings</code> object with different configuration
options, which will be used when sending an email:
<ul>
  <li>
    <code>smtp</code> provider, <code>settings</code> may contain <code>headers</code> object.
    <ul>
      <li>
        When using AWS SES SMTP host, you may provide a name of configuration set in
        <code>X-SES-Configuration-Set</code> header. Value must be a string.
      </li>
      <li>
        When using Sparkpost host, you may provide value for
        <code>X-MSYS_API</code> header. Value must be an object.
      </li>
    </ul>
    for <code>ses</code> provider, <code>settings</code> may contain <code>message</code> object, where you can provide
    a name of configuration set in <code>configuration_set_name</code> property. Value must be a string.
  </li>
</ul>
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->emails->provider->update(
    new UpdateEmailProviderRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `?bool` — Whether the provider is enabled (true) or disabled (false).
    
</dd>
</dl>

<dl>
<dd>

**$defaultFromAddress:** `?string` — Email address to use as "from" when no other address specified.
    
</dd>
</dl>

<dl>
<dd>

**$credentials:** `EmailProviderCredentialsSchemaZero|EmailProviderCredentialsSchemaAccessKeyId|EmailProviderCredentialsSchemaSmtpHost|EmailProviderCredentialsSchemaThree|EmailProviderCredentialsSchemaApiKey|EmailProviderCredentialsSchemaConnectionString|EmailProviderCredentialsSchemaClientId|ExtensibilityEmailProviderCredentials|null` 
    
</dd>
</dl>

<dl>
<dd>

**$settings:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## EventStreams Deliveries
<details><summary><code>$client-&gt;eventStreams-&gt;deliveries-&gt;list($id, $request) -> ?array</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->eventStreams->deliveries->list(
    'id',
    new ListEventStreamDeliveriesRequestParameters([
        'statuses' => 'statuses',
        'eventTypes' => 'event_types',
        'dateFrom' => 'date_from',
        'dateTo' => 'date_to',
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the event stream.
    
</dd>
</dl>

<dl>
<dd>

**$statuses:** `?string` — Comma-separated list of statuses by which to filter
    
</dd>
</dl>

<dl>
<dd>

**$eventTypes:** `?string` — Comma-separated list of event types by which to filter
    
</dd>
</dl>

<dl>
<dd>

**$dateFrom:** `?string` — An RFC-3339 date-time for redelivery start, inclusive. Does not allow sub-second precision.
    
</dd>
</dl>

<dl>
<dd>

**$dateTo:** `?string` — An RFC-3339 date-time for redelivery end, exclusive. Does not allow sub-second precision.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;eventStreams-&gt;deliveries-&gt;getHistory($id, $eventId) -> ?GetEventStreamDeliveryHistoryResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->eventStreams->deliveries->getHistory(
    'id',
    'event_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the event stream.
    
</dd>
</dl>

<dl>
<dd>

**$eventId:** `string` — Unique identifier for the event
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## EventStreams Redeliveries
<details><summary><code>$client-&gt;eventStreams-&gt;redeliveries-&gt;create($id, $request) -> ?CreateEventStreamRedeliveryResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->eventStreams->redeliveries->create(
    'id',
    new CreateEventStreamRedeliveryRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the event stream.
    
</dd>
</dl>

<dl>
<dd>

**$dateFrom:** `?DateTime` — An RFC-3339 date-time for redelivery start, inclusive. Does not allow sub-second precision.
    
</dd>
</dl>

<dl>
<dd>

**$dateTo:** `?DateTime` — An RFC-3339 date-time for redelivery end, exclusive. Does not allow sub-second precision.
    
</dd>
</dl>

<dl>
<dd>

**$statuses:** `?array` — Filter by status
    
</dd>
</dl>

<dl>
<dd>

**$eventTypes:** `?array` — Filter by event type
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;eventStreams-&gt;redeliveries-&gt;createById($id, $eventId)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->eventStreams->redeliveries->createById(
    'id',
    'event_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the event stream.
    
</dd>
</dl>

<dl>
<dd>

**$eventId:** `string` — Unique identifier for the event
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Flows Executions
<details><summary><code>$client-&gt;flows-&gt;executions-&gt;list($flowId, $request) -> ?ListFlowExecutionsPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->executions->list(
    'flow_id',
    new ListFlowExecutionsRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$flowId:** `string` — Flow id
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;executions-&gt;get($flowId, $executionId, $request) -> ?GetFlowExecutionResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->executions->get(
    'flow_id',
    'execution_id',
    new GetFlowExecutionRequestParameters([
        'hydrate' => [
            GetFlowExecutionRequestParametersHydrateEnum::Debug->value,
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$flowId:** `string` — Flow id
    
</dd>
</dl>

<dl>
<dd>

**$executionId:** `string` — Flow execution id
    
</dd>
</dl>

<dl>
<dd>

**$hydrate:** `?string` — Hydration param
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;executions-&gt;delete($flowId, $executionId)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->executions->delete(
    'flow_id',
    'execution_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$flowId:** `string` — Flows id
    
</dd>
</dl>

<dl>
<dd>

**$executionId:** `string` — Flow execution identifier
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Flows Vault Connections
<details><summary><code>$client-&gt;flows-&gt;vault-&gt;connections-&gt;list($request) -> ?ListFlowsVaultConnectionsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->vault->connections->list(
    new ListFlowsVaultConnectionsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;vault-&gt;connections-&gt;create($request) -> ?CreateFlowsVaultConnectionResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->vault->connections->create(
    new CreateFlowsVaultConnectionActivecampaignApiKey([
        'name' => 'name',
        'appId' => FlowsVaultConnectionAppIdActivecampaignEnum::Activecampaign->value,
        'setup' => new FlowsVaultConnectioSetupApiKeyWithBaseUrl([
            'type' => FlowsVaultConnectioSetupTypeApiKeyEnum::ApiKey->value,
            'apiKey' => 'api_key',
            'baseUrl' => 'base_url',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `CreateFlowsVaultConnectionActivecampaignApiKey|CreateFlowsVaultConnectionActivecampaignUninitialized|CreateFlowsVaultConnectionAirtableApiKey|CreateFlowsVaultConnectionAirtableUninitialized|CreateFlowsVaultConnectionAuth0OauthApp|CreateFlowsVaultConnectionAuth0Uninitialized|CreateFlowsVaultConnectionBigqueryJwt|CreateFlowsVaultConnectionBigqueryUninitialized|CreateFlowsVaultConnectionClearbitApiKey|CreateFlowsVaultConnectionClearbitUninitialized|CreateFlowsVaultConnectionDocusignOauthCode|CreateFlowsVaultConnectionDocusignUninitialized|CreateFlowsVaultConnectionGoogleSheetsOauthCode|CreateFlowsVaultConnectionGoogleSheetsUninitialized|CreateFlowsVaultConnectionHttpBearer|CreateFlowsVaultConnectionHttpBasicAuth|CreateFlowsVaultConnectionHttpApiKey|CreateFlowsVaultConnectionHttpOauthClientCredentials|CreateFlowsVaultConnectionHttpUninitialized|CreateFlowsVaultConnectionHubspotApiKey|CreateFlowsVaultConnectionHubspotOauthCode|CreateFlowsVaultConnectionHubspotUninitialized|CreateFlowsVaultConnectionJwtJwt|CreateFlowsVaultConnectionJwtUninitialized|CreateFlowsVaultConnectionMailchimpApiKey|CreateFlowsVaultConnectionMailchimpOauthCode|CreateFlowsVaultConnectionMailchimpUninitialized|CreateFlowsVaultConnectionMailjetApiKey|CreateFlowsVaultConnectionMailjetUninitialized|CreateFlowsVaultConnectionPipedriveToken|CreateFlowsVaultConnectionPipedriveOauthCode|CreateFlowsVaultConnectionPipedriveUninitialized|CreateFlowsVaultConnectionSalesforceOauthCode|CreateFlowsVaultConnectionSalesforceUninitialized|CreateFlowsVaultConnectionSendgridApiKey|CreateFlowsVaultConnectionSendgridUninitialized|CreateFlowsVaultConnectionSlackWebhook|CreateFlowsVaultConnectionSlackOauthCode|CreateFlowsVaultConnectionSlackUninitialized|CreateFlowsVaultConnectionStripeKeyPair|CreateFlowsVaultConnectionStripeOauthCode|CreateFlowsVaultConnectionStripeUninitialized|CreateFlowsVaultConnectionTelegramToken|CreateFlowsVaultConnectionTelegramUninitialized|CreateFlowsVaultConnectionTwilioApiKey|CreateFlowsVaultConnectionTwilioUninitialized|CreateFlowsVaultConnectionWhatsappToken|CreateFlowsVaultConnectionWhatsappUninitialized|CreateFlowsVaultConnectionZapierWebhook|CreateFlowsVaultConnectionZapierUninitialized` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;vault-&gt;connections-&gt;get($id) -> ?GetFlowsVaultConnectionResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->vault->connections->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Flows Vault connection ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;vault-&gt;connections-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->vault->connections->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Vault connection id
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;vault-&gt;connections-&gt;update($id, $request) -> ?UpdateFlowsVaultConnectionResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->vault->connections->update(
    'id',
    new UpdateFlowsVaultConnectionRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Flows Vault connection ID
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Flows Vault Connection name.
    
</dd>
</dl>

<dl>
<dd>

**$setup:** `FlowsVaultConnectioSetupApiKeyWithBaseUrl|FlowsVaultConnectioSetupApiKey|FlowsVaultConnectioSetupOauthApp|FlowsVaultConnectioSetupBigqueryOauthJwt|FlowsVaultConnectioSetupSecretApiKey|FlowsVaultConnectioSetupHttpBearer|FlowsVaultConnectionHttpBasicAuthSetup|FlowsVaultConnectionHttpApiKeySetup|FlowsVaultConnectionHttpOauthClientCredentialsSetup|FlowsVaultConnectioSetupJwt|FlowsVaultConnectioSetupMailjetApiKey|FlowsVaultConnectioSetupToken|FlowsVaultConnectioSetupWebhook|FlowsVaultConnectioSetupStripeKeyPair|FlowsVaultConnectioSetupOauthCode|FlowsVaultConnectioSetupTwilioApiKey|null` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Groups Members
<details><summary><code>$client-&gt;groups-&gt;members-&gt;get($id, $request) -> ?GetGroupMembersResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List all users that are a member of this group.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->groups->members->get(
    'id',
    new GetGroupMembersRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the group (service-generated).
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — A comma separated list of fields to include or exclude (depending on include_fields) from the result, empty to retrieve all fields
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Groups Roles
<details><summary><code>$client-&gt;groups-&gt;roles-&gt;list($id, $request) -> ?ListGroupRolesResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists the <a href="https://auth0.com/docs/manage-users/access-control/rbac">roles</a> assigned to a group.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->groups->roles->list(
    'id',
    new ListGroupRolesRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the group (service-generated).
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;groups-&gt;roles-&gt;create($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Assign one or more <a href="https://auth0.com/docs/manage-users/access-control/rbac">roles</a> to a specified group.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->groups->roles->create(
    'id',
    new CreateGroupRolesRequestParameters([
        'roles' => [
            'roles',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the group (service-generated).
    
</dd>
</dl>

<dl>
<dd>

**$roles:** `array` — Array of role IDs to assign to the group.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;groups-&gt;roles-&gt;delete($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Unassign one or more <a href="https://auth0.com/docs/manage-users/access-control/rbac">roles</a> from a specified group.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->groups->roles->delete(
    'id',
    new DeleteGroupRolesRequestContent([
        'roles' => [
            'roles',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Unique identifier for the group (service-generated).
    
</dd>
</dl>

<dl>
<dd>

**$roles:** `array` — Array of role IDs to remove from the group.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Guardian Enrollments
<details><summary><code>$client-&gt;guardian-&gt;enrollments-&gt;createTicket($request) -> ?CreateGuardianEnrollmentTicketResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a [multi-factor authentication (MFA) enrollment ticket](https://auth0.com/docs/secure/multi-factor-authentication/auth0-guardian/create-custom-enrollment-tickets), and optionally send an email with the created ticket to a given user. Enrollment tickets can specify which factor users must enroll with or allow existing MFA users to enroll in additional factors.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->enrollments->createTicket(
    new CreateGuardianEnrollmentTicketRequestContent([
        'userId' => 'user_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `string` — user_id for the enrollment ticket
    
</dd>
</dl>

<dl>
<dd>

**$email:** `?string` — alternate email to which the enrollment email will be sent. Optional - by default, the email will be sent to the user's default address
    
</dd>
</dl>

<dl>
<dd>

**$sendMail:** `?bool` — Send an email to the user to start the enrollment
    
</dd>
</dl>

<dl>
<dd>

**$emailLocale:** `?string` — Optional. Specify the locale of the enrollment email. Used with send_email.
    
</dd>
</dl>

<dl>
<dd>

**$factor:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$allowMultipleEnrollments:** `?bool` — Optional. Allows a user who has previously enrolled in MFA to enroll with additional factors.<br />Note: Parameter can only be used with Universal Login; it cannot be used with Classic Login or custom MFA pages.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;enrollments-&gt;get($id) -> ?GetGuardianEnrollmentResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details, such as status and type, for a specific multi-factor authentication enrollment registered to a user account.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->enrollments->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the enrollment to be retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;enrollments-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove a specific multi-factor authentication (MFA) enrollment from a user's account. This allows the user to re-enroll with MFA. For more information, review [Reset User Multi-Factor Authentication and Recovery Codes](https://auth0.com/docs/secure/multi-factor-authentication/reset-user-mfa).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->enrollments->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the enrollment to be deleted.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Guardian Factors
<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;list() -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of all <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors">multi-factor authentication factors</a> associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;set($name, $request) -> ?SetGuardianFactorResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the status (i.e., enabled or disabled) of a specific multi-factor authentication factor.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->set(
    GuardianFactorNameEnum::PushNotification->value,
    new SetGuardianFactorRequestContent([
        'enabled' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — Factor name. Can be `sms`, `push-notification`, `email`, `duo` `otp` `webauthn-roaming`, `webauthn-platform`, or `recovery-code`.
    
</dd>
</dl>

<dl>
<dd>

**$enabled:** `bool` — Whether this factor is enabled (true) or disabled (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Guardian Policies
<details><summary><code>$client-&gt;guardian-&gt;policies-&gt;list() -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the [multi-factor authentication (MFA) policies](https://auth0.com/docs/secure/multi-factor-authentication/enable-mfa) configured for your tenant.

The following policies are supported:

- `all-applications` policy prompts with MFA for all logins.
- `confidence-score` policy prompts with MFA only for low confidence logins.

**Note**: The `confidence-score` policy is part of the [Adaptive MFA feature](https://auth0.com/docs/secure/multi-factor-authentication/adaptive-mfa). Adaptive MFA requires an add-on for the Enterprise plan; review [Auth0 Pricing](https://auth0.com/pricing) for more details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->policies->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;policies-&gt;set($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Set [multi-factor authentication (MFA) policies](https://auth0.com/docs/secure/multi-factor-authentication/enable-mfa) for your tenant.

The following policies are supported:

- `all-applications` policy prompts with MFA for all logins.
- `confidence-score` policy prompts with MFA only for low confidence logins.

**Note**: The `confidence-score` policy is part of the [Adaptive MFA feature](https://auth0.com/docs/secure/multi-factor-authentication/adaptive-mfa). Adaptive MFA requires an add-on for the Enterprise plan; review [Auth0 Pricing](https://auth0.com/pricing) for more details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->policies->set(
    [
        MfaPolicyEnum::AllApplications->value,
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Guardian Factors Phone
<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;phone-&gt;getMessageTypes() -> ?GetGuardianFactorPhoneMessageTypesResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve list of <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-sms-voice-notifications-mfa">phone-type MFA factors</a> (i.e., sms and voice) that are enabled for your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->phone->getMessageTypes();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;phone-&gt;setMessageTypes($request) -> ?SetGuardianFactorPhoneMessageTypesResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Replace the list of <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-sms-voice-notifications-mfa">phone-type MFA factors</a> (i.e., sms and voice) that are enabled for your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->phone->setMessageTypes(
    new SetGuardianFactorPhoneMessageTypesRequestContent([
        'messageTypes' => [
            GuardianFactorPhoneFactorMessageTypeEnum::Sms->value,
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$messageTypes:** `array` — The list of phone factors to enable on the tenant. Can include `sms` and `voice`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;phone-&gt;getTwilioProvider() -> ?GetGuardianFactorsProviderPhoneTwilioResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve configuration details for a Twilio phone provider that has been set up in your tenant. To learn more, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-sms-voice-notifications-mfa">Configure SMS and Voice Notifications for MFA</a>. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->phone->getTwilioProvider();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;phone-&gt;setTwilioProvider($request) -> ?SetGuardianFactorsProviderPhoneTwilioResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the configuration of a Twilio phone provider that has been set up in your tenant. To learn more, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-sms-voice-notifications-mfa">Configure SMS and Voice Notifications for MFA</a>. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->phone->setTwilioProvider(
    new SetGuardianFactorsProviderPhoneTwilioRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — From number
    
</dd>
</dl>

<dl>
<dd>

**$messagingServiceSid:** `?string` — Copilot SID
    
</dd>
</dl>

<dl>
<dd>

**$authToken:** `?string` — Twilio Authentication token
    
</dd>
</dl>

<dl>
<dd>

**$sid:** `?string` — Twilio SID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;phone-&gt;getSelectedProvider() -> ?GetGuardianFactorsProviderPhoneResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of the multi-factor authentication phone provider configured for your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->phone->getSelectedProvider();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;phone-&gt;setProvider($request) -> ?SetGuardianFactorsProviderPhoneResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->phone->setProvider(
    new SetGuardianFactorsProviderPhoneRequestContent([
        'provider' => GuardianFactorsProviderSmsProviderEnum::Auth0->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$provider:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;phone-&gt;getTemplates() -> ?GetGuardianFactorPhoneTemplatesResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of the multi-factor authentication enrollment and verification templates for phone-type factors available in your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->phone->getTemplates();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;phone-&gt;setTemplates($request) -> ?SetGuardianFactorPhoneTemplatesResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Customize the messages sent to complete phone enrollment and verification (subscription required).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->phone->setTemplates(
    new SetGuardianFactorPhoneTemplatesRequestContent([
        'enrollmentMessage' => 'enrollment_message',
        'verificationMessage' => 'verification_message',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$enrollmentMessage:** `string` — Message sent to the user when they are invited to enroll with a phone number.
    
</dd>
</dl>

<dl>
<dd>

**$verificationMessage:** `string` — Message sent to the user when they are prompted to verify their account.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Guardian Factors PushNotification
<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;getApnsProvider() -> ?GetGuardianFactorsProviderApnsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve configuration details for the multi-factor authentication APNS provider associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->getApnsProvider();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;setApnsProvider($request) -> ?SetGuardianFactorsProviderPushNotificationApnsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Overwrite all configuration details of the multi-factor authentication APNS provider associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->setApnsProvider(
    new SetGuardianFactorsProviderPushNotificationApnsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$sandbox:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$bundleId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$p12:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;updateApnsProvider($request) -> ?UpdateGuardianFactorsProviderPushNotificationApnsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Modify configuration details of the multi-factor authentication APNS provider associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->updateApnsProvider(
    new UpdateGuardianFactorsProviderPushNotificationApnsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$sandbox:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$bundleId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$p12:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;setFcmProvider($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Overwrite all configuration details of the multi-factor authentication FCM provider associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->setFcmProvider(
    new SetGuardianFactorsProviderPushNotificationFcmRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$serverKey:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;updateFcmProvider($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Modify configuration details of the multi-factor authentication FCM provider associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->updateFcmProvider(
    new UpdateGuardianFactorsProviderPushNotificationFcmRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$serverKey:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;setFcmv1Provider($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Overwrite all configuration details of the multi-factor authentication FCMV1 provider associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->setFcmv1Provider(
    new SetGuardianFactorsProviderPushNotificationFcmv1RequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$serverCredentials:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;updateFcmv1Provider($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Modify configuration details of the multi-factor authentication FCMV1 provider associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->updateFcmv1Provider(
    new UpdateGuardianFactorsProviderPushNotificationFcmv1RequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$serverCredentials:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;getSnsProvider() -> ?GetGuardianFactorsProviderSnsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve configuration details for an AWS SNS push notification provider that has been enabled for MFA. To learn more, review [Configure Push Notifications for MFA](https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-push-notifications-for-mfa).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->getSnsProvider();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;setSnsProvider($request) -> ?SetGuardianFactorsProviderPushNotificationSnsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Configure the [AWS SNS push notification provider configuration](https://auth0.com/docs/multifactor-authentication/developer/sns-configuration) (subscription required).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->setSnsProvider(
    new SetGuardianFactorsProviderPushNotificationSnsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$awsAccessKeyId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$awsSecretAccessKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$awsRegion:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$snsApnsPlatformApplicationArn:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$snsGcmPlatformApplicationArn:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;updateSnsProvider($request) -> ?UpdateGuardianFactorsProviderPushNotificationSnsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Configure the [AWS SNS push notification provider configuration](https://auth0.com/docs/multifactor-authentication/developer/sns-configuration) (subscription required).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->updateSnsProvider(
    new UpdateGuardianFactorsProviderPushNotificationSnsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$awsAccessKeyId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$awsSecretAccessKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$awsRegion:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$snsApnsPlatformApplicationArn:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$snsGcmPlatformApplicationArn:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;getSelectedProvider() -> ?GetGuardianFactorsProviderPushNotificationResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Modify the push notification provider configured for your tenant. For more information, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-push-notifications-for-mfa">Configure Push Notifications for MFA</a>. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->getSelectedProvider();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;pushNotification-&gt;setProvider($request) -> ?SetGuardianFactorsProviderPushNotificationResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Modify the push notification provider configured for your tenant. For more information, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors/configure-push-notifications-for-mfa">Configure Push Notifications for MFA</a>. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->pushNotification->setProvider(
    new SetGuardianFactorsProviderPushNotificationRequestContent([
        'provider' => GuardianFactorsProviderPushNotificationProviderDataEnum::Guardian->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$provider:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Guardian Factors Sms
<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;sms-&gt;getTwilioProvider() -> ?GetGuardianFactorsProviderSmsTwilioResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the <a href="https://auth0.com/docs/multifactor-authentication/twilio-configuration">Twilio SMS provider configuration</a> (subscription required).

    A new endpoint is available to retrieve the Twilio configuration related to phone factors (<a href='https://auth0.com/docs/api/management/v2/#!/Guardian/get_twilio'>phone Twilio configuration</a>). It has the same payload as this one. Please use it instead.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->sms->getTwilioProvider();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;sms-&gt;setTwilioProvider($request) -> ?SetGuardianFactorsProviderSmsTwilioResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

This endpoint has been deprecated. To complete this action, use the <a href="https://auth0.com/docs/api/management/v2/guardian/put-twilio">Update Twilio phone configuration</a> endpoint.

    <b>Previous functionality</b>: Update the Twilio SMS provider configuration.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->sms->setTwilioProvider(
    new SetGuardianFactorsProviderSmsTwilioRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — From number
    
</dd>
</dl>

<dl>
<dd>

**$messagingServiceSid:** `?string` — Copilot SID
    
</dd>
</dl>

<dl>
<dd>

**$authToken:** `?string` — Twilio Authentication token
    
</dd>
</dl>

<dl>
<dd>

**$sid:** `?string` — Twilio SID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;sms-&gt;getSelectedProvider() -> ?GetGuardianFactorsProviderSmsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

This endpoint has been deprecated. To complete this action, use the <a href="https://auth0.com/docs/api/management/v2/guardian/get-phone-providers">Retrieve phone configuration</a> endpoint instead.

    <b>Previous functionality</b>: Retrieve details for the multi-factor authentication SMS provider configured for your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->sms->getSelectedProvider();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;sms-&gt;setProvider($request) -> ?SetGuardianFactorsProviderSmsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

This endpoint has been deprecated. To complete this action, use the <a href="https://auth0.com/docs/api/management/v2/guardian/put-phone-providers">Update phone configuration</a> endpoint instead.

    <b>Previous functionality</b>: Update the multi-factor authentication SMS provider configuration in your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->sms->setProvider(
    new SetGuardianFactorsProviderSmsRequestContent([
        'provider' => GuardianFactorsProviderSmsProviderEnum::Auth0->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$provider:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;sms-&gt;getTemplates() -> ?GetGuardianFactorSmsTemplatesResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

This endpoint has been deprecated. To complete this action, use the <a href="https://auth0.com/docs/api/management/v2/guardian/get-factor-phone-templates">Retrieve enrollment and verification phone templates</a> endpoint instead.

    <b>Previous function</b>: Retrieve details of SMS enrollment and verification templates configured for your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->sms->getTemplates();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;sms-&gt;setTemplates($request) -> ?SetGuardianFactorSmsTemplatesResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

This endpoint has been deprecated. To complete this action, use the <a href="https://auth0.com/docs/api/management/v2/guardian/put-factor-phone-templates">Update enrollment and verification phone templates</a> endpoint instead.

    <b>Previous functionality</b>: Customize the messages sent to complete SMS enrollment and verification.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->sms->setTemplates(
    new SetGuardianFactorSmsTemplatesRequestContent([
        'enrollmentMessage' => 'enrollment_message',
        'verificationMessage' => 'verification_message',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$enrollmentMessage:** `string` — Message sent to the user when they are invited to enroll with a phone number.
    
</dd>
</dl>

<dl>
<dd>

**$verificationMessage:** `string` — Message sent to the user when they are prompted to verify their account.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Guardian Factors Duo Settings
<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;duo-&gt;settings-&gt;get() -> ?GetGuardianFactorDuoSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the DUO account and factor configuration.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->duo->settings->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;duo-&gt;settings-&gt;set($request) -> ?SetGuardianFactorDuoSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Set the DUO account configuration and other properties specific to this factor.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->duo->settings->set(
    new SetGuardianFactorDuoSettingsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$ikey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$skey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$host:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;guardian-&gt;factors-&gt;duo-&gt;settings-&gt;update($request) -> ?UpdateGuardianFactorDuoSettingsResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->guardian->factors->duo->settings->update(
    new UpdateGuardianFactorDuoSettingsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$ikey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$skey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$host:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Hooks Secrets
<details><summary><code>$client-&gt;hooks-&gt;secrets-&gt;get($id) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a hook's secrets by the ID of the hook.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hooks->secrets->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the hook to retrieve secrets from.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;hooks-&gt;secrets-&gt;create($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Add one or more secrets to an existing hook. Accepts an object of key-value pairs, where the key is the name of the secret. A hook can have a maximum of 20 secrets.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hooks->secrets->create(
    'id',
    [
        'key' => 'value',
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the hook to retrieve
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;hooks-&gt;secrets-&gt;delete($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete one or more existing secrets for a given hook. Accepts an array of secret names to delete.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hooks->secrets->delete(
    'id',
    [
        'string',
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the hook whose secrets to delete.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;hooks-&gt;secrets-&gt;update($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update one or more existing secrets for an existing hook. Accepts an object of key-value pairs, where the key is the name of the existing secret.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hooks->secrets->update(
    'id',
    [
        'key' => 'value',
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the hook whose secrets to update.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Jobs UsersExports
<details><summary><code>$client-&gt;jobs-&gt;usersExports-&gt;create($request) -> ?CreateExportUsersResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export all users to a file via a long-running job.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->jobs->usersExports->create(
    new CreateExportUsersRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$connectionId:** `?string` — connection_id of the connection from which users will be exported.
    
</dd>
</dl>

<dl>
<dd>

**$format:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — Limit the number of records.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?array` — List of fields to be included in the CSV. Defaults to a predefined set of fields.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Jobs UsersImports
<details><summary><code>$client-&gt;jobs-&gt;usersImports-&gt;create($request) -> ?CreateImportUsersResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Import users from a <a href="https://auth0.com/docs/users/references/bulk-import-database-schema-examples">formatted file</a> into a connection via a long-running job. When importing users, with or without upsert, the `email_verified` is set to `false` when the email address is added or updated. Users must verify their email address. To avoid this behavior, set `email_verified` to `true` in the imported data.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->jobs->usersImports->create(
    new CreateImportUsersRequestContent([
        'users' => File::createFromString("example_users", "example_users"),
        'connectionId' => 'connection_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Jobs VerificationEmail
<details><summary><code>$client-&gt;jobs-&gt;verificationEmail-&gt;create($request) -> ?CreateVerificationEmailResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Send an email to the specified user that asks them to click a link to [verify their email address](https://auth0.com/docs/email/custom#verification-email).

Note: You must have the `Status` toggle enabled for the verification email template for the email to be sent.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->jobs->verificationEmail->create(
    new CreateVerificationEmailRequestContent([
        'userId' => 'user_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `string` — user_id of the user to send the verification email to.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — client_id of the client (application). If no value provided, the global Client ID will be used.
    
</dd>
</dl>

<dl>
<dd>

**$identity:** `?Identity` 
    
</dd>
</dl>

<dl>
<dd>

**$organizationId:** `?string` — (Optional) Organization ID – the ID of the Organization. If provided, organization parameters will be made available to the email template and organization branding will be applied to the prompt. In addition, the redirect link in the prompt will include organization_id and organization_name query string parameters.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Jobs Errors
<details><summary><code>$client-&gt;jobs-&gt;errors-&gt;get($id) -> array|GetJobGenericErrorResponseContent|null</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve error details of a failed job.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->jobs->errors->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the job.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Keys CustomSigning
<details><summary><code>$client-&gt;keys-&gt;customSigning-&gt;get() -> ?GetCustomSigningKeysResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get entire jwks representation of custom signing keys.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->customSigning->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;customSigning-&gt;set($request) -> ?SetCustomSigningKeysResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create or replace entire jwks representation of custom signing keys.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->customSigning->set(
    new SetCustomSigningKeysRequestContent([
        'keys' => [
            new CustomSigningKeyJwk([
                'kty' => CustomSigningKeyTypeEnum::Ec->value,
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$keys:** `array` — An array of custom public signing keys.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;customSigning-&gt;delete()</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete entire jwks representation of custom signing keys.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->customSigning->delete();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Keys Encryption
<details><summary><code>$client-&gt;keys-&gt;encryption-&gt;list($request) -> ?ListEncryptionKeyOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of all the encryption keys associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->encryption->list(
    new ListEncryptionKeysRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Default value is 50, maximum value is 100.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;encryption-&gt;create($request) -> ?CreateEncryptionKeyResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create the new, pre-activated encryption key, without the key material.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->encryption->create(
    new CreateEncryptionKeyRequestContent([
        'type' => CreateEncryptionKeyType::CustomerProvidedRootKey->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$type:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;encryption-&gt;rekey()</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Perform rekeying operation on the key hierarchy.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->encryption->rekey();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;encryption-&gt;get($kid) -> ?GetEncryptionKeyResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of the encryption key with the given ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->encryption->get(
    'kid',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$kid:** `string` — Encryption key ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;encryption-&gt;import($kid, $request) -> ?ImportEncryptionKeyResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Import wrapped key material and activate encryption key.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->encryption->import(
    'kid',
    new ImportEncryptionKeyRequestContent([
        'wrappedKey' => 'wrapped_key',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$kid:** `string` — Encryption key ID
    
</dd>
</dl>

<dl>
<dd>

**$wrappedKey:** `string` — Base64 encoded ciphertext of key material wrapped by public wrapping key.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;encryption-&gt;delete($kid)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete the custom provided encryption key with the given ID and move back to using native encryption key.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->encryption->delete(
    'kid',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$kid:** `string` — Encryption key ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;encryption-&gt;createPublicWrappingKey($kid) -> ?CreateEncryptionKeyPublicWrappingResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create the public wrapping key to wrap your own encryption key material.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->encryption->createPublicWrappingKey(
    'kid',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$kid:** `string` — Encryption key ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Keys Signing
<details><summary><code>$client-&gt;keys-&gt;signing-&gt;list() -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of all the application signing keys associated with your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->signing->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;signing-&gt;rotate() -> ?RotateSigningKeysResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Rotate the application signing key of your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->signing->rotate();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;signing-&gt;get($kid) -> ?GetSigningKeysResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details of the application signing key with the given ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->signing->get(
    'kid',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$kid:** `string` — Key id of the key to retrieve
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;keys-&gt;signing-&gt;revoke($kid) -> ?RevokedSigningKeysResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Revoke the application signing key with the given ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->keys->signing->revoke(
    'kid',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$kid:** `string` — Key id of the key to revoke
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Organizations ClientGrants
<details><summary><code>$client-&gt;organizations-&gt;clientGrants-&gt;list($id, $request) -> ?ListOrganizationClientGrantsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->clientGrants->list(
    'id',
    new ListOrganizationClientGrantsRequestParameters([
        'audience' => 'audience',
        'clientId' => 'client_id',
        'grantIds' => [
            'grant_ids',
        ],
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$audience:** `?string` — Optional filter on audience of the client grant.
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `?string` — Optional filter on client_id of the client grant.
    
</dd>
</dl>

<dl>
<dd>

**$grantIds:** `?string` — Optional filter on the ID of the client grant. Must be URL encoded and may be specified multiple times (max 10).<br /><b>e.g.</b> <i>../client-grants?grant_ids=id1&grant_ids=id2</i>
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;clientGrants-&gt;create($id, $request) -> ?AssociateOrganizationClientGrantResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->clientGrants->create(
    'id',
    new AssociateOrganizationClientGrantRequestContent([
        'grantId' => 'grant_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$grantId:** `string` — A Client Grant ID to add to the organization.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;clientGrants-&gt;delete($id, $grantId)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->clientGrants->delete(
    'id',
    'grant_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$grantId:** `string` — The Client Grant ID to remove from the organization
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Organizations Connections
<details><summary><code>$client-&gt;organizations-&gt;connections-&gt;list($id, $request) -> ?ListOrganizationAllConnectionsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->connections->list(
    'id',
    new ListOrganizationAllConnectionsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'isEnabled' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$isEnabled:** `?bool` — Filter connections by enabled status.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;connections-&gt;create($id, $request) -> ?CreateOrganizationAllConnectionResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->connections->create(
    'id',
    new CreateOrganizationAllConnectionRequestParameters([
        'connectionId' => 'connection_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$organizationConnectionName:** `?string` — Name of the connection in the scope of this organization.
    
</dd>
</dl>

<dl>
<dd>

**$assignMembershipOnLogin:** `?bool` — When true, all users that log in with this connection will be automatically granted membership in the organization. When false, users must be granted membership in the organization before logging in with this connection.
    
</dd>
</dl>

<dl>
<dd>

**$showAsButton:** `?bool` — Determines whether a connection should be displayed on this organization’s login prompt. Only applicable for enterprise connections. Default: true.
    
</dd>
</dl>

<dl>
<dd>

**$isSignupEnabled:** `?bool` — Determines whether organization signup should be enabled for this organization connection. Only applicable for database connections. Default: false.
    
</dd>
</dl>

<dl>
<dd>

**$organizationAccessLevel:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$isEnabled:** `?bool` — Whether the connection is enabled for the organization.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `string` — Connection identifier.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;connections-&gt;get($id, $connectionId) -> ?GetOrganizationAllConnectionResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->connections->get(
    'id',
    'connection_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `string` — Connection identifier.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;connections-&gt;delete($id, $connectionId)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->connections->delete(
    'id',
    'connection_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `string` — Connection identifier.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;connections-&gt;update($id, $connectionId, $request) -> ?UpdateOrganizationAllConnectionResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->connections->update(
    'id',
    'connection_id',
    new UpdateOrganizationConnectionRequestParameters([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `string` — Connection identifier.
    
</dd>
</dl>

<dl>
<dd>

**$organizationConnectionName:** `?string` — Name of the connection in the scope of this organization.
    
</dd>
</dl>

<dl>
<dd>

**$assignMembershipOnLogin:** `?bool` — When true, all users that log in with this connection will be automatically granted membership in the organization. When false, users must be granted membership in the organization before logging in with this connection.
    
</dd>
</dl>

<dl>
<dd>

**$showAsButton:** `?bool` — Determines whether a connection should be displayed on this organization’s login prompt. Only applicable for enterprise connections. Default: true.
    
</dd>
</dl>

<dl>
<dd>

**$isSignupEnabled:** `?bool` — Determines whether organization signup should be enabled for this organization connection. Only applicable for database connections. Default: false.
    
</dd>
</dl>

<dl>
<dd>

**$organizationAccessLevel:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$isEnabled:** `?bool` — Whether the connection is enabled for the organization.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Organizations DiscoveryDomains
<details><summary><code>$client-&gt;organizations-&gt;discoveryDomains-&gt;list($id, $request) -> ?ListOrganizationDiscoveryDomainsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve list of all organization discovery domains associated with the specified organization.
This endpoint is subject to eventual consistency; newly created, updated, or deleted discovery domains may not immediately appear in the response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->discoveryDomains->list(
    'id',
    new ListOrganizationDiscoveryDomainsRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the organization.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;discoveryDomains-&gt;create($id, $request) -> ?CreateOrganizationDiscoveryDomainResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new discovery domain for an organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->discoveryDomains->create(
    'id',
    new CreateOrganizationDiscoveryDomainRequestContent([
        'domain' => 'domain',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the organization.
    
</dd>
</dl>

<dl>
<dd>

**$domain:** `string` — The domain name to associate with the organization e.g. acme.com.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$useForOrganizationDiscovery:** `?bool` — Indicates whether this domain should be used for organization discovery.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;discoveryDomains-&gt;getByName($id, $discoveryDomain) -> ?GetOrganizationDiscoveryDomainByNameResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details about a single organization discovery domain specified by domain name.
This endpoint is subject to eventual consistency; newly created, updated, or deleted discovery domains may not immediately appear in the response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->discoveryDomains->getByName(
    'id',
    'discovery_domain',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the organization.
    
</dd>
</dl>

<dl>
<dd>

**$discoveryDomain:** `string` — Domain name of the discovery domain.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;discoveryDomains-&gt;get($id, $discoveryDomainId) -> ?GetOrganizationDiscoveryDomainResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details about a single organization discovery domain specified by ID.
This endpoint is subject to eventual consistency; newly created, updated, or deleted discovery domains may not immediately appear in the response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->discoveryDomains->get(
    'id',
    'discovery_domain_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the organization.
    
</dd>
</dl>

<dl>
<dd>

**$discoveryDomainId:** `string` — ID of the discovery domain.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;discoveryDomains-&gt;delete($id, $discoveryDomainId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove a discovery domain from an organization. This action cannot be undone. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->discoveryDomains->delete(
    'id',
    'discovery_domain_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the organization.
    
</dd>
</dl>

<dl>
<dd>

**$discoveryDomainId:** `string` — ID of the discovery domain.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;discoveryDomains-&gt;update($id, $discoveryDomainId, $request) -> ?UpdateOrganizationDiscoveryDomainResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the verification status and/or use_for_organization_discovery for an organization discovery domain. The <code>status</code> field must be either <code>pending</code> or <code>verified</code>. The <code>use_for_organization_discovery</code> field can be <code>true</code> or <code>false</code> (default: <code>true</code>).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->discoveryDomains->update(
    'id',
    'discovery_domain_id',
    new UpdateOrganizationDiscoveryDomainRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the organization.
    
</dd>
</dl>

<dl>
<dd>

**$discoveryDomainId:** `string` — ID of the discovery domain to update.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$useForOrganizationDiscovery:** `?bool` — Indicates whether this domain should be used for organization discovery.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Organizations EnabledConnections
<details><summary><code>$client-&gt;organizations-&gt;enabledConnections-&gt;list($id, $request) -> ?ListOrganizationConnectionsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details about a specific connection currently enabled for an Organization. Information returned includes details such as connection ID, name, strategy, and whether the connection automatically grants membership upon login.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->enabledConnections->list(
    'id',
    new ListOrganizationConnectionsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;enabledConnections-&gt;add($id, $request) -> ?AddOrganizationConnectionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Enable a specific connection for a given Organization. To enable a connection, it must already exist within your tenant; connections cannot be created through this action.

<a href="https://auth0.com/docs/authenticate/identity-providers">Connections</a> represent the relationship between Auth0 and a source of users. Available types of connections include database, enterprise, and social.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->enabledConnections->add(
    'id',
    new AddOrganizationConnectionRequestContent([
        'connectionId' => 'connection_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `string` — Single connection ID to add to the organization.
    
</dd>
</dl>

<dl>
<dd>

**$assignMembershipOnLogin:** `?bool` — When true, all users that log in with this connection will be automatically granted membership in the organization. When false, users must be granted membership in the organization before logging in with this connection.
    
</dd>
</dl>

<dl>
<dd>

**$isSignupEnabled:** `?bool` — Determines whether organization signup should be enabled for this organization connection. Only applicable for database connections. Default: false.
    
</dd>
</dl>

<dl>
<dd>

**$showAsButton:** `?bool` — Determines whether a connection should be displayed on this organization’s login prompt. Only applicable for enterprise connections. Default: true.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;enabledConnections-&gt;get($id, $connectionId) -> ?GetOrganizationConnectionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details about a specific connection currently enabled for an Organization. Information returned includes details such as connection ID, name, strategy, and whether the connection automatically grants membership upon login.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->enabledConnections->get(
    'id',
    'connectionId',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `string` — Connection identifier.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;enabledConnections-&gt;delete($id, $connectionId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Disable a specific connection for an Organization. Once disabled, Organization members can no longer use that connection to authenticate. 

<b>Note</b>: This action does not remove the connection from your tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->enabledConnections->delete(
    'id',
    'connectionId',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `string` — Connection identifier.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;enabledConnections-&gt;update($id, $connectionId, $request) -> ?UpdateOrganizationConnectionResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Modify the details of a specific connection currently enabled for an Organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->enabledConnections->update(
    'id',
    'connectionId',
    new UpdateOrganizationConnectionRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `string` — Connection identifier.
    
</dd>
</dl>

<dl>
<dd>

**$assignMembershipOnLogin:** `?bool` — When true, all users that log in with this connection will be automatically granted membership in the organization. When false, users must be granted membership in the organization before logging in with this connection.
    
</dd>
</dl>

<dl>
<dd>

**$isSignupEnabled:** `?bool` — Determines whether organization signup should be enabled for this organization connection. Only applicable for database connections. Default: false.
    
</dd>
</dl>

<dl>
<dd>

**$showAsButton:** `?bool` — Determines whether a connection should be displayed on this organization’s login prompt. Only applicable for enterprise connections. Default: true.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Organizations Invitations
<details><summary><code>$client-&gt;organizations-&gt;invitations-&gt;list($id, $request) -> ?ListOrganizationInvitationsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a detailed list of invitations sent to users for a specific Organization. The list includes details such as inviter and invitee information, invitation URLs, and dates of creation and expiration. To learn more about Organization invitations, review <a href="https://auth0.com/docs/manage-users/organizations/configure-organizations/invite-members">Invite Organization Members</a>. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->invitations->list(
    'id',
    new ListOrganizationInvitationsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'fields' => 'fields',
        'includeFields' => true,
        'sort' => 'sort',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — When true, return results inside an object that also contains the start and limit.  When false (default), a direct array of results is returned.  We do not yet support returning the total invitations count.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false). Defaults to true.
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?string` — Field to sort by. Use field:order where order is 1 for ascending and -1 for descending Defaults to created_at:-1.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;invitations-&gt;create($id, $request) -> ?CreateOrganizationInvitationResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a user invitation for a specific Organization. Upon creation, the listed user receives an email inviting them to join the Organization. To learn more about Organization invitations, review <a href="https://auth0.com/docs/manage-users/organizations/configure-organizations/invite-members">Invite Organization Members</a>. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->invitations->create(
    'id',
    new CreateOrganizationInvitationRequestContent([
        'inviter' => new OrganizationInvitationInviter([
            'name' => 'name',
        ]),
        'invitee' => new OrganizationInvitationInvitee([
            'email' => 'email',
        ]),
        'clientId' => 'client_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$inviter:** `OrganizationInvitationInviter` 
    
</dd>
</dl>

<dl>
<dd>

**$invitee:** `OrganizationInvitationInvitee` 
    
</dd>
</dl>

<dl>
<dd>

**$clientId:** `string` — Auth0 client ID. Used to resolve the application's login initiation endpoint.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `?string` — The id of the connection to force invitee to authenticate with.
    
</dd>
</dl>

<dl>
<dd>

**$appMetadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$userMetadata:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$ttlSec:** `?int` — Number of seconds for which the invitation is valid before expiration. If unspecified or set to 0, this value defaults to 604800 seconds (7 days). Max value: 2592000 seconds (30 days).
    
</dd>
</dl>

<dl>
<dd>

**$roles:** `?array` — List of roles IDs to associated with the user.
    
</dd>
</dl>

<dl>
<dd>

**$sendInvitationEmail:** `?bool` — Whether the user will receive an invitation email (true) or no email (false), true by default
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;invitations-&gt;get($id, $invitationId, $request) -> ?GetOrganizationInvitationResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->invitations->get(
    'id',
    'invitation_id',
    new GetOrganizationInvitationRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$invitationId:** `string` — The id of the user invitation.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false). Defaults to true.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;invitations-&gt;delete($id, $invitationId)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->invitations->delete(
    'id',
    'invitation_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$invitationId:** `string` — The id of the user invitation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Organizations Members
<details><summary><code>$client-&gt;organizations-&gt;members-&gt;list($id, $request) -> ?ListOrganizationMembersPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List organization members.
This endpoint is subject to eventual consistency. New users may not be immediately included in the response and deleted users may not be immediately removed from it.

<ul>
  <li>
    Use the <code>fields</code> parameter to optionally define the specific member details retrieved. If <code>fields</code> is left blank, all fields (except roles) are returned.
  </li>
  <li>
    Member roles are not sent by default. Use <code>fields=roles</code> to retrieve the roles assigned to each listed member. To use this parameter, you must include the <code>read:organization_member_roles</code> scope in the token.
  </li>
</ul>

This endpoint supports two types of pagination:

- Offset pagination
- Checkpoint pagination

Checkpoint pagination must be used if you need to retrieve more than 1000 organization members.

<h2>Checkpoint Pagination</h2>

To search by checkpoint, use the following parameters: - from: Optional id from which to start selection. - take: The total amount of entries to retrieve when using the from parameter. Defaults to 50. Note: The first time you call this endpoint using Checkpoint Pagination, you should omit the <code>from</code> parameter. If there are more results, a <code>next</code> value will be included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, this indicates there are no more pages remaining.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->members->list(
    'id',
    new ListOrganizationMembersRequestParameters([
        'from' => 'from',
        'take' => 1,
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;members-&gt;create($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Set one or more existing users as members of a specific <a href="https://auth0.com/docs/manage-users/organizations">Organization</a>.

To add a user to an Organization through this action, the user must already exist in your tenant. If a user does not yet exist, you can <a href="https://auth0.com/docs/manage-users/organizations/configure-organizations/invite-members">invite them to create an account</a>, manually create them through the Auth0 Dashboard, or use the Management API.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->members->create(
    'id',
    new CreateOrganizationMemberRequestContent([
        'members' => [
            'members',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$members:** `array` — List of user IDs to add to the organization as members.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;members-&gt;delete($id, $request)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->members->delete(
    'id',
    new DeleteOrganizationMembersRequestContent([
        'members' => [
            'members',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$members:** `array` — List of user IDs to remove from the organization.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Organizations Members Roles
<details><summary><code>$client-&gt;organizations-&gt;members-&gt;roles-&gt;list($id, $userId, $request) -> ?ListOrganizationMemberRolesOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve detailed list of roles assigned to a given user within the context of a specific Organization. 

Users can be members of multiple Organizations with unique roles assigned for each membership. This action only returns the roles associated with the specified Organization; any roles assigned to the user within other Organizations are not included.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->members->roles->list(
    'id',
    'user_id',
    new ListOrganizationMemberRolesRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `string` — ID of the user to associate roles with.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;members-&gt;roles-&gt;assign($id, $userId, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Assign one or more <a href="https://auth0.com/docs/manage-users/access-control/rbac">roles</a> to a user to determine their access for a specific Organization.

Users can be members of multiple Organizations with unique roles assigned for each membership. This action assigns roles to a user only for the specified Organization. Roles cannot be assigned to a user across multiple Organizations in the same call.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->members->roles->assign(
    'id',
    'user_id',
    new AssignOrganizationMemberRolesRequestContent([
        'roles' => [
            'roles',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `string` — ID of the user to associate roles with.
    
</dd>
</dl>

<dl>
<dd>

**$roles:** `array` — List of roles IDs to associated with the user.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;members-&gt;roles-&gt;delete($id, $userId, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove one or more Organization-specific <a href="https://auth0.com/docs/manage-users/access-control/rbac">roles</a> from a given user.

Users can be members of multiple Organizations with unique roles assigned for each membership. This action removes roles from a user in relation to the specified Organization. Roles assigned to the user within a different Organization cannot be managed in the same call.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organizations->members->roles->delete(
    'id',
    'user_id',
    new DeleteOrganizationMemberRolesRequestContent([
        'roles' => [
            'roles',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Organization identifier.
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `string` — User ID of the organization member to remove roles from.
    
</dd>
</dl>

<dl>
<dd>

**$roles:** `array` — List of roles IDs associated with the organization member to remove.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Prompts Rendering
<details><summary><code>$client-&gt;prompts-&gt;rendering-&gt;list($request) -> ?ListAculsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get render setting configurations for all screens.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->prompts->rendering->list(
    new ListAculsRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
        'prompt' => 'prompt',
        'screen' => 'screen',
        'renderingMode' => AculRenderingModeEnum::Advanced->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (default: true) or excluded (false).
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Maximum value is 100, default value is 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total configuration count (true) or as a direct array of results (false, default).
    
</dd>
</dl>

<dl>
<dd>

**$prompt:** `?string` — Name of the prompt to filter by
    
</dd>
</dl>

<dl>
<dd>

**$screen:** `?string` — Name of the screen to filter by
    
</dd>
</dl>

<dl>
<dd>

**$renderingMode:** `?string` — Rendering mode to filter by
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;prompts-&gt;rendering-&gt;bulkUpdate($request) -> ?BulkUpdateAculResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Learn more about [configuring render settings](https://auth0.com/docs/customize/login-pages/advanced-customizations/getting-started/configure-acul-screens) for advanced customization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->prompts->rendering->bulkUpdate(
    new BulkUpdateAculRequestContent([
        'configs' => [
            new AculConfigsItem([
                'prompt' => PromptGroupNameEnum::Login->value,
                'screen' => ScreenGroupNameEnum::Login->value,
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$configs:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;prompts-&gt;rendering-&gt;get($prompt, $screen) -> ?GetAculResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get render settings for a screen.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->prompts->rendering->get(
    PromptGroupNameEnum::Login->value,
    ScreenGroupNameEnum::Login->value,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$prompt:** `string` — Name of the prompt
    
</dd>
</dl>

<dl>
<dd>

**$screen:** `string` — Name of the screen
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;prompts-&gt;rendering-&gt;update($prompt, $screen, $request) -> ?UpdateAculResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Learn more about [configuring render settings](https://auth0.com/docs/customize/login-pages/advanced-customizations/getting-started/configure-acul-screens) for advanced customization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->prompts->rendering->update(
    PromptGroupNameEnum::Login->value,
    ScreenGroupNameEnum::Login->value,
    new UpdateAculRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$prompt:** `string` — Name of the prompt
    
</dd>
</dl>

<dl>
<dd>

**$screen:** `string` — Name of the screen
    
</dd>
</dl>

<dl>
<dd>

**$renderingMode:** `?string` — Rendering mode
    
</dd>
</dl>

<dl>
<dd>

**$contextConfiguration:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$defaultHeadTagsDisabled:** `?bool` — Override Universal Login default head tags
    
</dd>
</dl>

<dl>
<dd>

**$usePageTemplate:** `?bool` — Use page template with ACUL
    
</dd>
</dl>

<dl>
<dd>

**$headTags:** `?array` — An array of head tags
    
</dd>
</dl>

<dl>
<dd>

**$filters:** `?AculFilters` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Prompts CustomText
<details><summary><code>$client-&gt;prompts-&gt;customText-&gt;get($prompt, $language) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve custom text for a specific prompt and language.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->prompts->customText->get(
    PromptGroupNameEnum::Login->value,
    PromptLanguageEnum::Am->value,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$prompt:** `string` — Name of the prompt.
    
</dd>
</dl>

<dl>
<dd>

**$language:** `string` — Language to update.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;prompts-&gt;customText-&gt;set($prompt, $language, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Set custom text for a specific prompt. Existing texts will be overwritten.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->prompts->customText->set(
    PromptGroupNameEnum::Login->value,
    PromptLanguageEnum::Am->value,
    [
        'key' => "value",
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$prompt:** `string` — Name of the prompt.
    
</dd>
</dl>

<dl>
<dd>

**$language:** `string` — Language to update.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Prompts Partials
<details><summary><code>$client-&gt;prompts-&gt;partials-&gt;get($prompt) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get template partials for a prompt
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->prompts->partials->get(
    PartialGroupsEnum::Login->value,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$prompt:** `string` — Name of the prompt.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;prompts-&gt;partials-&gt;set($prompt, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Set template partials for a prompt
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->prompts->partials->set(
    PartialGroupsEnum::Login->value,
    [
        'key' => "value",
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$prompt:** `string` — Name of the prompt.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## RiskAssessments Settings
<details><summary><code>$client-&gt;riskAssessments-&gt;settings-&gt;get() -> ?GetRiskAssessmentsSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets the tenant settings for risk assessments
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->riskAssessments->settings->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;riskAssessments-&gt;settings-&gt;update($request) -> ?UpdateRiskAssessmentsSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates the tenant settings for risk assessments
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->riskAssessments->settings->update(
    new UpdateRiskAssessmentsSettingsRequestContent([
        'enabled' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$enabled:** `bool` — Whether or not risk assessment is enabled.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## RiskAssessments Settings NewDevice
<details><summary><code>$client-&gt;riskAssessments-&gt;settings-&gt;newDevice-&gt;get() -> ?GetRiskAssessmentsSettingsNewDeviceResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets the risk assessment settings for the new device assessor
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->riskAssessments->settings->newDevice->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;riskAssessments-&gt;settings-&gt;newDevice-&gt;update($request) -> ?UpdateRiskAssessmentsSettingsNewDeviceResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates the risk assessment settings for the new device assessor
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->riskAssessments->settings->newDevice->update(
    new UpdateRiskAssessmentsSettingsNewDeviceRequestContent([
        'rememberFor' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$rememberFor:** `int` — Length of time to remember devices for, in days.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Roles Permissions
<details><summary><code>$client-&gt;roles-&gt;permissions-&gt;list($id, $request) -> ?ListRolePermissionsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve detailed list (name, description, resource server) of permissions granted by a specified user role.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->roles->permissions->list(
    'id',
    new ListRolePermissionsRequestParameters([
        'perPage' => 1,
        'page' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the role to list granted permissions.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;roles-&gt;permissions-&gt;add($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Add one or more [permissions](https://auth0.com/docs/manage-users/access-control/configure-core-rbac/manage-permissions) to a specified user role.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->roles->permissions->add(
    'id',
    new AddRolePermissionsRequestContent([
        'permissions' => [
            new PermissionRequestPayload([
                'resourceServerIdentifier' => 'resource_server_identifier',
                'permissionName' => 'permission_name',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the role to add permissions to.
    
</dd>
</dl>

<dl>
<dd>

**$permissions:** `array` — array of resource_server_identifier, permission_name pairs.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;roles-&gt;permissions-&gt;delete($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove one or more [permissions](https://auth0.com/docs/manage-users/access-control/configure-core-rbac/manage-permissions) from a specified user role.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->roles->permissions->delete(
    'id',
    new DeleteRolePermissionsRequestContent([
        'permissions' => [
            new PermissionRequestPayload([
                'resourceServerIdentifier' => 'resource_server_identifier',
                'permissionName' => 'permission_name',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the role to remove permissions from.
    
</dd>
</dl>

<dl>
<dd>

**$permissions:** `array` — array of resource_server_identifier, permission_name pairs.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Roles Users
<details><summary><code>$client-&gt;roles-&gt;users-&gt;list($id, $request) -> ?ListRoleUsersPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve list of users associated with a specific role. For Dashboard instructions, review [View Users Assigned to Roles](https://auth0.com/docs/manage-users/access-control/configure-core-rbac/roles/view-users-assigned-to-roles).

This endpoint supports two types of pagination:

- Offset pagination
- Checkpoint pagination

Checkpoint pagination must be used if you need to retrieve more than 1000 organization members.

**Checkpoint Pagination**

To search by checkpoint, use the following parameters:

- `from`: Optional id from which to start selection.
- `take`: The total amount of entries to retrieve when using the from parameter. Defaults to 50.

**Note**: The first time you call this endpoint using checkpoint pagination, omit the `from` parameter. If there are more results, a `next` value is included in the response. You can use this for subsequent API calls. When `next` is no longer included in the response, no pages are remaining.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->roles->users->list(
    'id',
    new ListRoleUsersRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the role to retrieve a list of users associated with.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;roles-&gt;users-&gt;assign($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Assign one or more users to an existing user role. To learn more, review [Role-Based Access Control](https://auth0.com/docs/manage-users/access-control/rbac).

**Note**: New roles cannot be created through this action.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->roles->users->assign(
    'id',
    new AssignRoleUsersRequestContent([
        'users' => [
            'users',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the role to assign users to.
    
</dd>
</dl>

<dl>
<dd>

**$users:** `array` — user_id's of the users to assign the role to.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## SelfServiceProfiles CustomText
<details><summary><code>$client-&gt;selfServiceProfiles-&gt;customText-&gt;list($id, $language, $page) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves text customizations for a given self-service profile, language and Self-Service Enterprise Configuration flow page.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->selfServiceProfiles->customText->list(
    'id',
    SelfServiceProfileCustomTextLanguageEnum::En->value,
    SelfServiceProfileCustomTextPageEnum::GetStarted->value,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the self-service profile.
    
</dd>
</dl>

<dl>
<dd>

**$language:** `string` — The language of the custom text.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `string` — The page where the custom text is shown.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;selfServiceProfiles-&gt;customText-&gt;set($id, $language, $page, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates text customizations for a given self-service profile, language and Self-Service Enterprise Configuration flow page.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->selfServiceProfiles->customText->set(
    'id',
    SelfServiceProfileCustomTextLanguageEnum::En->value,
    SelfServiceProfileCustomTextPageEnum::GetStarted->value,
    [
        'key' => 'value',
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the self-service profile.
    
</dd>
</dl>

<dl>
<dd>

**$language:** `string` — The language of the custom text.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `string` — The page where the custom text is shown.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## SelfServiceProfiles SsoTicket
<details><summary><code>$client-&gt;selfServiceProfiles-&gt;ssoTicket-&gt;create($id, $request) -> ?CreateSelfServiceProfileSsoTicketResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates an access ticket to initiate the Self-Service Enterprise Configuration flow using a self-service profile.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->selfServiceProfiles->ssoTicket->create(
    'id',
    new CreateSelfServiceProfileSsoTicketRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The id of the self-service profile to retrieve
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `?string` — If provided, this will allow editing of the provided connection during the Self-Service Enterprise Configuration flow
    
</dd>
</dl>

<dl>
<dd>

**$connectionConfig:** `?SelfServiceProfileSsoTicketConnectionConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$enabledClients:** `?array` — List of client_ids that the connection will be enabled for.
    
</dd>
</dl>

<dl>
<dd>

**$enabledOrganizations:** `?array` — List of organizations that the connection will be enabled for.
    
</dd>
</dl>

<dl>
<dd>

**$ttlSec:** `?int` — Number of seconds for which the ticket is valid before expiration. If unspecified or set to 0, this value defaults to 432000 seconds (5 days).
    
</dd>
</dl>

<dl>
<dd>

**$domainAliasesConfig:** `?SelfServiceProfileSsoTicketDomainAliasesConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$provisioningConfig:** `?SelfServiceProfileSsoTicketProvisioningConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$useForOrganizationDiscovery:** `?bool` — Indicates whether a verified domain should be used for organization discovery during authentication.
    
</dd>
</dl>

<dl>
<dd>

**$enabledFeatures:** `?SelfServiceProfileSsoTicketEnabledFeatures` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;selfServiceProfiles-&gt;ssoTicket-&gt;revoke($profileId, $id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Revokes a Self-Service Enterprise Configuration access ticket and invalidates associated sessions. The ticket will no longer be accepted to initiate a Self-Service Enterprise Configuration session. If any users have already started a session through this ticket, their session will be terminated. Clients should expect a `202 Accepted` response upon successful processing, indicating that the request has been acknowledged and that the revocation is underway but may not be fully completed at the time of response. If the specified ticket does not exist, a `202 Accepted` response is also returned, signaling that no further action is required.
Clients should treat these `202` responses as an acknowledgment that the request has been accepted and is in progress, even if the ticket was not found.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->selfServiceProfiles->ssoTicket->revoke(
    'profileId',
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$profileId:** `string` — The id of the self-service profile
    
</dd>
</dl>

<dl>
<dd>

**$id:** `string` — The id of the ticket to revoke
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Tenants Settings
<details><summary><code>$client-&gt;tenants-&gt;settings-&gt;get($request) -> ?GetTenantSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve tenant settings. A list of fields to include or exclude may also be specified.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tenants->settings->get(
    new GetTenantSettingsRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$fields:** `?string` — Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;tenants-&gt;settings-&gt;update($request) -> ?UpdateTenantSettingsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update settings for a tenant.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tenants->settings->update(
    new UpdateTenantSettingsRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$changePassword:** `?TenantSettingsPasswordPage` 
    
</dd>
</dl>

<dl>
<dd>

**$deviceFlow:** `?TenantSettingsDeviceFlow` — Device Flow configuration.
    
</dd>
</dl>

<dl>
<dd>

**$guardianMfaPage:** `?TenantSettingsGuardianPage` 
    
</dd>
</dl>

<dl>
<dd>

**$defaultAudience:** `?string` — Default audience for API Authorization.
    
</dd>
</dl>

<dl>
<dd>

**$defaultDirectory:** `?string` — Name of connection used for password grants at the `/token` endpoint. The following connection types are supported: LDAP, AD, Database Connections, Passwordless, Windows Azure Active Directory, ADFS.
    
</dd>
</dl>

<dl>
<dd>

**$errorPage:** `?TenantSettingsErrorPage` 
    
</dd>
</dl>

<dl>
<dd>

**$defaultTokenQuota:** `?DefaultTokenQuota` 
    
</dd>
</dl>

<dl>
<dd>

**$flags:** `?TenantSettingsFlags` 
    
</dd>
</dl>

<dl>
<dd>

**$friendlyName:** `?string` — Friendly name for this tenant.
    
</dd>
</dl>

<dl>
<dd>

**$pictureUrl:** `?string` — URL of logo to be shown for this tenant (recommended size: 150x150)
    
</dd>
</dl>

<dl>
<dd>

**$supportEmail:** `?string` — End-user support email.
    
</dd>
</dl>

<dl>
<dd>

**$supportUrl:** `?string` — End-user support url.
    
</dd>
</dl>

<dl>
<dd>

**$allowedLogoutUrls:** `?array` — URLs that are valid to redirect to after logout from Auth0.
    
</dd>
</dl>

<dl>
<dd>

**$sessionLifetime:** `?int` — Number of hours a session will stay valid.
    
</dd>
</dl>

<dl>
<dd>

**$idleSessionLifetime:** `?int` — Number of hours for which a session can be inactive before the user must log in again.
    
</dd>
</dl>

<dl>
<dd>

**$ephemeralSessionLifetime:** `?int` — Number of hours an ephemeral (non-persistent) session will stay valid.
    
</dd>
</dl>

<dl>
<dd>

**$idleEphemeralSessionLifetime:** `?int` — Number of hours for which an ephemeral (non-persistent) session can be inactive before the user must log in again.
    
</dd>
</dl>

<dl>
<dd>

**$sandboxVersion:** `?string` — Selected sandbox version for the extensibility environment
    
</dd>
</dl>

<dl>
<dd>

**$legacySandboxVersion:** `?string` — Selected legacy sandbox version for the extensibility environment
    
</dd>
</dl>

<dl>
<dd>

**$defaultRedirectionUri:** `?string` — The default absolute redirection uri, must be https
    
</dd>
</dl>

<dl>
<dd>

**$enabledLocales:** `?array` — Supported locales for the user interface
    
</dd>
</dl>

<dl>
<dd>

**$sessionCookie:** `?SessionCookieSchema` 
    
</dd>
</dl>

<dl>
<dd>

**$sessions:** `?TenantSettingsSessions` 
    
</dd>
</dl>

<dl>
<dd>

**$oidcLogout:** `?TenantOidcLogoutSettings` 
    
</dd>
</dl>

<dl>
<dd>

**$customizeMfaInPostloginAction:** `?bool` — Whether to enable flexible factors for MFA in the PostLogin action
    
</dd>
</dl>

<dl>
<dd>

**$allowOrganizationNameInAuthenticationApi:** `?bool` — Whether to accept an organization name instead of an ID on auth endpoints
    
</dd>
</dl>

<dl>
<dd>

**$acrValuesSupported:** `?array` — Supported ACR values
    
</dd>
</dl>

<dl>
<dd>

**$mtls:** `?TenantSettingsMtls` 
    
</dd>
</dl>

<dl>
<dd>

**$pushedAuthorizationRequestsSupported:** `?bool` — Enables the use of Pushed Authorization Requests
    
</dd>
</dl>

<dl>
<dd>

**$authorizationResponseIssParameterSupported:** `?bool` — Supports iss parameter in authorization responses
    
</dd>
</dl>

<dl>
<dd>

**$skipNonVerifiableCallbackUriConfirmationPrompt:** `?bool` 

Controls whether a confirmation prompt is shown during login flows when the redirect URI uses non-verifiable callback URIs (for example, a custom URI schema such as `myapp://`, or `localhost`).
If set to true, a confirmation prompt will not be shown. We recommend that this is set to false for improved protection from malicious apps.
See https://auth0.com/docs/secure/security-guidance/measures-against-app-impersonation for more information.
    
</dd>
</dl>

<dl>
<dd>

**$resourceParameterProfile:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$clientIdMetadataDocumentSupported:** `?bool` — Whether the authorization server supports retrieving client metadata from a client_id URL.
    
</dd>
</dl>

<dl>
<dd>

**$enableAiGuide:** `?bool` — Whether Auth0 Guide (AI-powered assistance) is enabled for this tenant.
    
</dd>
</dl>

<dl>
<dd>

**$phoneConsolidatedExperience:** `?bool` — Whether Phone Consolidated Experience is enabled for this tenant.
    
</dd>
</dl>

<dl>
<dd>

**$dynamicClientRegistrationSecurityMode:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users AuthenticationMethods
<details><summary><code>$client-&gt;users-&gt;authenticationMethods-&gt;list($id, $request) -> ?ListUserAuthenticationMethodsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve detailed list of authentication methods associated with a specified user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->authenticationMethods->list(
    'id',
    new ListUserAuthenticationMethodsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the user in question.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0. Default is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Default is 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;authenticationMethods-&gt;create($id, $request) -> ?CreateUserAuthenticationMethodResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create an authentication method. Authentication methods created via this endpoint will be auto confirmed and should already have verification completed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->authenticationMethods->create(
    'id',
    new CreateUserAuthenticationMethodRequestContent([
        'type' => CreatedUserAuthenticationMethodTypeEnum::Phone->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the user to whom the new authentication method will be assigned.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — A human-readable label to identify the authentication method.
    
</dd>
</dl>

<dl>
<dd>

**$totpSecret:** `?string` — Base32 encoded secret for TOTP generation.
    
</dd>
</dl>

<dl>
<dd>

**$phoneNumber:** `?string` — Applies to phone authentication methods only. The destination phone number used to send verification codes via text and voice.
    
</dd>
</dl>

<dl>
<dd>

**$email:** `?string` — Applies to email authentication methods only. The email address used to send verification messages.
    
</dd>
</dl>

<dl>
<dd>

**$preferredAuthenticationMethod:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$keyId:** `?string` — Applies to webauthn/passkey authentication methods only. The id of the credential.
    
</dd>
</dl>

<dl>
<dd>

**$publicKey:** `?string` — Applies to webauthn/passkey authentication methods only. The public key, which is encoded as base64.
    
</dd>
</dl>

<dl>
<dd>

**$aaguid:** `?string` — Applies to passkeys only. Authenticator Attestation Globally Unique Identifier
    
</dd>
</dl>

<dl>
<dd>

**$relyingPartyIdentifier:** `?string` — Applies to webauthn authentication methods only. The relying party identifier.
    
</dd>
</dl>

<dl>
<dd>

**$credentialDeviceType:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$credentialBackedUp:** `?bool` — Applies to passkeys only. Whether the credential was backed up.
    
</dd>
</dl>

<dl>
<dd>

**$identityUserId:** `?string` — Applies to passkeys only. The ID of the user identity linked with the authentication method.
    
</dd>
</dl>

<dl>
<dd>

**$userAgent:** `?string` — Applies to passkeys only. The user-agent of the browser used to create the passkey.
    
</dd>
</dl>

<dl>
<dd>

**$userHandle:** `?string` — Applies to passkeys only. The user handle of the user identity.
    
</dd>
</dl>

<dl>
<dd>

**$transports:** `?array` — Applies to passkeys only. The transports used by clients to communicate with the authenticator.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;authenticationMethods-&gt;set($id, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Replace the specified user <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors"> authentication methods</a> with supplied values.

    <b>Note</b>: Authentication methods supplied through this action do not iterate on existing methods. Instead, any methods passed will overwrite the user&#8217s existing settings.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->authenticationMethods->set(
    'id',
    [
        new SetUserAuthenticationMethods([
            'type' => AuthenticationTypeEnum::Phone->value,
        ]),
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the user in question.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;authenticationMethods-&gt;deleteAll($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove all authentication methods (i.e., enrolled MFA factors) from the specified user account. This action cannot be undone. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->authenticationMethods->deleteAll(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the user in question.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;authenticationMethods-&gt;get($id, $authenticationMethodId) -> ?GetUserAuthenticationMethodResponseContent</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->authenticationMethods->get(
    'id',
    'authentication_method_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the user in question.
    
</dd>
</dl>

<dl>
<dd>

**$authenticationMethodId:** `string` — The ID of the authentication methods in question.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;authenticationMethods-&gt;delete($id, $authenticationMethodId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove the authentication method with the given ID from the specified user. For more information, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/manage-mfa-auth0-apis/manage-authentication-methods-with-management-api">Manage Authentication Methods with Management API</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->authenticationMethods->delete(
    'id',
    'authentication_method_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the user in question.
    
</dd>
</dl>

<dl>
<dd>

**$authenticationMethodId:** `string` — The ID of the authentication method to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;authenticationMethods-&gt;update($id, $authenticationMethodId, $request) -> ?UpdateUserAuthenticationMethodResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Modify the authentication method with the given ID from the specified user. For more information, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/manage-mfa-auth0-apis/manage-authentication-methods-with-management-api">Manage Authentication Methods with Management API</a>.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->authenticationMethods->update(
    'id',
    'authentication_method_id',
    new UpdateUserAuthenticationMethodRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — The ID of the user in question.
    
</dd>
</dl>

<dl>
<dd>

**$authenticationMethodId:** `string` — The ID of the authentication method to update.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — A human-readable label to identify the authentication method.
    
</dd>
</dl>

<dl>
<dd>

**$preferredAuthenticationMethod:** `?string` — Preferred phone authentication method
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users Authenticators
<details><summary><code>$client-&gt;users-&gt;authenticators-&gt;deleteAll($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove all authenticators registered to a given user ID, such as OTP, email, phone, and push-notification. This action cannot be undone. For more information, review [Manage Authentication Methods with Management API](https://auth0.com/docs/secure/multi-factor-authentication/manage-mfa-auth0-apis/manage-authentication-methods-with-management-api).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->authenticators->deleteAll(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users ConnectedAccounts
<details><summary><code>$client-&gt;users-&gt;connectedAccounts-&gt;list($id, $request) -> ?ListUserConnectedAccountsResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve all connected accounts associated with the user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->connectedAccounts->list(
    'id',
    new GetUserConnectedAccountsRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to list connected accounts for.
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results to return.  Defaults to 10 with a maximum of 20
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users Enrollments
<details><summary><code>$client-&gt;users-&gt;enrollments-&gt;get($id) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the first [multi-factor authentication](https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors) enrollment that a specific user has confirmed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->enrollments->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to list enrollments for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users FederatedConnectionsTokensets
<details><summary><code>$client-&gt;users-&gt;federatedConnectionsTokensets-&gt;list($id) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List active federated connections tokensets for a provided user
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->federatedConnectionsTokensets->list(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — User identifier
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;federatedConnectionsTokensets-&gt;delete($id, $tokensetId)</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->federatedConnectionsTokensets->delete(
    'id',
    'tokenset_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — Id of the user that owns the tokenset
    
</dd>
</dl>

<dl>
<dd>

**$tokensetId:** `string` — The tokenset id
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users Groups
<details><summary><code>$client-&gt;users-&gt;groups-&gt;get($id, $request) -> ?GetUserGroupsPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List all groups to which this user belongs.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->groups->get(
    'id',
    new GetUserGroupsRequestParameters([
        'fields' => 'fields',
        'includeFields' => true,
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to list groups for.
    
</dd>
</dl>

<dl>
<dd>

**$fields:** `?string` — A comma separated list of fields to include or exclude (depending on include_fields) from the result, empty to retrieve all fields
    
</dd>
</dl>

<dl>
<dd>

**$includeFields:** `?bool` — Whether specified fields are to be included (true) or excluded (false).
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users Identities
<details><summary><code>$client-&gt;users-&gt;identities-&gt;link($id, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Link two user accounts together forming a primary and secondary relationship. On successful linking, the endpoint returns the new array of the primary account identities.

Note: There are two ways of invoking the endpoint:

- With the authenticated primary account's JWT in the Authorization header, which has the `update:current_user_identities` scope:

  ```http
  POST /api/v2/users/PRIMARY_ACCOUNT_USER_ID/identities
  Authorization: "Bearer PRIMARY_ACCOUNT_JWT"
  {
    "link_with": "SECONDARY_ACCOUNT_JWT"
  }
  ```

  In this case, only the `link_with` param is required in the body, which also contains the JWT obtained upon the secondary account's authentication.

- With a token generated by the API V2 containing the `update:users` scope:

  ```http
  POST /api/v2/users/PRIMARY_ACCOUNT_USER_ID/identities
  Authorization: "Bearer YOUR_API_V2_TOKEN"
  {
    "provider": "SECONDARY_ACCOUNT_PROVIDER",
    "connection_id": "SECONDARY_ACCOUNT_CONNECTION_ID(OPTIONAL)",
    "user_id": "SECONDARY_ACCOUNT_USER_ID"
  }
  ```

  In this case you need to send `provider` and `user_id` in the body. Optionally you can also send the `connection_id` param which is suitable for identifying a particular database connection for the 'auth0' provider.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->identities->link(
    'id',
    new LinkUserIdentityRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the primary user account to link a second user account to.
    
</dd>
</dl>

<dl>
<dd>

**$provider:** `?string` — Identity provider of the secondary user account being linked.
    
</dd>
</dl>

<dl>
<dd>

**$connectionId:** `?string` — connection_id of the secondary user account being linked when more than one `auth0` database provider exists.
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `string|int|null` 
    
</dd>
</dl>

<dl>
<dd>

**$linkWith:** `?string` — JWT for the secondary account being linked. If sending this parameter, `provider`, `user_id`, and `connection_id` must not be sent.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;identities-&gt;delete($id, $provider, $userId) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Unlink a specific secondary account from a target user. This action requires the ID of both the target user and the secondary account. 

Unlinking the secondary account removes it from the identities array of the target user and creates a new standalone profile for the secondary account. To learn more, review [Unlink User Accounts](https://auth0.com/docs/manage-users/user-accounts/user-account-linking/unlink-user-accounts).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->identities->delete(
    'id',
    UserIdentityProviderEnum::Ad->value,
    'user_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the primary user account.
    
</dd>
</dl>

<dl>
<dd>

**$provider:** `string` — Identity provider name of the secondary linked account (e.g. `google-oauth2`).
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `string` — ID of the secondary linked account (e.g. `123456789081523216417` part after the `|` in `google-oauth2|123456789081523216417`).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users Logs
<details><summary><code>$client-&gt;users-&gt;logs-&gt;list($id, $request) -> ?UserListLogOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve log events for a specific user.

Note: For more information on all possible event types, their respective acronyms and descriptions, see <a href="https://auth0.com/docs/logs/log-event-type-codes">Log Event Type Codes</a>.

For more information on the list of fields that can be used in `sort`, see <a href="https://auth0.com/docs/logs/log-search-query-syntax#searchable-fields">Searchable Fields</a>.

Auth0 <a href="https://auth0.com/docs/logs/retrieve-log-events-using-mgmt-api#limitations">limits the number of logs</a> you can return by search criteria to 100 logs per request. Furthermore, you may only paginate through up to 1,000 search results. If you exceed this threshold, please redefine your search.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->logs->list(
    'id',
    new ListUserLogsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'sort' => 'sort',
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user of the logs to retrieve
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Paging is disabled if parameter not sent.
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?string` — Field to sort by. Use `fieldname:1` for ascending order and `fieldname:-1` for descending.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users Multifactor
<details><summary><code>$client-&gt;users-&gt;multifactor-&gt;invalidateRememberBrowser($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Invalidate all remembered browsers across all [authentication factors](https://auth0.com/docs/multifactor-authentication) for a user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->multifactor->invalidateRememberBrowser(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to invalidate all remembered browsers and authentication factors for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;multifactor-&gt;deleteProvider($id, $provider)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove a [multifactor](https://auth0.com/docs/multifactor-authentication) authentication configuration from a user's account. This forces the user to manually reconfigure the multi-factor provider.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->multifactor->deleteProvider(
    'id',
    UserMultifactorProviderEnum::Duo->value,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to remove a multifactor configuration from.
    
</dd>
</dl>

<dl>
<dd>

**$provider:** `string` — The multi-factor provider. Supported values 'duo' or 'google-authenticator'
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users Organizations
<details><summary><code>$client-&gt;users-&gt;organizations-&gt;list($id, $request) -> ?ListUserOrganizationsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve list of the specified user's current Organization memberships. User must be specified by user ID. For more information, review [Auth0 Organizations](https://auth0.com/docs/manage-users/organizations).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->organizations->list(
    'id',
    new ListUserOrganizationsRequestParameters([
        'page' => 1,
        'perPage' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to retrieve the organizations for.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users Permissions
<details><summary><code>$client-&gt;users-&gt;permissions-&gt;list($id, $request) -> ?ListUserPermissionsOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve all permissions associated with the user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->permissions->list(
    'id',
    new ListUserPermissionsRequestParameters([
        'perPage' => 1,
        'page' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to retrieve the permissions for.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;permissions-&gt;create($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Assign permissions to a user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->permissions->create(
    'id',
    new CreateUserPermissionsRequestContent([
        'permissions' => [
            new PermissionRequestPayload([
                'resourceServerIdentifier' => 'resource_server_identifier',
                'permissionName' => 'permission_name',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to assign permissions to.
    
</dd>
</dl>

<dl>
<dd>

**$permissions:** `array` — List of permissions to add to this user.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;permissions-&gt;delete($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove permissions from a user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->permissions->delete(
    'id',
    new DeleteUserPermissionsRequestContent([
        'permissions' => [
            new PermissionRequestPayload([
                'resourceServerIdentifier' => 'resource_server_identifier',
                'permissionName' => 'permission_name',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to remove permissions from.
    
</dd>
</dl>

<dl>
<dd>

**$permissions:** `array` — List of permissions to remove from this user.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users RiskAssessments
<details><summary><code>$client-&gt;users-&gt;riskAssessments-&gt;clear($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Clear risk assessment assessors for a specific user
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->riskAssessments->clear(
    'id',
    new ClearAssessorsRequestContent([
        'connection' => 'connection',
        'assessors' => [
            AssessorsTypeEnum::NewDevice->value,
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to clear assessors for.
    
</dd>
</dl>

<dl>
<dd>

**$connection:** `string` — The name of the connection containing the user whose assessors should be cleared.
    
</dd>
</dl>

<dl>
<dd>

**$assessors:** `array` — List of assessors to clear.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users Roles
<details><summary><code>$client-&gt;users-&gt;roles-&gt;list($id, $request) -> ?ListUserRolesOffsetPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve detailed list of all user roles currently assigned to a user.

**Note**: This action retrieves all roles assigned to a user in the context of your whole tenant. To retrieve Organization-specific roles, use the following endpoint: [Get user roles assigned to an Organization member](https://auth0.com/docs/api/management/v2/organizations/get-organization-member-roles).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->roles->list(
    'id',
    new ListUserRolesRequestParameters([
        'perPage' => 1,
        'page' => 1,
        'includeTotals' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to list roles for.
    
</dd>
</dl>

<dl>
<dd>

**$perPage:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page index of the results to return. First page is 0.
    
</dd>
</dl>

<dl>
<dd>

**$includeTotals:** `?bool` — Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;roles-&gt;assign($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Assign one or more existing user roles to a user. For more information, review [Role-Based Access Control](https://auth0.com/docs/manage-users/access-control/rbac).

**Note**: New roles cannot be created through this action. Additionally, this action is used to assign roles to a user in the context of your whole tenant. To assign roles in the context of a specific Organization, use the following endpoint: [Assign user roles to an Organization member](https://auth0.com/docs/api/management/v2/organizations/post-organization-member-roles).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->roles->assign(
    'id',
    new AssignUserRolesRequestContent([
        'roles' => [
            'roles',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to associate roles with.
    
</dd>
</dl>

<dl>
<dd>

**$roles:** `array` — List of roles IDs to associated with the user.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;roles-&gt;delete($id, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove one or more specified user roles assigned to a user.

**Note**: This action removes a role from a user in the context of your whole tenant. If you want to unassign a role from a user in the context of a specific Organization, use the following endpoint: [Delete user roles from an Organization member](https://auth0.com/docs/api/management/v2/organizations/delete-organization-member-roles).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->roles->delete(
    'id',
    new DeleteUserRolesRequestContent([
        'roles' => [
            'roles',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the user to remove roles from.
    
</dd>
</dl>

<dl>
<dd>

**$roles:** `array` — List of roles IDs to remove from the user.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users RefreshToken
<details><summary><code>$client-&gt;users-&gt;refreshToken-&gt;list($userId, $request) -> ?ListRefreshTokensPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details for a user's refresh tokens.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->refreshToken->list(
    'user_id',
    new ListRefreshTokensRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `string` — ID of the user to get refresh tokens for
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — An optional cursor from which to start the selection (exclusive).
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;refreshToken-&gt;delete($userId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete all refresh tokens for a user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->refreshToken->delete(
    'user_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `string` — ID of the user to get remove refresh tokens for
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users Sessions
<details><summary><code>$client-&gt;users-&gt;sessions-&gt;list($userId, $request) -> ?ListUserSessionsPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details for a user's sessions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->sessions->list(
    'user_id',
    new ListUserSessionsRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `string` — ID of the user to get sessions for
    
</dd>
</dl>

<dl>
<dd>

**$from:** `?string` — An optional cursor from which to start the selection (exclusive).
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;users-&gt;sessions-&gt;delete($userId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete all sessions for a user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->users->sessions->delete(
    'user_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `string` — ID of the user to get sessions for
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## VerifiableCredentials Verification Templates
<details><summary><code>$client-&gt;verifiableCredentials-&gt;verification-&gt;templates-&gt;list($request) -> ?ListVerifiableCredentialTemplatesPaginatedResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List verifiable credential templates.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->verifiableCredentials->verification->templates->list(
    new ListVerifiableCredentialTemplatesRequestParameters([
        'from' => 'from',
        'take' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `?string` — Optional Id from which to start selection.
    
</dd>
</dl>

<dl>
<dd>

**$take:** `?int` — Number of results per page. Defaults to 50.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;verifiableCredentials-&gt;verification-&gt;templates-&gt;create($request) -> ?CreateVerifiableCredentialTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a verifiable credential template.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->verifiableCredentials->verification->templates->create(
    new CreateVerifiableCredentialTemplateRequestContent([
        'name' => 'name',
        'type' => 'type',
        'dialect' => 'dialect',
        'presentation' => new MdlPresentationRequest([
            'orgIso1801351MDl' => new MdlPresentationRequestProperties([
                'orgIso1801351' => new MdlPresentationProperties([]),
            ]),
        ]),
        'wellKnownTrustedIssuers' => 'well_known_trusted_issuers',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$type:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$dialect:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$presentation:** `MdlPresentationRequest` 
    
</dd>
</dl>

<dl>
<dd>

**$customCertificateAuthority:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$wellKnownTrustedIssuers:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;verifiableCredentials-&gt;verification-&gt;templates-&gt;get($id) -> ?GetVerifiableCredentialTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a verifiable credential template.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->verifiableCredentials->verification->templates->get(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the template to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;verifiableCredentials-&gt;verification-&gt;templates-&gt;delete($id)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a verifiable credential template.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->verifiableCredentials->verification->templates->delete(
    'id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the template to retrieve.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;verifiableCredentials-&gt;verification-&gt;templates-&gt;update($id, $request) -> ?UpdateVerifiableCredentialTemplateResponseContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a verifiable credential template.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->verifiableCredentials->verification->templates->update(
    'id',
    new UpdateVerifiableCredentialTemplateRequestContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `string` — ID of the template to retrieve.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$dialect:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$presentation:** `?MdlPresentationRequest` 
    
</dd>
</dl>

<dl>
<dd>

**$wellKnownTrustedIssuers:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$version:** `?float` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

