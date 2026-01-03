<?php
/**
 * Steam Forum Minimized Replies Extension - English Language Pack
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

if (!defined('IN_PHPBB'))
{
    exit;
}

if (empty($lang) || !is_array($lang))
{
    $lang = [];
}

$lang = array_merge($lang, [
    // ACP Module
    'ACP_MINIMIZED_REPLIES'                       => 'Steam Minimized Replies',
    'ACP_MINIMIZED_REPLIES_SETTINGS'              => 'Minimized Replies Settings',
    'ACP_MINIMIZED_REPLIES_UPDATED'               => 'Minimized replies configuration has been updated successfully.',

    // Settings
    'ACP_MINIMIZED_REPLIES_ENABLED'               => 'Enable minimized replies',
    'ACP_MINIMIZED_REPLIES_ENABLED_EXPLAIN'       => 'Enable the vBulletin-style minimized replies system for topics with many replies.',

    'ACP_MINIMIZED_REPLIES_THRESHOLD'             => 'Reply threshold',
    'ACP_MINIMIZED_REPLIES_THRESHOLD_EXPLAIN'     => 'Number of replies required before topics switch to minimized view mode.',

    'ACP_MINIMIZED_REPLIES_PREVIEW_LENGTH'        => 'Preview text length',
    'ACP_MINIMIZED_REPLIES_PREVIEW_LENGTH_EXPLAIN' => 'Maximum length of preview text shown in minimized reply links.',

    'ACP_MINIMIZED_REPLIES_USE_THREADING'         => 'Enable threaded view',
    'ACP_MINIMIZED_REPLIES_USE_THREADING_EXPLAIN' => 'Enable vBulletin-style threaded view with tree structure for reply navigation.',

    // Error messages
    'ACP_MINIMIZED_REPLIES_ERROR_THRESHOLD'       => 'Reply threshold must be between 1 and 50.',
    'ACP_MINIMIZED_REPLIES_ERROR_PREVIEW_LENGTH'  => 'Preview length must be between 20 and 200 characters.',
]);