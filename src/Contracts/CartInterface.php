<?php

namespace MrPrompt\ShoppingCart\Contracts;

interface CartInterface
{
    public function getId(): string;
    public function addItem(ItemInterface $item): bool;
    public function removeItem(ItemInterface $item): bool;
    public function cleanUp(): bool;
    public function isEmpty(): bool;
    public function sum(): float;
}
