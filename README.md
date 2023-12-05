![auth0-php](https://cdn.auth0.com/website/sdks/banners/auth0-php-banner.png)

PHP SDK for [Auth0](https://auth0.com) Authentication and Management APIs.

[![Package](https://img.shields.io/packagist/dt/auth0/auth0-php)](https://packagist.org/packages/auth0/auth0-php)
[![Build Status](https://github.com/auth0/auth0-PHP/actions/workflows/tests.yml/badge.svg)](https://github.com/auth0/auth0-PHP/actions/workflows/tests.yml)
[![Coverage](https://img.shields.io/codecov/c/github/auth0/auth0-PHP/main)](https://codecov.io/gh/auth0/auth0-PHP)
[![License](https://img.shields.io/github/license/auth0/auth0-PHP)](https://doge.mit-license.org/)

:books: [Documentation](#documentation) - :rocket: [Getting Started](#getting-started) - :computer: [API Reference](#api-reference) :speech_balloon: [Feedback](#feedback)

## Documentation

We also have tailored SDKs for [Laravel](https://github.com/auth0/laravel-auth0), [Symfony](https://github.com/auth0/symfony), and [WordPress](https://github.com/auth0/wordpress). If you are using one of these frameworks, use the tailored SDK for the best integration experience.

- Quickstarts
  - [Application using Sessions (Stateful)](https://auth0.com/docs/quickstart/webapp/php) — Demonstrates a traditional web application that uses sessions and supports logging in, logging out, and querying user profiles. [The completed source code is also available.](https://github.com/auth0-samples/auth0-php-web-app)
  - [API using Access Tokens (Stateless)](https://auth0.com/docs/quickstart/backend/php) — Demonstrates a backend API that authorizes endpoints using access tokens provided by a frontend client and returns JSON. [The completed source code is also available.](https://github.com/auth0-samples/auth0-php-api-samples)
- [PHP Examples](./EXAMPLES.md) — Code samples for common scenarios.
- [Documentation Hub](https://www.auth0.com/docs) — Learn more about integrating Auth0 with your application.

## Getting Started

### Requirements

- PHP 8.1+
- [Composer](https://getcomposer.org/)
- PHP Extensions:
  - [mbstring](https://www.php.net/manual/en/book.mbstring.php)
- Dependencies:
  - [PSR-18 HTTP Client implementation](./FAQ.md#what-is-psr-18)
  - [PSR-17 HTTP Factory implementation](./FAQ.md#what-is-psr-17)
  - [PSR-7 HTTP Messages implementation](./FAQ.md#what-is-psr-7)

> Please review our [support policy](#support-policy) for details on our PHP version support.

### Installation

Ensure you have [the necessary dependencies](#requirements) installed, then add the SDK to your application using [Composer](https://getcomposer.org/):

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

Use the `getCredentials()` method to check if a user is authenticated.

```php
// getCredentials() returns null if the user is not authenticated.
$session = $auth0->getCredentials();

if (null === $session || $session->accessTokenExpired) {
    // Redirect to Auth0 to authenticate the user.
    header('Location: ' . $auth0->login());
    exit;
}
```

Complete the authentication flow and obtain the tokens by calling `exchange()`:

```php
if (null !== $auth0->getExchangeParameters()) {
    $auth0->exchange();
}
```

Finally, you can use `getCredentials()?->user` to retrieve information about our authenticated user:

```php
print_r($auth0->getCredentials()?->user);
```

**That's it! You have successfully authenticated your first user with Auth0!** From here, you may want to try following along with [one of our quickstarts](#documentation) or browse through [our examples](./EXAMPLES.md) for additional insight and guidance.

If you have questions, the [Auth0 Community](https://community.auth0.com/) is a fantastic resource to ask questions and get help.

## API Reference

- [API Reference](https://auth0.github.io/auth0-PHP/)

## Support Policy

Our support lifecycle mirrors the [PHP release support schedule](https://www.php.net/supported-versions.php).

| SDK Version | PHP Version | Support Ends |
| ----------- | ----------- | ------------ |
| 8           | 8.3         | Nov 2026     |
|             | 8.2         | Nov 2025     |
|             | 8.1         | Nov 2024     |

We drop support for PHP versions when they reach end-of-life and cease receiving security fixes from the PHP Foundation. Please ensure your environment remains up to date so you can continue receiving updates for PHP and this SDK.

## Feedback

### Contributing

We appreciate feedback and contribution to this repo! Before you get started, please see the following:

- [Contribution Guide](./CONTRIBUTING.md)
- [Auth0's General Contribution Guidelines](https://github.com/auth0/open-source-template/blob/master/GENERAL-CONTRIBUTING.md)
- [Auth0's Code of Conduct Guidelines](https://github.com/auth0/open-source-template/blob/master/CODE-OF-CONDUCT.md)

### Raise an issue

To provide feedback or report a bug, [please raise an issue on our issue tracker](https://github.com/auth0/auth0-PHP/issues).

### Vulnerability Reporting

Please do not report security vulnerabilities on the public GitHub issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

---

<p align="center">
  <picture>
    <source media="(prefers-color-scheme: light)" srcset="https://cdn.auth0.com/website/sdks/logos/auth0_light_mode.png" width="150">
    <source media="(prefers-color-scheme: dark)" srcset="https://cdn.auth0.com/website/sdks/logos/auth0_dark_mode.png" width="150">
    <img alt="Auth0 Logo" src="https://cdn.auth0.com/website/sdks/logos/auth0_light_mode.png" width="150">
  </picture>
</p>

<p align="center">Auth0 is an easy-to-implement, adaptable authentication and authorization platform.<br />To learn more, check out <a href="https://auth0.com/why-auth0">"Why Auth0?"</a></p>

<p align="center">This project is licensed under the MIT license. See the <a href="./LICENSE.md">LICENSE file</a> for more info.</p>
