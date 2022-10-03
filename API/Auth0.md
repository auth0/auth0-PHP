# Auth0\\SDK\\Auth0

This class serves as the main entry point for the SDK. It primarily serves as a helper class for working with authentication, managing statefulness (sessions), and factories for other classes in the SDK.

### __construct
Consumes a `Auth0\SDK\Configuration\SdkConfiguration` configuration instance. Informs all functions of the SDK on how to interact with Auth0's APIs based on your configuration.

Parameters:
- `configuration` — [SdkConfiguration](Configuration/SdkConfiguration.md) | array  
  Required. Base configuration options for the SDK.  
