<?php
/**
 * Clients endpoints for the Management API.
 *
 * @package Auth0\SDK\API\Management
 */
namespace Auth0\SDK\API\Management;

/**
 * Class Clients.
 * Handles requests to the Clients endpoint of the v2 Management API.
 *
 * @package Auth0\SDK\API\Management
 */
class Clients extends GenericResource
{
    /**
     * Allowed app types for self::getAll().
     */
    const APP_TYPE_NATIVE = 'native';
    const APP_TYPE_NON_INTERACTIVE = 'non_interactive';
    const APP_TYPE_REGULAR_WEB = 'regular_web';
    const APP_TYPE_SPA = 'spa';

    /**
     * Get all Clients by page.
     *
     * @param null|string|array $fields         - Fields to include or exclude from the result.
     * @param null|boolean      $include_fields - True to include $fields, false to exclude $fields.
     * @param null|string       $app_type       - Application type to get, see class constants above.
     * @param integer           $page           - Page number to get, zero-based.
     * @param null|integer      $per_page       - Number of results to get, null to return the default number.
     *
     * @return mixed
     *
     * @throws \Exception
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/get_clients
     */
    public function getAll($fields = null, $include_fields = null, $app_type = null, $page = 0, $per_page = null)
    {
        $request = $this->apiClient->method('get')->addPath('clients');

        if (!empty($fields)) {
            if (is_array($fields)) {
                $fields = implode(',', $fields);
            }
            $request->withParam('fields', $fields);
        }

        if (null !== $include_fields) {
            $request->withParam('include_fields', $include_fields);
        }

        if (null !== $app_type) {
            $request->withParam('app_type', $app_type);
        }

        $request->withParam('page', abs(intval($page)));

        if (null !== $per_page) {
            $request->withParam('per_page', $per_page);
        }

        return $request->call();
    }

    /**
     * Get a single Client by ID.
     *
     * @param string            $id             - Client ID to get.
     * @param null|string|array $fields         - Fields to include or exclude, based on $include_fields parameter.
     * @param null|string|array $include_fields - Should the field(s) above be included or excluded?
     *
     * @return mixed
     *
     * @throws \Exception
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/get_clients_by_id
     */
    public function get($id, $fields = null, $include_fields = null)
    {
        $request = $this->apiClient->method('get')->addPath('clients', $id);

        if (!empty($fields)) {
            if (is_array($fields)) {
                $fields = implode(',', $fields);
            }
            $request->withParam('fields', $fields);
        }

        if (null !== $include_fields) {
            $request->withParam('include_fields', $include_fields);
        }

        return $request->call();
    }

    /**
     * Delete a client.
     *
     * @param string $id - Client ID to delete.
     *
     * @return mixed|string
     *
     * @throws \Exception
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/delete_clients_by_id
     */
    public function delete($id)
    {
        return $this->apiClient->method('delete')
            ->addPath('clients', $id)
            ->call();
    }

    /**
     * Create a new Client.
     *
     * @param array $data - Client create data.
     *
     * @return mixed|string
     *
     * @throws \Exception
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/post_clients
     */
    public function create($data)
    {
        if (empty($data['name'])) {
            throw new \Exception('Missing required "name" field.');
        }

        return $this->apiClient->method('post')
            ->addPath('clients')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Update a Client.
     *
     * @param string $id - Client ID to update
     * @param array $data - Client data to update.
     *
     * @return mixed|string
     *
     * @throws \Exception
     *
     * @link https://auth0.com/docs/api/management/v2#!/Clients/patch_clients_by_id
     */
    public function update($id, $data)
    {
        return $this->apiClient->method('patch')
            ->addPath('clients', $id)
            ->withBody(json_encode($data))
            ->call();
    }
}
