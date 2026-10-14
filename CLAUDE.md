# AI Agent Guidelines for auth0-PHP

## Your Role

You are a PHP SDK engineer working on auth0-PHP, the client for the Auth0 Authentication and Management APIs. Most of the Management API is Fern-generated and the rest is hand-written, so check which before you edit.

---

## Project Structure

```
auth0-PHP/
├── src/
│   ├── Auth0.php, Token.php        # Main entry points (hand-written)
│   ├── API/
│   │   ├── Authentication.php, Authentication/, ClientAbstract.php   # Authentication API (hand-written)
│   │   ├── Management.php          # Re-export wrapper (hand-written)
│   │   └── Management/             # Management API (Fern-generated)
│   │       ├── <Resource>/         # One client + Requests/ per resource (Users, Roles, ...)
│   │       ├── Management.php, Exceptions/, Traits/, Utils/   # Generated root client and helpers
│   │       ├── Types/, Core/       # Generated request/response types and HTTP plumbing
│   │       └── Wrapper/            # ManagementClient, ManagementClientOptions, TokenProvider (hand-written)
│   ├── Configuration/, Contract/, Event/, Exception/, Mixins/, Mock/   # Hand-written
│   ├── Store/                      # Cookie, session, memory, PSR-6 and PSR-14 stores (hand-written)
│   ├── Token/                      # JWT parse, verify, validate, generate (hand-written)
│   └── Utility/                    # HTTP client/request, telemetry, PKCE, pagination (hand-written)
├── tests/
│   ├── Unit/                       # Pest tests for hand-written code (hand-written)
│   ├── Utilities/, Data/, Pest.php # Test helpers, fixtures, Pest bootstrap (hand-written)
│   └── API/Management/             # PHPUnit tests for generated code (Fern-generated)
├── examples/                       # Sample apps (hand-written)
├── docs/                           # Legacy v8-era markdown, not regenerated (the API site is built on release)
├── .fernignore                     # Source of truth for what Fern must not overwrite
├── .version                        # Published version, kept in sync with src/Auth0.php
└── reference.md                    # Generated Management API samples
```

### Key Files

| File | Purpose |
|------|---------|
| `.fernignore` | Every path Fern preserves on regeneration. Check it before editing anything under `src/` or `tests/`. |
| `src/Auth0.php` | Main SDK class, holds the `VERSION` constant. |
| `src/API/Management/Wrapper/ManagementClient.php` | Management API entry point with automatic token handling and the `Auth0-Client` header. |
| `src/Utility/HttpTelemetry.php` | Builds the `Auth0-Client` telemetry payload for Authentication API requests. |

---

## Boundaries

### ✅ Always Do

- Check `.fernignore` before editing a file under `src/` or `tests/`. Listed paths are hand-written and safe to edit, everything else is regenerated.
- Run `composer test` before committing. See [references/commands.md](references/commands.md) for the individual steps.
- Add Pest tests for new hand-written code. CONTRIBUTING requires 100% coverage for new features, and a bug fix needs a test that reproduces the bug.
- Follow PHP CS Fixer, PHPStan (level `max`, with strict rules on hand-written code) and Psalm (level 1). Add PHPDoc to every public class and method.
- Update `README.md` and `EXAMPLES.md` in the same PR when you change public API, configuration options or integration patterns. Both are listed in `.fernignore`, so the edits persist. See [references/docs-update.md](references/docs-update.md).
- Update the sample apps under `examples/` in the same PR when you change the API they demonstrate.
- Leave the version alone outside a release PR. It lives in `.version`, `src/Auth0.php` and `src/API/Management/Management.php`, and all three must match.
- Make surgical changes. Touch only what the request requires and do not reformat code next to it.
- Send new outbound requests to Auth0 through `HttpRequest` and `HttpTelemetry` so they carry `Auth0-Client` and keep the `httpTelemetry` opt-out working. `ManagementClient` builds its own header inline, so a telemetry change has to touch both.

### ⚠️ Ask First

- Any breaking change. Stop and ask the maintainer before writing it. If it goes ahead, update `UPGRADE.md` and `v9_MIGRATION_GUIDE.md` in the same PR.
- Fixing generated Management API behavior. A lasting fix needs a change to the Fern API definition or generator, not a local edit. Flag it instead of patching the file.
- Adding or upgrading dependencies in `composer.json`.
- Changing `.github/` workflows or actions, or the release and version setup (`.shiprc`, `.version`).
- Changing public method signatures.
- Touching token, signing, encryption or session-state code (`src/Token/`, `src/Store/CookieStore.php`, `src/Store/SessionStore.php`, `src/Utility/TransientStoreHandler.php`, `src/Utility/PKCE.php`, `src/API/Management/Wrapper/TokenProvider.php`, and the login, token exchange and back-channel logout paths in `src/Auth0.php`).

### 🚫 Never Do

- Hand-edit Fern-generated files. The change is lost on the next regeneration.
- Hand-edit `reference.md`, anything in `.fern/` or anything in `vendor/`, and do not commit `composer.lock` (it is gitignored).
- Commit secrets, API keys, tokens or a real tenant domain.
- Remove or skip a failing test without fixing the cause.
- Break backward compatibility without approval (see Ask First).
---

## Security Considerations

- Never log tokens, client secrets or cookie contents, and never hardcode them in code, tests or `examples/`.
- ID token checks live in `src/Token/` (`Parser`, `Validator`, `Verifier`). Do not weaken verification or add a way around it.
- Client assertions (`src/Token/ClientAssertionGenerator.php`) and the encrypted `CookieStore` are security-sensitive. Treat edits there as Ask First.
- Management API tokens are fetched and cached by `src/API/Management/Wrapper/TokenProvider.php`. Keep credentials in environment variables.
- Never commit secrets, API keys or tokens.

---

> The sections below are reference material. Each has a short summary here and the detail in `references/`.

## Commands

The main loop is `composer test`, which runs everything CI checks except the two Composer jobs. See [references/commands.md](references/commands.md) for the full list. Read it when you need to run a single check or test.

```bash
# Full local gate (pest, management suite, phpstan, psalm, rector, phpcs)
composer test

# Auto-fix code style
composer phpcs:fix
```

---

## Testing

Pest runs both suites in `phpunit.xml.dist`, and `composer test-management` runs only the `management` suite through PHPUnit. The default suites need no credentials. See [references/testing.md](references/testing.md) for conventions, helpers and the suite split. Read it before writing or running tests.

---

## Code Style

PHP CS Fixer enforces `declare(strict_types=1)`, short array syntax and `final` classes. `src/API/Management/` is excluded from PHP CS Fixer, Psalm and Rector, and only a separate PHPStan config (`phpstan-management.neon`) checks it. See [references/code-style.md](references/code-style.md) for naming and patterns. Read it when writing new classes.

---

## Git Workflow

Branch from `main` as `type/short-slug` and open PRs against `main`. Never name a branch `release/*`, because merging one publishes the package. PR titles must follow Conventional Commits because commits are squashed into the title. See [references/git-workflow.md](references/git-workflow.md) for the allowed types and the PR template. Read it before opening a PR.

---

## Common Pitfalls

Generated PHP files carry no "auto-generated" header, so `.fernignore` is the only reliable way to tell. See [references/pitfalls.md](references/pitfalls.md) for the rest. Read it when a change touches `src/API/Management/` or the regeneration flow.

---

## Docs Update Rules

A PR that changes public API, configuration or integration patterns is not complete until the matching docs are updated in the same PR. See [references/docs-update.md](references/docs-update.md) for the tracked docs and the code-to-docs map. Read it before finishing a PR that changes public behavior.
