<?php

namespace Auth0\SDK\API\Management\Keys;

use Auth0\SDK\API\Management\Keys\CustomSigning\CustomSigningClientInterface;
use Auth0\SDK\API\Management\Keys\Encryption\EncryptionClientInterface;
use Auth0\SDK\API\Management\Keys\Signing\SigningClientInterface;

interface KeysClientInterface
{
    /**
     * @return CustomSigningClientInterface
     */
    public function getCustomSigning(): CustomSigningClientInterface;

    /**
     * @return EncryptionClientInterface
     */
    public function getEncryption(): EncryptionClientInterface;

    /**
     * @return SigningClientInterface
     */
    public function getSigning(): SigningClientInterface;
}
