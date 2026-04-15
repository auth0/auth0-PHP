<?php

namespace Auth0\SDK\API\Management\Types;

enum ConnectionStrategyEnum: string
{
    case Ad = "ad";
    case Adfs = "adfs";
    case Amazon = "amazon";
    case Apple = "apple";
    case Dropbox = "dropbox";
    case Bitbucket = "bitbucket";
    case Auth0Oidc = "auth0-oidc";
    case Auth0 = "auth0";
    case Baidu = "baidu";
    case Bitly = "bitly";
    case Box = "box";
    case Custom = "custom";
    case Daccount = "daccount";
    case Dwolla = "dwolla";
    case Email = "email";
    case EvernoteSandbox = "evernote-sandbox";
    case Evernote = "evernote";
    case Exact = "exact";
    case Facebook = "facebook";
    case Fitbit = "fitbit";
    case Github = "github";
    case GoogleApps = "google-apps";
    case GoogleOauth2 = "google-oauth2";
    case Instagram = "instagram";
    case Ip = "ip";
    case Line = "line";
    case Linkedin = "linkedin";
    case Oauth1 = "oauth1";
    case Oauth2 = "oauth2";
    case Office365 = "office365";
    case Oidc = "oidc";
    case Okta = "okta";
    case Paypal = "paypal";
    case PaypalSandbox = "paypal-sandbox";
    case Pingfederate = "pingfederate";
    case Planningcenter = "planningcenter";
    case SalesforceCommunity = "salesforce-community";
    case SalesforceSandbox = "salesforce-sandbox";
    case Salesforce = "salesforce";
    case Samlp = "samlp";
    case Sharepoint = "sharepoint";
    case Shopify = "shopify";
    case Shop = "shop";
    case Sms = "sms";
    case Soundcloud = "soundcloud";
    case Thirtysevensignals = "thirtysevensignals";
    case Twitter = "twitter";
    case Untappd = "untappd";
    case Vkontakte = "vkontakte";
    case Waad = "waad";
    case Weibo = "weibo";
    case Windowslive = "windowslive";
    case Wordpress = "wordpress";
    case Yahoo = "yahoo";
    case Yandex = "yandex";
    case Auth0Adldap = "auth0-adldap";
}
