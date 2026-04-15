<?php

namespace Auth0\SDK\API\Management\Core\Types;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Date
{
    public const TYPE_DATE = 'date';
    public const TYPE_DATETIME = 'datetime';

    public function __construct(public string $type)
    {
    }
}
