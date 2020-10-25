<?php

namespace _Utils;

use _Exceptions\ItemsExceededException;
use _Exceptions\StoragesFullException;
use User\User;

/**
 *
 * @package     _Utils
 * @author      Miguel Castro <miguelcastrotic@gmail.com>
 * @version     1.0
 * @access      public
 * @date        2020-10-24
 */
class Organize
{
    private array $items;
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->groupItems();
        $this->clearStorages();
        $this->refillStorages();
    }

    private function groupItems()
    {
        foreach ($this->user->backpack->items as $item) {
            $this->items[] = $item;
        }

        foreach ($this->user->bags as $bag) {
            foreach ($bag->items as $item) {
                $this->items[] = $item;
            }
        }
    }

    private function clearStorages()
    {
        $this->user->backpack->clear();

        foreach ($this->user->bags as $bag) {
            $bag->clear();
        }
    }

    private function refillStorages()
    {
        //Refill bags
        foreach ($this->user->bags as $bag) {
            foreach ($this->items as $key => $item) {
                if ($item->category->name === $bag->category->name) {
                    try {
                        $bag->addItem($item);
                        unset($this->items[$key]);
                    } catch (ItemsExceededException $e) {
                    }
                }
            }
        }

        // Add remaining items randomly
        foreach ($this->items as $key => $item) {
            try {
                $this->user->addItem($item);
                unset($this->items[$key]);
            } catch (StoragesFullException $e) {
            }
        }

        // Order items alphabetically in each storage
        Sort::name($this->user->backpack->items);
        foreach ($this->user->bags as $bag) {
            Sort::name($bag->items);
        }
    }
}
