## Contributing

We provide and maintain SDKs for the benefit of our developer community. Feedback, detailed bug reports, and focused PRs are always appreciated. Thank you in advance!

When contributing to this SDK, please:

- Maintain the minimum PHP version (found under `require.php` in `composer.json` for the branch).
- Code to the [PSR-2 standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).
- Ensure all tests are passing on the whole project before submitting your PR, specifically `composer tests` and `composer tests:phpversions`
- Keep PRs focused and change the minimum number of lines to achieve your goal.

### Running static analysis

Prior to making a PR, please ensure that the unit tests pass and the static analysis suite detects no defects:

`composer tests`

You can add this to a pre-commit hook with the following:

```
echo '#!/bin/sh' > .git/hooks/pre-commit && echo 'composer tests' >> .git/hooks/pre-commit
```

Ensure it's executable: `chmod 0700 .git/hooks/pre-commit`

> Note: you need [Xdebug](https://xdebug.org/) installed. In Xdebug 3.x you need the following modes enabled: `xdebug.mode = develop,coverage,debug`

### PHP version-specific tests

Prior to making a PR, please ensure that the PHP version-specific tests pass (required Docker):

`compooser tests:phpversions`

> Note: ensure `docker/entrypoint.sh` is executable.

### Running integration tests

The integration tests require a tenant and Auth0 Application configured with the following:

- The Application must be of type Machine-to-Machine and have the Management API authorized
- The tenant must have the default Database connection named "Username-Password-Authentication", and it must not have the "Requires Username" enabled
- The tenant must have at least two rules (they can be empty rules)

You will also need to create a `.env` file in the root of this package with the following entries:

- `DOMAIN` - Auth0 domain for your test tenant
- `APP_CLIENT_ID` - Client ID for a Machine-to-Machine Application within your test tenant
- `APP_CLIENT_SECRET` - Client Secret for a Machine-to-Machine Application within your test tenant
 
> This file is automatically excluded from Git with the `.gitignore` for this repo.

To run the integration tests:

`composer test-integration`
