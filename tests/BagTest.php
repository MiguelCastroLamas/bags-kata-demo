<?php

namespace Tests;

use _Exceptions\ItemsExceededException;
use Bag\Bag;
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
class BagTest extends TestCase
{

    /**
     * Create a new instance of bag without category and test if its an empty array
     * @test
     */
    public function create_bag_without_category_and_test_its_empty()
    {
        $bag = new Bag();
        $this->assertIsArray($bag->items);
        $this->assertEmpty($bag->items);
    }

    /**
     * Create a new instance of bag with category and test if its an empty array
     * @test
     */
    public function create_bag_with_category_and_test_its_empty()
    {
        $category = new Category('Generic');
        $bag = new Bag($category);
        $this->assertIsArray($bag->items);
        $this->assertEmpty($bag->items);
    }

    /**
     * Add item to bag
     * @test
     */
    public function add_item_to_bag()
    {
        $category = new Category('Generic');
        $bag = new Bag($category);
        $item = new Item('Item', $category);
        $bag->addItem($item);
        $this->assertEquals([$item], $bag->items);
    }

    /**
     * Create a new instance of bag, add item and then remove it.
     * @test
     */
    public function empty_items_of_bag()
    {
        $category = new Category('Generic');
        $bag = new Bag($category);
        $item = new Item('Item', $category);
        $bag->addItem($item);
        $bag->clear();
        $this->assertEmpty($bag->items);
    }

    /**
     * Create a new instance of bag, add items until full it and add one more trying to throw an exception
     * @test
     */
    public function cant_add_items_to_bag_when_if_full()
    {
        $this->expectException(ItemsExceededException::class);

        $category = new Category('Generic');
        $bag = new Bag($category);
        for ($i = 0; $i < $bag->size() + 1; $i++) {
            $name = "Item" . $i;
            $item = new Item($name, $category);
            $bag->addItem($item);
        }
    }
}
