<?php
namespace Auth0\SDK\API\Management;

use Auth0\SDK\Exception\CoreException;

class Grants extends GenericResource
{
    /**
     * Get all Grants by page.
     * Required scope: "read:grants"
     *
     * @param  integer      $page     The page number to return, zero-based.
     * @param  null|integer $per_page The number of results per page, null to return all.
     * @param  array        $params
     * @return mixed|string
     * @throws \Exception
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
     * @param  $client_id
     * @param  null      $page
     * @param  null      $per_page
     * @return mixed|string
     * @throws CoreException
     * @throws \Exception
     */
    public function getByClientId($client_id, $page = null, $per_page = null)
    {
        if (empty($client_id) || ! is_string($client_id)) {
            throw new CoreException('Empty or invalid "client_id" parameter.');
        }

        return $this->getAll($page, $per_page, ['client_id' => $client_id]);
    }

    /**
     * @param  $audience
     * @param  null     $page
     * @param  null     $per_page
     * @return mixed|string
     * @throws CoreException
     * @throws \Exception
     */
    public function getByAudience($audience, $page = null, $per_page = null)
    {
        if (empty($audience) || ! is_string($audience)) {
            throw new CoreException('Empty or invalid "audience" parameter.');
        }

        return $this->getAll($page, $per_page, ['audience' => $audience]);
    }

    /**
     * @param  $user_id
     * @param  null    $page
     * @param  null    $per_page
     * @return mixed|string
     * @throws CoreException
     * @throws \Exception
     */
    public function getByUserId($user_id, $page = null, $per_page = null)
    {
        if (empty($user_id) || ! is_string($user_id)) {
            throw new CoreException('Empty or invalid "user_id" parameter.');
        }

        return $this->getAll($page, $per_page, ['user_id' => $user_id]);
    }

    /**
     * @param  $id
     * @return mixed|string
     * @throws \Exception
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

    /**
     * @param  $user_id
     * @return mixed|string
     * @throws \Exception
     */
    public function deleteUserGrants($user_id)
    {
        return $this->delete($user_id);
    }
}
