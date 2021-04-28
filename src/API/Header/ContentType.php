<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Header;

class ContentType extends Header
{

    /**
     * ContentType constructor.
     *
     * @param string $contentType Content-Type to use.
     */
    public function __construct(string $contentType)
    {
        parent::__construct('Content-Type', $contentType);
    }
}
