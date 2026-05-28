<?php

namespace Auth0\SDK\API\Management\Types;

enum BrandingPhoneMaskingEnum: string
{
    case ShowAll = "show_all";
    case HideCountryCode = "hide_country_code";
    case MaskDigits = "mask_digits";
}
