# Common Pitfalls

Read this file when a change touches `src/API/Management/` or the regeneration flow.

## Generated files have no marker

Fern-generated PHP files do not start with an "auto-generated" header comment, so you cannot tell by opening the file. The only reliable check is `.fernignore`. If a path under `src/` or `tests/` is not listed there, it is regenerated.

## `.fernignore` protects only what it lists

`src/API/Management/Wrapper/` and `src/API/Management.php` are protected, but the rest of `src/API/Management/` is not, including `Core/`, `Types/`, `Management.php` (the generated root client) and every resource client. `reference.md` is also regenerated.

Fern Replay records a few manual edits in `.fern/replay.lock` and re-applies them after regeneration. Never edit `.fern/` by hand. The only sanctioned manual edit to a generated file is the version bump in a release PR.

## Most style checks skip the Management API

PHP CS Fixer, Psalm and Rector exclude `src/API/Management/`, and the main PHPStan config does too. Only `phpstan-management.neon` analyzes it, without the strict rules. The `src/API/Management/Wrapper/` files are hand-written but get the same treatment, so a green run says little about wrapper code and it needs a careful read.

## PHPStan runs as two configs

`composer phpstan` runs `phpstan.neon.dist` for the hand-written side and `phpstan-management.neon` for the Management side. Run `composer phpstan` and not one config when you check a change. Do not add entries to `phpstan-baseline.neon`.

## The version lives in three places

`.version`, the `VERSION` constant in `src/Auth0.php` and the two version strings in `src/API/Management/Management.php` must match. `.shiprc` bumps only the first two, so the release PR edits the third by hand. Do not change any of them outside a release PR.

## A new Management resource needs a docblock update

`ManagementClient` lists each resource as an `@property-read` in its docblock, and the list is hand-written. When a regeneration adds a top-level resource, add its line there, or IDEs and static analysis lose the type even though the call works.
