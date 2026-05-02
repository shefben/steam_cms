<?php

if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = [];
}

$lang = array_merge($lang, [
    'ACP_FORUM_RULES'              => 'Forum Rules',
    'ACP_FORUM_RULES_SETTINGS'     => 'Forum Rules Settings',
    'ACP_FORUM_RULES_ENABLE'       => 'Enable custom forum rules',
    'ACP_FORUM_RULES_TEXT'         => 'Forum rules text',
    'ACP_FORUM_RULES_TEXT_EXPLAIN' => 'Enter the custom forum rules text. BBCode is supported.',
    'ACP_FORUM_RULES_SAVED'        => 'Forum rules settings saved successfully.',
]);
