<?php
/**
 * Historical Data Filter - Migration
 *
 * Adds is_historical columns to phpBB tables.
 */

namespace steamcms\historical_filter\migrations;

class add_historical_columns extends \phpbb\db\migration\migration
{
    /**
     * Check if the migration has already been applied
     *
     * @return bool
     */
    public function effectively_installed()
    {
        return $this->db_tools->sql_column_exists($this->table_prefix . 'users', 'is_historical');
    }

    /**
     * Define dependencies
     *
     * @return array
     */
    public static function depends_on()
    {
        return array('\phpbb\db\migration\data\v320\v320');
    }

    /**
     * Add columns to database schema
     *
     * @return array
     */
    public function update_schema()
    {
        return array(
            'add_columns' => array(
                $this->table_prefix . 'users' => array(
                    'is_historical' => array('TINT:1', 0),
                ),
                $this->table_prefix . 'forums' => array(
                    'is_historical' => array('TINT:1', 0),
                ),
                $this->table_prefix . 'topics' => array(
                    'is_historical' => array('TINT:1', 0),
                ),
                $this->table_prefix . 'posts' => array(
                    'is_historical' => array('TINT:1', 0),
                ),
            ),
            'add_index' => array(
                $this->table_prefix . 'users' => array(
                    'is_historical' => array('is_historical'),
                ),
                $this->table_prefix . 'topics' => array(
                    'is_historical' => array('is_historical'),
                ),
                $this->table_prefix . 'posts' => array(
                    'is_historical' => array('is_historical'),
                ),
            ),
        );
    }

    /**
     * Revert database schema changes
     *
     * @return array
     */
    public function revert_schema()
    {
        return array(
            'drop_columns' => array(
                $this->table_prefix . 'users' => array(
                    'is_historical',
                ),
                $this->table_prefix . 'forums' => array(
                    'is_historical',
                ),
                $this->table_prefix . 'topics' => array(
                    'is_historical',
                ),
                $this->table_prefix . 'posts' => array(
                    'is_historical',
                ),
            ),
        );
    }
}
