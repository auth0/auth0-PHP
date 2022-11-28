<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([__DIR__ . '/src', __DIR__ . '/tests']);

    $rectorConfig->sets([
        SetList::CODE_QUALITY,
    ]);

    $rectorConfig->skip([
        CompleteDynamicPropertiesRector::class => [
            // Breaks PEST
            __DIR__ . '/tests/Utilities/MockApi.php',
        ],
    ]);

    $rectorConfig->rule(TypedPropertyRector::class);

    $rectorConfig->phpVersion(PhpVersion::PHP_80);

    $rectorConfig->phpstanConfig(__DIR__ . '/phpstan.neon.dist');
};
