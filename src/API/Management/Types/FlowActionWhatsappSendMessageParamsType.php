<?php

namespace Auth0\SDK\API\Management\Types;

enum FlowActionWhatsappSendMessageParamsType: string
{
    case Audio = "AUDIO";
    case Contacts = "CONTACTS";
    case Document = "DOCUMENT";
    case Image = "IMAGE";
    case Interactive = "INTERACTIVE";
    case Location = "LOCATION";
    case Sticker = "STICKER";
    case Template = "TEMPLATE";
    case Text = "TEXT";
}
