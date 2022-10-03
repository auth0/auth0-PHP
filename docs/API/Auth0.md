# Auth0\\SDK\\Auth0

This class serves as the main entry point for the SDK. It primarily serves as a helper class for working with authentication, managing statefulness (sessions), and factories for other classes in the SDK.

### __construct
Consumes a `Auth0\SDK\Configuration\SdkConfiguration` configuration instance. Informs all functions of the SDK on how to interact with Auth0's APIs based on your configuration.

Parameters:
- `configuration` — [SdkConfiguration](Configuration/SdkConfiguration.md) | array  
  Required. Base configuration options for the SDK.  

### authentication
Create, configure, and return an instance of the [Authentication](API/Authentication.md) class.

### management
Create, configure, and return an instance of the [Management](API/Management.md) class.

### configuration
Returns the [SdkConfiguration](Configuration/SdkConfiguration.md) instance that was passed during SDK initialization.

### login
Establishes a session for the user, generates necessary code challenges, and returns a URL which your application should redirect the user through to begin the authentication flow.

Returns: (string) URL to redirect the user through.

Parameters:
- `redirectUrl` — string | null  
  Optional. URI to return to after logging out. Defaults to the SDK's configured redirectUri.  
- `params` — array | null  
  Optional. Additional parameters to include with the request.  