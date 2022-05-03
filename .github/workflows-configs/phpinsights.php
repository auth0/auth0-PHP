<?php

declare(strict_types=1);

return [
    'preset' => 'default',
    'ide' => null,

    'add' => [
        \NunoMaduro\PhpInsights\Domain\Metrics\Code\Comments::class => [
            \SlevomatCodingStandard\Sniffs\Classes\RequireMultiLineMethodSignatureSniff::class,
        ],
    ],

    'remove' => [
        \NunoMaduro\PhpInsights\Domain\Insights\CyclomaticComplexityIsHigh::class,
        \NunoMaduro\PhpInsights\Domain\Insights\ForbiddenGlobals::class,
        \NunoMaduro\PhpInsights\Domain\Insights\ForbiddenTraits::class,
        \NunoMaduro\PhpInsights\Domain\Sniffs\ForbiddenSetterSniff::class,
        \PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff::class,
        \PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\TodoSniff::class,
        \SlevomatCodingStandard\Sniffs\Classes\SuperfluousExceptionNamingSniff::class,
        \SlevomatCodingStandard\Sniffs\Classes\SuperfluousInterfaceNamingSniff::class,
        \SlevomatCodingStandard\Sniffs\Functions\FunctionLengthSniff::class,
        \SlevomatCodingStandard\Sniffs\TypeHints\DisallowMixedTypeHintSniff::class,
        \SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff::class,
        \SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff::class,
        \SlevomatCodingStandard\Sniffs\Commenting\InlineDocCommentDeclarationSniff::class,
        \PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer::class,
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
        \SlevomatCodingStandard\Sniffs\Variables\UselessVariableSniff::class => [
            'exclude' => [
                'src/API/Management.php',
                'src/Token.php',
            ],
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
