<?php

namespace MrPrompt\ShoppingCart\Contracts;

interface ItemInterface
{
    public function getId(): string;
    public function getQuantity(): int;
    public function setQuantity(int $quantity);
    public function getPrice(): float;
    public function setPrice(float $price);
}
