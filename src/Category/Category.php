<?php

namespace Category;

/**
 *
 * @package     Category
 * @author      Miguel Castro <miguelcastrotic@gmail.com>
 * @version     1.0
 * @access      public
 * @date        2020-10-24
 */
class Category
{
    public ?string $name;

    public function __construct(string $name = null)
    {
        $this->name = $name;
    }
}
