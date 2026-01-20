<?php
/**
 * Historical Data Filter Extension for phpBB
 *
 * Filters historical 2004 Steam forum data based on active style.
 */

namespace steamcms\historical_filter;

class ext extends \phpbb\extension\base
{
    /**
     * Check whether the extension can be enabled.
     *
     * @return bool
     */
    public function is_enableable()
    {
        return true;
    }
}
