<?php

namespace User;

use _Exceptions\BagsExceededException;
use _Exceptions\StoragesFullException;
use _Exceptions\ItemsExceededException;
use Backpack\Backpack;
use Bag\Bag;
use Item\Item;

/**
 *
 * @package     User
 * @author      Miguel Castro <miguelcastrotic@gmail.com>
 * @version     1.0
 * @access      public
 * @date        2020-10-24
 */
class User
{
    public const MAX_BAGS = 4;

    public string $name;
    public ?array $bags;
    public Backpack $backpack;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->backpack = new Backpack();
        $this->bags = [];
    }

    public function addBag(Bag $bag)
    {
        if (count($this->bags) < self::MAX_BAGS) {
            $this->bags[] = $bag;
        } else {
            throw new BagsExceededException();
        }
    }

    public function addItem(Item $item)
    {
        try {
            $this->backpack->addItem($item);
        } catch (ItemsExceededException $e) {
            if (empty($this->bags)) {
                throw new StoragesFullException();
            }

            // Select next avaliable bag
            foreach ($this->bags as $key => $bag) {
                try {
                    $bag->addItem($item);
                    break;
                } catch (ItemsExceededException $e) {
                    if ($key === array_key_last($this->bags)) {
                        throw new StoragesFullException();
                    }
                }
            }
        }
    }
}
