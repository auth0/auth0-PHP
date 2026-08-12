<?php

namespace Auth0\SDK\API\Management\Flows\Vault;

use Auth0\SDK\API\Management\Flows\Vault\Connections\ConnectionsClientInterface;

interface VaultClientInterface
{
    /**
     * @return ConnectionsClientInterface
     */
    public function getConnections(): ConnectionsClientInterface;
}
