<?php
$finder = (new PhpCsFixer\Finder())
    ->exclude('vendor')
    ->in(__DIR__);
return (new PhpCsFixer\Config())
    ->setUsingCache(true)
    ->setCacheFile('.cache/php-cs-fixer/php-cs-fixer.cache')
    ->setRules([
        '@PSR2' => true,
        'encoding' => true,
        'braces' => true,
        'elseif' => true,
        'no_spaces_after_function_name' => true,
        'function_declaration' => true,
        'indentation_type' => true,
        'blank_line_after_namespace' => true,
        'line_ending' => true,
        'constant_case' => ['case' => 'lower'],
        'lowercase_keywords' => true,
        'no_closing_tag' => true,
        'single_line_after_imports' => true,
        'no_trailing_whitespace' => true,
        'visibility_required' => true,
        'whitespace_after_comma_in_array' => true,
        'blank_line_after_opening_tag' => true,
        'no_empty_statement' => true,
        'no_extra_blank_lines' => true,
        'function_typehint_space' => true,
        'no_leading_namespace_whitespace' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'phpdoc_scalar' => true,
        'phpdoc_types' => true,
        'no_leading_import_slash' => true,
        'blank_line_before_statement' => ['statements' => ['return']],
        'self_accessor' => false,
        'no_short_bool_cast' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'cast_spaces' => true,
        'standardize_not_equals' => true,
        'ternary_operator_spaces' => true,
        'trim_array_spaces' => true,
        'no_unused_imports' => true,
        'no_whitespace_in_blank_line' => true,
        'header_comment' => false,
        'linebreak_after_opening_tag' => true,
        'array_syntax' => ['syntax' => 'short'],
        'declare_strict_types' => true,
        'phpdoc_align' => true,
    ])
    ->setFinder($finder);
