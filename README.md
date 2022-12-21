![auth0-php](https://cdn.auth0.com/website/sdks/banners/auth0-php-banner.png)

PHP SDK for [Auth0](https://auth0.com) Authentication and Management APIs.

[![Package](https://img.shields.io/packagist/dt/auth0/auth0-php)](https://packagist.org/packages/auth0/auth0-php)
[![Unit Tests](https://github.com/auth0/auth0-PHP/actions/workflows/test-unit.yml/badge.svg)](https://github.com/auth0/auth0-PHP/actions/workflows/test-unit.yml)
[![Acceptance Tests](https://github.com/auth0/auth0-PHP/actions/workflows/test-acceptance.yml/badge.svg)](https://github.com/auth0/auth0-PHP/actions/workflows/test-acceptance.yml)
[![Coverage](https://codecov.io/gh/auth0/auth0-PHP/branch/main/graph/badge.svg?token=PtrLf5j8JK)](https://codecov.io/gh/auth0/auth0-PHP)
[![License](https://img.shields.io/packagist/l/auth0/auth0-php)](https://doge.mit-license.org/)

:books: [Documentation](#documentation) - :rocket: [Getting Started](#getting-started) - :computer: [API Reference](#api-reference) :speech_balloon: [Feedback](#feedback)

## Documentation

- Stateful Applications
  - [Quickstart](https://auth0.com/docs/quickstart/webapp/php) — add login, logout and user information to a PHP application using Auth0.
  - [Sample Application](https://github.com/auth0-samples/auth0-php-web-app) — a sample PHP web application integrated with Auth0.
- Stateless Applications
  - [Quickstart](https://auth0.com/docs/quickstart/backend/php) — add access token handling and route authorization to a backend PHP application using Auth0.
  - [Sample Application](https://github.com/auth0-samples/auth0-php-api-samples) — a sample PHP backend application integrated with Auth0.
- [Examples](./EXAMPLES.md) — code samples for common scenarios.
- [Docs site](https://www.auth0.com/docs) — explore our docs site and learn more about Auth0.

## Getting Started

### Requirements

- PHP 8.0+
- A [PSR-17](https://packagist.org/providers/psr/http-factory-implementation) (HTTP factory) library
- A [PSR-18](https://packagist.org/providers/psr/http-client-implementation) (HTTP client) library

> Please review our [support policy](#support-policy) to learn when language and framework versions will exit support in the future.

### Installation

After installing the [required dependencies](#requirements), add the SDK to your application with [Composer](https://getcomposer.org/):

```
composer require auth0/auth0-php
```

### Configure Auth0

Create a **Regular Web Application** in the [Auth0 Dashboard](https://manage.auth0.com/#/applications). Verify that the "Token Endpoint Authentication Method" is set to `POST`.

Next, configure the callback and logout URLs for your application under the "Application URIs" section of the "Settings" page:

- **Allowed Callback URLs**: The URL of your application where Auth0 will redirect to during authentication, e.g., `http://localhost:3000/callback`.
- **Allowed Logout URLs**: The URL of your application where Auth0 will redirect to after user logout, e.g., `http://localhost:3000/login`.

Note the **Domain**, **Client ID**, and **Client Secret**. These values will be used later.

### Add login to your application

Create a `SdkConfiguration` instance configured with your Auth0 domain and Auth0 application client ID and secret. Generate a sufficiently long, random string for your `cookieSecret` using `openssl rand -hex 32`. Create a new `Auth0` instance and pass your configuration to it.

```php
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

$configuration = new SdkConfiguration(
    domain: 'Your Auth0 domain',
    clientId: 'Your Auth0 application client ID',
    clientSecret: 'Your Auth0 application client secret',
    cookieSecret: 'Your generated string',
);

$auth0 = new Auth0($configuration);
```

Use `getCredentials()` to check if a user is signed in. Redirect guests to sign in using the Auth0 login page with `login()`:

```php
$session = $auth0->getCredentials();

if (null === $session || $session->accessTokenExpired) {
    header('Location: ' . $auth0->login());
    exit;
}
```

Complete the authentication and obtain the tokens by calling `exchange()`:

```php
if (null !== $auth0->getExchangeParameters()) {
    $auth0->exchange();
}
```

Use `getUser()` to retrieve information about our authenticated user:

```php
print_r($auth0->getUser());
```

That's it! You have authenticated the user with Auth0. More examples can be found in [EXAMPLES.md](./EXAMPLES.md).

## API Reference

- [API Reference](https://auth0.github.io/auth0-PHP/)

## Support Policy

Our support lifecycle mirrors the [PHP release support schedule](https://www.php.net/supported-versions.php). Our support for PHP versions end when they stop receiving security fixes.

| SDK Version | PHP Version | Support Ends |
| ----------- | ----------- | ------------ |
| 8           | 8.2         | Dec 2025     |
|             | 8.1         | Nov 2024     |
|             | 8.0         | Nov 2023     |

Deprecations of EOL'd versions are not considered a breaking change, as Composer handles these scenarios elegantly. Legacy applications will stop receiving updates from us, but will continue to function on those unsupported SDK versions. Please ensure your PHP environment always remains up to date, particularly in production.

## Feedback

### Contributing

We appreciate feedback and contribution to this repo! Before you get started, please see the following:

- [Contribution Guide](./CONTRIBUTING.md)
- [Auth0's General Contribution Guidelines](https://github.com/auth0/open-source-template/blob/master/GENERAL-CONTRIBUTING.md)
- [Auth0's Code of Conduct Guidelines](https://github.com/auth0/open-source-template/blob/master/CODE-OF-CONDUCT.md)

### Raise an issue

To provide feedback or report a bug, [please raise an issue on our issue tracker](https://github.com/auth0/auth0-PHP/issues).

### Vulnerability Reporting

Please do not report security vulnerabilities on the public Github issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

---

<p align="center">
  <picture>
    <source media="(prefers-color-scheme: light)" srcset="https://cdn.auth0.com/website/sdks/logos/auth0_light_mode.png" width="150">
    <source media="(prefers-color-scheme: dark)" srcset="https://cdn.auth0.com/website/sdks/logos/auth0_dark_mode.png" width="150">
    <img alt="Auth0 Logo" src="https://cdn.auth0.com/website/sdks/logos/auth0_light_mode.png" width="150">
  </picture>
</p>

<p align="center">Auth0 is an easy to implement, adaptable authentication and authorization platform.<br />To learn more checkout <a href="https://auth0.com/why-auth0">Why Auth0?</a></p>

<p align="center">This project is licensed under the MIT license. See the <a href="./LICENSE.md"> LICENSE</a> file for more info.</p>
