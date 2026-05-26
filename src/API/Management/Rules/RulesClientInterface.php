<?php

namespace Auth0\SDK\API\Management\Rules;

use Auth0\SDK\API\Management\Rules\Requests\ListRulesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Rule;
use Auth0\SDK\API\Management\Rules\Requests\CreateRuleRequestContent;
use Auth0\SDK\API\Management\Types\CreateRuleResponseContent;
use Auth0\SDK\API\Management\Rules\Requests\GetRuleRequestParameters;
use Auth0\SDK\API\Management\Types\GetRuleResponseContent;
use Auth0\SDK\API\Management\Rules\Requests\UpdateRuleRequestContent;
use Auth0\SDK\API\Management\Types\UpdateRuleResponseContent;

interface RulesClientInterface
{
    /**
     * Retrieve a filtered list of [rules](https://auth0.com/docs/rules). Accepts a list of fields to include or exclude.
     *
     * @param ListRulesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Rule>
     */
    public function list(ListRulesRequestParameters $request = new ListRulesRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a [new rule](https://auth0.com/docs/rules#create-a-new-rule-using-the-management-api).
     *
     * Note: Changing a rule's stage of execution from the default `login_success` can change the rule's function signature to have user omitted.
     *
     * @param CreateRuleRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateRuleResponseContent
     */
    public function create(CreateRuleRequestContent $request, ?array $options = null): ?CreateRuleResponseContent;

    /**
     * Retrieve [rule](https://auth0.com/docs/rules) details. Accepts a list of fields to include or exclude in the result.
     *
     * @param string $id ID of the rule to retrieve.
     * @param GetRuleRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetRuleResponseContent
     */
    public function get(string $id, GetRuleRequestParameters $request = new GetRuleRequestParameters(), ?array $options = null): ?GetRuleResponseContent;

    /**
     * Delete a rule.
     *
     * @param string $id ID of the rule to delete.
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
     * Update an existing rule.
     *
     * @param string $id ID of the rule to retrieve.
     * @param UpdateRuleRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateRuleResponseContent
     */
    public function update(string $id, UpdateRuleRequestContent $request = new UpdateRuleRequestContent(), ?array $options = null): ?UpdateRuleResponseContent;
}
