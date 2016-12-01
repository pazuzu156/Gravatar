<?php

use Pazuzu156\Gravatar\Gravatar;

if (!function_exists('g_const')) {
    /**
     * Uses Gravatar's _const function to get the value of supplied constant.
     *
     * @param string $constant - The constant you need to get the value of
     *
     * @return string
     */
    function g_const($constant)
    {
        $g = new Gravatar();

        return $g->_const($constant);
    }
}
