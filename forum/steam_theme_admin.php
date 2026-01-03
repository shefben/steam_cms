<?php
/**
 * Steam Theme Date Administration Tool
 * Allows administrators to change the CDRDATE setting for theme testing
 *
 * @copyright (c) 2024 Valve Corporation
 * @license GPL-2.0-only
 */

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
require($phpbb_root_path . 'common.' . $phpEx);
require($phpbb_root_path . 'includes/functions_admin.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('acp/common');

// Check if user has admin permissions
if (!$auth->acl_get('a_'))
{
	trigger_error('NOT_AUTHORISED');
}

$action = $request->variable('action', '');
$new_date = $request->variable('new_date', '');

// Handle form submission
if ($action === 'update_date' && $new_date)
{
	// Validate date format (m/d/Y)
	$date_parts = explode('/', $new_date);
	if (count($date_parts) === 3 && checkdate($date_parts[0], $date_parts[1], $date_parts[2]))
	{
		// Update the CDRDATE setting
		$sql = "INSERT INTO settings (`key`, `value`) VALUES ('CDRDATE', '" . $db->sql_escape($new_date) . "')
				ON DUPLICATE KEY UPDATE `value` = '" . $db->sql_escape($new_date) . "'";
		$db->sql_query($sql);

		// Clear theme cache to force immediate update
		$cache->destroy('steam_theme_date_selection');

		$message = 'CDRDATE updated successfully to: ' . htmlspecialchars($new_date);
		$message_type = 'success';
	}
	else
	{
		$message = 'Invalid date format. Please use m/d/Y format (e.g., 3/15/2002)';
		$message_type = 'error';
	}
}

// Get current CDRDATE value
$sql = "SELECT value FROM settings WHERE `key` = 'CDRDATE'";
$result = $db->sql_query($sql);
$current_date = $db->sql_fetchfield('value');
$db->sql_freeresult($result);

// Get current theme based on date
if (file_exists($phpbb_root_path . 'includes/functions_steam_theme.' . $phpEx))
{
	require_once($phpbb_root_path . 'includes/functions_steam_theme.' . $phpEx);
	$current_theme = get_steam_theme_by_date($db, $cache);
	$current_style_id = get_style_id_by_theme_name($db, $current_theme);
}
else
{
	$current_theme = 'Not available (functions not found)';
	$current_style_id = 0;
}

// Predefined date examples for easy testing
$predefined_dates = array(
	'2002_v1' => array('date' => '3/15/2002', 'description' => '2002 v1 Theme (Blue/Gray ChatBear)'),
	'2002_v2' => array('date' => '9/20/2002', 'description' => '2002 v2 Theme (Green/Brown ChatBear)'),
	'2003_v1' => array('date' => '4/10/2003', 'description' => '2003 v1 Theme'),
	'2003_v2' => array('date' => '8/25/2003', 'description' => '2003 v2 Theme'),
	'2004' => array('date' => '12/31/2005', 'description' => '2004 Theme'),
	'2008' => array('date' => '1/15/2009', 'description' => '2008 Theme'),
	'2011' => array('date' => '7/20/2012', 'description' => '2011 Theme')
);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Steam Theme Date Administration</title>
	<style>
		body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
		.container { max-width: 800px; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
		.success { color: green; font-weight: bold; }
		.error { color: red; font-weight: bold; }
		.current-info { background: #e7f3ff; padding: 15px; margin: 15px 0; border-radius: 5px; }
		.predefined-dates { margin: 20px 0; }
		.date-option { display: inline-block; margin: 5px; padding: 8px 12px; background: #007cba; color: white; text-decoration: none; border-radius: 3px; }
		.date-option:hover { background: #005a8b; color: white; }
		.form-group { margin: 15px 0; }
		label { display: block; font-weight: bold; margin-bottom: 5px; }
		input[type="text"] { padding: 8px; width: 200px; border: 1px solid #ddd; border-radius: 3px; }
		input[type="submit"] { padding: 10px 20px; background: #007cba; color: white; border: none; border-radius: 3px; cursor: pointer; }
		input[type="submit"]:hover { background: #005a8b; }
		.instructions { background: #fffbcc; padding: 15px; margin: 15px 0; border-radius: 5px; border-left: 4px solid #ffeb3b; }
	</style>
</head>
<body>
	<div class="container">
		<h1>Steam Theme Date Administration</h1>

		<?php if (isset($message)): ?>
			<div class="<?php echo $message_type; ?>">
				<?php echo $message; ?>
			</div>
		<?php endif; ?>

		<div class="current-info">
			<h3>Current Settings:</h3>
			<p><strong>CDRDATE:</strong> <?php echo htmlspecialchars($current_date ?: 'Not set'); ?></p>
			<p><strong>Active Theme:</strong> <?php echo htmlspecialchars($current_theme); ?></p>
			<p><strong>Style ID:</strong> <?php echo $current_style_id; ?></p>
		</div>

		<div class="instructions">
			<h3>Instructions:</h3>
			<p>Change the CDRDATE to automatically switch between different Steam forum themes. The date format must be <strong>m/d/Y</strong> (e.g., 3/15/2002).</p>
			<p>Theme changes are cached for 15 minutes. After updating, the new theme will be applied on the next page load.</p>
		</div>

		<form method="post">
			<div class="form-group">
				<label for="new_date">Enter New Date (m/d/Y format):</label>
				<input type="text" id="new_date" name="new_date" placeholder="3/15/2002" value="<?php echo htmlspecialchars($current_date ?: ''); ?>" />
				<input type="hidden" name="action" value="update_date" />
				<input type="submit" value="Update Date" />
			</div>
		</form>

		<div class="predefined-dates">
			<h3>Quick Theme Selection:</h3>
			<p>Click a theme below to set the date automatically:</p>
			<?php foreach ($predefined_dates as $theme_key => $theme_info): ?>
				<a href="?action=update_date&new_date=<?php echo urlencode($theme_info['date']); ?>" class="date-option">
					<?php echo htmlspecialchars($theme_info['description']); ?><br />
					<small>(<?php echo htmlspecialchars($theme_info['date']); ?>)</small>
				</a>
			<?php endforeach; ?>
		</div>

		<div style="margin-top: 30px; font-size: 12px; color: #666;">
			<h4>Date Ranges:</h4>
			<ul>
				<li><strong>2002_v1:</strong> 12/1/2001 - 6/3/2002</li>
				<li><strong>2002_v2:</strong> 6/4/2002 - 12/31/2002</li>
				<li><strong>2003_v1:</strong> 1/1/2003 - 6/15/2003</li>
				<li><strong>2003_v2:</strong> 6/16/2003 - 9/15/2003</li>
				<li><strong>2004:</strong> 9/16/2003 - 6/15/2008</li>
				<li><strong>2008:</strong> 6/16/2008 - 4/15/2010</li>
				<li><strong>2011:</strong> 4/16/2010 - 1/1/2017</li>
			</ul>
		</div>
	</div>
</body>
</html>