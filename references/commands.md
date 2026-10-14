# Commands

All commands are Composer scripts from `composer.json`. Pest, PHPUnit and PHPStan run in CI on PHP 8.2, 8.3 and 8.4 (`.github/workflows/matrix.json`). The other checks run on 8.2 only. Read this file when you need to run one check instead of the whole gate.

## Everything at once

```bash
# pest, test-management, phpstan, psalm, rector, phpcs
composer test
```

CI also runs two Composer checks that `composer test` does not.

```bash
composer normalize --dry-run --diff
composer validate --strict --with-dependencies
```

## Tests

```bash
# Pest with coverage, runs every suite in phpunit.xml.dist (needs Xdebug or PCOV)
composer pest

# What CI runs for Pest, in parallel and random order
composer pest:ci

# Only the PHPUnit "management" suite (generated Management tests and the wrapper tests)
composer test-management

# One Pest file
vendor/bin/pest tests/Unit/Store/MemoryStoreTest.php
```

`composer pest` passes `--strict-global-state --fail-on-risky --fail-on-warning --coverage --strict-coverage`, so risky tests and warnings fail the run. It sets no minimum coverage, so the 100% rule is a review rule that no tool enforces.

A gitignored `phpunit.xml` overrides `phpunit.xml.dist` when it exists. If Pest reports no `Unit` tests, check for that file or pass `-c phpunit.xml.dist`.

## Static analysis and style

```bash
# PHPStan for both configs (phpstan.neon.dist and phpstan-management.neon)
composer phpstan

# One config only (phpstan:auth or phpstan:management)
composer phpstan:auth

# Psalm
composer psalm

# Rector, dry run (use rector:fix to apply)
composer rector

# PHP CS Fixer, dry run
composer phpcs

# PHP CS Fixer, apply fixes
composer phpcs:fix
```
