<?php

namespace Auth0\SDK\API\Management\Types;

enum EmailProviderNameEnum: string
{
    case Mailgun = "mailgun";
    case Mandrill = "mandrill";
    case Sendgrid = "sendgrid";
    case Ses = "ses";
    case Sparkpost = "sparkpost";
    case Smtp = "smtp";
    case AzureCs = "azure_cs";
    case Ms365 = "ms365";
    case Custom = "custom";
}
