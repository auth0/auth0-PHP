## Contributing

We provide and maintain SDKs for the benefit of our developer community. Feedback, detailed bug reports, and focused PRs are appreciated. Thank you in advance!

When contributing to this SDK, please:

- Maintain the minimum PHP version (found under `require.php` in `composer.json`).
- Code to the [PSR-2 standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md).
- Write tests and run them with `composer test`.
- Keep PRs focused and change the minimum number of lines to achieve your goal.

To run tests on the SDK, you'll need to create a `.env` file in the root of this package with the following entries:

- `DOMAIN` - Auth0 domain for your test tenant
- `APP_CLIENT_ID` - Client ID for a Regular Web Application within your test tenant
- `APP_CLIENT_SECRET` - Client Secret for a Regular Web Application within your test tenant
- `NIC_ID` - Client ID for a test Non-Interactive Client Application
- `NIC_SECRET` - Client Secret for a test Non-Interactive Client Application
- `GLOBAL_CLIENT_ID` - Client ID for your tenant (found in Tenant > Settings > Advanced)
- `GLOBAL_CLIENT_SECRET` - Client Secret for your tenant (found in Tenant > Settings > Advanced)

This file is automatically excluded from Git with the `.gitignore` for this repo. 

We're working on test coverage and quality but please note that newer tenants might see errors (typically `404`) for endpoints that are no longer available. Another common error is a `429` for too many requests. 
