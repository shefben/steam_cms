<?php
/**
 * Steam Theme Date-Based Selection Functions
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Get the appropriate theme based on CDRDATE from settings table
 * Caches result for 15 minutes to avoid excessive database queries
 *
 * @param object $db Database connection object
 * @param object $cache Cache object
 * @return string Theme name based on date ranges
 */
function get_steam_theme_by_date($db, $cache)
{
	// Check cache first (15 minute cache)
	$cache_key = 'steam_theme_date_selection';
	$cached_theme = $cache->get($cache_key);

	if ($cached_theme !== false)
	{
		return $cached_theme;
	}

	// Get CDRDATE from settings table
	$sql = "SELECT value FROM settings WHERE `key` = 'CDRDATE'";
	$result = $db->sql_query($sql);
	$cdr_date_str = $db->sql_fetchfield('value');
	$db->sql_freeresult($result);

	// Default theme if no date found
	if (!$cdr_date_str)
	{
		$theme_name = '2002_v1'; // Default fallback
		$cache->put($cache_key, $theme_name, 900); // Cache for 15 minutes (900 seconds)
		return $theme_name;
	}

	// Parse the date (m/d/Y format)
	$cdr_timestamp = strtotime($cdr_date_str);
	if ($cdr_timestamp === false)
	{
		// Invalid date format, use default
		$theme_name = '2002_v1';
		$cache->put($cache_key, $theme_name, 900);
		return $theme_name;
	}

	// Define date ranges and corresponding themes
	$theme_ranges = array(
		array(
			'start' => strtotime('2001-12-01'),
			'end' => strtotime('2002-06-03'),
			'theme' => '2002_v1'
		),
		array(
			'start' => strtotime('2002-06-04'),
			'end' => strtotime('2002-12-31'),
			'theme' => '2002_v2'
		),
		array(
			'start' => strtotime('2003-01-01'),
			'end' => strtotime('2003-06-15'),
			'theme' => 'steam_2003_v1'
		),
		array(
			'start' => strtotime('2003-06-16'),
			'end' => strtotime('2003-09-15'),
			'theme' => 'steam_2003_v2'
		),
		array(
			'start' => strtotime('2003-09-16'),
			'end' => strtotime('2008-06-15'),
			'theme' => 'steam_2004'
		),
		array(
			'start' => strtotime('2008-06-16'),
			'end' => strtotime('2010-04-15'),
			'theme' => 'steam_2008'
		),
		array(
			'start' => strtotime('2010-04-16'),
			'end' => strtotime('2017-01-01'),
			'theme' => 'steam_2011'
		)
	);

	// Find matching theme for the date
	$theme_name = '2002_v1'; // Default fallback

	foreach ($theme_ranges as $range)
	{
		if ($cdr_timestamp >= $range['start'] && $cdr_timestamp <= $range['end'])
		{
			$theme_name = $range['theme'];
			break;
		}
	}

	// Cache the result for 15 minutes
	$cache->put($cache_key, $theme_name, 900);

	return $theme_name;
}

/**
 * Get style ID by theme name from database
 *
 * @param object $db Database connection object
 * @param string $theme_name Theme name to look up
 * @return int Style ID or 0 if not found
 */
function get_style_id_by_theme_name($db, $theme_name)
{
	$sql = 'SELECT style_id
			FROM ' . STYLES_TABLE . "
			WHERE style_name = '" . $db->sql_escape($theme_name) . "'";
	$result = $db->sql_query($sql);
	$style_id = (int) $db->sql_fetchfield('style_id');
	$db->sql_freeresult($result);

	return $style_id;
}

/**
 * Get default steam theme style ID if date-based theme is not found
 *
 * @param object $db Database connection object
 * @return int Style ID for default theme
 */
function get_default_steam_theme_style_id($db)
{
	// Try to get 2002_v1 as default
	$style_id = get_style_id_by_theme_name($db, '2002_v1');

	if (!$style_id)
	{
		// Fallback to any available steam theme
		$steam_themes = array('2002_v2', 'steam_2003_v1', 'steam_2003_v2', 'steam_2004', 'steam_2008', 'steam_2011');

		foreach ($steam_themes as $theme)
		{
			$style_id = get_style_id_by_theme_name($db, $theme);
			if ($style_id)
			{
				break;
			}
		}
	}

	return $style_id;
}
?>