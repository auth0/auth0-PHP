<?php
namespace Auth0\SDK\API\Management;

use Auth0\SDK\Exception\CoreException;

/**
 * Class Grants
 *
 * @package Auth0\SDK\API\Management
 */
class Grants extends GenericResource
{
    /**
     * Get all Grants with pagination.
     * Required scope: "read:grants"
     *
     * @param integer      $page     Page number to return, zero-based.
     * @param null|integer $per_page Number of results per page, null to return all.
     * @param array        $params   Additional URL parameters to send.
     *
     * @return mixed
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getAll($page = 0, $per_page = null, array $params = [])
    {
        if (! empty($page)) {
            $params['page'] = abs(intval($page));
        }

        if (! empty($per_page)) {
            $params['per_page'] = abs(intval($per_page));
        }

        return $this->apiClient->method('get')
            ->addPath('grants')
            ->withDictParams($params)
            ->call();
    }

    /**
     * Get Grants by Client ID with pagination.
     * Required scope: "read:grants"
     *
     * @param string       $client_id Client ID to filter Grants.
     * @param integer      $page      Page number to return, zero-based.
     * @param null|integer $per_page  Number of results per page, null to return all.
     *
     * @return mixed
     *
     * @throws CoreException If $client_id is empty or not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getByClientId($client_id, $page = 0, $per_page = null)
    {
        if (empty($client_id) || ! is_string($client_id)) {
            throw new CoreException('Empty or invalid "client_id" parameter.');
        }

        return $this->getAll($page, $per_page, ['client_id' => $client_id]);
    }

    /**
     * Get Grants by Audience with pagination.
     * Required scope: "read:grants"
     *
     * @param string       $audience Audience to filter Grants.
     * @param integer      $page     Page number to return, zero-based.
     * @param null|integer $per_page Number of results per page, null to return all.
     *
     * @return mixed
     *
     * @throws CoreException If $audience is empty or not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getByAudience($audience, $page = null, $per_page = null)
    {
        if (empty($audience) || ! is_string($audience)) {
            throw new CoreException('Empty or invalid "audience" parameter.');
        }

        return $this->getAll($page, $per_page, ['audience' => $audience]);
    }

    /**
     * Get Grants by User ID with pagination.
     * Required scope: "read:grants"
     *
     * @param string       $user_id  User ID to filter Grants.
     * @param integer      $page     Page number to return, zero-based.
     * @param null|integer $per_page Number of results per page, null to return all.
     *
     * @return mixed
     *
     * @throws CoreException If $user_id is empty or not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getByUserId($user_id, $page = 0, $per_page = null)
    {
        if (empty($user_id) || ! is_string($user_id)) {
            throw new CoreException('Empty or invalid "user_id" parameter.');
        }

        return $this->getAll($page, $per_page, ['user_id' => $user_id]);
    }

    /**
     * Delete a grant by Grant ID or User ID.
     * Required scope: "delete:grants"
     *
     * @param string $id Grant ID to delete a single Grant or User ID to delete all Grants for a User.
     *
     * @return mixed
     *
     * @throws CoreException If $id is empty or not a string.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/delete_grants_by_id
     */
    public function delete($id)
    {
        if (empty($id) || ! is_string($id)) {
            throw new CoreException('Empty or invalid "id" parameter.');
        }

        return $this->apiClient->method('delete')
            ->addPath('grants', $id)
            ->call();
    }
}
