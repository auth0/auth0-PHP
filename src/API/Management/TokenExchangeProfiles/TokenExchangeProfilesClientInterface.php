<?php

namespace Auth0\SDK\API\Management\TokenExchangeProfiles;

use Auth0\SDK\API\Management\TokenExchangeProfiles\Requests\TokenExchangeProfilesListRequest;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\TokenExchangeProfileResponseContent;
use Auth0\SDK\API\Management\TokenExchangeProfiles\Requests\CreateTokenExchangeProfileRequestContent;
use Auth0\SDK\API\Management\Types\CreateTokenExchangeProfileResponseContent;
use Auth0\SDK\API\Management\Types\GetTokenExchangeProfileResponseContent;
use Auth0\SDK\API\Management\TokenExchangeProfiles\Requests\UpdateTokenExchangeProfileRequestContent;

interface TokenExchangeProfilesClientInterface
{
    /**
     * Retrieve a list of all Token Exchange Profiles available in your tenant.
     *
     * By using this feature, you agree to the applicable Free Trial terms in <a href="https://www.okta.com/legal/">Okta’s Master Subscription Agreement</a>. It is your responsibility to securely validate the user’s subject_token. See <a href="https://auth0.com/docs/authenticate/custom-token-exchange">User Guide</a> for more details.
     *
     * This endpoint supports Checkpoint pagination. To search by checkpoint, use the following parameters:
     * <ul>
     * <li><code>from</code>: Optional id from which to start selection.</li>
     * <li><code>take</code>: The total amount of entries to retrieve when using the from parameter. Defaults to 50.</li>
     * </ul>
     *
     * <b>Note</b>: The first time you call this endpoint using checkpoint pagination, omit the <code>from</code> parameter. If there are more results, a <code>next</code> value is included in the response. You can use this for subsequent API calls. When <code>next</code> is no longer included in the response, no pages are remaining.
     *
     * @param TokenExchangeProfilesListRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<TokenExchangeProfileResponseContent>
     */
    public function list(TokenExchangeProfilesListRequest $request = new TokenExchangeProfilesListRequest(), ?array $options = null): Pager;

    /**
     * Create a new Token Exchange Profile within your tenant.
     *
     * By using this feature, you agree to the applicable Free Trial terms in <a href="https://www.okta.com/legal/">Okta’s Master Subscription Agreement</a>. It is your responsibility to securely validate the user’s subject_token. See <a href="https://auth0.com/docs/authenticate/custom-token-exchange">User Guide</a> for more details.
     *
     * @param CreateTokenExchangeProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateTokenExchangeProfileResponseContent
     */
    public function create(CreateTokenExchangeProfileRequestContent $request, ?array $options = null): ?CreateTokenExchangeProfileResponseContent;

    /**
     * Retrieve details about a single Token Exchange Profile specified by ID.
     *
     * By using this feature, you agree to the applicable Free Trial terms in <a href="https://www.okta.com/legal/">Okta’s Master Subscription Agreement</a>. It is your responsibility to securely validate the user’s subject_token. See <a href="https://auth0.com/docs/authenticate/custom-token-exchange">User Guide</a> for more details.
     *
     * @param string $id ID of the Token Exchange Profile to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetTokenExchangeProfileResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetTokenExchangeProfileResponseContent;

    /**
     * Delete a Token Exchange Profile within your tenant.
     *
     * By using this feature, you agree to the applicable Free Trial terms in <a href="https://www.okta.com/legal/">Okta's Master Subscription Agreement</a>. It is your responsibility to securely validate the user's subject_token. See <a href="https://auth0.com/docs/authenticate/custom-token-exchange">User Guide</a> for more details.
     *
     *
     * @param string $id ID of the Token Exchange Profile to delete.
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
     * Update a Token Exchange Profile within your tenant.
     *
     * By using this feature, you agree to the applicable Free Trial terms in <a href="https://www.okta.com/legal/">Okta's Master Subscription Agreement</a>. It is your responsibility to securely validate the user's subject_token. See <a href="https://auth0.com/docs/authenticate/custom-token-exchange">User Guide</a> for more details.
     *
     *
     * @param string $id ID of the Token Exchange Profile to update.
     * @param UpdateTokenExchangeProfileRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function update(string $id, UpdateTokenExchangeProfileRequestContent $request = new UpdateTokenExchangeProfileRequestContent(), ?array $options = null): void;
}
