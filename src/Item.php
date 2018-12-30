<?php

namespace MrPrompt\ShoppingCart;

use MrPrompt\ShoppingCart\Contracts\ItemInterface;

class Item implements ItemInterface
{
    private $id;
    private $price;
    private $quantity;

    public function __construct(string $id, float $price = 0.00, int $quantity = 1)
    {
        $this->id = $id;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }
}