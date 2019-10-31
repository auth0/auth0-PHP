## Contributing

We provide and maintain SDKs for the benefit of our developer community. Feedback, detailed bug reports, and focused PRs are always appreciated. Thank you in advance!

When contributing to this SDK, please:

- Maintain the minimum PHP version (found under `require.php` in `composer.json` for the branch).
- Code to the [PSR-2 standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).
- Write tests and run them with `composer test`.
- Run `composer phpcbf` for the whole project before submitting your PR for review. 
- Run `composer phpcs` for the changed PHP files before submitting your PR for review (optional). 
- Keep PRs focused and change the minimum number of lines to achieve your goal.

To run integration tests on the SDK, you'll need to create a `.env` file in the root of this package with the following entries:

- `DOMAIN` - Auth0 domain for your test tenant
- `APP_CLIENT_ID` - Client ID for a Regular Web Application within your test tenant
- `APP_CLIENT_SECRET` - Client Secret for a Regular Web Application within your test tenant

This file is automatically excluded from Git with the `.gitignore` for this repo.
