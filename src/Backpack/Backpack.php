<?php

namespace Backpack;

use Storage\Storage;

/**
 *
 * @package     Backpack
 * @author      Miguel Castro <miguelcastrotic@gmail.com>
 * @version     1.0
 * @access      public
 * @date        2020-10-24
 */
class Backpack extends Storage
{
    public function __construct()
    {
        parent::__construct();
    }

    public function size()
    {
        return 8;
    }
}
