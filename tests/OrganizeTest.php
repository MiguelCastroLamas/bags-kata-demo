<?php

namespace Tests;

use _Utils\Organize;
use User\User;
use Bag\Bag;
use Item\Item;
use Category\Category;
use PHPUnit\Framework\TestCase;

/**
 *
 * @package     Tests
 * @author      Miguel Castro <miguelcastrotic@gmail.com>
 * @version     1.0
 * @access      public
 * @date        2020-10-24
 */
class OrganizeTest extends TestCase
{
    /**
     * Add items to backpack and them reorganize in bags by category
     * @test
     */
    public function reorganize_items_from_backpack_in_bags()
    {
        $user = new User('Durance');

        // Create categories
        $gold_category = new Category('Gold');
        $silver_category = new Category('Silver');

        // Create bags
        $gold_bag = new Bag($gold_category);
        $silver_bag = new Bag($silver_category);

        // Add bags to user
        $user->addBag($gold_bag);
        $user->addBag($silver_bag);

        // Create items
        $gold_item = new Item('Trophy', $gold_category);
        $silver_item = new Item('Spoon', $silver_category);

        // Add items to backpack
        $user->addItem($gold_item);
        $user->addItem($silver_item);

        // Organize user storages
        new Organize($user);

        $this->assertEmpty($user->backpack->items);
        $this->assertEquals([$gold_item], $gold_bag->items);
        $this->assertEquals([$silver_item], $silver_bag->items);
    }

    /**
     * Add items that have the same category as a bag then add random item and reoganize
     * @test
     */
    public function move_item_in_bag_with_different_category_to_the_backpack()
    {

        $user = new User('Durance');

        // Add gold bag
        $gold_category = new Category('Gold');
        $gold_bag = new Bag($gold_category);
        $user->addBag($gold_bag);

        // Add gold items to backpack
        for ($i = 0; $i < $user->backpack->size() + 1; $i++) {
            $name = "Item" . $i;
            $item = new Item($name, $gold_category);
            $user->addItem($item);
        }

        // Add ramdon item
        $random_item = new Item('Random', new Category());
        $user->addItem($random_item);

        // Organize user storages
        new Organize($user);

        $this->assertContains($random_item, $user->backpack->items);
    }

    /**
     * Add items unsorted then reorganize
     * @test
     */
    public function items_are_sorted_by_name()
    {
        $user = new User('Durance');
        $gold_category = new Category('Gold');

        // Add items unsorted
        $first_item = new Item('A', $gold_category);
        $second_item = new Item('B', $gold_category);
        $user->addItem($second_item);
        $user->addItem($first_item);

        // Organize user storages
        new Organize($user);

        $this->assertEquals([$first_item, $second_item], $user->backpack->items);
    }
}
