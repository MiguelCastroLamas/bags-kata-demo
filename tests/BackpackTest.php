<?php

namespace Tests;

use _Exceptions\ItemsExceededException;
use Backpack\Backpack;
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
class BackpackTest extends TestCase
{

    /**
     * Create a new instance of backpack and test if its an empty array
     * @test
     */
    public function create_backpack_and_test_if_is_empty()
    {
        $backpack = new Backpack();
        $this->assertIsArray($backpack->items);
        $this->assertEmpty($backpack->items);
    }

    /**
     * Add item to backpack
     * @test
     */
    public function add_item_to_backpack()
    {
        $backpack = new Backpack();
        $category = new Category('Generic');
        $item = new Item('Item', $category);
        $backpack->addItem($item);
        $this->assertEquals([$item], $backpack->items);
    }

    /**
     * Create a new instance of backpack, add item and then remove it.
     * @test
     */
    public function empty_items_of_backpack()
    {
        $backpack = new Backpack();
        $category = new Category('Generic');
        $item = new Item('Item', $category);
        $backpack->addItem($item);
        $backpack->clear();
        $this->assertEmpty($backpack->items);
    }

    /**
     * Create a new instance of backpack, add items until full it and add one more trying to throw an exception
     * @test
     */
    public function cant_add_items_to_backpack_when_if_full()
    {
        $this->expectException(ItemsExceededException::class);

        $backpack = new Backpack();
        $category = new Category('Generic');
        for ($i = 0; $i < $backpack->size() + 1; $i++) {
            $name = "Item" . $i;
            $item = new Item($name, $category);
            $backpack->addItem($item);
        }
    }
}
