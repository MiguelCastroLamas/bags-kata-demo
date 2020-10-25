<?php

namespace Tests;

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
class CategoryTest extends TestCase
{
    /**
     * Create a new instance of category with name
     * @test
     */
    public function create_category_with_name_and_test_asignment()
    {
        $name = 'Generic';
        $category = new Category('Generic');
        $this->assertEquals($name, $category->name);
    }

    /**
     * Create a new instance of category without name
     * * @test
     */
    public function create_category_without_name_and_test_null_asignment()
    {
        $category = new Category();
        $this->assertNull($category->name);
    }
}
