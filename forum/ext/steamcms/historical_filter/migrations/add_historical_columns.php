<?php
namespace steamcms\historicalfilter\migrations;

class add_historical_columns extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return $this->db_tools->sql_column_exists($this->table_prefix . 'users', 'is_historical');
    }

    static public function depends_on()
    {
        return array('\phpbb\db\migration\data\v31x\v314');
    }

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
