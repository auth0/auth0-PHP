<?php

namespace Auth0\SDK\API\Management\Types;

enum FormFieldFileConfigCategoryEnum: string
{
    case Audio = "AUDIO";
    case Video = "VIDEO";
    case Image = "IMAGE";
    case Document = "DOCUMENT";
    case Archive = "ARCHIVE";
}
