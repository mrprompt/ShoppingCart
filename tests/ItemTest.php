<?php

namespace MrPrompt\ShoppingCart\Tests;

use MrPrompt\ShoppingCart\Item;
use PHPUnit\Framework\TestCase;
use MrPrompt\ShoppingCart\Contracts\ItemInterface;

/**
 * ItemTest
 * @group group
 */
class ItemTest extends TestCase
{
    /** 
     * @test 
     * @covers \MrPrompt\ShoppingCart\Item::__construct
     * */
    public function constructorWithDefaultValues()
    {
        $id = uniqid();
        $item = new Item($id);

        $this->assertInstanceOf(ItemInterface::class, $item);
    }

    /** 
     * @test 
     * @covers \MrPrompt\ShoppingCart\Item::__construct
     */
    public function constructorWithPassedValues()
    {
        $id = uniqid();
        $quantity = 10;
        $price = 1.00;

        $item = new Item($id, $price, $quantity);

        $this->assertInstanceOf(ItemInterface::class, $item);
    }

    /** 
     * @test 
     * @covers \MrPrompt\ShoppingCart\Item::__construct
     * @covers \MrPrompt\ShoppingCart\Item::getId
     */
    public function getIdMustBeReturnIdAttribute()
    {
        $id = uniqid();

        $item = new Item($id);

        $this->assertEquals($id, $item->getId());
    }
    
    /** 
     * @test 
     * @covers \MrPrompt\ShoppingCart\Item::__construct
     * @covers \MrPrompt\ShoppingCart\Item::getQuantity
     */
    public function getQuantityMustBeReturnIdAttribute()
    {
        $id = uniqid();
        $price = 0.00;
        $quantity = 10;

        $item = new Item($id, $price, $quantity);

        $this->assertEquals($quantity, $item->getQuantity());
    }
    
    /** 
     * @test 
     * @covers \MrPrompt\ShoppingCart\Item::__construct
     * @covers \MrPrompt\ShoppingCart\Item::setQuantity
     */
    public function setQuantityMustBeReturnNull()
    {
        $id = uniqid();

        $item = new Item($id);

        $result = $item->setQuantity(10);

        $this->assertNull($result);
    }

    /** 
     * @test 
     * @covers \MrPrompt\ShoppingCart\Item::__construct
     * @covers \MrPrompt\ShoppingCart\Item::getPrice
     */
    public function getPriceMustBeReturnIdAttribute()
    {
        $id = uniqid();
        $price = 0.00;
        $quantity = 10;

        $item = new Item($id, $price, $quantity);

        $this->assertEquals($price, $item->getPrice());
    }

    /** 
     * @test 
     * @covers \MrPrompt\ShoppingCart\Item::__construct
     * @covers \MrPrompt\ShoppingCart\Item::setPrice
     */
    public function setPriceMustBeReturnNull()
    {
        $id = uniqid();

        $item = new Item($id);

        $result = $item->setPrice(10.00);

        $this->assertNull($result);
    }
}
