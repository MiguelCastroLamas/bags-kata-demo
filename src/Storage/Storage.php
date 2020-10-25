<?php

namespace Storage;

use _Exceptions\ItemsExceededException;
use Item\Item;

/**
 *
 * @package     Storage
 * @author      Miguel Castro <miguelcastrotic@gmail.com>
 * @version     1.0
 * @access      public
 * @date        2020-10-24
 */
abstract class Storage
{
    public array $items;

    public function __construct()
    {
        $this->items = [];
    }

    abstract public function size();

    public function clear()
    {
        $this->items = [];
    }

    public function isFull()
    {
        return count($this->items) >= $this->size();
    }

    public function addItem(Item $item)
    {
        if (!$this->isFull()) {
            $this->items[] = $item;
        } else {
            throw new ItemsExceededException();
        }
    }
}
