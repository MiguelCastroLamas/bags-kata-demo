<?php

namespace Item;

use Category\Category;

/**
 *
 * @package     Item
 * @author      Miguel Castro <miguelcastrotic@gmail.com>
 * @version     1.0
 * @access      public
 * @date        2020-10-24
 */
class Item
{
    public string $name;
    public Category $category;

    public function __construct(string $name, Category $category)
    {
        $this->name = $name;
        $this->category = $category;
    }
}
