<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Array_\CallableThisArrayToAnonymousFunctionRector;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\EarlyReturn\Rector\Foreach_\ChangeNestedForeachIfsToEarlyContinueRector;
use Rector\EarlyReturn\Rector\If_\ChangeIfElseValueAssignToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\ChangeNestedIfsToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfContinueToMultiContinueRector;
use Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector;
use Rector\Php74\Rector\Property\RestoreDefaultNullToNullableTypePropertyRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php81\Rector\Array_\FirstClassCallableRector;
use Rector\Php81\Rector\ClassMethod\NewInInitializerRector;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;
use Rector\Php82\Rector\Class_\ReadOnlyClassRector;
use Rector\PHPUnit\Rector\Class_\AddSeeTestAnnotationRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Rector\Class_\CommandDescriptionToPropertyRector;
use Rector\Symfony\Rector\Class_\CommandPropertyToAttributeRector;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $basePath = __DIR__ . '/../../';
    $paths = [
        $basePath . 'config',
        $basePath . 'public',
        $basePath . 'src',
        $basePath . 'tests',
        $basePath . 'tools',
    ];
    $rectorConfig->paths($paths);

    $skipReadonly = [
        dirname(__DIR__, 2) . '/src/*/Domain/Model/*',
        dirname(__DIR__, 2) . '/src/*/*/Domain/Model/*',
        dirname(__DIR__, 2) . '/src/*/*/*/Domain/Model/*',
    ];

    $rectorConfig->parallel(240);
    $rectorConfig->phpstanConfig(dirname(__DIR__, 2) . '/tools/phpstan/config.neon');
    $rectorConfig->skip([
        ReadOnlyPropertyRector::class => $skipReadonly,
        ReadOnlyClassRector::class => $skipReadonly,
        ClassPropertyAssignToConstructorPromotionRector::class,
        CallableThisArrayToAnonymousFunctionRector::class,
        FirstClassCallableRector::class,
        InlineConstructorDefaultToPropertyRector::class,
        NewInInitializerRector::class,
        NullToStrictStringFuncCallArgRector::class,
        RestoreDefaultNullToNullableTypePropertyRector::class,
        AddSeeTestAnnotationRector::class,
    ]);
    $rectorConfig->importShortClasses(false);

    $rectorConfig->importNames(false); // We are using our own implementation till Rector introduces better support for function imports.

    $rectorConfig->import(SetList::CODE_QUALITY);
    $rectorConfig->import(SetList::TYPE_DECLARATION);
    $rectorConfig->import(SetList::PSR_4);
    $rectorConfig->import(DoctrineSetList::DOCTRINE_CODE_QUALITY);
    $rectorConfig->import(LevelSetList::UP_TO_PHP_82);
    $rectorConfig->import(SymfonySetList::SYMFONY_51);
    $rectorConfig->import(SymfonySetList::SYMFONY_52);
    $rectorConfig->import(SymfonySetList::SYMFONY_53);
    $rectorConfig->import(SymfonySetList::SYMFONY_54);
    $rectorConfig->import(SymfonySetList::SYMFONY_60);
    $rectorConfig->import(SymfonySetList::SYMFONY_61);
    $rectorConfig->import(SymfonySetList::SYMFONY_62);
    $rectorConfig->import(PHPUnitSetList::PHPUNIT_CODE_QUALITY);
    $rectorConfig->import(PHPUnitSetList::PHPUNIT_SPECIFIC_METHOD);

    $rectorConfig->rule(ChangeNestedIfsToEarlyReturnRector::class);
    $rectorConfig->rule(ChangeOrIfContinueToMultiContinueRector::class);
    $rectorConfig->rule(ChangeNestedForeachIfsToEarlyContinueRector::class);
    $rectorConfig->rule(RemoveAlwaysElseRector::class);
    $rectorConfig->rule(ChangeIfElseValueAssignToEarlyReturnRector::class);

    // Symfony rules
    $rectorConfig->rule(CommandDescriptionToPropertyRector::class);
    $rectorConfig->rule(CommandPropertyToAttributeRector::class);
};
