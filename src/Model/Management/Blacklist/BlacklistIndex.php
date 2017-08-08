<?php

namespace Auth0\SDK\Model\Management\Blacklist;

use Auth0\SDK\Model\CreatableFromArray;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class BlacklistIndex implements CreatableFromArray
{
    /**
     * @var array
     */
    private $blacklists;

    private function __construct()
    {
    }

    /**
     * @return array
     */
    public function getBlacklists()
    {
        return $this->blacklists;
    }

    /**
     * @param array $data
     *
     * @return BlacklistIndex
     */
    public static function createFromArray(array $data)
    {
        $model = new self();

        // TODO verify the correctness
        $model->blacklists = $data;

        return $model;
    }
}
