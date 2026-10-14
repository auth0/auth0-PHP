# Code Style

Read this file when you write a new class or method. `src/API/Management/` is excluded from PHP CS Fixer, Psalm and Rector, and the main PHPStan config skips it too. A separate config, `phpstan-management.neon`, runs PHPStan on it at level `max`, without the strict rules. `tests/` is never linted or statically analyzed, and `src/Utility/Assert.php` is skipped by every tool.

## What the tools enforce

PHP CS Fixer (`.php-cs-fixer.dist.php`) requires `declare(strict_types=1)`, short array syntax, `final` classes, alphabetical imports and native function invocation. PHPStan runs at level `max` with strict rules (`phpstan.neon.dist`), Psalm at error level 1 (`psalm.xml.dist`), and Rector applies PHP 8.2 sets plus dead code, code quality, coding style, type declarations and early return (`rector.php`). `.editorconfig` sets 4-space PHP indentation, LF line endings and a final newline.

## Patterns in the code

Hand-written classes in `src/` are `final` and implement an interface from `src/Contract/` where one exists, for example `ValidatorInterface` and the stores that implement `StoreInterface`. Many helpers such as `Parser`, `Verifier` and `HttpRequest` are `final` with no interface. Errors are `final` exception classes in `src/Exception/` that implement the `Auth0Exception` interface. Configuration goes through `SdkConfiguration`. Public classes and methods carry PHPDoc, as `CONTRIBUTING.md` requires.

## Example

```php
<?php

declare(strict_types=1);

namespace Auth0\SDK\Store;

use Auth0\SDK\Contract\StoreInterface;

final class MemoryStore implements StoreInterface
{
    // ...
}
```

This is the shape of `src/Store/MemoryStore.php`. In hand-written `src/` code outside `src/API/Management/`, a class that is not `final` or omits `declare(strict_types=1)` fails PHP CS Fixer in CI. The files in `src/API/Management/Wrapper/` are not checked, so add `declare(strict_types=1)` by hand when you write new ones.
