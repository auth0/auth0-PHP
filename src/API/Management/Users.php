<?php
/**
 * Users endpoints for the Management API.
 *
 * @package Auth0\SDK\API\Management
 */
namespace Auth0\SDK\API\Management;

/**
 * Class Users.
 * Handles requests to the Users endpoint of the v2 Management API.
 *
 * @package Auth0\SDK\API\Management
 */
class Users extends GenericResource
{
    /**
     * Get a single User by ID.
     *
     * @param string $user_id - User ID to get.
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function get($user_id)
    {
        return $this->apiClient->method('get')
            ->addPath('users', $user_id)
            ->call();
    }

    /**
     * Update a User.
     *
     * @param string $user_id - User ID to update.
     * @param array $data - User data to update:
     *      - Only certain fields can be updated; see the @link below for allowed fields.
     *      - "user_metadata" and "app_metadata" fields are merged, not replaced.
     *
     * @return mixed|string
     *
     * @throws \Exception
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/patch_users_by_id
     */
    public function update($user_id, $data)
    {
        return $this->apiClient->method('patch')
            ->addPath('users', $user_id)
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Create a new User.
     *
     * @param array $data - User create data:
     *      - "connection" name field is required and limited to sms, email, & DB connections.
     *      - "phone_number" field is required by sms connections.
     *      - "email" field is required by email and DB connections.
     *      - "password" field is required by DB connections.
     *
     * @return mixed|string
     *
     * @throws \Exception
     *
     * @link https://auth0.com/docs/api/management/v2#!/Users/post_users
     */
    public function create($data)
    {
        if (empty($data['connection'])) {
            throw new \Exception('Missing required "connection" field.');
        }

        if ('sms' === $data['connection'] && empty($data['phone_number'])) {
            // "phone_number" field is required for an sms connection.
            throw new \Exception('Missing required "phone_number" field for sms connection.');
        } elseif ('sms' !== $data['connection']) {
            // "email" field is required for email and DB connections.
            if (empty($data['email'])) {
                throw new \Exception('Missing required "email" field.');
            }

            // Passwords are required for DB connections.
            if ('email' !== $data['connection'] && empty($data['password'])) {
                throw new \Exception('Missing required "password" field for DB connection.');
            }
        }

        return $this->apiClient->method('post')
            ->addPath('users')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Search all Users.
     *
     * @param array $params - Search parameters to send:
     *      - "fields", "include_fields", "page", and "per_page" keys here will override the explicit parameters.
     *      - Queries using "search_engine" set to "v2" should be migrated to v3; see migration @link below
     * @param null|string|array $fields - Fields to include or exclude from the result, empty to retrieve all fields:
     *      - Including only the fields required can speed up API calls significantly.
     *      - Arrays will be converted to comma-separated strings
     * @param null|boolean $include_fields - True to include $fields, false to exclude $fields.
     * @param null|integer $page - Page number to get, zero-based.
     * @param null|integer $per_page - Number of results to get, null to return the default number.
     *
     * @return mixed
     *
     * @throws \Exception
     *
     * @link https://auth0.com/docs/users/search/v3#migrate-from-search-engine-v2-to-v3
     * @link https://auth0.com/docs/api/management/v2#!/Users/get_users
     * @link https://auth0.com/docs/users/search/best-practices
     * @link https://auth0.com/docs/users/search/v3/query-syntax
     * @link https://auth0.com/docs/users/search/v2/query-syntax
     */
    public function getAll($params = [], $fields = null, $include_fields = null, $page = null, $per_page = null)
    {
        $params = is_array($params) ? $params : [];

        // Fields to include/exclude.
        if (!isset($params['fields']) && null !== $fields) {
            $params['fields'] = $fields;
        }
        if (isset($params['fields'])) {
            if (empty($params['fields'])) {
                unset($params['fields']);
            } else {
                if (is_array($params['fields'])) {
                    $params['fields'] = implode(',', $params['fields']);
                }
                if (null !== $include_fields) {
                    $params['include_fields'] = (bool) $include_fields;
                }
            }
        }

        // Keep existing pagination params if passed (backwards-compat), override with non-null function param if not.
        if (!isset($params['page']) && null !== $page) {
            $params['page'] = abs(intval($page));
        }
        if (!isset($params['per_page']) && null !== $per_page) {
            $params['per_page'] = abs(intval($per_page));
        }

        return $this->apiClient->method('get')
            ->addPath('users')
            ->withDictParams($params)
            ->call();
    }

    /**
     * Wrapper for self::search().
     *
     * @param array $params - Search parameters to send.
     *
     * @return mixed|string
     *
     * @throws \Exception
     *
     * @see self::getAll()
     */
    public function search($params = [])
    {
        return $this->getAll($params);
    }

    /**
     * Delete a User by ID.
     *
     * @param string $user_id - User ID to delete.
     *
     * @return mixed|string
     *
     * @throws \Exception
     */
    public function delete($user_id)
    {
        return $this->apiClient->method('delete')
            ->addPath('users', $user_id)
            ->call();
    }

    /**
     * Link one user account to another.
     *
     * @param string $user_id - User ID of the primary identity where you are linking the secondary account to.
     * @param array $data - Secondary account to link; either link_with JWT or provider, connection_id, and user_id.
     *
     * @return array - Array of the primary account identities.
     *
     * @throws \Exception
     */
    public function linkAccount($user_id, $data)
    {
        return $this->apiClient->method('post')
            ->addPath('users', $user_id)
            ->addPath('identities')
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Unlink an identity from the target user.
     *
     * @param string $user_id - User ID to unlink.
     * @param string $provider - Identity provider of the secondary linked account.
     * @param string $identity_id- The unique identifier of the secondary linked account.
     *
     * @return mixed|string
     *
     * @throws \Exception
     */
    public function unlinkAccount($user_id, $provider, $identity_id)
    {
        return $this->apiClient->method('delete')
            ->addPath('users', $user_id)
            ->addPath('identities', $provider)
            ->addPathVariable($identity_id)
            ->call();
    }

    /**
     * TODO: Deprecate, endpoint does not exist.
     *
     * @param string $user_id - User ID to unlink.
     * @param string $device_id - Device ID to unlink.
     *
     * @return mixed|string
     *
     * @throws \Exception
     */
    public function unlinkDevice($user_id, $device_id)
    {
        return $this->apiClient->method('delete')
            ->addPath('users', $user_id)
            ->addPath('devices', $device_id)
            ->call();
    }

    /**
     * Delete the multifactor provider settings for a particular user.
     * This will force user to re-configure the multifactor provider.
     * 
     * @param string $user_id - User ID with the multifactor provider to delete.
     * @param string $mfa_provider - Multifactor provider to delete
     *
     * @return mixed|string
     *
     * @throws \Exception
     */
    public function deleteMultifactorProvider($user_id, $mfa_provider)
    {
        return $this->apiClient->method('delete')
            ->addPath('users', $user_id)
            ->addPath('multifactor', $mfa_provider)
            ->call();
    }
}
