<?php
/**
 * Historical Data Filter Helper Functions
 * Include this file in phpBB global scope for historical data filtering
 */

if (!defined('IN_PHPBB'))
{
    exit;
}

/**
 * Check if current style allows historical data display
 * Style names must match what get_steam_theme_by_date() returns in functions_steam_theme.php
 */
function is_historical_style_active()
{
    global $user;

    $style_name = isset($user->style['style_name']) ? $user->style['style_name'] : '';

    // All styles that should show historical forum data
    $allowed_styles = [
        // Date-based theme names (from functions_steam_theme.php)
        'steam_2003_v1', 'steam_2003_v2', 'steam_2004',
        // Legacy style names for backwards compatibility
        'Steam 2003', 'Steam 2003 v1', 'Steam 2003 v2', 'Steam 2004',
        'steam_2003', '2003_v1', '2003_v2', '2004'
    ];

    return in_array($style_name, $allowed_styles, true);
}

/**
 * Get SQL filter clause for historical data
 */
function get_historical_filter_sql($table_alias = '')
{
    if (is_historical_style_active()) {
        return ''; // Show all data including historical
    }

    $prefix = $table_alias ? $table_alias . '.' : '';
    return ' AND (' . $prefix . 'is_historical IS NULL OR ' . $prefix . 'is_historical = 0)';
}

/**
 * Apply historical filter to SQL WHERE clause
 */
function apply_historical_filter($sql_where, $table_alias = '')
{
    $filter = get_historical_filter_sql($table_alias);
    return $sql_where . $filter;
}

/**
 * Filter array of data based on historical status
 */
function filter_historical_data($data_array, $is_historical_key = 'is_historical')
{
    if (is_historical_style_active()) {
        return $data_array; // Return all data
    }

    return array_filter($data_array, function($item) use ($is_historical_key) {
        return !isset($item[$is_historical_key]) || !$item[$is_historical_key];
    });
}
