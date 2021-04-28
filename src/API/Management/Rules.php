<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Rules.
 * Handles requests to the Rules endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Rules
 *
 * @package Auth0\SDK\API\Management
 */
class Rules extends GenericResource
{
    /**
     * Get all Rules, by page if desired.
     * Required scope: `read:rules`
     *
     * @param bool|null           $enabled Retrieves rules that match the value, otherwise all rules are retrieved.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/get_rules
     */
    public function getAll(
        ?bool $enabled = null,
        ?RequestOptions $options = null
    ): ?array {
        $payload = [];

        if (null !== $enabled) {
            $payload['enabled'] = $enabled;
        }

        return $this->apiClient->method('get')
            ->addPath('rules')
            ->withParams($payload)
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
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/get_rules_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('rules', $id)
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
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/delete_rules_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('rules', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a new Rule.
     * Required scope: `create:rules`
     *
     * @param array               $name    Name of this rule.
     * @param array               $script  Code to be executed when this rule runs.
     * @param array               $query   Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|mixed
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/post_rules
     * @link https://auth0.com/docs/rules/current#create-rules-with-the-management-api
     */
    public function create(
        string $name,
        string $script,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'name' => $name,
            'script' => $script
        ] + $query;

        return $this->apiClient->method('post')
            ->addPath('rules')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a Rule by ID.
     * Required scope: `update:rules`
     *
     * @param string              $id      Rule ID to delete.
     * @param array               $query   Rule data to update.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/patch_rules_by_id
     */
    public function update(
        string $id,
        array $query,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('patch')
            ->addPath('rules', $id)
            ->withBody($query)
            ->withOptions($options)
            ->call();
    }
}
