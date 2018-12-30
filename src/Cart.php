<?php

namespace MrPrompt\ShoppingCart;

use MrPrompt\ShoppingCart\Contracts\CartInterface;
use MrPrompt\ShoppingCart\Contracts\ItemInterface;
use SplObjectStorage;

class Cart extends SplObjectStorage implements CartInterface
{
    public function __construct(array $items = [])
    {
        array_walk($items, [ $this, 'attach']);
    }
    
    public function addItem(ItemInterface $item): bool
    {
        if ($this->contains($item)) {
            return false;
        }

        $this->attach($item);
        
        return true;
    }

    public function removeItem(ItemInterface $item): bool
    {
        if ($this->contains($item)) {
            $this->detach($item);

            return true;
        }

        return false;
    }

    public function cleanUp(): bool
    {
        $this->removeAll($this);

        return $this->isEmpty();
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }
}
