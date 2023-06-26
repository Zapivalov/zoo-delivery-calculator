<?php

declare(strict_types=1);

$basePath = __DIR__ . '/../../';

$finder = (new PhpCsFixer\Finder())
    ->in($basePath . '/src')
    ->in($basePath . '/tests')
    ->in($basePath . '/tools')
    ->exclude('var');

return (new PhpCsFixer\Config())
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@DoctrineAnnotation' => true,
        '@PHP80Migration:risky' => true,
        '@PHP81Migration' => true,
        '@PHPUnit84Migration:risky' => true,
        'mb_str_functions' => true,
        'global_namespace_import' => [
            'import_classes' => false,
        ],
        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'date_time_immutable' => true,
        'ordered_imports' => true,
        'trailing_comma_in_multiline' => [
            'elements' => ['arrays', 'arguments', 'parameters'],
        ],
        'ordered_class_elements' => [
            'order' => ['use_trait', 'case', 'constant', 'property', 'construct', 'destruct', 'magic', 'phpunit', 'method'],
        ],
        'ordered_interfaces' => true,
        'single_line_throw' => false,
        'declare_strict_types' => true,
        'single_import_per_statement' => false,
        'yoda_style' => false,
        'phpdoc_align' => [
            'align' => 'left',
        ],
        'single_trait_insert_per_statement' => false,
        'php_unit_mock' => ['target' => 'newest'],
        'php_unit_namespaced' => ['target' => 'newest'],
        'php_unit_method_casing' => ['case' => 'snake_case'],
        'php_unit_set_up_tear_down_visibility' => true,
        'php_unit_test_case_static_method_calls' => [
            'call_type' => 'self',
        ],
        'php_unit_test_annotation' => [
            'style' => 'annotation',
        ],
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                'continue',
                'declare',
                'phpdoc',
                'return',
                'throw',
                'try',
            ],
        ],
    ]);
