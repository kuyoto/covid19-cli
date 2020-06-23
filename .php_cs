<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . DIRECTORY_SEPARATOR . 'src');


return PhpCsFixer\Config::create()
    ->setUsingCache(true)
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        'yoda_style' => false,
    ])
    ->setFinder($finder);
