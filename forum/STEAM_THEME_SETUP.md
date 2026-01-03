# Steam Date-Based Theme Selection System

This system automatically selects phpBB forum themes based on a CDRDATE value stored in the database. The theme changes based on date ranges and is cached for 15 minutes to optimize performance.

## Installation

### 1. Database Setup

Run the SQL script to create the settings table:

```bash
mysql -u [username] -p [database_name] < install/steam_theme_setup.sql
```

Or manually execute the SQL commands in `install/steam_theme_setup.sql`.

### 2. File Verification

Ensure these files are present:

- `includes/functions_steam_theme.php` - Core theme selection functions
- `phpbb/user.php` - Modified user setup with date-based theme logic
- `steam_theme_admin.php` - Admin interface for changing dates
- `install/steam_theme_setup.sql` - Database setup script

### 3. Theme Installation

Ensure all Steam themes are properly installed in the `styles/` directory:

- `2002_v1/` - ChatBear 2002 v1 (Blue/Gray)
- `2002_v2/` - ChatBear 2002 v2 (Green/Brown)
- `steam_2003_v1/` - Steam 2003 v1
- `steam_2003_v2/` - Steam 2003 v2
- `steam_2004/` - Steam 2004
- `steam_2008/` - Steam 2008
- `steam_2011/` - Steam 2011

## Date Range Configuration

The system uses the following date ranges to determine themes:

| Theme | Start Date | End Date | Description |
|-------|------------|----------|-------------|
| `2002_v1` | 2001-12-01 | 2002-06-03 | ChatBear 2002 v1 (Blue/Gray) |
| `2002_v2` | 2002-06-04 | 2002-12-31 | ChatBear 2002 v2 (Green/Brown) |
| `steam_2003_v1` | 2003-01-01 | 2003-06-15 | Steam 2003 v1 |
| `steam_2003_v2` | 2003-06-16 | 2003-09-15 | Steam 2003 v2 |
| `steam_2004` | 2003-09-16 | 2008-06-15 | Steam 2004 |
| `steam_2008` | 2008-06-16 | 2010-04-15 | Steam 2008 |
| `steam_2011` | 2010-04-16 | 2017-01-01 | Steam 2011 |

## Usage

### Admin Interface

1. Access the admin interface: `http://yoursite.com/forum/steam_theme_admin.php`
2. Login with administrator credentials
3. Change the CDRDATE using either:
   - Manual date entry (m/d/Y format)
   - Quick theme selection buttons

### Direct Database Update

Update the CDRDATE directly in the database:

```sql
UPDATE settings SET value = '3/15/2002' WHERE `key` = 'CDRDATE';
```

**Date Format:** Must be in m/d/Y format (e.g., 3/15/2002, 12/25/2008)

## Testing

To test different themes, use these example dates:

```sql
-- 2002_v1 theme
UPDATE settings SET value = '3/15/2002' WHERE `key` = 'CDRDATE';

-- 2002_v2 theme
UPDATE settings SET value = '9/20/2002' WHERE `key` = 'CDRDATE';

-- 2003_v1 theme
UPDATE settings SET value = '4/10/2003' WHERE `key` = 'CDRDATE';

-- 2008 theme
UPDATE settings SET value = '1/15/2009' WHERE `key` = 'CDRDATE';

-- 2011 theme
UPDATE settings SET value = '7/20/2012' WHERE `key` = 'CDRDATE';
```

## Caching

- Theme selection is cached for **15 minutes** (900 seconds)
- Cache key: `steam_theme_date_selection`
- To force immediate update: Clear cache or wait 15 minutes

### Clear Cache Manually

```php
$cache->destroy('steam_theme_date_selection');
```

## Troubleshooting

### Theme Not Changing

1. Verify CDRDATE is set correctly: `SELECT * FROM settings WHERE \`key\` = 'CDRDATE';`
2. Check if theme exists in database: `SELECT * FROM phpbb_styles WHERE style_name = 'theme_name';`
3. Clear theme cache: `DELETE FROM phpbb_cache WHERE cache_name = 'steam_theme_date_selection';`
4. Check file permissions on `includes/functions_steam_theme.php`

### Default Fallback

If no themes are found or CDRDATE is invalid, the system will:

1. Try to use `2002_v1` as default
2. Fall back to any available Steam theme
3. Use phpBB's configured default style

### Debug Information

Check current theme selection:

```php
// Get current theme
require_once('includes/functions_steam_theme.php');
$current_theme = get_steam_theme_by_date($db, $cache);
echo "Current theme: " . $current_theme;

// Get style ID
$style_id = get_style_id_by_theme_name($db, $current_theme);
echo "Style ID: " . $style_id;
```

## Security Notes

- Admin interface requires administrator permissions (`a_` ACL)
- All user input is properly escaped before database queries
- CDRDATE format is validated before database update
- Only authorized users can modify theme settings

## Performance

- Database query for CDRDATE is cached for 15 minutes
- Theme selection adds minimal overhead (1-2 cached database queries)
- Cache automatically refreshes every 15 minutes when users visit
- No impact on page load after initial cache

## File Structure

```
forum/
├── includes/
│   └── functions_steam_theme.php      # Core theme functions
├── phpbb/
│   └── user.php                       # Modified user setup
├── install/
│   └── steam_theme_setup.sql          # Database setup
├── steam_theme_admin.php              # Admin interface
└── styles/
    ├── 2002_v1/                       # ChatBear themes
    ├── 2002_v2/
    ├── steam_2003_v1/                 # Steam themes
    ├── steam_2003_v2/
    ├── steam_2004/
    ├── steam_2008/
    └── steam_2011/
```