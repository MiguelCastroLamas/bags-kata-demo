<?php

namespace Tests;

use Category\Category;
use Item\Item;
use PHPUnit\Framework\TestCase;

/**
 *
 * @package     Tests
 * @author      Miguel Castro <miguelcastrotic@gmail.com>
 * @version     1.0
 * @access      public
 * @date        2020-10-24
 */
class ItemTest extends TestCase
{
    /**
     * Create a new instance of item with name and test asignment
     * @test
     */
    public function create_item_with_name_and_test_asignment()
    {
        $name = 'Item';
        $category = new Category('Generic');
        $item = new Item($name, $category);
        $this->assertEquals($name, $item->name);
    }
}
