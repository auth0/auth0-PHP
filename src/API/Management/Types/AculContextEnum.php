<?php

namespace Auth0\SDK\API\Management\Types;

enum AculContextEnum: string
{
    case BrandingSettings = "branding.settings";
    case BrandingThemesDefault = "branding.themes.default";
    case ClientLogoUri = "client.logo_uri";
    case ClientDescription = "client.description";
    case OrganizationDisplayName = "organization.display_name";
    case OrganizationBranding = "organization.branding";
    case ScreenTexts = "screen.texts";
    case TenantName = "tenant.name";
    case TenantFriendlyName = "tenant.friendly_name";
    case TenantLogoUrl = "tenant.logo_url";
    case TenantEnabledLocales = "tenant.enabled_locales";
    case UntrustedDataSubmittedFormData = "untrusted_data.submitted_form_data";
    case UntrustedDataAuthorizationParamsLoginHint = "untrusted_data.authorization_params.login_hint";
    case UntrustedDataAuthorizationParamsScreenHint = "untrusted_data.authorization_params.screen_hint";
    case UntrustedDataAuthorizationParamsUiLocales = "untrusted_data.authorization_params.ui_locales";
    case UserOrganizations = "user.organizations";
    case TransactionCustomDomainDomain = "transaction.custom_domain.domain";
}
