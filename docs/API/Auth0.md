# Auth0\\SDK\\Auth0

This class serves as the main entry point for the SDK. It primarily serves as a helper class for working with authentication, managing statefulness (sessions), and factories for other classes in the SDK.

### __construct
This method acts as the consumer of a `Auth0\SDK\Configuration\SdkConfiguration` configuration instance, for informing all functions of the SDK on how to interact with Auth0's APIs.

Parameters:
- `configuration` [SdkConfiguration](Configuration/SdkConfiguration.md)|array <mark style="background: #FF5582A6;">Required.</mark> Base configuration options for the SDK.
