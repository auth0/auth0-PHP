<?php

namespace Auth0SDK;

/*
 * This file is part of Auth0-PHP package.
 * 
 * (c) Auth0
 * 
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

require_once 'BaseAuth0.php';

/**
 * Basic implementation of Auth0 SDK. This class provides
 * a layer to persist user access using PHP Sessions.
 * 
 * @author Auth0
 */
class Auth0 extends BaseAuth0
{
    const BASE_NAME = 'auth0_';

    /**
     * @see Auth0SDK\BaseAuth0
     */
    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->initSession();
    }

    /**
     * This basic implementation of BaseAuth0 SDK uses
     * PHP Sessions to store volatile data.
     * 
     * @return void
     */
    private function initSession()
    {
        if (!session_id()) {
            session_set_cookie_params(60 * 60 * 24 * 7); //seven days
            session_start();
        }
    }

    /**
     * Persists $value on $_SESSION, idetified by $key.
     *
     * @see Auth0SDK\BaseAuth0
     * 
     * @param string $key
     * @param mixed $value
     */
    protected function setPersistentData($key, $value)
    {
        $this->validateKey($key);
        $key_name = $this->getSessionKeyName($key);

        $_SESSION[$key_name] = $value;
    }

    /**
     * Gets persisted values idetified by $key.
     * If the value is not setted, returns $default.
     * 
     * @see Auth0SDK\BaseAuth0
     * 
     * @param  string  $key
     * @param  mixed   $default
     * 
     * @return mixed
     */
    protected function getPersistentData($key, $default=false)
    {
        $this->validateKey($key);
        $key_name = $this->getSessionKeyName($key);

        if (isset($_SESSION[$key_name])) {
            return $_SESSION[$key_name];
        } else {
            return $default;
        }
    }

    /**
     * Removes a persisted value identified by $key.
     *
     * @see Auth0SDK\BaseAuth0
     * 
     * @param  string $key
     */
    protected function deletePersistentData($key)
    {
        $this->validateKey($key);
        $key_name = $this->getSessionKeyName($key);

        unset($_SESSION[$key_name]);
    }

    /**
     * Checks if the provided persistence $key provided
     * is valid.
     * 
     * @param  string $key
     * 
     * @throws Auth0SDK\CoreException If $key is not valid.
     */
    protected function validateKey($key) 
    {
        if (!in_array($key, self::$PERSISTANCE_MAP)) {
           throw new CoreException(sprintf('"%s" is not a valid key. Allowed keys are: %s',$key,implode(', ', self::$PERSISTANCE_MAP)));
        } else {
            return true;
        }
    }

    /**
     * Constructs a session var name.
     * 
     * @param  strign $key
     * 
     * @return string
     */
    public function getSessionKeyName($key)
    {
        return self::BASE_NAME . '_' . $this->getClientId() . '_' . $key;
    }
}