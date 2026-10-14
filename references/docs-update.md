# Docs Update Rules

A PR that changes public API, configuration or integration patterns is not complete until the matching docs change in the same PR. Read this file before you finish a PR that changes public behavior.

## Tracked docs

| File | Covers | Edit by hand? |
|------|--------|---------------|
| `README.md` | Install, setup, Authentication API, Management API client, errors, pagination, retries | Yes, listed in `.fernignore` |
| `EXAMPLES.md` | Strategy configurations, logging out, refresh tokens, Authentication API, Custom Token Exchange, Management API, decoding tokens, Organizations, PSR-17 and PSR-18, cookie and PHP session storage | Yes, listed in `.fernignore` |
| `FAQ.md` | PSR and caching questions | Yes, listed in `.fernignore` |
| `UPGRADE.md`, `v9_MIGRATION_GUIDE.md` | Upgrade steps for breaking changes | Yes, listed in `.fernignore` |
| `examples/` | Sample apps | Yes, listed in `.fernignore` |
| `reference.md` | Management API samples | No, generated |
| `docs/` | Legacy v8-era markdown that is not regenerated | Leave alone |

The Authentication API reference site is built by the `docs` job in `release.yml` with phpDocumentor and published to the `docs` branch. Running phpDocumentor locally writes into `docs/` and dirties the tree, so do not commit that output. `CHANGELOG.md` is updated by the release flow, not in feature PRs.

## When you change code, update these docs

| Code change | Update |
|-------------|--------|
| `Auth0` class, `SdkConfiguration` options | `README.md` setup and `EXAMPLES.md` |
| `src/API/Authentication*` methods | `README.md` Authentication API and `EXAMPLES.md` Authentication API |
| `src/API/Management/Wrapper/` options or token handling | `README.md` Management API Client and `EXAMPLES.md` Management API |
| `src/Store/*` | `EXAMPLES.md` cookie and PHP session storage |
| `src/Token/*` | `EXAMPLES.md` manual token decoding |
| `src/Exception/*` | `EXAMPLES.md` Error handling sections |
| Generated Management exceptions | `README.md` Exception Handling |
| A breaking change | `UPGRADE.md` and `v9_MIGRATION_GUIDE.md` |
| Behavior shown in a sample app | The matching app under `examples/` |

Update the doc in the same PR and do not defer it.
