# Changelog

## [Unreleased]

## [8.5.0](https://github.com/auth0/auth0-PHP/tree/8.5.0) - 2023-03-27

**Added**

- **Management API**
  - `Auth0\APIs\Management\Users`
    - `DELETE /users/:id/authenticators` → `deleteAllAuthenticators()` ([#702](https://github.com/auth0/auth0-PHP/pull/702)) ([Documentation](https://auth0.github.io/auth0-PHP/API/Management/Management.html#method-deleteAllAuthenticators))
  - Support for Authentication Method endpoints: ([#707](https://github.com/auth0/auth0-PHP/pull/707)):
    - `GET /api/v2/users/:user/authentication-methods` → `getAuthenticationMethods()` ([Documentation](https://auth0.com/docs/api/management/v2#!/Users/get_authentication_methods))
    - `PUT /api/v2/users/:user/authentication-methods` → `replaceAuthenticationMethods()` ([Documentation](https://auth0.com/docs/api/management/v2#!/Users/put_authentication_methods))
    - `DELETE /api/v2/users/:user/authentication-methods` → `deleteAuthenticationMethods(string user)` ([Documentation](https://auth0.com/docs/api/management/v2#!/Users/delete_authentication_methods))
    - `POST /api/v2/users/:user/authentication-methods` → `createAuthenticationMethod()` ([Documentation](https://auth0.com/docs/api/management/v2#!/Users/post_authentication_methods))
    - `GET /api/v2/users/:user/authentication-methods/:method` → `getAuthenticationMethod()` ([Documentation](https://auth0.com/docs/api/management/v2#!/Users/get_authentication_methods_by_authentication_method_id))
    - `PATCH /api/v2/users/:user/authentication-methods/:method` → `updateAuthenticationMethod()` ([Documentation](https://auth0.com/docs/api/management/v2#!/Users/patch_authentication_methods_by_authentication_method_id))
    - `DELETE /api/v2/users/:user/authentication-methods/:method` → `deleteAuthenticationMethod()` ([Documentation](https://auth0.com/docs/api/management/v2#!/Users/delete_authentication_methods_by_authentication_method_id))

**Changed**

- Upgraded test suite to [PEST](https://pestphp.com/) 2.0 framework.
- Updated production dependencies:
    - Replaced `php-http/discovery` dependency with `psr-discovery/all`.
    - Replaced `php-http/httplug` dependency with `psr-discovery/all`.
- Updated development dependencies:
    - Removed `ergebnis/composer-normalize` as it now runs in CI.
    - Removed `firebase/php-jwt` as it was replaced by an in-library generator.
    - Replaced `hyperf/event` with `symfony/event-dispatcher`.
    - Replaced `laravel/pint` with `friendsofphp/php-cs-fixer`.
    - Replaced `nyholm/psr7` with `psr-mock/http-factory-implementation`.
    - Replaced `php-http/mock-client` with `psr-mock/http-client-implementation`.
    - Updated `vimeo/psalm` to 5.8.
    - Updated `phpstan/phpstan` to 1.10.
    - Updated `rector/rector` to 0.15.

Thanks to our contributors for this release: [knash94](https://github.com/knash94)

## [8.4.0](https://github.com/auth0/auth0-PHP/tree/8.4.0) - 2023-01-24

**Added**

- Client Assertion ([private_key_jwt](https://oauth.net/private-key-jwt/)) support [\#699](https://github.com/auth0/auth0-PHP/pull/699) ([evansims](https://github.com/evansims))
- Client Credentials management endpoints [\#700](https://github.com/auth0/auth0-PHP/pull/700) ([evansims](https://github.com/evansims))
- JSON Web Token generator classes, `Auth0\SDK\Token\Generator` and `Auth0\SDK\Token\ClientAssertionGenerator`. [\#698](https://github.com/auth0/auth0-PHP/pull/698) ([evansims](https://github.com/evansims))

**Changed**

- Restore test coverage to 100% [\#697](https://github.com/auth0/auth0-PHP/pull/697) ([evansims](https://github.com/evansims))
- Exclude unnecessary files from distribution package [\#696](https://github.com/auth0/auth0-PHP/pull/696) ([ramsey](https://github.com/ramsey))

## [8.3.8](https://github.com/auth0/auth0-PHP/tree/8.3.8) - 2022-11-28

**Fixed**

- fix: Always store provided state in transient medium [\#674](https://github.com/auth0/auth0-PHP/pull/674) ([evansims](https://github.com/evansims))

## [8.3.7](https://github.com/auth0/auth0-PHP/tree/8.3.7) - 2022-11-07

**Fixed**

- fix: emailPasswordlessStart() incorrectly passes `params` as `array` under some conditions [\#670](https://github.com/auth0/auth0-PHP/pull/670) ([evansims](https://github.com/evansims))
- fix: Remove redundant Cache `getItem()` call in `Auth0\SDK\Token\Verifier::getKeySet()` [\#669](https://github.com/auth0/auth0-PHP/pull/669) ([pkivits-litebit](https://github.com/pkivits-litebit))

## [8.3.6](https://github.com/auth0/auth0-PHP/tree/8.3.6) - 2022-10-24

**Fixed**

- fix: Restore previous behavior of SdkConfiguration::setScope() being nullable [\#665](https://github.com/auth0/auth0-PHP/pull/665) ([evansims](https://github.com/evansims))

## [8.3.5](https://github.com/auth0/auth0-PHP/tree/8.3.5) - 2022-10-21

**Fixed**

- [SDK-3722] Fix: Stateless strategies should not invoke stateful session classes [\#662](https://github.com/auth0/auth0-PHP/pull/662) ([evansims](https://github.com/evansims))

## [8.3.4](https://github.com/auth0/auth0-PHP/tree/8.3.4) - 2022-10-19

**Fixed**

- Fix `SdkConfiguration::setScope()` not assigning default values when an empty array is passed [\#659](https://github.com/auth0/auth0-PHP/pull/659) ([evansims](https://github.com/evansims))

## [8.3.3](https://github.com/auth0/auth0-PHP/tree/8.3.3) - 2022-10-19

**Fixed**

- Configuration validator improvements [\#657](https://github.com/auth0/auth0-PHP/pull/657) ([evansims](https://github.com/evansims))

## [8.3.2](https://github.com/auth0/auth0-PHP/tree/8.3.2) - 2022-10-18

**Fixed**

- [SDK-3719] Fix PHP 8.0+ SdkConfiguration named arguments usage [\#654](https://github.com/auth0/auth0-PHP/pull/654) ([evansims](https://github.com/evansims))

## [8.3.1](https://github.com/auth0/auth0-PHP/tree/8.3.1) - 2022-09-24

**Changed**

- [SDK-3647] Add PHP 8.2.0-dev to test matrix [\#650](https://github.com/auth0/auth0-PHP/pull/650) ([evansims](https://github.com/evansims))

**Fixed**

- [SDK-3646] Reliability and performance improvements to CookieStore [\#649](https://github.com/auth0/auth0-PHP/pull/649) ([evansims](https://github.com/evansims))

## [8.3.0](https://github.com/auth0/auth0-PHP/tree/8.3.0) - 2022-09-22

**Added**

- [SDK-3636] Add PSR-14 Event Dispatcher, for ultra customizable session storage purposes [\#646](https://github.com/auth0/auth0-PHP/pull/646) ([evansims](https://github.com/evansims))

**Changed**

- [SDK-3633] Treat passing an empty string to SdkConfiguration as the default undefined value type of NULL [\#643](https://github.com/auth0/auth0-PHP/pull/643) ([evansims](https://github.com/evansims))
- [SDK-3635] Enable configuration of SessionStore and CookieStore `samesite` property [\#645](https://github.com/auth0/auth0-PHP/pull/645) ([evansims](https://github.com/evansims))
- [SDK-3634] Add hardcoded debugging flag to CookieStore to disable encryption of session cookies [\#644](https://github.com/auth0/auth0-PHP/pull/644) ([evansims](https://github.com/evansims))
- [SDK-3632] Update `getRequestParameter()` filter to use FILTER_SANITIZE_FULL_SPECIAL_CHARS and allow passing extra filter options [\#642](https://github.com/auth0/auth0-PHP/pull/642) ([evansims](https://github.com/evansims))
- [SDK-3631] Defer/batch "Set-Cookie" headers at `login()` for transient cookies, and `clear()` [\#641](https://github.com/auth0/auth0-PHP/pull/641) ([evansims](https://github.com/evansims))

## [8.2.1](https://github.com/auth0/auth0-PHP/tree/8.2.1) - 2022-06-06

**Fixed**

- Fixed an issue in `Auth0\SDK\Configuration\SdkConfiguration` where `customDomain` was not properly formatted in some configurations, leading to inconsistencies in certain SDK functions, such as Token validation. `customDomain` is now formatted identically to `domain`. [#633](https://github.com/auth0/auth0-PHP/pull/633) ([evansims](https://github.com/evansims))

**Closed Issues**

- Resolves [#630](https://github.com/auth0/auth0-PHP/issues/630) ([barasimumatik](https://github.com/barasimumatik))

## [8.2.0](https://github.com/auth0/auth0-PHP/tree/8.2.0) - 2022-04-25

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

## [8.1.0](https://github.com/auth0/auth0-PHP/tree/8.1.0) - 2022-02-17

**Added**

- Add Attack Protection endpoints [#593](https://github.com/auth0/auth0-PHP/pull/597) ([evansims](https://github.com/evansims))

## [8.0.6](https://github.com/auth0/auth0-PHP/tree/8.0.6) - 2022-01-25

**Fixed**

- Auth0->renew(): now correctly updates all appropriate session details after a successful token refresh [#593](https://github.com/auth0/auth0-PHP/pull/593) ([evansims](https://github.com/evansims))

## [8.0.5](https://github.com/auth0/auth0-PHP/tree/8.0.5) - 2022-01-04

**Fixed**

- Auth0->exchange(): optimize setcookie() calls [#591](https://github.com/auth0/auth0-PHP/pull/591) ([Nebual](https://github.com/Nebual))

## [8.0.4](https://github.com/auth0/auth0-PHP/tree/8.0.4) - 2021-12-13

**Fixed**

- Require `domain` configuration for `management` strategy [#589](https://github.com/auth0/auth0-PHP/pull/589) ([evansims](https://github.com/evansims))

**Documentation**

- Update UPGRADE.md with additional notes about `Auth0::login()` changes from v7. [#585](https://github.com/auth0/auth0-PHP/pull/585) ([BGehrels](https://github.com/BGehrels))
- Update UPGRADE.md with additional notes about `Auth0::exchange()` changes from v7. [#584](https://github.com/auth0/auth0-PHP/pull/584) ([BGehrels](https://github.com/BGehrels))

**Tests**

- Add Semgrep to test suite [#588](https://github.com/auth0/auth0-PHP/pull/588) ([evansims](https://github.com/evansims))
- Upgrade test suite to use 8.1 GA (up from RC builds) [#587](https://github.com/auth0/auth0-PHP/pull/587) ([evansims](https://github.com/evansims))
- Fix warnings introduced in new Psalm update [#586](https://github.com/auth0/auth0-PHP/pull/586) ([evansims](https://github.com/evansims))

## [8.0.3](https://github.com/auth0/auth0-PHP/tree/8.0.3) - 2021-11-01

**Changes**

- Introduce Interfaces to Final Classes [#581](https://github.com/auth0/auth0-PHP/pull/581) ([komando82](https://github.com/komando82))

## [8.0.2](https://github.com/auth0/auth0-PHP/tree/8.0.2) - 2021-10-18

**Fixed**

- Resolve `SessionStore::purge()` not iterating over session storage when a falsey value is stored [#577](https://github.com/auth0/auth0-PHP/pull/577) ([evansims](https://github.com/evansims))

## [8.0.1](https://github.com/auth0/auth0-PHP/tree/8.0.1) - 2021-09-23

**Fixed**

- Simplify decoding of Access Tokens via `Auth0::decode()` [#534](https://github.com/auth0/auth0-PHP/pull/571) ([shadowhand](https://github.com/shadowhand))

## [8.0.0](https://github.com/auth0/auth0-PHP/tree/8.0.0) - 2021-09-20

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

---

> Changelog entries for releases prior to 8.0 have been relocated to [CHANGELOG.ARCHIVE.md](CHANGELOG.ARCHIVE.md).
