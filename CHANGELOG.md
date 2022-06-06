# CHANGELOG

## [8.2.1](https://github.com/auth0/auth0-PHP/tree/8.2.1) (2022-06-06)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/8.2.0..8.2.1)

**Fixed**

- Fixed an issue in `Auth0\SDK\Configuration\SdkConfiguration` where `customDomain` was not properly formatted in some configurations, leading to inconsistencies in certain SDK functions, such as Token validation. `customDomain` is now formatted identically to `domain`. [#633](https://github.com/auth0/auth0-PHP/pull/633) ([evansims](https://github.com/evansims))

**Closed Issues**

- Resolves [#630](https://github.com/auth0/auth0-PHP/issues/630) ([barasimumatik](https://github.com/barasimumatik))

## [8.2.0](https://github.com/auth0/auth0-PHP/tree/8.2.0) (2022-04-25)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/8.1.0..8.2.0)

Many thanks to our community contributors for this release: [elbebass](https://github.com/elbebass), [fullstackfool](https://github.com/fullstackfool), [jeromefitzpatrick](https://github.com/jeromefitzpatrick), [marko-ilic](https://github.com/marko-ilic) and [sepiariver](https://github.com/sepiariver).

**Added**

- Add bearer token extraction helper, `Auth0\SDK\Auth0::getBearerToken()` [#620](https://github.com/auth0/auth0-PHP/pull/620) ([evansims](https://github.com/evansims))
- Add configuration strategy constants, e.g. `Auth0\SDK\Configuration\SdkConfiguration::STRATEGY_API` [#619](https://github.com/auth0/auth0-PHP/pull/619) ([evansims](https://github.com/evansims))

**Changed**

- Throw `Auth0\SDK\Exception\InvalidTokenException` on JsonException [#614](https://github.com/auth0/auth0-PHP/pull/614) ([marko-ilic](https://github.com/marko-ilic))
- Throw `Auth0\SDK\Exception\NetworkException` when Management API credential exchange fails [#608](https://github.com/auth0/auth0-PHP/pull/608) ([sepiariver](https://github.com/sepiariver))

**Documentation Contributions**

- Correct the new method name for get_authorize_link() for 8.x in UPGRADE.md [#623](https://github.com/auth0/auth0-PHP/pull/623) ([jeromefitzpatrick](https://github.com/jeromefitzpatrick))
- Remove PHP 7.3 README note (deprecated) [#610](https://github.com/auth0/auth0-PHP/pull/610) ([evansims](https://github.com/evansims))
- Update CONTRIBUTING.md guidance [#609](https://github.com/auth0/auth0-PHP/pull/609) ([sepiariver](https://github.com/sepiariver))
- Update README.md guidance on `management` configuration strategy (`domain` is required) [#604](https://github.com/auth0/auth0-PHP/pull/604) ([fullstackfool](https://github.com/fullstackfool))
- Correct README.md typos in Management API example [#602](https://github.com/auth0/auth0-PHP/pull/602) ([elbebass](https://github.com/elbebass))

**Other Improvements**

- Relax `pestphp/pest-plugin-parallel` dev dependency from `^0.2` to `^0.2 || ^1.0` [#617](https://github.com/auth0/auth0-PHP/pull/617)
- Bump `firebase/php-jwt` dev dependency to `^6.0` [#613](https://github.com/auth0/auth0-PHP/pull/613) ([evansims](https://github.com/evansims))
- Add Semgrep to continous integration test suite [#616](https://github.com/auth0/auth0-PHP/pull/616) ([evansims](https://github.com/evansims))

## [8.1.0](https://github.com/auth0/auth0-PHP/tree/8.1.0) (2022-02-17)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/8.0.6..8.1.0)

**Added**

- Add Attack Protection endpoints [#593](https://github.com/auth0/auth0-PHP/pull/597) ([evansims](https://github.com/evansims))

## [8.0.6](https://github.com/auth0/auth0-PHP/tree/8.0.6) (2022-01-25)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/8.0.5..8.0.6)

**Fixed**

- Auth0->renew(): now correctly updates all appropriate session details after a successful token refresh [#593](https://github.com/auth0/auth0-PHP/pull/593) ([evansims](https://github.com/evansims))

## [8.0.5](https://github.com/auth0/auth0-PHP/tree/8.0.5) (2022-01-04)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/8.0.4..8.0.5)

**Fixed**

- Auth0->exchange(): optimize setcookie() calls [#591](https://github.com/auth0/auth0-PHP/pull/591) ([Nebual](https://github.com/Nebual))

## [8.0.4](https://github.com/auth0/auth0-PHP/tree/8.0.4) (2021-12-13)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/8.0.3...8.0.4)

**Fixed**

- Require `domain` configuration for `management` strategy [#589](https://github.com/auth0/auth0-PHP/pull/589) ([evansims](https://github.com/evansims))

**Documentation**
- Update UPGRADE.md with additional notes about `Auth0::login()` changes from v7. [#585](https://github.com/auth0/auth0-PHP/pull/585) ([BGehrels](https://github.com/BGehrels))
- Update UPGRADE.md with additional notes about `Auth0::exchange()` changes from v7. [#584](https://github.com/auth0/auth0-PHP/pull/584) ([BGehrels](https://github.com/BGehrels))

**Tests**

- Add Semgrep to test suite [#588](https://github.com/auth0/auth0-PHP/pull/588) ([evansims](https://github.com/evansims))
- Upgrade test suite to use 8.1 GA (up from RC builds) [#587](https://github.com/auth0/auth0-PHP/pull/587) ([evansims](https://github.com/evansims))
- Fix warnings introduced in new Psalm update [#586](https://github.com/auth0/auth0-PHP/pull/586) ([evansims](https://github.com/evansims))

## [8.0.3](https://github.com/auth0/auth0-PHP/tree/8.0.3) (2021-11-01)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/8.0.2...8.0.1)

**Changes**

- Introduce Interfaces to Final Classes [#581](https://github.com/auth0/auth0-PHP/pull/581) ([komando82](https://github.com/komando82))

## [8.0.2](https://github.com/auth0/auth0-PHP/tree/8.0.2) (2021-10-18)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/8.0.1...8.0.2)

**Fixed**

- Resolve `SessionStore::purge()` not iterating over session storage when a falsey value is stored [#577](https://github.com/auth0/auth0-PHP/pull/577) ([evansims](https://github.com/evansims))

## [8.0.1](https://github.com/auth0/auth0-PHP/tree/8.0.1) (2021-09-23)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/8.0.0...8.0.1)

**Fixed**

- Simplify decoding of Access Tokens via `Auth0::decode()` [#534](https://github.com/auth0/auth0-PHP/pull/571) ([shadowhand](https://github.com/shadowhand))

## [8.0.0](https://github.com/auth0/auth0-PHP/tree/8.0.0) (2021-09-20)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.9.0...8.0.0)

**BEFORE YOU UPGRADE**

- This is a major release that includes breaking changes. Please see [UPGRADE.md](UPGRADE.md) before upgrading. This release will require changes to your application.
- The SDK no longer specifically relies on Guzzle for network requests. Options for supplying your libraries of choice have been added through [PSR-18](https://www.php-fig.org/psr/psr-18/) and [PSR-17](https://www.php-fig.org/psr/psr-17/) configuration options.
- PHP 7.4 is now the minimum supported PHP version, but we encourage using PHP 8.0. PHP 7.4 will be the last supported 7.x release. This library follows [the official support schedule for PHP](https://www.php.net/supported-versions.php).

**8.0 Highlights**

- Updated SDK API for more intuitive use and improved usability. Now follows fluent interface principles.
- Updated SDK API designed with PHP 8.0's named arguments as the encouraged interface method.
- New configuration object, SdkConfiguration, allows for dynamic changes within your application.
- Updated PHP language support, including typed properties and return types, are now used throughout the SDK.
- Added support for the following PHP-FIG standards interfaces:
  - [PSR-6](https://www.php-fig.org/psr/psr-6/) caches are now used for caching JWKs and Management API tokens.
  - [PSR-7](https://www.php-fig.org/psr/psr-7/) HTTP messages are now returned by methods that initiate network requests.
  - [PSR-14](https://www.php-fig.org/psr/psr-14/) events are now raised, allowing for deeper integration into the SDK's behavior.
  - [PSR-17](https://www.php-fig.org/psr/psr-17/) HTTP factories are now used during network requests for generating PSR-7 messages.
  - [PSR-18](https://www.php-fig.org/psr/psr-18/) HTTP clients are now supported, allowing you to choose your network client.
- Improved Token handling system.
- Encrypted session cookies, with cookies being the default session handler. PHP sessions may be phased out in a future release.
- New Management API auto-pagination helper for iterating through API results.
- [PKCE](https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce) is now enabled by default.

For a complete overview of API changes, please see [UPGRADE.md](UPGRADE.md).

For guidance on using the new configuration interface or SDK API, please see [README.md](README.md).

## [8.0.0-BETA3](https://github.com/auth0/auth0-PHP/tree/8.0.0-BETA3) (2021-09-03)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.9.0...8.0.0-BETA3)

**Changes Since BETA2**

- Cookie namespace prefixes are now configurable from `SdkConfiguration` interface. [#534](https://github.com/auth0/auth0-PHP/pull/534) ([Nyholm](https://github.com/Nyholm))
- Improvements to and standardization of variable filtering rules. [#535](https://github.com/auth0/auth0-PHP/pull/535) ([evansims](https://github.com/evansims))
- Fixed Management API calls incorrectly converted child arrays into objects. [#541](https://github.com/auth0/auth0-PHP/pull/541) ([evansims](https://github.com/evansims))
- Fixed explicit `SdkConfiguration` object reference passing on arguments. [#548](https://github.com/auth0/auth0-PHP/pull/548) ([Nyholm](https://github.com/Nyholm))
- Performance improvements to session/cookie transient storage. [#542](https://github.com/auth0/auth0-PHP/pull/542) ([evansims](https://github.com/evansims))
- Add new `MemoryStore` storage medium for tests. [#544](https://github.com/auth0/auth0-PHP/pull/544) ([Nyholm](https://github.com/Nyholm))
- Add new `Psr6Store` storage medium. [#549](https://github.com/auth0/auth0-PHP/pull/549) ([Nyholm](https://github.com/Nyholm))
- Delay restoring session state (no longer occurs during constructor initialization; now just-in-time.) [#550](https://github.com/auth0/auth0-PHP/pull/550) ([evansims](https://github.com/evansims))
- Improve support for custom domains with new `customDomain` option in `SdkConfiguration` [#554](https://github.com/auth0/auth0-PHP/pull/554) ([evansims](https://github.com/evansims))
- Support for Actions API endpoints in Management SDK [#551](https://github.com/auth0/auth0-PHP/pull/551) ([evansims](https://github.com/evansims))
- Expand test coverage to 100% and transition to PEST test framework [#552](https://github.com/auth0/auth0-PHP/pull/552) ([evansims](https://github.com/evansims))

## [8.0.0-BETA2](https://github.com/auth0/auth0-PHP/tree/8.0.0-BETA2) (2021-08-06)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.9.0...8.0.0-BETA2)

**Changes Since BETA1**

- `Auth0\SDK\API\Management` endpoint factory magic methods documented for proper IDE hinting.
- `Auth0\SDK\API\Authentication` and `Auth0\SDK\API\Management` create their HTTP client instances as needed when `getHttpClient()` is invoked, rather than at class initialization.
- `Auth0\SDK\Configuration\SdkConfiguration` now supports passing a `strategy` option to customize what configuration options are necessary at initialization appropriate for different use cases. Defaults to the general use `webapp` with the same configuration requirements as previously used. See the `README` for more information.
- `Auth0\SDK\Utility\HttpRequest` now intercepts `429` rate-limit errors from Auth0 API responses and will automatically retry these requests on your behalf, using an exponential backoff strategy. Defaults to 3 retry attempts, configurable with `httpMaxRetires` during SDK configuration up to 10, or 0 to opt-out of this behavior.

## [7.9.2](https://github.com/auth0/auth0-PHP/tree/7.9.2) (2021-08-03)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.9.1...7.9.2)

**Fixed**

- Add missing API2 POST /tickets/password-change params [\#523](https://github.com/auth0/auth0-PHP/pull/523) ([evansims](https://github.com/evansims))

## [7.9.1](https://github.com/auth0/auth0-PHP/tree/7.9.1) (2021-07-06)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.9.0...7.9.1)

**Fixed**

- Replace deprated/removed GuzzleHttp\Psr7\build_query [\#500](https://github.com/auth0/auth0-PHP/pull/500) ([bartvanraaij](https://github.com/bartvanraaij))

## [8.0.0-BETA1](https://github.com/auth0/auth0-PHP/tree/8.0.0-BETA1) (2021-06-30)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.9.0...8.0.0-BETA1)

**BEFORE YOU UPGRADE**

- This is a major release that includes breaking changes. Please see [UPGRADE.md](UPGRADE.md) before upgrading. This release will require changes to your application.
- The SDK no longer specifically relies on Guzzle for network requests. Options for supplying your libraries of choice have been added through [PSR-18](https://www.php-fig.org/psr/psr-18/) and [PSR-17](https://www.php-fig.org/psr/psr-17/) configuration options.
- PHP 7.4 is now the minimum supported PHP version, but we encourage using PHP 8.0. PHP 7.4 will be the last supported 7.x release. This library follows [the official support schedule for PHP](https://www.php.net/supported-versions.php).

**8.0 Highlights**

- Updated SDK API for more intuitive use and improved usability. Now follows fluent interface principles.
- Updated SDK API designed with PHP 8.0's named arguments as the encouraged interface method.
- New configuration object, SdkConfiguration, allows for dynamic changes within your application.
- Updated PHP language support, including typed properties and return types, are now used throughout the SDK.
- Added support for the following PHP-FIG standards interfaces:
  - [PSR-6](https://www.php-fig.org/psr/psr-6/) caches are now used for caching JWKs and Management API tokens.
  - [PSR-7](https://www.php-fig.org/psr/psr-7/) HTTP messages are now returned by methods that initiate network requests.
  - [PSR-14](https://www.php-fig.org/psr/psr-14/) events are now raised, allowing for deeper integration into the SDK's behavior.
  - [PSR-17](https://www.php-fig.org/psr/psr-17/) HTTP factories are now used during network requests for generating PSR-7 messages.
  - [PSR-18](https://www.php-fig.org/psr/psr-18/) HTTP clients are now supported, allowing you to choose your network client.
- Improved Token handling system.
- Encrypted session cookies, with cookies being the default session handler. PHP sessions may be phased out in a future release.
- New Management API auto-pagination helper for iterating through API results.
- [PKCE](https://auth0.com/docs/flows/call-your-api-using-the-authorization-code-flow-with-pkce) is now enabled by default.

For a complete overview of API changes, please see [UPGRADE.md](UPGRADE.md).

For guidance on using the new configuration interface or SDK API, please see [README.md](README.md).

## [7.9.0](https://github.com/auth0/auth0-PHP/tree/7.9.0) (2021-05-03)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.8.0...7.9.0)

**Changed**

- Reintroduce Guzzle 6 support [\#489](https://github.com/auth0/auth0-PHP/pull/489) ([marko-ilic](https://github.com/marko-ilic))
- Update Auth0\SDK\Auth0::getState() visibility to public [\#498](https://github.com/auth0/auth0-PHP/pull/498) ([evansims](https://github.com/evansims))

## [7.8.0](https://github.com/auth0/auth0-PHP/tree/7.8.0) (2021-03-19)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.7.0...7.8.0)

This release expands Organizations support to the Management API client. Please see the README for details on Organizations, currently in closed beta testing.

**Added**

- Add Organizations support to Management API Client [\#483](https://github.com/auth0/auth0-PHP/pull/483) ([evansims](https://github.com/evansims))

## [7.7.0](https://github.com/auth0/auth0-PHP/tree/7.7.0) (2021-03-19)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.6.2...7.7.0)

This release includes initial support for Organizations, a new feature from Auth0 currently in closed beta testing. Please see the updated README for usage instructions.

**Added**

- Add Organizations support to Authentication API Client [\#482](https://github.com/auth0/auth0-PHP/pull/482) ([evansims](https://github.com/evansims))

**Changed**

- Support client_id on /tickets/password-change [\#481](https://github.com/auth0/auth0-PHP/pull/481) ([evansims](https://github.com/evansims))

## [7.6.2](https://github.com/auth0/auth0-PHP/tree/7.6.2) (2021-01-01)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.6.1...7.6.2)

**Fixed**

- Ensure ?include_totals are handled properly on GET /users and GET /roles requests for Management API [\#476](https://github.com/auth0/auth0-PHP/pull/476) ([evansims](https://github.com/evansims))

## [7.6.1](https://github.com/auth0/auth0-PHP/tree/7.6.1) (2021-01-01)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.6.0...7.6.1)

This hotfix addresses an issue with a dependency reference.

## [7.6.0](https://github.com/auth0/auth0-PHP/tree/7.6.0) (2021-01-01)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.5.0...7.6.0)

SDK 7.6 introduces support for [the newly released PHP 8.0](https://www.php.net/releases/8.0/en.php) and drops supported for PHP 7.1 and 7.2 (which have reached their end of support cycles.) Please ensure you are running [supported versions of PHP](https://www.php.net/supported-versions.php) in your environments.

**Added**

- PHP 8.0 support [\#467](https://github.com/auth0/auth0-PHP/pull/467) ([evansims](https://github.com/evansims))
- Static code analysis [#470](https://github.com/auth0/auth0-PHP/pull/470) ([FrontEndCoffee](https://github.com/FrontEndCoffee))

## [7.5.0](https://github.com/auth0/auth0-PHP/tree/7.5.0) (2020-11-16)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.4.0...7.5.0)

**Closed issues**

- createPasswordChangeTicket doesn't support 'ttl_sec' parameter [\#457](https://github.com/auth0/auth0-PHP/issues/457)
- Make the CACHE_TTL used in the JWKFetcher configurable. [\#450](https://github.com/auth0/auth0-PHP/issues/450)
- Allow programmatic clearing of cache values managed by Auth0Service [\#441](https://github.com/auth0/auth0-PHP/issues/441)

**Added**

- Add support for Authorization Code Flow with PKCE [\#449](https://github.com/auth0/auth0-PHP/pull/449) ([ls-youssef-jlidat](https://github.com/ls-youssef-jlidat))
- Allow specifying TTL when creating password change tickets [#463](https://github.com/auth0/auth0-PHP/pull/463) ([evansims](https://github.com/evansims))
- Expand control over TTL/Caching in JWKFetcher [#462](https://github.com/auth0/auth0-PHP/pull/462) ([evansims](https://github.com/evansims))
- Add support for Management V2 users export job endpoint [#461](https://github.com/auth0/auth0-PHP/pull/461) ([evansims](https://github.com/evansims))

## [7.4.0](https://github.com/auth0/auth0-PHP/tree/7.4.0) (2020-09-28)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.3.0...7.4.0)

**Added**

- Add support for new identity field for email verifications [\#455](https://github.com/auth0/auth0-PHP/pull/455) ([jimmyjames](https://github.com/jimmyjames))

## [7.3.0](https://github.com/auth0/auth0-PHP/tree/7.3.0) (2020-08-27)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.2.0...7.3.0)

**Closed issues**

- TokenVerifier::verify throws a \RuntimeException instead of an InvalidTokenException [\#438](https://github.com/auth0/auth0-PHP/issues/438)
- Support Guzzle 7 [\#421](https://github.com/auth0/auth0-PHP/issues/421)

**Added**

- Add Support for Log Streams Management APIs [\#451](https://github.com/auth0/auth0-PHP/pull/451) ([jimmyjames](https://github.com/jimmyjames))
- Update composer requirements to support guzzle ~7.0 [\#443](https://github.com/auth0/auth0-PHP/pull/443) ([banderon1](https://github.com/banderon1))

**Fixed**

- Throw InvalidTokenException instead of RuntimeException when parsing malformed token [\#439](https://github.com/auth0/auth0-PHP/pull/439) ([B-Galati](https://github.com/B-Galati))

## [7.2.0](https://github.com/auth0/auth0-PHP/tree/7.2.0) (2020-04-23)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.1.0...7.2.0)

**Closed issues**

- Renew Tokens throws nonce error [\#432](https://github.com/auth0/auth0-PHP/issues/432)
- email_passwordless_start not setting client_secret [\#431](https://github.com/auth0/auth0-PHP/issues/431)

**Added**

- /passwordless/start accepts client_secret now [\#430](https://github.com/auth0/auth0-PHP/pull/430) ([abbaspour](https://github.com/abbaspour))

**Fixed**

- Allow no nonce option [\#434](https://github.com/auth0/auth0-PHP/pull/434) ([joshcanhelp](https://github.com/joshcanhelp))

## [7.1.0](https://github.com/auth0/auth0-PHP/tree/7.1.0) (2020-02-19)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/7.0.0...7.1.0)

**Closed issues**

- Authorized Party (azp) claim mismatch in the ID token [\#422](https://github.com/auth0/auth0-PHP/issues/422)
- JWTVerifier alternatives [\#419](https://github.com/auth0/auth0-PHP/issues/419)
- Consider to customize the jwks path [\#417](https://github.com/auth0/auth0-PHP/issues/417)

**Added**

- Add TokenVerifier for non-OIDC-compliant JWTs [\#428](https://github.com/auth0/auth0-PHP/pull/428) ([joshcanhelp](https://github.com/joshcanhelp))
- Add signing key rotation and custom JWKS URI support [\#426](https://github.com/auth0/auth0-PHP/pull/426) ([joshcanhelp](https://github.com/joshcanhelp))
- Add Client ID to verification email method [\#423](https://github.com/auth0/auth0-PHP/pull/423) ([joshcanhelp](https://github.com/joshcanhelp))

## [7.0.0](https://github.com/auth0/auth0-PHP/tree/7.0.0) (2020-01-15)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.7.0...7.0.0)

**BEFORE YOU UPGRADE**

This is a major release with several breaking changes. Please see the [v5 to v7 migration guide here](https://github.com/auth0/auth0-PHP/blob/master/UPGRADE.md) before you upgrade.

**Added**

- Add types for StoreInterface and implementors; add back EmptyStore [\#414](https://github.com/auth0/auth0-PHP/pull/414) ([joshcanhelp](https://github.com/joshcanhelp))
- Add select Guardian management endpoints [\#412](https://github.com/auth0/auth0-PHP/pull/412) ([joshcanhelp](https://github.com/joshcanhelp))
- Add Auth0->decodeIdToken() method for ID token decoding by deps [\#410](https://github.com/auth0/auth0-PHP/pull/410) ([joshcanhelp](https://github.com/joshcanhelp))
- Add SameSite cookie attribute handling [\#400](https://github.com/auth0/auth0-PHP/pull/400) ([joshcanhelp](https://github.com/joshcanhelp))
- Nonce and max_age handling with new CookieStore class [\#395](https://github.com/auth0/auth0-PHP/pull/395) ([joshcanhelp](https://github.com/joshcanhelp))

**Changed**

- Convert caching to PSR-16 interface [\#403](https://github.com/auth0/auth0-PHP/pull/403) ([joshcanhelp](https://github.com/joshcanhelp))
- Move AuthorizationBearer to new namespace [\#402](https://github.com/auth0/auth0-PHP/pull/402) ([joshcanhelp](https://github.com/joshcanhelp))
- Improve transient authorization data handling [\#397](https://github.com/auth0/auth0-PHP/pull/397) ([joshcanhelp](https://github.com/joshcanhelp))
- Cleanup Auth0 class constructor for clarification and better defaults [\#394](https://github.com/auth0/auth0-PHP/pull/394) ([joshcanhelp](https://github.com/joshcanhelp))
- Change client secret requirements [\#390](https://github.com/auth0/auth0-PHP/pull/390) ([joshcanhelp](https://github.com/joshcanhelp))
- Improved OIDC compliance [\#386](https://github.com/auth0/auth0-PHP/pull/386) ([joshcanhelp](https://github.com/joshcanhelp))
- Update minimum PHP from 5.5 to 7.1 [\#377](https://github.com/auth0/auth0-PHP/pull/377) ([joshcanhelp](https://github.com/joshcanhelp))

**Removed**

- Remove future iat check [\#411](https://github.com/auth0/auth0-PHP/pull/411) ([joshcanhelp](https://github.com/joshcanhelp))
- Remove Firebase JWT library [\#396](https://github.com/auth0/auth0-PHP/pull/396) ([joshcanhelp](https://github.com/joshcanhelp))
- Remove session cookie expiration option [\#389](https://github.com/auth0/auth0-PHP/pull/389) ([joshcanhelp](https://github.com/joshcanhelp))
- Remove deprecated Authentication methods and add types [\#385](https://github.com/auth0/auth0-PHP/pull/385) ([joshcanhelp](https://github.com/joshcanhelp))
- Remove deprecated JWKS methods and adjust tests [\#384](https://github.com/auth0/auth0-PHP/pull/384) ([joshcanhelp](https://github.com/joshcanhelp))
- Remove deprecated M-API methods [\#383](https://github.com/auth0/auth0-PHP/pull/383) ([joshcanhelp](https://github.com/joshcanhelp))
- Remove deprecated InformationHeaders methods and add types [\#382](https://github.com/auth0/auth0-PHP/pull/382) ([joshcanhelp](https://github.com/joshcanhelp))
- Remove deprecated methods and add types to RequestBuilder [\#381](https://github.com/auth0/auth0-PHP/pull/381) ([joshcanhelp](https://github.com/joshcanhelp))
- Remove deprecated token generator [\#380](https://github.com/auth0/auth0-PHP/pull/380) ([joshcanhelp](https://github.com/joshcanhelp))
- Remove deprecated legacy classes [\#379](https://github.com/auth0/auth0-PHP/pull/379) ([joshcanhelp](https://github.com/joshcanhelp))
- Update management props [\#378](https://github.com/auth0/auth0-PHP/pull/378) ([joshcanhelp](https://github.com/joshcanhelp))

## [5.7.0](https://github.com/auth0/auth0-PHP/tree/5.7.0) (2019-12-09)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.6.0...5.7.0)

**Added**

- Add default scopes to Auth0 class [\#406](https://github.com/auth0/auth0-PHP/pull/406) ([joshcanhelp](https://github.com/joshcanhelp))
- fix: add missing options for renewTokens method [\#405](https://github.com/auth0/auth0-PHP/pull/405) ([bkotrys](https://github.com/bkotrys))

**Deprecated**

- Add deprecation notices for removals in v7 major release [\#407](https://github.com/auth0/auth0-PHP/pull/407) ([joshcanhelp](https://github.com/joshcanhelp))

**Fixed**

- Fix mkdir race condition in FileSystemCacheHandler [\#375](https://github.com/auth0/auth0-PHP/pull/375) ([B-Galati](https://github.com/B-Galati))

## [5.6.0](https://github.com/auth0/auth0-PHP/tree/5.6.0) (2019-09-26)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.5.1...5.6.0)

**Closed issues**

- [Auth0\SDK\Exception\CoreException] Invalid domain when trying to run unit tests with Codeception 3.1.0 [\#358](https://github.com/auth0/auth0-PHP/issues/358)
- JWT Verification fails everytime [\#356](https://github.com/auth0/auth0-PHP/issues/356)
- Bulk User Imports - I can't Use `upsert` as a paramater for the `importUsers` feature [\#353](https://github.com/auth0/auth0-PHP/issues/353)

**Added**

- Add \Auth0\SDK\Auth0::getLoginUrl() method and switch login() to use it [\#371](https://github.com/auth0/auth0-PHP/pull/371) ([joshcanhelp](https://github.com/joshcanhelp))
- Add JWKFetcher::getFormatted() method and switch validator to use [\#369](https://github.com/auth0/auth0-PHP/pull/369) ([joshcanhelp](https://github.com/joshcanhelp))
- Add additional API params to Jobs > importUsers [\#354](https://github.com/auth0/auth0-PHP/pull/354) ([pinodex](https://github.com/pinodex))

**Deprecated**

- Deprecated unused JWKFetcher methods [\#373](https://github.com/auth0/auth0-PHP/pull/373) ([joshcanhelp](https://github.com/joshcanhelp))
- Deprecate magic \_\_call method on RequestBuilder class [\#366](https://github.com/auth0/auth0-PHP/pull/366) ([joshcanhelp](https://github.com/joshcanhelp))
- Deprecate Management properties; add lazy-load methods [\#363](https://github.com/auth0/auth0-PHP/pull/363) ([joshcanhelp](https://github.com/joshcanhelp))
- Deprecate and stop using magic call method on ApiClient [\#362](https://github.com/auth0/auth0-PHP/pull/362) ([joshcanhelp](https://github.com/joshcanhelp))
- Deprecate addPathVariable and dump methods on RequestBuilder [\#361](https://github.com/auth0/auth0-PHP/pull/361) ([joshcanhelp](https://github.com/joshcanhelp))
- Deprecate TokenGenerator class [\#360](https://github.com/auth0/auth0-PHP/pull/360) ([joshcanhelp](https://github.com/joshcanhelp))

**Fixed**

- Fix boolean form parameters not sending as strings [\#357](https://github.com/auth0/auth0-PHP/pull/357) ([joshcanhelp](https://github.com/joshcanhelp))

## [5.5.1](https://github.com/auth0/auth0-PHP/tree/5.5.1) (2019-07-15)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.5.0...5.5.1)

**Closed issues**

- No packagist package created for 5.5.0 [\#346](https://github.com/auth0/auth0-PHP/issues/346)

**Fixed**

- Fix empty url params [\#349](https://github.com/auth0/auth0-PHP/pull/349) ([joshcanhelp](https://github.com/joshcanhelp))
- Fix tests to reduce the number of sensitive credentials used [\#348](https://github.com/auth0/auth0-PHP/pull/348) ([joshcanhelp](https://github.com/joshcanhelp))
- Change normalizeIncludeTotals() in GenericResource to have sane defaults [\#347](https://github.com/auth0/auth0-PHP/pull/347) ([kler](https://github.com/kler))

## [5.5.0](https://github.com/auth0/auth0-PHP/tree/5.5.0) (2019-06-07)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.4.0...5.5.0)

**Closed issues**

- Consider dropping PHP-5.x version supports [\#343](https://github.com/auth0/auth0-PHP/issues/343)
- Auth0 Error: 'Invalid state' in /auth0/vendor/auth0/auth0-php/src/Auth0.php: line#537 [\#333](https://github.com/auth0/auth0-PHP/issues/333)

**Added**

- Add missing User endpoints for Management API [\#341](https://github.com/auth0/auth0-PHP/pull/341) ([joshcanhelp](https://github.com/joshcanhelp))
- Add all Management API Roles endpoints [\#337](https://github.com/auth0/auth0-PHP/pull/337) ([joshcanhelp](https://github.com/joshcanhelp))
- Add missing Users test and switch to mocked calls. [\#336](https://github.com/auth0/auth0-PHP/pull/336) ([joshcanhelp](https://github.com/joshcanhelp))
- Add Authentication::refresh_token() method [\#335](https://github.com/auth0/auth0-PHP/pull/335) ([joshcanhelp](https://github.com/joshcanhelp))

## [5.4.0](https://github.com/auth0/auth0-PHP/tree/5.4.0) (2019-02-28)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.3.2...5.4.0)

**Notes for this release:**

- `\Auth0\SDK\Auth0` now accepts a `$config` key called `skip_userinfo` that uses the decoded ID token for the user profile instead of a call to the `/userinfo` endpoint. This will save an HTTP call during login and should have no affect on most applications.

**Closed issues**

- `Auth0::exchange()` assumes a valid id_token [\#317](https://github.com/auth0/auth0-PHP/issues/317)
- Feature Request: Support sending `auth0-forwarded-for` header [\#208](https://github.com/auth0/auth0-PHP/issues/208)

**Added**

- Authentication class cleanup and tests [\#322](https://github.com/auth0/auth0-PHP/pull/322) ([joshcanhelp](https://github.com/joshcanhelp))
- Add Grants Management endpoint [\#321](https://github.com/auth0/auth0-PHP/pull/321) ([joshcanhelp](https://github.com/joshcanhelp))
- Add `Auth0-Forwarded-For` header for RO grant [\#320](https://github.com/auth0/auth0-PHP/pull/320) ([joshcanhelp](https://github.com/joshcanhelp))
- Improve API Telemetry [\#319](https://github.com/auth0/auth0-PHP/pull/319) ([joshcanhelp](https://github.com/joshcanhelp))
- Add Mock API Request Capability and Mocked Connections Tests [\#314](https://github.com/auth0/auth0-PHP/pull/314) ([joshcanhelp](https://github.com/joshcanhelp))

**Changed**

- Test suite improvements [\#313](https://github.com/auth0/auth0-PHP/pull/313) ([joshcanhelp](https://github.com/joshcanhelp))
- Improve repo documentation [\#312](https://github.com/auth0/auth0-PHP/pull/312) ([joshcanhelp](https://github.com/joshcanhelp))

**Deprecated**

- Official deprecation for `JWKFetcher` method [\#328](https://github.com/auth0/auth0-PHP/pull/328) ([joshcanhelp](https://github.com/joshcanhelp))
  - `\Auth0\SDK\Helpers\JWKFetcher::fetchKeys()`
- Official deprecation for `User` methods [\#327](https://github.com/auth0/auth0-PHP/pull/327) ([joshcanhelp](https://github.com/joshcanhelp))
  - `\Auth0\SDK\API\Management\Users::search()`
  - `\Auth0\SDK\API\Management\Users::unlinkDevice()`
- Official deprecation of `ClientGrants` method [\#326](https://github.com/auth0/auth0-PHP/pull/326) ([joshcanhelp](https://github.com/joshcanhelp))
  - `\Auth0\SDK\API\Management\ClientGrants::get()`
- Official deprecation of legacy `InformationHeaders` methods [\#325](https://github.com/auth0/auth0-PHP/pull/325) ([joshcanhelp](https://github.com/joshcanhelp))
  - `\Auth0\SDK\API\Helpers\InformationHeaders::setEnvironment()`
  - `\Auth0\SDK\API\Helpers\InformationHeaders::setDependency()`
  - `\Auth0\SDK\API\Helpers\InformationHeaders::setDependencyData()`
- Official deprecation of legacy `Authentication` methods [\#324](https://github.com/auth0/auth0-PHP/pull/324) ([joshcanhelp](https://github.com/joshcanhelp))
  - `\Auth0\SDK\API\Authentication::setApiClient()`
  - `\Auth0\SDK\API\Authentication::sms_code_passwordless_verify()`
  - `\Auth0\SDK\API\Authentication::email_code_passwordless_verify()`
  - `\Auth0\SDK\API\Authentication::impersonate()`

**Fixed**

- Fix `Auth0::exchange()` to handle missing id_token [\#318](https://github.com/auth0/auth0-PHP/pull/318) ([joshcanhelp](https://github.com/joshcanhelp))

## [5.3.2](https://github.com/auth0/auth0-PHP/tree/5.3.2) (2018-11-2)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.3.1...5.3.2)

**Closed issues**

- Something is wrong with the latest release 5.3.1 [\#303](https://github.com/auth0/auth0-PHP/issues/303)

**Fixed**

- Fix info headers Extend error in dependant libs [\#304](https://github.com/auth0/auth0-PHP/pull/304) ([joshcanhelp](https://github.com/joshcanhelp))

## [5.3.1](https://github.com/auth0/auth0-PHP/tree/5.3.1) (2018-10-31)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.3.0...5.3.1)

**Closed issues**

- Array to String exception when audience is an array [\#296](https://github.com/auth0/auth0-PHP/issues/296)
- Passing accessToken from frontend to PHP API [\#281](https://github.com/auth0/auth0-PHP/issues/281)
- Deprecated method email_code_passwordless_verify [\#280](https://github.com/auth0/auth0-PHP/issues/280)

**Added**

- Fix documentation for Auth0 constructor options [\#298](https://github.com/auth0/auth0-PHP/pull/298) ([biganfa](https://github.com/biganfa))

**Changed**

- Change telemetry headers to new format and add tests [\#300](https://github.com/auth0/auth0-PHP/pull/300) ([joshcanhelp](https://github.com/joshcanhelp))

**Fixed**

- Fix bad exception message generation [\#297](https://github.com/auth0/auth0-PHP/pull/297) ([joshcanhelp](https://github.com/joshcanhelp))

## [5.3.0](https://github.com/auth0/auth0-PHP/tree/5.3.0) (2018-10-09)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.2.0...5.3.0)

**Closed issues**

- Question: Handling rate limits [\#277](https://github.com/auth0/auth0-PHP/issues/277)
- Allow configuration of the JWKS URL [\#276](https://github.com/auth0/auth0-PHP/issues/276)
- Allow changing the session key name [\#273](https://github.com/auth0/auth0-PHP/issues/273)
- SessionStore overrides PHP session cookie lifetime setting [\#215](https://github.com/auth0/auth0-PHP/issues/215)

**Added**

- Add custom JWKS path and kid check to JWKFetcher + tests [\#287](https://github.com/auth0/auth0-PHP/pull/287) ([joshcanhelp](https://github.com/joshcanhelp))
- Add config keys for session base name and cookie expires [\#279](https://github.com/auth0/auth0-PHP/pull/279) ([joshcanhelp](https://github.com/joshcanhelp))
- Add return request object [\#278](https://github.com/auth0/auth0-PHP/pull/278) ([joshcanhelp](https://github.com/joshcanhelp))
- Add pagination and tests to Resource Servers [\#275](https://github.com/auth0/auth0-PHP/pull/275) ([joshcanhelp](https://github.com/joshcanhelp))
- Fix formatting, code standards scan [\#274](https://github.com/auth0/auth0-PHP/pull/274) ([joshcanhelp](https://github.com/joshcanhelp))
- Add pagination, docs, and better tests for Rules [\#272](https://github.com/auth0/auth0-PHP/pull/272) ([joshcanhelp](https://github.com/joshcanhelp))
- Adding pagination, tests, + docs to Client Grants; minor test suite refactor [\#271](https://github.com/auth0/auth0-PHP/pull/271) ([joshcanhelp](https://github.com/joshcanhelp))
- Add tests, docblocks for Logs endpoints [\#270](https://github.com/auth0/auth0-PHP/pull/270) ([joshcanhelp](https://github.com/joshcanhelp))
- Add PHP_CodeSniffer + ruleset config [\#267](https://github.com/auth0/auth0-PHP/pull/267) ([joshcanhelp](https://github.com/joshcanhelp))
- Add session state and dummy state handler tests [\#266](https://github.com/auth0/auth0-PHP/pull/266) ([joshcanhelp](https://github.com/joshcanhelp))

**Changed**

- Build/PHPCS: update/improve the PHPCS configuration [\#284](https://github.com/auth0/auth0-PHP/pull/284) ([jrfnl](https://github.com/jrfnl))

**Deprecated**

- Deprecate Auth0\SDK\API\Oauth2Client class [\#269](https://github.com/auth0/auth0-PHP/pull/269) ([joshcanhelp](https://github.com/joshcanhelp))

**Removed**

- Remove examples, add links to Quickstarts [\#293](https://github.com/auth0/auth0-PHP/pull/293) ([joshcanhelp](https://github.com/joshcanhelp))

**Fixed**

- Whitespace pass with new standards using composer phpcbf [\#268](https://github.com/auth0/auth0-PHP/pull/268) ([joshcanhelp](https://github.com/joshcanhelp))

**Security**

- Add ID token validation [\#285](https://github.com/auth0/auth0-PHP/pull/285) ([joshcanhelp](https://github.com/joshcanhelp))

## [5.2.0](https://github.com/auth0/auth0-PHP/tree/5.2.0) (2018-06-13)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.1.1...5.2.0)

**Closed issues**

- getAppMetadata - how to use? [\#248](https://github.com/auth0/auth0-PHP/issues/248)
- Auth0 class missing action to renew access token [\#234](https://github.com/auth0/auth0-PHP/issues/234)
- DOC maj [\#217](https://github.com/auth0/auth0-PHP/issues/217)

**Added**

- User pagination and fields, docblocks, formatting, test improvements [\#261](https://github.com/auth0/auth0-PHP/pull/261) ([joshcanhelp](https://github.com/joshcanhelp))
- Unit test for withDictParams method [\#260](https://github.com/auth0/auth0-PHP/pull/260) ([joshcanhelp](https://github.com/joshcanhelp))
- Pagination, additional parameters, and tests for the Connections endpoint [\#258](https://github.com/auth0/auth0-PHP/pull/258) ([joshcanhelp](https://github.com/joshcanhelp))
- Renew tokens method for Auth0 client class [\#257](https://github.com/auth0/auth0-PHP/pull/257) ([jspetrak](https://github.com/jspetrak))
- Clients endpoint pagination and improvements [\#256](https://github.com/auth0/auth0-PHP/pull/256) ([joshcanhelp](https://github.com/joshcanhelp))
- Add email template endpoints [\#251](https://github.com/auth0/auth0-PHP/pull/251) ([joshcanhelp](https://github.com/joshcanhelp))

**Changed**

- Code style scan and fixes [\#250](https://github.com/auth0/auth0-PHP/pull/250) ([joshcanhelp](https://github.com/joshcanhelp))

**Fixed**

- Fix PHPUnit test. [\#262](https://github.com/auth0/auth0-PHP/pull/262) ([maurobonfietti](https://github.com/maurobonfietti))
- Allow \$page to be null for Clients so pagination is not triggered [\#259](https://github.com/auth0/auth0-PHP/pull/259) ([joshcanhelp](https://github.com/joshcanhelp))
- Rewrite README; add news and notes to CHANGELOG [\#253](https://github.com/auth0/auth0-PHP/pull/253) ([joshcanhelp](https://github.com/joshcanhelp))

## [5.1.1](https://github.com/auth0/auth0-PHP/tree/5.1.1) (2018-04-03)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.1.0...5.1.1)

**Closed issues**

- State Handler with Custom Session Store [\#233](https://github.com/auth0/auth0-PHP/issues/233)
- Implement ResourceServices::getAll [\#200](https://github.com/auth0/auth0-PHP/issues/200)

**Added**

- Implement ResourceServices::getAll() [\#236](https://github.com/auth0/auth0-PHP/pull/236) ([joshcanhelp](https://github.com/joshcanhelp))

**Fixed**

- Incorrect type hint on SessionStateHandler \_\_construct [\#235](https://github.com/auth0/auth0-PHP/pull/235) ([joshcanhelp](https://github.com/joshcanhelp))
- Auth0 class documentation fixed for store and state handler [\#232](https://github.com/auth0/auth0-PHP/pull/232) ([jspetrak](https://github.com/jspetrak))
- Fixing minor code quality issues [\#231](https://github.com/auth0/auth0-PHP/pull/231) ([joshcanhelp](https://github.com/joshcanhelp))

## [5.1.0](https://github.com/auth0/auth0-PHP/tree/5.1.0) (2018-03-02)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.0.6...5.1.0)

**Notes on this release:**

[State validation](https://auth0.com/docs/protocols/oauth2/oauth-state) was added for improved security. Please see our [troubleshooting page](https://auth0.com/docs/libraries/auth0-php/troubleshooting) for more information on how this works and potential issues.

**Closed issues**

- Support for php-jwt 5 [\#210](https://github.com/auth0/auth0-PHP/issues/210)

**Added**

- Added XSRF State Storage / Validation [\#214](https://github.com/auth0/auth0-PHP/pull/214) ([cocojoe](https://github.com/cocojoe))
- Adding tests for state handler; correcting storage method used [\#228](https://github.com/auth0/auth0-PHP/pull/228) ([joshcanhelp](https://github.com/joshcanhelp))

**Changed**

- Bumping JWT package version [\#229](https://github.com/auth0/auth0-PHP/pull/229) ([joshcanhelp](https://github.com/joshcanhelp))

## [5.0.6](https://github.com/auth0/auth0-PHP/tree/5.0.4) (2017-11-24)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.0.4...5.0.6)

**Added**

- Add support for the new users by email API [\#213](https://github.com/auth0/auth0-PHP/pull/213) ([erichard](https://github.com/erichard))

**Fixed**

- Fixes build [\#211](https://github.com/auth0/auth0-PHP/pull/211) ([aknosis](https://github.com/aknosis))

## [5.0.4](https://github.com/auth0/auth0-PHP/tree/5.0.4) (2017-06-26)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/5.0.0...5.0.4)

**Added**

- Added setter for debugger [\#149](https://github.com/auth0/auth0-PHP/pull/149) ([AxaliaN](https://github.com/AxaliaN))

**Changed**

- Restructured tests and fixed hhvm build [\#164](https://github.com/auth0/auth0-PHP/pull/164) ([Nyholm](https://github.com/Nyholm))
- Update .env.example with more appropriate values [\#148](https://github.com/auth0/auth0-PHP/pull/148) ([AmaanC](https://github.com/AmaanC))

**Removed**

- Remove non-essential dev package [\#157](https://github.com/auth0/auth0-PHP/pull/157) ([Nyholm](https://github.com/Nyholm))

## [3.4.0](https://github.com/auth0/auth0-PHP/tree/3.4.0) (2016-06-21)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.3.7...3.4.0)

**Closed issues:**

- More descriptive error message when code exchange fails [\#86](https://github.com/auth0/auth0-PHP/issues/86)

**Merged pull requests:**

- Correctly build logout url query string [\#87](https://github.com/auth0/auth0-PHP/pull/87) ([robinvdvleuten](https://github.com/robinvdvleuten))

## [3.3.7](https://github.com/auth0/auth0-PHP/tree/3.3.7) (2016-06-09)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.3.6...3.3.7)

## [3.3.6](https://github.com/auth0/auth0-PHP/tree/3.3.6) (2016-06-09)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.3.5...3.3.6)

**Merged pull requests:**

- \$this-\>access_token is an array, not object [\#85](https://github.com/auth0/auth0-PHP/pull/85) ([dev101](https://github.com/dev101))

## [3.3.5](https://github.com/auth0/auth0-PHP/tree/3.3.5) (2016-05-24)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.3.4...3.3.5)

**Closed issues:**

- Create password change ticket fails [\#84](https://github.com/auth0/auth0-PHP/issues/84)
- UnexpectedValueException is used in Auth0JWT.php but is not defined [\#80](https://github.com/auth0/auth0-PHP/issues/80)
- Add support for auth api endpoints \(/ro\) [\#22](https://github.com/auth0/auth0-PHP/issues/22)

## [3.3.4](https://github.com/auth0/auth0-PHP/tree/3.3.4) (2016-05-24)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.3.3...3.3.4)

## [3.3.3](https://github.com/auth0/auth0-PHP/tree/3.3.3) (2016-05-24)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/2.2.3...3.3.3)

## [2.2.3](https://github.com/auth0/auth0-PHP/tree/2.2.3) (2016-05-10)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.3.2...2.2.3)

## [3.3.2](https://github.com/auth0/auth0-PHP/tree/3.3.2) (2016-05-10)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.3.1...3.3.2)

## [3.3.1](https://github.com/auth0/auth0-PHP/tree/3.3.1) (2016-05-10)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/2.2.2...3.3.1)

## [2.2.2](https://github.com/auth0/auth0-PHP/tree/2.2.2) (2016-05-10)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.3.0...2.2.2)

## [3.3.0](https://github.com/auth0/auth0-PHP/tree/3.3.0) (2016-05-09)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.2.1...3.3.0)

**Merged pull requests:**

- deleted uneccessary code, fixed typos [\#83](https://github.com/auth0/auth0-PHP/pull/83) ([Amialc](https://github.com/Amialc))
- Add Docker support [\#82](https://github.com/auth0/auth0-PHP/pull/82) ([smtx](https://github.com/smtx))
- changed UnexpectedValueException to CoreException [\#81](https://github.com/auth0/auth0-PHP/pull/81) ([dryror](https://github.com/dryror))
- Added auth api support [\#78](https://github.com/auth0/auth0-PHP/pull/78) ([glena](https://github.com/glena))

## [3.2.1](https://github.com/auth0/auth0-PHP/tree/3.2.1) (2016-05-02)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/2.2.1...3.2.1)

## [2.2.1](https://github.com/auth0/auth0-PHP/tree/2.2.1) (2016-04-27)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.2.0...2.2.1)

**Closed issues:**

- outdated dependency in api example [\#75](https://github.com/auth0/auth0-PHP/issues/75)

**Merged pull requests:**

- dependencies update in basic api example [\#79](https://github.com/auth0/auth0-PHP/pull/79) ([Amialc](https://github.com/Amialc))

## [3.2.0](https://github.com/auth0/auth0-PHP/tree/3.2.0) (2016-04-15)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/2.2.0...3.2.0)

- Now the SDK supports RS256 codes, it will decode using the `.well-known/jwks.json` endpoint to fetch the public key

## [2.2.0](https://github.com/auth0/auth0-PHP/tree/2.2.0) (2016-04-15)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.1.0...2.2.0)

**Notes**

- Now the SDK fetches the user using the `tokeninfo` endpoint to be fully compliant with the openid spec
- Now the SDK supports RS256 codes, it will decode using the `.well-known/jwks.json` endpoint to fetch the public key

**Closed issues:**

- /tokeninfo API support [\#76](https://github.com/auth0/auth0-PHP/issues/76)
- Specify GuzzleHttp config [\#73](https://github.com/auth0/auth0-PHP/issues/73)

**Merged pull requests:**

- Fix typo in DocBlock [\#77](https://github.com/auth0/auth0-PHP/pull/77) ([tflight](https://github.com/tflight))

## [3.1.0](https://github.com/auth0/auth0-PHP/tree/3.1.0) (2016-03-10)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.0.1...3.1.0)

**Closed issues:**

- API seed incomptaible with auth0-php 3 [\#70](https://github.com/auth0/auth0-PHP/issues/70)
- "cURL error 60: SSL certificate problem: self signed certificate in certificate chain \(see http://curl.haxx.se/libcurl/c/libcurl-errors.html\)", [\#69](https://github.com/auth0/auth0-PHP/issues/69)
- basic-webapp outdated dependencies [\#68](https://github.com/auth0/auth0-PHP/issues/68)
- basic-webapp project relative path [\#67](https://github.com/auth0/auth0-PHP/issues/67)
- Typo on README [\#63](https://github.com/auth0/auth0-PHP/issues/63)
- Missing updateAppMetadata\(\) method? [\#59](https://github.com/auth0/auth0-PHP/issues/59)

**Merged pull requests:**

- 3.1.0 [\#74](https://github.com/auth0/auth0-PHP/pull/74) ([glena](https://github.com/glena))
- Compatibility with new version of Auth0php [\#72](https://github.com/auth0/auth0-PHP/pull/72) ([Annyv2](https://github.com/Annyv2))
- depedencies update, fix routes to css and js [\#71](https://github.com/auth0/auth0-PHP/pull/71) ([Amialc](https://github.com/Amialc))
- update lock version [\#66](https://github.com/auth0/auth0-PHP/pull/66) ([Amialc](https://github.com/Amialc))
- Fixed typo [\#65](https://github.com/auth0/auth0-PHP/pull/65) ([thijsvdanker](https://github.com/thijsvdanker))
- Update README.md [\#64](https://github.com/auth0/auth0-PHP/pull/64) ([Annyv2](https://github.com/Annyv2))
- Test travis env vars [\#62](https://github.com/auth0/auth0-PHP/pull/62) ([glena](https://github.com/glena))
- Fix typo [\#58](https://github.com/auth0/auth0-PHP/pull/58) ([vboctor](https://github.com/vboctor))

## [3.0.1](https://github.com/auth0/auth0-PHP/tree/3.0.1) (2016-02-03)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.11...3.0.1)

**Merged pull requests:**

- Fixed Importing users [\#61](https://github.com/auth0/auth0-PHP/pull/61) ([polishdeveloper](https://github.com/polishdeveloper))

## [1.0.11](https://github.com/auth0/auth0-PHP/tree/1.0.11) (2016-01-27)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/3.0.0...1.0.11)

**Closed issues:**

- Exception: Cannot handle token prior to \[timestamp\] [\#56](https://github.com/auth0/auth0-PHP/issues/56)

**Merged pull requests:**

- Fix ApiConnections class name [\#60](https://github.com/auth0/auth0-PHP/pull/60) ([bjyoungblood](https://github.com/bjyoungblood))

## [3.0.0](https://github.com/auth0/auth0-PHP/tree/3.0.0) (2016-01-18)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/2.1.2...3.0.0)

**General 3.x notes**

- SDK api changes, now the Auth0 API client is not build of static classes anymore. Usage example:

```php
$token = "eyJhbGciO....eyJhdWQiOiI....1ZVDisdL...";
$domain = "account.auth0.com";
$guzzleOptions = [ ... ];

$auth0Api = new \Auth0\SDK\Auth0Api($token, $domain, $guzzleOptions); /* $guzzleOptions is optional */

$usersList = $auth0Api->users->search([ "q" => "email@test.com" ]);
```

**Closed issues:**

- Missing instruccions step 2 Configure Auth0 PHP Plugin [\#55](https://github.com/auth0/auth0-PHP/issues/55)
- Outdated Lock [\#52](https://github.com/auth0/auth0-PHP/issues/52)
- Deprecated method in basic-webapp [\#50](https://github.com/auth0/auth0-PHP/issues/50)

**Merged pull requests:**

- V3 with new API and full support for API V2 [\#57](https://github.com/auth0/auth0-PHP/pull/57) ([glena](https://github.com/glena))

## [2.1.2](https://github.com/auth0/auth0-PHP/tree/2.1.2) (2016-01-14)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/2.1.1...2.1.2)

**Merged pull requests:**

- Update Lock [\#53](https://github.com/auth0/auth0-PHP/pull/53) ([Annyv2](https://github.com/Annyv2))
- Update index.php [\#51](https://github.com/auth0/auth0-PHP/pull/51) ([Annyv2](https://github.com/Annyv2))
- Update lock [\#45](https://github.com/auth0/auth0-PHP/pull/45) ([Annyv2](https://github.com/Annyv2))

## [2.1.1](https://github.com/auth0/auth0-PHP/tree/2.1.1) (2015-11-29)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/2.1.0...2.1.1)

**Merged pull requests:**

- Fix Closure namespace issue [\#49](https://github.com/auth0/auth0-PHP/pull/49) ([mkeasling](https://github.com/mkeasling))

## [2.1.0](https://github.com/auth0/auth0-PHP/tree/2.1.0) (2015-11-24)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/2.0.0...2.1.0)

**Closed issues:**

- Update to use v3.0 of firebase/php-jwt [\#47](https://github.com/auth0/auth0-PHP/issues/47)

**Merged pull requests:**

- 2.0.1 updated JWT dependency [\#48](https://github.com/auth0/auth0-PHP/pull/48) ([glena](https://github.com/glena))

## [2.0.0](https://github.com/auth0/auth0-PHP/tree/2.0.0) (2015-11-23)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.10...2.0.0)

**General 2.x notes**

- Session storage now returns null (and null is expected by the sdk) if there is no info stored (this change was made since false is a valid value to be stored in session).
- Guzzle 6.1 required

**Closed issues:**

- Guzzle 6 [\#43](https://github.com/auth0/auth0-PHP/issues/43)
- User is null not false [\#41](https://github.com/auth0/auth0-PHP/issues/41)
- Issues with PHP Seed project [\#38](https://github.com/auth0/auth0-PHP/issues/38)
- authParams... how do I retrieve the results? [\#37](https://github.com/auth0/auth0-PHP/issues/37)

**Merged pull requests:**

- 2.x.x dev [\#46](https://github.com/auth0/auth0-PHP/pull/46) ([glena](https://github.com/glena))
- Update README.md [\#40](https://github.com/auth0/auth0-PHP/pull/40) ([Annyv2](https://github.com/Annyv2))
- Update composer instructions [\#39](https://github.com/auth0/auth0-PHP/pull/39) ([iWader](https://github.com/iWader))

## [1.0.10](https://github.com/auth0/auth0-PHP/tree/1.0.10) (2015-09-23)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.9...1.0.10)

**Closed issues:**

- Improve error message when no id_token is received after code exchange [\#35](https://github.com/auth0/auth0-PHP/issues/35)
- PHP should be 5.4+, not 5.3+ [\#34](https://github.com/auth0/auth0-PHP/issues/34)

**Merged pull requests:**

- Release 1.0.10 [\#36](https://github.com/auth0/auth0-PHP/pull/36) ([glena](https://github.com/glena))
- Remove code that rewrites user_id property in \$body [\#33](https://github.com/auth0/auth0-PHP/pull/33) ([Ring](https://github.com/Ring))

## [1.0.9](https://github.com/auth0/auth0-PHP/tree/1.0.9) (2015-08-03)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.8...1.0.9)

**Closed issues:**

- Stable dependencies in composer.json instead of "dev-master" [\#30](https://github.com/auth0/auth0-PHP/issues/30)

**Merged pull requests:**

- tagged adoy to ~1.3 [\#31](https://github.com/auth0/auth0-PHP/pull/31) ([glena](https://github.com/glena))
- Bad reference in Android PHP API Seed Project Readme file \#67 [\#29](https://github.com/auth0/auth0-PHP/pull/29) ([glena](https://github.com/glena))

## [1.0.8](https://github.com/auth0/auth0-PHP/tree/1.0.8) (2015-07-27)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.7...1.0.8)

**Closed issues:**

- Class 'JWT' not found [\#25](https://github.com/auth0/auth0-PHP/issues/25)
- Correct way to use the JWT Token generated in API v2 if we want expanded scope [\#19](https://github.com/auth0/auth0-PHP/issues/19)

**Merged pull requests:**

- Fix create client api call + new create user example [\#28](https://github.com/auth0/auth0-PHP/pull/28) ([glena](https://github.com/glena))

## [1.0.7](https://github.com/auth0/auth0-PHP/tree/1.0.7) (2015-07-17)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.6...1.0.7)

**Closed issues:**

- Error at Auth0JWT::encode when using custom payload [\#23](https://github.com/auth0/auth0-PHP/issues/23)
- Error in composer install [\#21](https://github.com/auth0/auth0-PHP/issues/21)
- Test [\#20](https://github.com/auth0/auth0-PHP/issues/20)

**Merged pull requests:**

- v1.0.7 [\#26](https://github.com/auth0/auth0-PHP/pull/26) ([glena](https://github.com/glena))
- Readme file call URL port fixed [\#18](https://github.com/auth0/auth0-PHP/pull/18) ([jose-e-rodriguez](https://github.com/jose-e-rodriguez))
- ApiUsers link account identities fix [\#16](https://github.com/auth0/auth0-PHP/pull/16) ([deboorn](https://github.com/deboorn))

## [1.0.6](https://github.com/auth0/auth0-PHP/tree/1.0.6) (2015-06-12)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.5...1.0.6)

**Merged pull requests:**

- Make Auth0::setUser public in order to let update the stored user [\#17](https://github.com/auth0/auth0-PHP/pull/17) ([glena](https://github.com/glena))

## [1.0.5](https://github.com/auth0/auth0-PHP/tree/1.0.5) (2015-06-02)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.4...1.0.5)

**Merged pull requests:**

- Updates the changed endpoints \(tickets\) [\#15](https://github.com/auth0/auth0-PHP/pull/15) ([glena](https://github.com/glena))
- Api users search link accounts fix [\#14](https://github.com/auth0/auth0-PHP/pull/14) ([deboorn](https://github.com/deboorn))
- Auth0JWT encode fix to allow scope with null custom payload [\#13](https://github.com/auth0/auth0-PHP/pull/13) ([deboorn](https://github.com/deboorn))

## [1.0.4](https://github.com/auth0/auth0-PHP/tree/1.0.4) (2015-05-19)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.3...1.0.4)

## [1.0.3](https://github.com/auth0/auth0-PHP/tree/1.0.3) (2015-05-15)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.2...1.0.3)

**Merged pull requests:**

- Applied the new Info Headers schema [\#12](https://github.com/auth0/auth0-PHP/pull/12) ([glena](https://github.com/glena))

## [1.0.2](https://github.com/auth0/auth0-PHP/tree/1.0.2) (2015-05-13)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.1...1.0.2)

**Closed issues:**

- EU tenants are getting Unauthorize on api calls [\#10](https://github.com/auth0/auth0-PHP/issues/10)
- PHP Fatal error: Class 'Auth0\SDK\API\ApiUsers' not found in vendor/auth0/auth0-php/src/Auth0.php on line 256 [\#9](https://github.com/auth0/auth0-PHP/issues/9)

**Merged pull requests:**

- Fix EU api calls and autoloading issue [\#11](https://github.com/auth0/auth0-PHP/pull/11) ([glena](https://github.com/glena))

## [1.0.1](https://github.com/auth0/auth0-PHP/tree/1.0.1) (2015-05-12)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/1.0.0...1.0.1)

**Closed issues:**

- SDK Client headers spec compliant [\#7](https://github.com/auth0/auth0-PHP/issues/7)
- Example is out of date [\#5](https://github.com/auth0/auth0-PHP/issues/5)

**Merged pull requests:**

- SDK Client headers spec compliant \#7 [\#8](https://github.com/auth0/auth0-PHP/pull/8) ([glena](https://github.com/glena))

## [1.0.0](https://github.com/auth0/auth0-PHP/tree/1.0.0) (2015-05-07)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/0.6.6...1.0.0)

**General 1.x notes**

- Now, all the SDK is under the namespace `\Auth0\SDK`
- The exceptions were moved to the namespace `\Auth0\SDK\Exceptions`
- The Auth0 class, now provides two methods to access the user metadata, `getUserMetadata` and `getAppMetadata`. For more info, check the [API v2 changes](https://auth0.com/docs/apiv2Changes)
- The Auth0 class, now provides a way to update the UserMetadata with the method `updateUserMetadata`. Internally, it uses the [update user endpoint](https://auth0.com/docs/apiv2#!/users/patch_users_by_id), check the method documentation for more info.
- The new service `\Auth0\SDK\API\ApiUsers` provides an easy way to consume the API v2 Users endpoints.
- A simple API client (`\Auth0\SDK\API\ApiClient`) is also available to use.
- A JWT generator and decoder is also available (`\Auth0\SDK\Auth0JWT`)
- Now provides an interface for the [Authentication API](https://auth0.com/docs/auth-api).

**Closed issues:**

- Unexpected token [\#4](https://github.com/auth0/auth0-PHP/issues/4)

**Merged pull requests:**

- Auth0 API v2 support [\#6](https://github.com/auth0/auth0-PHP/pull/6) ([glena](https://github.com/glena))
- Fixed port number on PHP README [\#2](https://github.com/auth0/auth0-PHP/pull/2) ([mgonto](https://github.com/mgonto))

## [0.6.6](https://github.com/auth0/auth0-PHP/tree/0.6.6) (2014-04-14)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/0.6.5...0.6.6)

**Closed issues:**

- generateUrl\(\) in BaseAuth0 is creating bad URLs [\#1](https://github.com/auth0/auth0-PHP/issues/1)

## [0.6.5](https://github.com/auth0/auth0-PHP/tree/0.6.5) (2014-04-02)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/0.6.4...0.6.5)

## [0.6.4](https://github.com/auth0/auth0-PHP/tree/0.6.4) (2014-02-13)

[Full Changelog](https://github.com/auth0/auth0-PHP/compare/0.6.3...0.6.4)

## [0.6.3](https://github.com/auth0/auth0-PHP/tree/0.6.3) (2014-01-06)

\* _This Change Log was automatically generated by [github_changelog_generator](https://github.com/skywinder/Github-Changelog-Generator)_
