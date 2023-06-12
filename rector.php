<?php

declare(strict_types=1);

use Rector\Arguments\Rector\ClassMethod\ArgumentAdderRector;
use Rector\Arguments\Rector\FuncCall\FunctionArgumentDefaultValueReplacerRector;
use Rector\Arguments\ValueObject\{ArgumentAdder,
    ReplaceFuncCallArgumentDefaultValue};
use Rector\CodeQuality\Rector\Array_\CallableThisArrayToAnonymousFunctionRector;
use Rector\CodeQuality\Rector\Assign\{CombinedAssignRector,
    SplitListAssignToSeparateLineRector};
use Rector\CodeQuality\Rector\BooleanAnd\SimplifyEmptyArrayCheckRector;
use Rector\CodeQuality\Rector\BooleanNot\{ReplaceMultipleBooleanNotRector,
    SimplifyDeMorganBinaryRector};
use Rector\CodeQuality\Rector\Catch_\ThrowWithPreviousExceptionRector;
use Rector\CodeQuality\Rector\Class_\{CompleteDynamicPropertiesRector,
    InlineConstructorDefaultToPropertyRector};
use Rector\CodeQuality\Rector\ClassMethod\{InlineArrayReturnAssignRector,
    NarrowUnionTypeDocRector,
    OptionalParametersAfterRequiredRector,
    ReturnTypeFromStrictScalarReturnExprRector};
use Rector\CodeQuality\Rector\Concat\JoinStringConcatRector;
use Rector\CodeQuality\Rector\Empty_\SimplifyEmptyCheckOnEmptyArrayRector;
use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;
use Rector\CodeQuality\Rector\Expression\{InlineIfToExplicitIfRector,
    TernaryFalseExpressionToIfRector};
use Rector\CodeQuality\Rector\For_\{ForRepeatedCountToOwnVariableRector,
    ForToForeachRector};
use Rector\CodeQuality\Rector\Foreach_\{ForeachItemsAssignToEmptyArrayToAssignRector,
    ForeachToInArrayRector,
    SimplifyForeachToArrayFilterRector,
    SimplifyForeachToCoalescingRector,
    UnusedForeachValueToArrayKeysRector};
use Rector\CodeQuality\Rector\FuncCall\{AddPregQuoteDelimiterRector,
    ArrayKeysAndInArrayToArrayKeyExistsRector,
    ArrayMergeOfNonArraysToSimpleArrayRector,
    BoolvalToTypeCastRector,
    CallUserFuncWithArrowFunctionToInlineRector,
    ChangeArrayPushToArrayAssignRector,
    CompactToVariablesRector,
    FloatvalToTypeCastRector,
    InlineIsAInstanceOfRector,
    IntvalToTypeCastRector,
    IsAWithStringWithThirdArgumentRector,
    RemoveSoleValueSprintfRector,
    SetTypeToCastRector,
    SimplifyFuncGetArgsCountRector,
    SimplifyInArrayValuesRector,
    SimplifyRegexPatternRector,
    SimplifyStrposLowerRector,
    SingleInArrayToCompareRector,
    StrvalToTypeCastRector,
    UnwrapSprintfOneArgumentRector};
use Rector\CodeQuality\Rector\FunctionLike\{RemoveAlwaysTrueConditionSetInConstructorRector,
    SimplifyUselessLastVariableAssignRector,
    SimplifyUselessVariableRector};
use Rector\CodeQuality\Rector\Identical\{BooleanNotIdenticalToNotIdenticalRector,
    FlipTypeControlToUseExclusiveTypeRector,
    GetClassToInstanceOfRector,
    SimplifyArraySearchRector,
    SimplifyBoolIdenticalTrueRector,
    SimplifyConditionsRector,
    StrlenZeroToIdenticalEmptyStringRector};
use Rector\CodeQuality\Rector\If_\{CombineIfRector,
    ConsecutiveNullCompareReturnsToNullCoalesceQueueRector,
    ExplicitBoolCompareRector,
    ShortenElseIfRector,
    SimplifyIfElseToTernaryRector,
    SimplifyIfExactValueReturnValueRector,
    SimplifyIfNotNullReturnRector,
    SimplifyIfNullableReturnRector,
    SimplifyIfReturnBoolRector};
use Rector\CodeQuality\Rector\Include_\AbsolutizeRequireAndIncludePathRector;
use Rector\CodeQuality\Rector\Isset_\IssetOnPropertyObjectToPropertyExistsRector;
use Rector\CodeQuality\Rector\LogicalAnd\{AndAssignsToSeparateLinesRector,
    LogicalToBooleanRector};
use Rector\CodeQuality\Rector\New_\NewStaticToNewSelfRector;
use Rector\CodeQuality\Rector\NotEqual\CommonNotEqualRector;
use Rector\CodeQuality\Rector\PropertyFetch\ExplicitMethodCallOverMagicGetSetRector;
use Rector\CodeQuality\Rector\Switch_\SingularSwitchToIfRector;
use Rector\CodeQuality\Rector\Ternary\{ArrayKeyExistsTernaryThenValueToCoalescingRector,
    SimplifyTautologyTernaryRector,
    SwitchNegatedTernaryRector,
    TernaryEmptyArrayArrayDimFetchToCoalesceRector,
    UnnecessaryTernaryExpressionRector};
use Rector\CodingStyle\Rector\ArrowFunction\StaticArrowFunctionRector;
use Rector\CodingStyle\Rector\Assign\SplitDoubleAssignRector;
use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector;
use Rector\CodingStyle\Rector\ClassConst\{RemoveFinalFromConstRector, SplitGroupedClassConstantsRector, VarConstantCommentRector};
use Rector\CodingStyle\Rector\ClassMethod\{FuncGetArgsToVariadicParamRector, MakeInheritedMethodVisibilitySameAsParentRector, NewlineBeforeNewAssignSetRector, RemoveDoubleUnderscoreInMethodNameRector, UnSpreadOperatorRector};
use Rector\CodingStyle\Rector\Closure\StaticClosureRector;
use Rector\CodingStyle\Rector\Encapsed\{EncapsedStringsToSprintfRector, WrapEncapsedVariableInCurlyBracesRector};
use Rector\CodingStyle\Rector\FuncCall\{CallUserFuncArrayToVariadicRector, CallUserFuncToMethodCallRector, ConsistentImplodeRector, ConsistentPregDelimiterRector, CountArrayToEmptyArrayComparisonRector, StrictArraySearchRector, VersionCompareFuncCallToConstantRector};
use Rector\CodingStyle\Rector\If_\NullableCompareToNullRector;
use Rector\CodingStyle\Rector\Plus\UseIncrementAssignRector;
use Rector\CodingStyle\Rector\PostInc\PostIncDecToPreIncDecRector;
use Rector\CodingStyle\Rector\Property\{AddFalseDefaultToBoolPropertyRector, SplitGroupedPropertiesRector};
use Rector\CodingStyle\Rector\Stmt\NewlineAfterStatementRector;
use Rector\CodingStyle\Rector\String_\{SymplifyQuoteEscapeRector, UseClassKeywordForClassNameResolutionRector};
use Rector\CodingStyle\Rector\Switch_\BinarySwitchToIfElseRector;
use Rector\CodingStyle\Rector\Ternary\TernaryConditionVariableAssignmentRector;
use Rector\CodingStyle\Rector\Use_\SeparateMultiUseImportsRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\Array_\RemoveDuplicatedArrayKeyRector;
use Rector\DeadCode\Rector\Assign\{RemoveDoubleAssignRector,
    RemoveUnusedVariableAssignRector};
use Rector\DeadCode\Rector\BinaryOp\RemoveDuplicatedInstanceOfRector;
use Rector\DeadCode\Rector\BooleanAnd\RemoveAndTrueRector;
use Rector\DeadCode\Rector\Cast\RecastingRemovalRector;
use Rector\DeadCode\Rector\ClassConst\RemoveUnusedPrivateClassConstantRector;
use Rector\DeadCode\Rector\ClassMethod\{RemoveDelegatingParentCallRector,
    RemoveEmptyClassMethodRector,
    RemoveLastReturnRector,
    RemoveUnusedConstructorParamRector,
    RemoveUnusedPrivateMethodParameterRector,
    RemoveUnusedPrivateMethodRector,
    RemoveUnusedPromotedPropertyRector,
    RemoveUselessParamTagRector,
    RemoveUselessReturnTagRector};
use Rector\DeadCode\Rector\Concat\RemoveConcatAutocastRector;
use Rector\DeadCode\Rector\Expression\{RemoveDeadStmtRector,
    SimplifyMirrorAssignRector};
use Rector\DeadCode\Rector\For_\{RemoveDeadContinueRector,
    RemoveDeadIfForeachForRector,
    RemoveDeadLoopRector};
use Rector\DeadCode\Rector\Foreach_\RemoveUnusedForeachKeyRector;
use Rector\DeadCode\Rector\FunctionLike\{RemoveDeadReturnRector,
    RemoveDuplicatedIfReturnRector};
use Rector\DeadCode\Rector\If_\{RemoveAlwaysTrueIfConditionRector,
    RemoveDeadInstanceOfRector,
    RemoveUnusedNonEmptyArrayBeforeForeachRector,
    SimplifyIfElseWithSameContentRector,
    UnwrapFutureCompatibleIfPhpVersionRector};
use Rector\DeadCode\Rector\MethodCall\RemoveEmptyMethodCallRector;
use Rector\DeadCode\Rector\Node\RemoveNonExistingVarAnnotationRector;
use Rector\DeadCode\Rector\Plus\RemoveDeadZeroAndOneOperationRector;
use Rector\DeadCode\Rector\Property\{RemoveUnusedPrivatePropertyRector,
    RemoveUselessVarTagRector};
use Rector\DeadCode\Rector\PropertyProperty\RemoveNullPropertyInitializationRector;
use Rector\DeadCode\Rector\Return_\RemoveDeadConditionAboveReturnRector;
use Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector;
use Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector;
use Rector\DeadCode\Rector\StmtsAwareInterface\{RemoveJustPropertyFetchForAssignRector,
    RemoveJustVariableAssignRector};
use Rector\DeadCode\Rector\Switch_\RemoveDuplicatedCaseInSwitchRector;
use Rector\DeadCode\Rector\Ternary\TernaryToBooleanOrFalseToBooleanAndRector;
use Rector\DeadCode\Rector\TryCatch\RemoveDeadTryCatchRector;
use Rector\DependencyInjection\Rector\Class_\ActionInjectionToConstructorInjectionRector;
use Rector\EarlyReturn\Rector\Foreach_\ChangeNestedForeachIfsToEarlyContinueRector;
use Rector\EarlyReturn\Rector\If_\{ChangeAndIfToEarlyReturnRector,
    ChangeIfElseValueAssignToEarlyReturnRector,
    ChangeNestedIfsToEarlyReturnRector,
    ChangeOrIfContinueToMultiContinueRector,
    ChangeOrIfReturnToEarlyReturnRector,
    RemoveAlwaysElseRector};
use Rector\EarlyReturn\Rector\Return_\{PreparedValueToEarlyReturnRector,
    ReturnBinaryAndToEarlyReturnRector,
    ReturnBinaryOrToEarlyReturnRector};
use Rector\EarlyReturn\Rector\StmtsAwareInterface\ReturnEarlyIfVariableRector;
use Rector\Naming\Rector\Assign\RenameVariableToMatchMethodCallReturnTypeRector;
use Rector\Naming\Rector\Class_\RenamePropertyToMatchTypeRector;
use Rector\Naming\Rector\ClassMethod\{RenameParamToMatchTypeRector,
    RenameVariableToMatchNewTypeRector};
use Rector\Naming\Rector\Foreach_\{RenameForeachValueVariableToMatchExprVariableRector,
    RenameForeachValueVariableToMatchMethodCallReturnTypeRector};
use Rector\Php52\Rector\Property\VarToPublicPropertyRector;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\Php80\Rector\Catch_\RemoveUnusedVariableInCatchRector;
use Rector\Php80\Rector\Class_\{ClassPropertyAssignToConstructorPromotionRector,
    StringableForToStringRector};
use Rector\Php80\Rector\ClassConstFetch\ClassOnThisVariableObjectRector;
use Rector\Php80\Rector\ClassMethod\{AddParamBasedOnParentClassMethodRector,
    FinalPrivateToPrivateVisibilityRector,
    SetStateToStaticRector};
use Rector\Php80\Rector\FuncCall\{ClassOnObjectRector,
    Php8ResourceReturnToObjectRector,
    TokenGetAllToObjectRector};
use Rector\Php80\Rector\FunctionLike\{MixedTypeRector,
    UnionTypesRector};
use Rector\Php80\Rector\Identical\{StrEndsWithRector,
    StrStartsWithRector};
use Rector\Php80\Rector\NotIdentical\StrContainsRector;
use Rector\Php80\Rector\Switch_\ChangeSwitchToMatchRector;
use Rector\Php80\Rector\Ternary\GetDebugTypeRector;
use Rector\PHPUnit\Rector\ClassMethod\RemoveEmptyTestMethodRector;
use Rector\Privatization\Rector\Class_\{ChangeGlobalVariablesToPropertiesRector,
    ChangeReadOnlyVariableWithDefaultValueToConstantRector,
    FinalizeClassesWithoutChildrenRector};
use Rector\Privatization\Rector\ClassMethod\PrivatizeFinalClassMethodRector;
use Rector\Privatization\Rector\MethodCall\PrivatizeLocalGetterToPropertyRector;
use Rector\Privatization\Rector\Property\{ChangeReadOnlyPropertyWithDefaultValueToConstantRector,
    PrivatizeFinalClassPropertyRector};
use Rector\PSR4\Rector\FileWithoutNamespace\NormalizeNamespaceByPSR4ComposerAutoloadRector;
use Rector\PSR4\Rector\Namespace_\MultipleClassFileToPsr4ClassesRector;
use Rector\Renaming\Rector\FuncCall\RenameFunctionRector;
use Rector\Transform\Rector\FuncCall\FuncCallToConstFetchRector;
use Rector\Transform\Rector\StaticCall\StaticCallToFuncCallRector;
use Rector\Transform\ValueObject\StaticCallToFuncCall;
use Rector\TypeDeclaration\Rector\ArrowFunction\AddArrowFunctionReturnTypeRector;
use Rector\TypeDeclaration\Rector\Class_\{PropertyTypeFromStrictSetterGetterRector,
    ReturnTypeFromStrictTernaryRector};
use Rector\TypeDeclaration\Rector\ClassMethod\{AddMethodCallBasedStrictParamTypeRector,
    AddParamTypeBasedOnPHPUnitDataProviderRector,
    AddParamTypeFromPropertyTypeRector,
    AddReturnTypeDeclarationBasedOnParentClassMethodRector,
    AddVoidReturnTypeWhereNoReturnRector,
    ArrayShapeFromConstantArrayReturnRector,
    ParamAnnotationIncorrectNullableRector,
    ParamTypeByMethodCallTypeRector,
    ParamTypeByParentCallTypeRector,
    ReturnAnnotationIncorrectNullableRector,
    ReturnNeverTypeRector,
    ReturnTypeFromReturnDirectArrayRector,
    ReturnTypeFromReturnNewRector,
    ReturnTypeFromStrictBoolReturnExprRector,
    ReturnTypeFromStrictConstantReturnRector,
    ReturnTypeFromStrictNativeCallRector,
    ReturnTypeFromStrictNewArrayRector,
    ReturnTypeFromStrictTypedCallRector,
    ReturnTypeFromStrictTypedPropertyRector};
use Rector\TypeDeclaration\Rector\Closure\AddClosureReturnTypeRector;
use Rector\TypeDeclaration\Rector\Empty_\EmptyOnNullableObjectToInstanceOfRector;
use Rector\TypeDeclaration\Rector\FunctionLike\{AddParamTypeSplFixedArrayRector,
    AddReturnTypeDeclarationFromYieldsRector};
use Rector\TypeDeclaration\Rector\Param\ParamTypeFromStrictTypedPropertyRector;
use Rector\TypeDeclaration\Rector\Property\{TypedPropertyFromAssignsRector,
    TypedPropertyFromStrictConstructorRector,
    TypedPropertyFromStrictGetterMethodReturnTypeRector,
    TypedPropertyFromStrictSetUpRector,
    VarAnnotationIncorrectNullableRector};

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/config',
        __DIR__ . '/src',
    ]);

    $rectorConfig->ruleWithConfiguration(
        RenameFunctionRector::class,
        [
            'chop'         => 'rtrim',
            'doubleval'    => 'floatval',
            'fputs'        => 'fwrite',
            'gzputs'       => 'gzwrites',
            'ini_alter'    => 'ini_set',
            'is_double'    => 'is_float',
            'is_integer'   => 'is_int',
            'is_long'      => 'is_int',
            'is_real'      => 'is_float',
            'is_writeable' => 'is_writable',
            'join'         => 'implode',
            'key_exists'   => 'array_key_exists',
            'mbstrcut'     => 'mb_strcut',
            'mbstrlen'     => 'mb_strlen',
            'mbstrpos'     => 'mb_strpos',
            'mbstrrpos'    => 'mb_strrpos',
            'mbsubstr'     => 'mb_substr',
            'pos'          => 'current',
            'sizeof'       => 'count',
            'split'        => 'explode',
            'strchr'       => 'strstr',
        ],
    );

    $rectorConfig->ruleWithConfiguration(
        StaticCallToFuncCallRector::class,
        [
            new StaticCallToFuncCall('Nette\\Utils\\Strings', 'contains', 'str_contains'),
            new StaticCallToFuncCall('Nette\\Utils\\Strings', 'endsWith', 'str_ends_with'),
            new StaticCallToFuncCall('Nette\\Utils\\Strings', 'startsWith', 'str_starts_with'),
        ],
    );

    $rectorConfig->ruleWithConfiguration(
        ArgumentAdderRector::class,
        [new ArgumentAdder('Nette\\Utils\\Strings', 'replace', 2, 'replacement', '')],
    );

    $rectorConfig->ruleWithConfiguration(
        RenameFunctionRector::class,
        [
            'pg_clientencoding'    => 'pg_client_encoding',
            'pg_cmdtuples'         => 'pg_affected_rows',
            'pg_errormessage'      => 'pg_last_error',
            'pg_fieldisnull'       => 'pg_field_is_null',
            'pg_fieldname'         => 'pg_field_name',
            'pg_fieldnum'          => 'pg_field_num',
            'pg_fieldprtlen'       => 'pg_field_prtlen',
            'pg_fieldsize'         => 'pg_field_size',
            'pg_fieldtype'         => 'pg_field_type',
            'pg_freeresult'        => 'pg_free_result',
            'pg_getlastoid'        => 'pg_last_oid',
            'pg_loclose'           => 'pg_lo_close',
            'pg_locreate'          => 'pg_lo_create',
            'pg_loexport'          => 'pg_lo_export',
            'pg_loimport'          => 'pg_lo_import',
            'pg_loopen'            => 'pg_lo_open',
            'pg_loread'            => 'pg_lo_read',
            'pg_loreadall'         => 'pg_lo_read_all',
            'pg_lounlink'          => 'pg_lo_unlink',
            'pg_lowrite'           => 'pg_lo_write',
            'pg_numfields'         => 'pg_num_fields',
            'pg_numrows'           => 'pg_num_rows',
            'pg_result'            => 'pg_fetch_result',
            'pg_setclientencoding' => 'pg_set_client_encoding'
        ],
    );

    $rectorConfig->ruleWithConfiguration(
        FunctionArgumentDefaultValueReplacerRector::class,
        [
            new ReplaceFuncCallArgumentDefaultValue('version_compare', 2, 'gte', 'ge'),
            new ReplaceFuncCallArgumentDefaultValue('version_compare', 2, 'lte', 'le'),
            new ReplaceFuncCallArgumentDefaultValue('version_compare', 2, '', '!='),
            new ReplaceFuncCallArgumentDefaultValue('version_compare', 2, '!', '!='),
            new ReplaceFuncCallArgumentDefaultValue('version_compare', 2, 'g', 'gt'),
            new ReplaceFuncCallArgumentDefaultValue('version_compare', 2, 'l', 'lt'),
            new ReplaceFuncCallArgumentDefaultValue('version_compare', 2, 'gte', 'ge'),
            new ReplaceFuncCallArgumentDefaultValue('version_compare', 2, 'lte', 'le'),
            new ReplaceFuncCallArgumentDefaultValue('version_compare', 2, 'n', 'ne')
        ],
    );

    $rectorConfig->ruleWithConfiguration(
        FuncCallToConstFetchRector::class,
        [
            'php_sapi_name' => 'PHP_SAPI',
            'pi'            => 'M_PI'
        ],
    );

    $rectorConfig->rules([
        AbsolutizeRequireAndIncludePathRector::class,
        ActionInjectionToConstructorInjectionRector::class,
        AddArrayDefaultToArrayPropertyRector::class,
        AddArrowFunctionReturnTypeRector::class,
        AddClosureReturnTypeRector::class,
        // AddFalseDefaultToBoolPropertyRector::class,
        AddMethodCallBasedStrictParamTypeRector::class,
        AddParamBasedOnParentClassMethodRector::class,
        AddParamTypeBasedOnPHPUnitDataProviderRector::class,
        AddParamTypeSplFixedArrayRector::class,
        // AddPregQuoteDelimiterRector::class,
        AddReturnTypeDeclarationBasedOnParentClassMethodRector::class,
        AddReturnTypeDeclarationFromYieldsRector::class,
        AddVoidReturnTypeWhereNoReturnRector::class,
        AndAssignsToSeparateLinesRector::class,
        ArrayKeyExistsTernaryThenValueToCoalescingRector::class,
        ArrayKeysAndInArrayToArrayKeyExistsRector::class,
        ArrayMergeOfNonArraysToSimpleArrayRector::class,
        // ArrayShapeFromConstantArrayReturnRector::class,
        BinarySwitchToIfElseRector::class,
        BooleanNotIdenticalToNotIdenticalRector::class,
        BoolvalToTypeCastRector::class,
        CallableThisArrayToAnonymousFunctionRector::class,
        CallUserFuncArrayToVariadicRector::class,
        CallUserFuncToMethodCallRector::class,
        CallUserFuncToMethodCallRector::class,
        CallUserFuncWithArrowFunctionToInlineRector::class,
        CatchExceptionNameMatchingTypeRector::class,
        ChangeArrayPushToArrayAssignRector::class,
        ChangeGlobalVariablesToPropertiesRector::class,
        ChangeIfElseValueAssignToEarlyReturnRector::class,
        ChangeNestedForeachIfsToEarlyContinueRector::class,
        ChangeNestedIfsToEarlyReturnRector::class,
        ChangeOrIfContinueToMultiContinueRector::class,
        // ChangeReadOnlyPropertyWithDefaultValueToConstantRector::class,
        // ChangeReadOnlyVariableWithDefaultValueToConstantRector::class,
        ChangeSwitchToMatchRector::class,
        ClassOnObjectRector::class,
        ClassOnThisVariableObjectRector::class,
        ClassPropertyAssignToConstructorPromotionRector::class,
        CombinedAssignRector::class,
        CombineIfRector::class,
        CommonNotEqualRector::class,
        CompactToVariablesRector::class,
        CompleteDynamicPropertiesRector::class,
        ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class,
        ConsistentImplodeRector::class,
        // ConsistentPregDelimiterRector::class,
        CountArrayToEmptyArrayComparisonRector::class,
        CountArrayToEmptyArrayComparisonRector::class,
        EmptyOnNullableObjectToInstanceOfRector::class,
        EncapsedStringsToSprintfRector::class,
        ExplicitBoolCompareRector::class,
        // ExplicitMethodCallOverMagicGetSetRector::class,
        FinalizeClassesWithoutChildrenRector::class,
        FinalPrivateToPrivateVisibilityRector::class,
        FlipTypeControlToUseExclusiveTypeRector::class,
        FloatvalToTypeCastRector::class,
        ForeachItemsAssignToEmptyArrayToAssignRector::class,
        ForeachToInArrayRector::class,
        ForRepeatedCountToOwnVariableRector::class,
        // ForToForeachRector::class,
        FuncGetArgsToVariadicParamRector::class,
        FuncGetArgsToVariadicParamRector::class,
        GetClassToInstanceOfRector::class,
        GetDebugTypeRector::class,
        InlineArrayReturnAssignRector::class,
        InlineConstructorDefaultToPropertyRector::class,
        InlineIfToExplicitIfRector::class,
        InlineIsAInstanceOfRector::class,
        IntvalToTypeCastRector::class,
        IsAWithStringWithThirdArgumentRector::class,
        IssetOnPropertyObjectToPropertyExistsRector::class,
        JoinStringConcatRector::class,
        LogicalToBooleanRector::class,
        MakeInheritedMethodVisibilitySameAsParentRector::class,
        MultipleClassFileToPsr4ClassesRector::class,
        NarrowUnionTypeDocRector::class,
        NewlineBeforeNewAssignSetRector::class,
        NewStaticToNewSelfRector::class,
        NormalizeNamespaceByPSR4ComposerAutoloadRector::class,
        NullableCompareToNullRector::class,
        OptionalParametersAfterRequiredRector::class,
        OptionalParametersAfterRequiredRector::class,
        ParamAnnotationIncorrectNullableRector::class,
        ParamTypeByMethodCallTypeRector::class,
        ParamTypeByParentCallTypeRector::class,
        ParamTypeFromStrictTypedPropertyRector::class,
        Php8ResourceReturnToObjectRector::class,
        PostIncDecToPreIncDecRector::class,
        PrivatizeFinalClassMethodRector::class,
        PrivatizeFinalClassPropertyRector::class,
        PropertyTypeFromStrictSetterGetterRector::class,
        RemoveAlwaysElseRector::class,
        RemoveAlwaysTrueConditionSetInConstructorRector::class,
        RemoveAndTrueRector::class,
        RemoveDeadConditionAboveReturnRector::class,
        RemoveDeadContinueRector::class,
        RemoveDeadIfForeachForRector::class,
        RemoveDeadLoopRector::class,
        RemoveDeadReturnRector::class,
        RemoveDeadStmtRector::class,
        RemoveDeadTryCatchRector::class,
        RemoveDeadZeroAndOneOperationRector::class,
        RemoveDelegatingParentCallRector::class,
        RemoveDoubleAssignRector::class,
        // RemoveDoubleUnderscoreInMethodNameRector::class,
        RemoveDuplicatedArrayKeyRector::class,
        RemoveDuplicatedCaseInSwitchRector::class,
        // RemoveDuplicatedIfReturnRector::class,
        // RemoveDuplicatedInstanceOfRector::class,
        RemoveEmptyClassMethodRector::class,
        RemoveEmptyMethodCallRector::class,
        RemoveEmptyTestMethodRector::class,
        RemoveExtraParametersRector::class,
        RemoveFinalFromConstRector::class,
        RemoveJustPropertyFetchForAssignRector::class,
        RemoveJustVariableAssignRector::class,
        RemoveLastReturnRector::class,
        RemoveNonExistingVarAnnotationRector::class,
        RemoveNullPropertyInitializationRector::class,
        RemoveParentCallWithoutParentRector::class,
        RemoveParentCallWithoutParentRector::class,
        RemoveSoleValueSprintfRector::class,
        RemoveUnreachableStatementRector::class,
        RemoveUnusedConstructorParamRector::class,
        RemoveUnusedForeachKeyRector::class,
        RemoveUnusedNonEmptyArrayBeforeForeachRector::class,
        RemoveUnusedPrivateClassConstantRector::class,
        RemoveUnusedPrivateMethodParameterRector::class,
        RemoveUnusedPrivatePropertyRector::class,
        RemoveUnusedPromotedPropertyRector::class,
        RemoveUnusedVariableAssignRector::class,
        RemoveUnusedVariableInCatchRector::class,
        RemoveUselessReturnTagRector::class,
        RemoveUselessVarTagRector::class,
        RenameForeachValueVariableToMatchExprVariableRector::class,
        RenameForeachValueVariableToMatchMethodCallReturnTypeRector::class,
        ReplaceMultipleBooleanNotRector::class,
        ReturnAnnotationIncorrectNullableRector::class,
        ReturnBinaryAndToEarlyReturnRector::class,
        ReturnBinaryOrToEarlyReturnRector::class,
        ReturnEarlyIfVariableRector::class,
        ReturnNeverTypeRector::class,
        ReturnTypeFromReturnDirectArrayRector::class,
        ReturnTypeFromReturnNewRector::class,
        ReturnTypeFromStrictBoolReturnExprRector::class,
        ReturnTypeFromStrictConstantReturnRector::class,
        ReturnTypeFromStrictNativeCallRector::class,
        ReturnTypeFromStrictNewArrayRector::class,
        ReturnTypeFromStrictScalarReturnExprRector::class,
        ReturnTypeFromStrictScalarReturnExprRector::class,
        ReturnTypeFromStrictTernaryRector::class,
        ReturnTypeFromStrictTypedCallRector::class,
        ReturnTypeFromStrictTypedPropertyRector::class,
        SeparateMultiUseImportsRector::class,
        SetStateToStaticRector::class,
        SetTypeToCastRector::class,
        ShortenElseIfRector::class,
        SimplifyArraySearchRector::class,
        SimplifyBoolIdenticalTrueRector::class,
        SimplifyConditionsRector::class,
        SimplifyDeMorganBinaryRector::class,
        SimplifyEmptyArrayCheckRector::class,
        SimplifyEmptyCheckOnEmptyArrayRector::class,
        SimplifyForeachToArrayFilterRector::class,
        SimplifyForeachToCoalescingRector::class,
        SimplifyFuncGetArgsCountRector::class,
        SimplifyIfElseToTernaryRector::class,
        SimplifyIfElseWithSameContentRector::class,
        // SimplifyIfExactValueReturnValueRector::class,
        SimplifyIfNotNullReturnRector::class,
        SimplifyIfNullableReturnRector::class,
        SimplifyIfReturnBoolRector::class,
        SimplifyInArrayValuesRector::class,
        SimplifyMirrorAssignRector::class,
        SimplifyRegexPatternRector::class,
        SimplifyStrposLowerRector::class,
        SimplifyTautologyTernaryRector::class,
        // SimplifyUselessLastVariableAssignRector::class,
        SimplifyUselessVariableRector::class,
        SingleInArrayToCompareRector::class,
        SingularSwitchToIfRector::class,
        SplitDoubleAssignRector::class,
        SplitGroupedClassConstantsRector::class,
        SplitGroupedPropertiesRector::class,
        // SplitListAssignToSeparateLineRector::class,
        StaticArrowFunctionRector::class,
        StaticClosureRector::class,
        StrContainsRector::class,
        StrEndsWithRector::class,
        StrictArraySearchRector::class,
        StringableForToStringRector::class,
        StrlenZeroToIdenticalEmptyStringRector::class,
        StrStartsWithRector::class,
        StrvalToTypeCastRector::class,
        SwitchNegatedTernaryRector::class,
        SymplifyQuoteEscapeRector::class,
        TernaryConditionVariableAssignmentRector::class,
        TernaryEmptyArrayArrayDimFetchToCoalesceRector::class,
        TernaryFalseExpressionToIfRector::class,
        TernaryToBooleanOrFalseToBooleanAndRector::class,
        ThrowWithPreviousExceptionRector::class,
        // TokenGetAllToObjectRector::class,
        TypedPropertyFromAssignsRector::class,
        TypedPropertyFromStrictConstructorRector::class,
        TypedPropertyFromStrictGetterMethodReturnTypeRector::class,
        TypedPropertyFromStrictSetUpRector::class,
        UnnecessaryTernaryExpressionRector::class,
        UnSpreadOperatorRector::class,
        UnusedForeachValueToArrayKeysRector::class,
        UnwrapFutureCompatibleIfPhpVersionRector::class,
        UnwrapSprintfOneArgumentRector::class,
        UseClassKeywordForClassNameResolutionRector::class,
        UseIdenticalOverEqualWithSameTypeRector::class,
        UseIncrementAssignRector::class,
        // VarAnnotationIncorrectNullableRector::class,
        VarConstantCommentRector::class,
        VarToPublicPropertyRector::class,
        VersionCompareFuncCallToConstantRector::class,
        WrapEncapsedVariableInCurlyBracesRector::class,
    ]);
};
