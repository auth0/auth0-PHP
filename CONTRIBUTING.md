# Contribution Guide

- [Getting Involved](#getting-involved)
- [Support Questions](#support-questions)
- [Code Contributions](#code-contributions)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Coding Style](#coding-style)
  - [PHPDoc](#phpdoc)
  - [Pint](#pint)
- [Code of Conduct](#code-of-conduct)

## Getting Involved

To encourage active collaboration, Auth0 strongly encourages pull requests, not just bug reports. Pull requests will only be reviewed when marked as "ready for review" (not in the "draft" state) and all tests for new features are passing. Lingering, non-active pull requests left in the "draft" state will eventually be closed.

If you file a bug report, your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue. The goal of a bug report is to make it easy for yourself - and others - to replicate the bug and develop a fix.

Remember, bug reports are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the bug report will automatically see any activity or that others will jump to fix it. Creating a bug report serves to help yourself and others start on the path of fixing the problem. If you want to chip in, you can help out by fixing any bugs listed in our issue trackers.

## Support Questions

Auth0's GitHub issue trackers are not intended to provide integration support. Instead, please refer your questions to the [Auth0 Community](https://community.auth0.com).

## Code Contributions

You may propose new features or improvements of existing SDK behavior by creating a feature request within the repository's issue tracker. If you are willing to implement at least some of the code that would be needed to complete the feature, please fork the repository and submit a pull request.

All development should be done in individual forks using dedicated branches, and submitted against the `main` default branch.

Pull request titles must follow [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) rules so our changelogs can be automatically generated. Commits messages are irrelevant as they will be squashed into the Pull request's title during merge. Titles will be automatically validated upon commit.

The following types are allowed:

- _feat:_ A new feature
- _perf:_ A code change that improves performance
- _refactor:_ A code change that neither fixes a bug nor adds a feature
- _build:_ Changes that affect the build system or external dependencies (example scopes: gulp, broccoli, npm)
- _ci:_ Changes to our CI configuration files and scripts (example scopes: Travis, Circle, BrowserStack, SauceLabs)
- _style:_ Changes that do not affect the meaning of the code (white-space, formatting, missing semi-colons, etc)
- _fix:_ A bug fix
- _security:_ A change that improves security
- _docs:_ Documentation only changes
- _test:_ Adding missing tests or correcting existing tests

## Security Vulnerabilities

If you discover a security vulnerability within the SDK, please do **not** report it in the issue tracker. Auth0's [Responsible Disclosure Program](https://auth0.com/responsible-disclosure-policy) details the procedure for disclosing security issues.

## Coding Style

This SDK follows the [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) coding standard and the [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) autoloading standard.

### PHPDoc

Below is an example of a valid documentation block. Note that the @param attribute is followed by two spaces, the argument type, two more spaces, and finally the variable name:

```php
/**
 * Register a binding with the container.
 *
 * @param  string|array  $abstract
 * @param  \Closure|string|null  $concrete
 * @param  bool  $shared
 * @return void
 *
 * @throws \Exception
 */
public function bind($abstract, $concrete = null, $shared = false)
{
    //
}
```

### Pint

You should focus on the content of your contribution and not on the code styling. To this end, we use [Laravel Pint](https://github.com/laravel/pint) to automatically check and fix the code styling.

Before creating a pull request, please run `composer pint` to review any necessary styling changes. `composer pint:fix` will attempt to automatically fix the issues.

## Code of Conduct

Before making any contributions to this repo, please review Auth0's [Code of Conduct](https://github.com/auth0/open-source-template/blob/master/CODE-OF-CONDUCT.md). By contributing, you agree to uphold this code.
