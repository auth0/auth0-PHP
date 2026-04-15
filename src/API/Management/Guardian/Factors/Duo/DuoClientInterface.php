<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\Duo;

use Auth0\SDK\API\Management\Guardian\Factors\Duo\Settings\SettingsClientInterface;

interface DuoClientInterface
{
    /**
     * @return SettingsClientInterface
     */
    public function getSettings(): SettingsClientInterface;
}
