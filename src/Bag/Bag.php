<?php

namespace Bag;

use Category\Category;
use Storage\Storage;

/**
 *
 * @package     Bag
 * @author      Miguel Castro <miguelcastrotic@gmail.com>
 * @version     1.0
 * @access      public
 * @date        2020-10-24
 */
class Bag extends Storage
{
    public ?Category $category;

    public function __construct(Category $category = null)
    {
        parent::__construct();
        $this->category = $category;
    }

    public function size()
    {
        return 4;
    }
}
