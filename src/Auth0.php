<?php

namespace Auth0SDK;

require_once 'BaseAuth0.php';

class Auth0 extends BaseAuth0
{
    const BASE_NAME = 'auth0_';

    public function __construct(array $config)
    {
        parent::__construct($config);

        $this->initSession();
    }

    private function initSession()
    {
        if (!session_id()) {
            session_set_cookie_params(60 * 60 * 24 * 7); //seven days
            session_start();
        }
    }

    protected function setPersistentData($key, $value)
    {
        $this->validateKey($key);
        $key_name = $this->getSessionKeyName($key);

        $_SESSION[$key_name] = $value;
    }

    protected function getPersistentData($key)
    {
        $this->validateKey($key);
        $key_name = $this->getSessionKeyName($key);

        if (isset($_SESSION[$key_name])) {
            return $_SESSION[$key_name];
        } else {
            return $default;
        }
    }

    protected function deletePersistentData($key)
    {
        $this->validateKey($key);
        $key_name = $this->getSessionKeyName($key);

        unset($_SESSION[$key_name]);
    }

    protected function validateKey($key) 
    {
        if (!in_array($key, self::$PERSISTANCE_MAP)) {
           throw new CoreException(sprintf('"%s" is not a valid key. Allowed keys are: %s',$key,implode(', ', self::$PERSISTANCE_MAP)));
        } else {
            return true;
        }
    }

    public function getSessionKeyName($key)
    {
        return self::BASE_NAME . '_' . $this->getClientId() . '_' . $key;
    }
}