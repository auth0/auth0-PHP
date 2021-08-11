<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Rules.
 * Handles requests to the Rules endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Rules
 */
final class Rules extends ManagementEndpoint
{
    /**
     * Create a new Rule.
     * Required scope: `create:rules`
     *
     * @param string              $name    Name of this rule.
     * @param string              $script  Code to be executed when this rule runs.
     * @param array<mixed>|null   $body    Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `name` or `script` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/post_rules
     * @link https://auth0.com/docs/rules/current#create-rules-with-the-management-api
     */
    public function create(
        string $name,
        string $script,
        ?array $body = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$name, $script] = Toolkit::filter([$name, $script])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
            [$script, \Auth0\SDK\Exception\ArgumentException::missing('script')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('rules')
            ->withBody(
                (object) Toolkit::merge([
                    'name' => $name,
                    'script' => $script,
                ], $body)
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Get all Rules, by page if desired.
     * Required scope: `read:rules`
     *
     * @param array<int|string|null>|null $parameters Optional. Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null         $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/get_rules
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        return $this->getHttpClient()
            ->method('get')
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
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/get_rules_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('rules', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update a Rule by ID.
     * Required scope: `update:rules`
     *
     * @param string              $id      Rule ID to delete.
     * @param array<mixed>        $body    Rule data to update.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` or `body` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/patch_rules_by_id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
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
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Rules/delete_rules_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')
            ->addPath('rules', $id)
            ->withOptions($options)
            ->call();
    }
}
