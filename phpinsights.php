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
        \NunoMaduro\PhpInsights\Domain\Insights\CyclomaticComplexityIsHigh::class,
        \NunoMaduro\PhpInsights\Domain\Insights\ForbiddenGlobals::class,
        \NunoMaduro\PhpInsights\Domain\Insights\ForbiddenNormalClasses::class,
        \NunoMaduro\PhpInsights\Domain\Insights\ForbiddenTraits::class,
        \NunoMaduro\PhpInsights\Domain\Sniffs\ForbiddenSetterSniff::class,
        \ObjectCalisthenics\Sniffs\Files\ClassTraitAndInterfaceLengthSniff::class,
        \ObjectCalisthenics\Sniffs\Files\FunctionLengthSniff::class,
        \ObjectCalisthenics\Sniffs\Metrics\MethodPerClassLimitSniff::class,
        \ObjectCalisthenics\Sniffs\Metrics\MaxNestingLevelSniff::class,
        \PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff::class,
        \PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\TodoSniff::class,
        \SlevomatCodingStandard\Sniffs\Classes\SuperfluousExceptionNamingSniff::class,
        \SlevomatCodingStandard\Sniffs\Classes\SuperfluousInterfaceNamingSniff::class,
        \SlevomatCodingStandard\Sniffs\Classes\UnusedPrivateElementsSniff::class,
        \SlevomatCodingStandard\Sniffs\Functions\FunctionLengthSniff::class,
        \SlevomatCodingStandard\Sniffs\TypeHints\DisallowMixedTypeHintSniff::class,
        \SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff::class,
        \SlevomatCodingStandard\Sniffs\TypeHints\PropertyTypeHintSniff::class,
        \SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff::class,
    ],

    'config' => [
        \PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DeprecatedFunctionsSniff::class => [
            'exclude' => [
                'src/Token/Verifier.php',
            ],
        ],
        \SlevomatCodingStandard\Sniffs\Functions\UnusedParameterSniff::class => [
            'exclude' => [
                'src/API/Management.php',
                'src/Configuration/SdkConfiguration.php',
                'src/Configuration/SdkState.php',
                'src/Store/SessionStore.php',
                'src/Store/MemoryStore.php',
                'src/Store/Psr6Store.php',
            ],
        ],
        \SlevomatCodingStandard\Sniffs\Classes\ModernClassNameReferenceSniff::class => [
            'exclude' => [
                'src/Mixins/ConfigurableMixin.php',
            ],
        ],
        \SlevomatCodingStandard\Sniffs\Classes\RequireMultiLineMethodSignatureSniff::class => [
            'minLineLength' => '0',
        ],
    ],

    'requirements' => [
        'min-quality' => 90,
        'min-complexity' => 50,
        'min-architecture' => 90,
        'min-style' => 90,
        'disable-security-check' => false,
    ],
];
