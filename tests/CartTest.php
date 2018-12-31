<?php

namespace MrPrompt\ShoppingCart\Tests;

use MrPrompt\ShoppingCart\Cart;
use PHPUnit\Framework\TestCase;
use MrPrompt\ShoppingCart\Contracts\CartInterface;
use MrPrompt\ShoppingCart\Contracts\ItemInterface;

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
        $id = uniqid();
        $cart = new Cart($id);

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

        $id = uniqid();
        $cart = new Cart($id, $items);

        $this->assertInstanceOf(CartInterface::class, $cart);
        $this->assertCount(3, $cart);
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     * @covers MrPrompt\ShoppingCart\Cart::getId
     */
    public function getIdReturnIdAttribute()
    {
        $id = uniqid();

        $cart = new Cart($id);

        $this->assertInstanceOf(CartInterface::class, $cart);
        $this->assertEquals($id, $cart->getId());
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     * @covers MrPrompt\ShoppingCart\Cart::addItem
     */
    public function addItemIncrementCounter()
    {
        $item = $this->createMock(ItemInterface::class);

        $id = uniqid();

        $cart = new Cart($id);
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

        $id = uniqid();

        $cart = new Cart($id);
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
        
        $id = uniqid();

        $cart = new Cart($id, [ $item ]);
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

        $id = uniqid();
        
        $cart = new Cart($id, [ $item ]);
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

        $id = uniqid();

        $cart = new Cart($id, $items);
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

        $id = uniqid();

        $cart = new Cart($id, $items);
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
        $id = uniqid();

        $cart = new Cart($id);
        $result = $cart->isEmpty();
        
        $this->assertTrue($result);
    }

    /** 
     * @test 
     * @covers MrPrompt\ShoppingCart\Cart::__construct
     * @covers MrPrompt\ShoppingCart\Cart::sum
     */
    public function sumReturnTotalFromItems()
    {
        $mockOne = $this->getMockBuilder(ItemInterface::class)
                        ->disableOriginalConstructor()
                        ->setMethods([
                            'getId', 
                            'getQuantity', 
                            'setQuantity', 
                            'getPrice',
                            'setPrice',
                            ])
                        ->getMock();
        
        $mockOne->method('getQuantity')
                ->will($this->returnValue(1));
        
        $mockOne->method('getPrice')
                ->will($this->returnValue(5.00));

        $mockTwo = clone $mockOne;
        $mockThree = clone $mockOne;
        
        $items = [ 
            $mockOne,
            $mockTwo,
            $mockThree
        ];

        $id = uniqid();
        $cart = new Cart($id, $items);
        $sum = $cart->sum();

        $this->assertInstanceOf(CartInterface::class, $cart);
        $this->assertEquals(15.00, $sum);
    }
}
