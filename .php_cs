<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in('src')
    ->in('spec')
;

PedroTroller\CS\Fixer\Contrib\YamlSymfonyServiceFileFixer::addPath('src/Knp/MegaMAN/Resources/config/services.yml');

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers(array(
        'align_double_arrow',
        'align_equals',
        'assign_and_return',
        'concat_with_spaces',
        'line_break_between_statements',
        'logical_not_operators_with_spaces',
        'short_array_syntax',
        'newline_after_open_tag',
        'ordered_use',
        'phpdoc_order',
        'phpspec',
        'single_comment_expanded',
        'yaml_symfony_service_file',
    ))
    ->addCustomFixer(new PedroTroller\CS\Fixer\Contrib\AssignAndReturnFixer())
    ->addCustomFixer(new PedroTroller\CS\Fixer\Contrib\LineBreakBetweenStatementsFixer())
    ->addCustomFixer(new PedroTroller\CS\Fixer\Contrib\PhpspecFixer())
    ->addCustomFixer(new PedroTroller\CS\Fixer\Contrib\SingleCommentExpandedFixer())
    ->addCustomFixer(new PedroTroller\CS\Fixer\Contrib\YamlSymfonyServiceFileFixer())
    ->finder($finder)
;
