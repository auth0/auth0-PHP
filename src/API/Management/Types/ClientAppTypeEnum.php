<?php

namespace Auth0\SDK\API\Management\Types;

enum ClientAppTypeEnum: string
{
    case Native = "native";
    case Spa = "spa";
    case RegularWeb = "regular_web";
    case NonInteractive = "non_interactive";
    case ResourceServer = "resource_server";
    case ExpressConfiguration = "express_configuration";
    case Rms = "rms";
    case Box = "box";
    case Cloudbees = "cloudbees";
    case Concur = "concur";
    case Dropbox = "dropbox";
    case Mscrm = "mscrm";
    case Echosign = "echosign";
    case Egnyte = "egnyte";
    case Newrelic = "newrelic";
    case Office365 = "office365";
    case Salesforce = "salesforce";
    case Sentry = "sentry";
    case Sharepoint = "sharepoint";
    case Slack = "slack";
    case Springcm = "springcm";
    case Zendesk = "zendesk";
    case Zoom = "zoom";
    case SsoIntegration = "sso_integration";
    case Oag = "oag";
}
