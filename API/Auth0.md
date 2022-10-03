# Auth0\\SDK\\Auth0

This class serves as the main entry point for the SDK. It primarily serves as a helper class for working with authentication, managing statefulness (sessions), and factories for other classes in the SDK.

## Variables

## Methods

### __construct
Consumes a `Auth0\SDK\Configuration\SdkConfiguration` configuration instance. Informs all functions of the SDK on how to interact with Auth0's APIs based on your configuration.

Parameters:
- `configuration` — [SdkConfiguration](Configuration/SdkConfiguration.md) | array  
  Base configuration options for the SDK.  
  
---
  
### authentication
Create, configure, and return an instance of the [Authentication](API/Authentication.md) class.
  
---
  
### management
Create, configure, and return an instance of the [Management](API/Management.md) class.
  
---
  
### configuration
Returns the [SdkConfiguration](Configuration/SdkConfiguration.md) instance that was passed during SDK initialization.
  
---
  
### login
Establishes a session for the user, generates necessary code challenges, and returns a URL which your application should redirect the user through to begin the authentication flow.

Returns: (string) URL to redirect the user through.

Parameters:
- `redirectUrl` — string | null  
  Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.  
- `params` — array | null  
  Optional. Additional parameters to include with the request.  
  
---
  
### signup
Establishes a session for the user, generates necessary code challenges, and returns a URL which your application should redirect the user through to begin the authentication flow. This method is identical to `login()`, but adds the `screen_hint=signup` parameter to customize Universal Login prompts.

Returns: (string) URL to redirect the user through.

Parameters:
- `redirectUrl` — string | null  
  Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.  
- `params` — array | null  
  Optional. Additional parameters to include with the request.  
  
---
  
### logout
Deletes any persistent session data and clear out all stored properties, and return the URI to Auth0 /logout endpoint for redirection.

Returns: (string) URL to redirect the user through.

Parameters:
- `returnUrl` — string | null  
  Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.  
- `params` — array | null  
  Optional. Additional parameters to include with the request.  
  
---
  
### clear
Delete any persistent data and clear out all stored properties.

Returns: (self)

Parameters:
- `transient` — bool
  When true, data in transient storage is also cleared.  
  
---
  
### decode
Verifies and decodes an ID or access token using the properties in this class.

Returns: ([TokenInterface](Token.md)) [Token](Token.md) representing a successfully decoded ID or access token.

Parameters:
- `token` — string  
  Token to verify and decode.  
- `tokenAudience` — string[]  
  Optional. An array of allowed values for the `aud` claim. Successful if ANY match.  
- `tokenOrganization` — string[] | null  
  Optional. An array of allowed values for the `org_id` claim. Successful if ANY match.  
- `tokenNonce` — string | null  
  Optional. The value expected for the `nonce` claim.  
- `tokenMaxAge` — int | null  
  Optional. Maximum window of time in seconds since the `auth_time` to accept the token.
- `tokenLeeway` — int | null  
  Optional. Leeway in seconds to allow during time calculations. Defaults to 60.
- `tokenNow` — int | null  
  Optional. Unix timestamp representing the current point in time to use for time calculations.