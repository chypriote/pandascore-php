<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@PSR2' => true,
        '@PSR1' => true,
        '@PHP70Migration' => true,
        'single_import_per_statement' => false,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => true
    ])
    ->setFinder($finder)
;
