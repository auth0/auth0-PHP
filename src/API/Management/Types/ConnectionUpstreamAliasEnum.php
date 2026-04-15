<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionUpstreamAliasEnum: string
{
    case AcrValues = "acr_values";
    case Audience = "audience";
    case ClientId = "client_id";
    case Display = "display";
    case IdTokenHint = "id_token_hint";
    case LoginHint = "login_hint";
    case MaxAge = "max_age";
    case Prompt = "prompt";
    case Resource = "resource";
    case ResponseMode = "response_mode";
    case ResponseType = "response_type";
    case UiLocales = "ui_locales";
}
