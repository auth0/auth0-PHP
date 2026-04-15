<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionProtocolBindingEnumSaml: string
{
    case UrnOasisNamesTcSaml20BindingsHttpPost = "urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST";
    case UrnOasisNamesTcSaml20BindingsHttpRedirect = "urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect";
}
