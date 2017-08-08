<?php

namespace Auth0\SDK\Model\Management\Users;

use Auth0\SDK\Model\CreatableFromArray;

class User implements CreatableFromArray
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var bool
     */
    private $emailVerified;

    /**
     * @var string
     */
    private $username;

    // ...

    private function __construct()
    {
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isEmailVerified()
    {
        return $this->emailVerified;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    // ...

    /**
     * @param array $data
     *
     * @return User
     */
    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->email = $data['email'];
        $model->emailVerified = $data['email_verified'];
        $model->username = $data['username'];

        // ...

        return $model;
    }
}
