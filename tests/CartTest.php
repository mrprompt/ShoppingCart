<?php

namespace MrPrompt\ShoppingCart\Tests;

use MrPrompt\ShoppingCart\Cart;
use MrPrompt\ShoppingCart\Contracts\CartInterface;
use MrPrompt\ShoppingCart\Contracts\ItemInterface;
use PHPUnit\Framework\TestCase;

/**
 * CartTest
 */
class CartTest extends TestCase
{
    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     */
    public function constructorWithoutParams()
    {
        $cart = new Cart();

        $this->assertInstanceOf(CartInterface::class, $cart);
        $this->assertCount(0, $cart);
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     */
    public function constructorWithItems()
    {
        $items = [ 
            $this->createMock(ItemInterface::class),
            $this->createMock(ItemInterface::class),
            $this->createMock(ItemInterface::class),
        ];

        $cart = new Cart($items);

        $this->assertInstanceOf(CartInterface::class, $cart);
        $this->assertCount(3, $cart);
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     * @covers MrPrompt\ShoppingCart\Cart::addItem
     */
    public function addItemIncrementCounter()
    {
        $item = $this->createMock(ItemInterface::class);

        $cart = new Cart();
        $cart->addItem($item);

        $this->assertInstanceOf(CartInterface::class, $cart);
        $this->assertCount(1, $cart);
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     * @covers MrPrompt\ShoppingCart\Cart::addItem
     */
    public function addItemWithSameObjectDontIncrementCounter()
    {
        $item = $this->createMock(ItemInterface::class);
        $item2 = clone $item;

        $cart = new Cart();
        $cart->addItem($item);
        $cart->addItem($item);
        $cart->addItem($item2);

        $this->assertInstanceOf(CartInterface::class, $cart);
        $this->assertCount(2, $cart);
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     * @covers MrPrompt\ShoppingCart\Cart::removeItem
     */
    public function removeItemSubstractCounter()
    {
        $item = $this->createMock(ItemInterface::class);
        
        $cart = new Cart([ $item ]);
        $cart->removeItem($item);

        $this->assertInstanceOf(CartInterface::class, $cart);
        $this->assertCount(0, $cart);
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     * @covers MrPrompt\ShoppingCart\Cart::removeItem
     */
    public function removeItemWithAbsentObjectReturnFalse()
    {
        $item = $this->createMock(ItemInterface::class);
        $item2 = clone $item;
        
        $cart = new Cart([ $item ]);
        $result = $cart->removeItem($item2);

        $this->assertInstanceOf(CartInterface::class, $cart);
        $this->assertCount(1, $cart);
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     * @covers MrPrompt\ShoppingCart\Cart::cleanUp
     */
    public function cleanUpRemoveAll()
    {
        $items = [ 
            $this->createMock(ItemInterface::class),
            $this->createMock(ItemInterface::class),
            $this->createMock(ItemInterface::class),
        ];

        $cart = new Cart($items);
        $result = $cart->cleanUp();
        
        $this->assertTrue($result);
        $this->assertCount(0, $cart);
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     * @covers MrPrompt\ShoppingCart\Cart::isEmpty
     */
    public function isEmptyWithFilledCartReturnFalse()
    {
        $items = [ 
            $this->createMock(ItemInterface::class),
            $this->createMock(ItemInterface::class),
            $this->createMock(ItemInterface::class),
        ];

        $cart = new Cart($items);
        $result = $cart->isEmpty();
        
        $this->assertFalse($result);
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     * @covers MrPrompt\ShoppingCart\Cart::isEmpty
     */
    public function isEmptyWithEmptyCartReturnTrue()
    {
        $cart = new Cart();
        $result = $cart->isEmpty();
        
        $this->assertTrue($result);
    }
}
