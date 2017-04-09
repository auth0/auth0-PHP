<?php

namespace Auth0\SDK\API\Helpers;

class ClientHeaders {

    const API_VERSION  = "5.0.0";

    protected static $infoHeadersDataEnabled = true;
    protected static $infoHeadersData;

    public static function setInfoHeadersData(InformationHeaders $infoHeadersData) {
        if (!self::$infoHeadersDataEnabled) return null;

        self::$infoHeadersData = $infoHeadersData;
    }

    public static function getInfoHeadersData() {
        if (!self::$infoHeadersDataEnabled) return null;

        if (self::$infoHeadersData === null) {
            self::$infoHeadersData = new InformationHeaders;

            self::$infoHeadersData->setPackage('auth0-php', self::API_VERSION);
            self::$infoHeadersData->setEnvironment('PHP', phpversion());
        }
        return self::$infoHeadersData;
    }

    public static function disableInfoHeaders(){
        self::$infoHeadersDataEnabled = false;
    }
}