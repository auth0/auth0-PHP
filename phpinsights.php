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
        \NunoMaduro\PhpInsights\Domain\Insights\ForbiddenTraits::class,
        \NunoMaduro\PhpInsights\Domain\Sniffs\ForbiddenSetterSniff::class,
        \ObjectCalisthenics\Sniffs\Files\ClassTraitAndInterfaceLengthSniff::class,
        \ObjectCalisthenics\Sniffs\Files\FunctionLengthSniff::class,
        \ObjectCalisthenics\Sniffs\Metrics\MethodPerClassLimitSniff::class,
        \PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff::class,
        \SlevomatCodingStandard\Sniffs\Classes\SuperfluousExceptionNamingSniff::class,
        \SlevomatCodingStandard\Sniffs\Classes\SuperfluousInterfaceNamingSniff::class,
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
                'src/Configuration/SdkConfiguration.php',
                'src/Configuration/SdkState.php',
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
        \ObjectCalisthenics\Sniffs\Metrics\MaxNestingLevelSniff::class => [
            'maxNestingLevel' => 5,
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
