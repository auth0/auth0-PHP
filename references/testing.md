# Testing

The default suites need no credentials. Read this file before writing or running tests.

## Two suites

`phpunit.xml.dist` defines two suites. The `management` suite covers `tests/API/Management` (generated) and `tests/Unit/API/Management/Wrapper` (hand-written). The `unit` suite covers the rest of `tests/Unit`. `composer pest` runs both suites, and `composer test-management` runs only the management suite through PHPUnit.

A gitignored `phpunit.xml` overrides `phpunit.xml.dist` when it exists. A local copy with only the `management` suite makes `composer pest` look green while it runs no unit tests, so check for that file or pass `-c phpunit.xml.dist`.

## Pest conventions

Hand-written tests under `tests/Unit` use Pest. A typical file declares `declare(strict_types=1)`, tags itself with `uses()->group('storage', 'storage.memory')`, builds shared state in `beforeEach`, and writes each case as `test('set() assigns values as expected', function (...): void { ... })` with a `->with([...])` dataset where inputs vary. See `tests/Unit/Store/MemoryStoreTest.php` for a short example.

The wrapper tests in `tests/Unit/API/Management/Wrapper` are the exception. They are PHPUnit `TestCase` classes that use Guzzle's `MockHandler` instead of a real network.

## Helpers

`tests/Utilities` holds the shared helpers, including `TokenGenerator` for signed test tokens, `MockStore`, `MockDomain`, `MockConfiguration`, `MockCrypto`, `MockClientAbstract` and `AuthenticationMockClient` for fake HTTP, and `HttpResponseGenerator`. Reuse them before adding new ones.

## Coverage

New features need 100% coverage and a bug fix needs a test that reproduces the bug, per `CONTRIBUTING.md` and the PR template. No tool enforces the percentage, so reviewers do. `src/Event/`, `src/Contract/` and `src/Exception/` are excluded from coverage in `phpunit.xml.dist`.

## Generated tests

Files under `tests/API/Management` come from Fern. Do not edit them by hand, because regeneration overwrites them. `tests/Pest.php`, `tests/Data/`, `tests/Unit/` and `tests/Utilities/` are in `.fernignore`. Nothing under `tests/` is linted or statically analyzed, so match the style of the surrounding tests by hand.
