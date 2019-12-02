# Auth0 PHP SDK

[![CircleCI](https://img.shields.io/circleci/project/github/auth0/auth0-PHP/master.svg)](https://circleci.com/gh/auth0/auth0-PHP)
[![Latest Stable Version](https://poser.pugx.org/auth0/auth0-php/v/stable)](https://packagist.org/packages/auth0/auth0-php)
[![codecov](https://codecov.io/gh/auth0/auth0-PHP/branch/master/graph/badge.svg)](https://codecov.io/gh/auth0/auth0-PHP)
[![License](https://poser.pugx.org/auth0/auth0-php/license)](https://packagist.org/packages/auth0/auth0-php)
[![Total Downloads](https://poser.pugx.org/auth0/auth0-php/downloads)](https://packagist.org/packages/auth0/auth0-php)

The Auth0 PHP SDK provides straight-forward and tested methods for accessing Authentication and Management API endpoints. This README describes how to get started and provides simple examples of how to use the SDK.

**Branches**

- `master` - Work in progress for minor and patch releases
- [`7.0.0-dev`](https://github.com/auth0/auth0-PHP/tree/7.0.0-dev) - Work in progress for upcoming major release
- **All other branches are not maintained and will be removed**

## Table of Contents

- [Documentation](#documentation)
- [Installation](#installation)
- [Getting Started](#getting-started)
- [Contributing](#contributing)
- [Support + Feedback](#support--feedback)
- [Vulnerability Reporting](#vulnerability-reporting)
- [What is Auth0](#what-is-auth0)
- [License](#license)

## Documentation

* [Documentation](https://auth0.com/docs/libraries/auth0-php)
* [Basic PHP application quickstart](https://auth0.com/docs/quickstart/webapp/php/)
* [PHP API quickstart](https://auth0.com/docs/quickstart/backend/php/)

## Installation

We recommend installing the SDK with [Composer](https://getcomposer.org/):

```bash
$ composer require auth0/auth0-php
```

More details on this process as well as a manual option can be found on the [main documentation page](https://auth0.com/docs/libraries/auth0-php#installation).


## Getting Started

To get started, you'll need a [free Auth0 account](https://auth0.com/signup) and an [Application](https://auth0.com/docs/applications). Use the settings from the Auth0 Application in the code snippet below:

```php
// Instantiate the base Auth0 class.
$auth0 = new Auth0([
	// The values below are found on the Application settings tab.
	'domain' => 'your-tenant.auth0.com',
	'client_id' => 'application_client_id',
	'client_secret' => 'application_client_secret',

	// This is your application URL that will be used to process the login.
	// Save this URL in the "Allowed Callback URLs" field on the Application settings tab
	'redirect_uri' => 'https://yourdomain.com/auth/callback',
]);
```

**The values above should not be hard-coded in a production application** but will suffice for testing or local development. Please see our complete guide on the [main documentation page](https://auth0.com/docs/libraries/auth0-php#getting-started) for more information on how to store and use these values.

## Contributing

We appreciate feedback and contribution to this repo! Before you get started, please see the following:

- [Auth0's general contribution guidelines](https://github.com/auth0/open-source-template/blob/master/GENERAL-CONTRIBUTING.md)
- [Auth0's code of conduct guidelines](https://github.com/auth0/open-source-template/blob/master/CODE-OF-CONDUCT.md)
- [This repo's contribution guide](CONTRIBUTING.md)

## Support + Feedback

- Use [Community](https://community.auth0.com/) for usage, questions, specific cases
- Use [Issues](https://github.com/auth0/auth0-PHP/issues) here for code-level support and bug reports
- Customers with a paid Auth0 subscription can use the [Support Center](https://support.auth0.com/) to submit a ticket to our support specialists.

## Vulnerability Reporting

Please do not report security vulnerabilities on the public GitHub issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

## What is Auth0?

Auth0 helps you to easily:

- implement authentication with multiple identity providers, including social (e.g., Google, Facebook, Microsoft, LinkedIn, GitHub, Twitter, etc), or enterprise (e.g., Windows Azure AD, Google Apps, Active Directory, ADFS, SAML, etc.)
- log in users with username/password databases, passwordless, or multi-factor authentication
- link multiple user accounts together
- generate signed JSON Web Tokens to authorize your API calls and flow the user identity securely
- access demographics and analytics detailing how, when, and where users are logging in
- enrich user profiles from other data sources using customizable JavaScript rules

[Why Auth0?](https://auth0.com/why-auth0)

## License

The Auth0-PHP SDK is licensed under MIT - [LICENSE](LICENSE.txt)
