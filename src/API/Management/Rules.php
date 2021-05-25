<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Rules.
 * Handles requests to the Rules endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Rules
 */
class Rules extends ManagementEndpoint
{
    /**
     * Create a new Rule.
     * Required scope: `create:rules`
     *
     * @param array               $name    Name of this rule.
     * @param array               $script  Code to be executed when this rule runs.
     * @param array               $body    Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/post_rules
     * @link https://auth0.com/docs/rules/current#create-rules-with-the-management-api
     */
    public function create(
        string $name,
        string $script,
        array $body = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $payload = [
            'name' => $name,
            'script' => $script,
        ] + $body;

        return $this->apiClient->method('post')
            ->addPath('rules')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get all Rules, by page if desired.
     * Required scope: `read:rules`
     *
     * @param array               $parameters Optional. Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/get_rules
     */
    public function getAll(
        array $parameters = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('get')
            ->addPath('rules')
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get a single rule by ID.
     * Required scope: `read:rules`
     *
     * @param string              $id      Rule ID to get.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/get_rules_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('get')
            ->addPath('rules', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a Rule by ID.
     * Required scope: `update:rules`
     *
     * @param string              $id      Rule ID to delete.
     * @param array               $body    Rule data to update.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/patch_rules_by_id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');
        $this->validateArray($body, 'body');

        return $this->apiClient->method('patch')
            ->addPath('rules', $id)
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a rule by ID.
     * Required scope: `delete:rules`
     *
     * @param string              $id      Rule ID to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/delete_rules_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('delete')
            ->addPath('rules', $id)
            ->withOptions($options)
            ->call();
    }
}
