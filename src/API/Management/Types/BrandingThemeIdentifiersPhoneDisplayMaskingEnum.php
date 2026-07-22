<?php

namespace Auth0\SDK\API\Management\Types;

enum BrandingThemeIdentifiersPhoneDisplayMaskingEnum: string
{
    case HideCountryCode = "hide_country_code";
    case MaskDigits = "mask_digits";
    case ShowAll = "show_all";
}
