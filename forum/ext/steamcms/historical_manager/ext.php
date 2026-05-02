<?php
/**
 * Historical Forum Manager Extension for phpBB
 *
 * Provides admin tools for managing historical 2004 Steam forum data.
 */

namespace steamcms\historical_manager;

class ext extends \phpbb\extension\base
{
    public function is_enableable()
    {
        return true;
    }
}
