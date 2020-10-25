<?php

namespace _Utils;

/**
 *
 * @package     _Utils
 * @author      Miguel Castro <miguelcastrotic@gmail.com>
 * @version     1.0
 * @access      public
 * @date        2020-10-24
 */
class Sort
{
    public static function name(array &$items)
    {
        usort($items, fn ($l, $r) => strnatcasecmp($l->name, $r->name));
    }
}
