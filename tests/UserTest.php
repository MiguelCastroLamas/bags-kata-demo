<?php

namespace Tests;

use _Exceptions\BagsExceededException;
use _Exceptions\StoragesFullException;
use User\User;
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
class UserTest extends TestCase
{
    /**
     * Create a new instance of user
     * @test
     */
    public function create_user_with_name_and_test_asignment()
    {
        $name = 'Durance';
        $user = new User($name);
        $this->assertEquals($name, $user->name);
    }

    /**
     * Add a new bag to user
     * * @test
     */
    public function add_bag_to_user()
    {
        $user = new User('Durance');
        $category = new Category('Generic');
        $bag = new Bag($category);
        $user->addBag($bag);
        $this->assertEquals([$bag], $user->bags);
    }

    /**
     * Create a new instance of user, add bags until limit and add one more trying to throw an exception
     * @test
     */
    public function cant_add_unlimited_bags_to_user()
    {
        $this->expectException(BagsExceededException::class);

        $user = new User('Durance');
        $category = new Category('Generic');

        for ($i = 0; $i < User::MAX_BAGS + 1; $i++) {
            $bag = new Bag($category);
            $user->addBag($bag);
        }
    }

    /**
     * Add item to user empty backpack
     * @test
     */
    public function add_item_to_user_empty_backpack()
    {
        $user = new User('Durance');
        $category = new Category('Generic');
        $item = new Item('Item', $category);
        $user->addItem($item);
        $this->assertEquals([$item], $user->backpack->items);
    }

    /**
     * Add item to user not empty backpack
     * @test
     */
    public function add_item_to_user_not_empty_backpack()
    {
        $items = [];

        $user = new User('Durance');
        $category = new Category('Generic');

        $item_previous = new Item('Item', $category);
        $items[] = $item_previous;
        $user->addItem($item_previous);

        $item_added = new Item('Item', $category);
        $items[] = $item_added;
        $user->addItem($item_added);

        $this->assertEquals($items, $user->backpack->items);
    }

    /**
     * Add item to user full backpack without bags
     * @test
     */
    public function add_item_to_user_full_backpack_without_bags()
    {
        $this->expectException(StoragesFullException::class);

        $user = new User('Durance');
        $category = new Category('Generic');
        for ($i = 0; $i < $user->backpack->size() + 1; $i++) {
            $name = "Item" . $i;
            $item = new Item($name, $category);
            $user->addItem($item);
        }
    }

    /**
     * Add item to user full backpack with space in bags
     * @test
     */
    public function add_item_to_user_full_backpack_with_space_in_bags()
    {
        $user = new User('Durance');
        $category = new Category('Generic');
        $bag = new Bag($category);
        $user->addBag($bag);

        // Fill backpack
        for ($i = 0; $i < $user->backpack->size(); $i++) {
            $name = "Item" . $i;
            $item = new Item($name, $category);
            $user->addItem($item);
        }

        // Add extra element
        $item_bag = new Item('ItemBag', $category);
        $user->addItem($item_bag);

        $this->assertEquals(count($user->backpack->items), $user->backpack->size());
        $this->assertEquals([$item_bag], $bag->items);
    }

    /**
     * Add item to user full backpack and bags
     * @test
     */
    public function add_item_to_user_full_backpack_and_full_bags()
    {
        $this->expectException(StoragesFullException::class);

        $user = new User('Durance');
        $category = new Category('Generic');

        // Fill backpack
        for ($i = 0; $i < $user->backpack->size(); $i++) {
            $name = "Item" . $i;
            $item = new Item($name, $category);
            $user->addItem($item);
        }

        // Create bags
        for ($i = 0; $i < User::MAX_BAGS; $i++) {
            $category = new Category('Generic' . $i);
            $bag = new Bag($category);
            $user->addBag($bag);

            // Fill bags
            for ($y = 0; $y < $bag->size(); $y++) {
                $item = new Item('Item' . $i . $y, $category);
                $user->addItem($item);
            }
        }

        // Add extra element
        $item = new Item('Item', new Category());
        $user->addItem($item);
    }
}
