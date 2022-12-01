# Auth0 Contributing Guide

Before submitting your contribution, please make sure to take a moment and read through the following guidelines:

- [General Contribution Guidelines](https://github.com/auth0/open-source-template/blob/master/GENERAL-CONTRIBUTING.md)
- [Code of Conduct](https://github.com/auth0/open-source-template/blob/master/CODE-OF-CONDUCT.md)

- [Issue Reporting Guidelines](#issue-reporting-guidelines)
- [Pull Request Guidelines](#pull-request-guidelines)
- [Development Setup](#development-setup)

## Issue Reporting Guidelines

- Always use [https://github.com/auth0/auth0-PHP/issues/new/chooese](https://github.com/auth0/auth0-PHP/issues/new/chooese) to create new issues.

## Pull Request Guidelines

- All development should be done in dedicated branches. Submit PRs against the `main` branch.

- When possible, checkout a topic branch from the relevant branch, and merge back against that branch.

- It's OK to have multiple commits as you work on a PR. GitHub will automatically squash them before merging.

- Make sure `composer test` passes. (see [development setup](#development-setup))

- If adding a new feature:

  - Add appropriate test coverage.

  - Provide a convincing reason to add this feature. Ideally, you should open a proposal issue first and have it approved before working on it.

- If fixing bug:

  - Provide a detailed description of the bug in the PR.

  - Add appropriate test coverage if applicable.

## Development Setup

You will need the latest [PHP](https://php.net) version and [Composer](https://getcomposer.org/).

After cloning the repo, run:

```bash
composer install
```

### Committing Changes

Pull Request titles must follow [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) rules so our changelogs can be automatically generated. Commits messages are irrelevant as they will be squashed into the Pull Request's title during merge. Titles will be automatically validated upon commit.

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

### Commonly used Composer commands

```bash
# run the phpstan static analysis tool against /src
composer phpstan
```

```bash
# run the psalm static analysis tool against /src
composer psalm
```

```bash
# run the rector tool against /src
composer rector
```

```bash
# run the pint tool against /src
composer pint
```

```bash
# run the pest unit tests
composer pest
```

```bash
# run the full tst suite, including static analysis and unit tests
composer test
```

**Please make sure to have `composer test` pass successfully before submitting a PR.** Although the same tests will be run against your PR on the CI server, it is better to have it working locally.
