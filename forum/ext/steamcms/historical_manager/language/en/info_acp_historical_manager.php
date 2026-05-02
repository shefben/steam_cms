<?php
/**
 * Language file for Historical Forum Manager ACP module
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
    // Module titles
    'ACP_HISTORICAL_MANAGER'            => 'Historical Forum Manager',
    'ACP_HISTORICAL_MANAGER_DASHBOARD'  => 'Dashboard',
    'ACP_HISTORICAL_MANAGER_USERS'      => 'Historical Users',
    'ACP_HISTORICAL_MANAGER_FORUMS'     => 'Historical Forums',
    'ACP_HISTORICAL_MANAGER_TOPICS'     => 'Historical Topics',
    'ACP_HISTORICAL_MANAGER_IMPORT'     => 'Import / Reimport',

    // Dashboard
    'HISTORICAL_STATS'                  => 'Historical Data Statistics',
    'HISTORICAL_USERS_COUNT'            => 'Historical Users',
    'HISTORICAL_FORUMS_COUNT'           => 'Historical Forums',
    'HISTORICAL_TOPICS_COUNT'           => 'Historical Topics',
    'HISTORICAL_POSTS_COUNT'            => 'Historical Posts',
    'HISTORICAL_ATTACHMENTS_COUNT'      => 'Historical Attachments',

    // Actions
    'HISTORICAL_RECALCULATE'            => 'Recalculate Counters',
    'HISTORICAL_RECALCULATE_CONFIRM'    => 'Are you sure you want to recalculate all historical forum counters? This may take a moment.',
    'HISTORICAL_RECALCULATED'           => 'Historical forum counters have been recalculated.',
    'HISTORICAL_PURGE'                  => 'Purge All Historical Data',
    'HISTORICAL_PURGE_CONFIRM'          => 'Are you sure you want to permanently delete ALL historical data? This cannot be undone!',
    'HISTORICAL_PURGED'                 => 'All historical data has been purged.',
    'HISTORICAL_REBUILD_TREE'           => 'Rebuild Forum Tree',
    'HISTORICAL_TREE_REBUILT'           => 'Forum tree has been rebuilt.',

    // Users
    'HISTORICAL_USER_ADD'               => 'Add Historical User',
    'HISTORICAL_USER_EDIT'              => 'Edit Historical User',
    'HISTORICAL_USER_DELETE'            => 'Delete Historical User',
    'HISTORICAL_USER_DELETED'           => 'Historical user deleted.',
    'HISTORICAL_USER_SAVED'             => 'Historical user saved.',
    'HISTORICAL_USERNAME'               => 'Username',
    'HISTORICAL_USER_EMAIL'             => 'Email',
    'HISTORICAL_USER_REGDATE'           => 'Registration Date',
    'HISTORICAL_USER_POSTS'             => 'Post Count',

    // Forums
    'HISTORICAL_FORUM_ADD'              => 'Add Historical Forum',
    'HISTORICAL_FORUM_EDIT'             => 'Edit Historical Forum',
    'HISTORICAL_FORUM_DELETE'           => 'Delete Historical Forum',
    'HISTORICAL_FORUM_DELETED'          => 'Historical forum deleted.',
    'HISTORICAL_FORUM_SAVED'            => 'Historical forum saved.',
    'HISTORICAL_FORUM_NAME'             => 'Forum Name',
    'HISTORICAL_FORUM_DESC'             => 'Forum Description',
    'HISTORICAL_FORUM_PARENT'           => 'Parent Forum',

    // Topics
    'HISTORICAL_TOPIC_ADD'              => 'Add Historical Topic',
    'HISTORICAL_TOPIC_EDIT'             => 'Edit Historical Topic',
    'HISTORICAL_TOPIC_DELETE'           => 'Delete Historical Topic',
    'HISTORICAL_TOPIC_DELETED'          => 'Historical topic deleted.',
    'HISTORICAL_TOPIC_SAVED'            => 'Historical topic saved.',
    'HISTORICAL_TOPIC_TITLE'            => 'Topic Title',
    'HISTORICAL_TOPIC_FORUM'            => 'Forum',
    'HISTORICAL_TOPIC_POSTER'           => 'Posted By',
    'HISTORICAL_TOPIC_TIME'             => 'Post Date',

    // Posts / Replies
    'HISTORICAL_POST_ADD'               => 'Add Historical Reply',
    'HISTORICAL_POST_EDIT'              => 'Edit Historical Reply',
    'HISTORICAL_POST_DELETE'            => 'Delete Historical Reply',
    'HISTORICAL_POST_DELETED'           => 'Historical reply deleted.',
    'HISTORICAL_POST_SAVED'             => 'Historical reply saved.',
    'HISTORICAL_POST_SUBJECT'           => 'Subject',
    'HISTORICAL_POST_TEXT'              => 'Post Content',
    'HISTORICAL_POST_POSTER'            => 'Posted By',
    'HISTORICAL_POST_TIME'              => 'Post Date',

    // Import
    'HISTORICAL_IMPORT'                 => 'Import Historical Data',
    'HISTORICAL_IMPORT_FILE'            => 'SQL File',
    'HISTORICAL_IMPORT_UPLOAD'          => 'Upload SQL File',
    'HISTORICAL_IMPORT_SELECT'          => 'Select Available File',
    'HISTORICAL_IMPORT_START'           => 'Start Import',
    'HISTORICAL_IMPORT_REIMPORT'        => 'Reimport (purge existing, then import)',
    'HISTORICAL_IMPORT_COMPLETE'        => 'Import complete: %d statements succeeded, %d failed.',
    'HISTORICAL_IMPORT_NO_FILE'         => 'No SQL file selected or uploaded.',
    'HISTORICAL_IMPORT_AVAILABLE'       => 'Available SQL Files',

    // Common
    'HISTORICAL_NO_RESULTS'             => 'No historical data found.',
    'HISTORICAL_CONFIRM_DELETE'         => 'Are you sure you want to delete this item?',
    'HISTORICAL_PAGE'                   => 'Page %d of %d',
    'HISTORICAL_ACTIONS'                => 'Actions',
    'HISTORICAL_ID'                     => 'ID',
    'HISTORICAL_CREATED'                => 'Created',
    'HISTORICAL_SAVE'                   => 'Save',
    'HISTORICAL_CANCEL'                 => 'Cancel',
    'HISTORICAL_BACK'                   => 'Back',
    'HISTORICAL_FIX_PERMISSIONS'        => 'Fix Permissions',
    'HISTORICAL_PERMISSIONS_FIXED'      => 'ACL permissions have been set for all historical forums.',
]);
