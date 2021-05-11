<?php

declare(strict_types=1);

return [
    'preset' => 'default',
    'ide' => null,

    'exclude' => [
        // 'path/to/directory-or-file'
    ],

    'add' => [
        \NunoMaduro\PhpInsights\Domain\Metrics\Code\Comments::class => [
            \SlevomatCodingStandard\Sniffs\Classes\RequireMultiLineMethodSignatureSniff::class,
        ],
    ],

    'remove' => [
        \NunoMaduro\PhpInsights\Domain\Insights\ForbiddenGlobals::class,
        \NunoMaduro\PhpInsights\Domain\Insights\ForbiddenNormalClasses::class,
        \NunoMaduro\PhpInsights\Domain\Sniffs\ForbiddenSetterSniff::class,
        \ObjectCalisthenics\Sniffs\Files\ClassTraitAndInterfaceLengthSniff::class,
        \ObjectCalisthenics\Sniffs\Files\FunctionLengthSniff::class,
        \ObjectCalisthenics\Sniffs\Metrics\MethodPerClassLimitSniff::class,
        \PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff::class,
        \SlevomatCodingStandard\Sniffs\Classes\SuperfluousExceptionNamingSniff::class,
        \SlevomatCodingStandard\Sniffs\Classes\SuperfluousInterfaceNamingSniff::class,
    ],

    'config' => [
        \SlevomatCodingStandard\Sniffs\Functions\UnusedParameterSniff::class => [
            'exclude' => [
                'src/Store/EmptyStore.php',
            ],
        ],
        \SlevomatCodingStandard\Sniffs\Classes\RequireMultiLineMethodSignatureSniff::class => [
            'minLineLength' => '0',
        ],
    ],

    'requirements' => [
        // 'min-quality' => 0,
        // 'min-complexity' => 0,
        // 'min-architecture' => 0,
        // 'min-style' => 0,
        // 'disable-security-check' => false,
    ],
];
