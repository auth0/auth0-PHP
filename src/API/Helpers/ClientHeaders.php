<?php

namespace Auth0\SDK\API\Helpers;

final class ClientHeaders
{
    const API_VERSION = '5.0.0';

    private static $infoHeadersDataEnabled = true;
    private static $infoHeadersData;

    public static function setInfoHeadersData(InformationHeaders $infoHeadersData)
    {
        if (self::$infoHeadersDataEnabled) {
            self::$infoHeadersData = $infoHeadersData;
        }
    }

    public static function getInfoHeadersData()
    {
        if (!self::$infoHeadersDataEnabled) {
            return;
        }

        if (self::$infoHeadersData === null) {
            self::$infoHeadersData = new InformationHeaders();

            self::$infoHeadersData->setPackage('auth0-php', self::API_VERSION);
            self::$infoHeadersData->setEnvironment('PHP', phpversion());
        }

        return self::$infoHeadersData;
    }

    public static function disableInfoHeaders()
    {
        self::$infoHeadersDataEnabled = false;
    }
}
