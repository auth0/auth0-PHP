<?php

namespace Auth0\SDK\API\Management\Anomaly;

use Auth0\SDK\API\Management\Anomaly\Blocks\BlocksClientInterface;

interface AnomalyClientInterface
{
    /**
     * @return BlocksClientInterface
     */
    public function getBlocks(): BlocksClientInterface;
}
