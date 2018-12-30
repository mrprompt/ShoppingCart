# ShoppingCart

[![Build Status](https://travis-ci.org/mrprompt/ShoppingCart.svg?branch=master)](https://travis-ci.org/mrprompt/ShoppingCart)
[![Build Status](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

A reusable shopping cart implementation.

### Install

```console
composer require mrprompt/shopping-cart
```

### Using

#### Initializing a cart with items

You can initializes a cart passing an array of items. An item is a instance of `Item` class 
or an implementation of `ItemInterface`.

```php
use \MrPrompt\ShoppingCart\Cart;
use \MrPrompt\ShoppingCart\Item;

$items = [ 
    new Item(uniqid()),
    new Item(uniqid(), 1.00),
    new Item(uniqid(), 5.00, 10),
];

$cart = new Cart($items);
```

#### Add items to cart

You can add items to an existent cart passing an instance of `Item`.

```php
use \MrPrompt\ShoppingCart\Item;

$itemId = uniqid();
$itemPrice = 1.99;
$itemQuantity = 30;

$item = new Item($itemId, $itemPrice, $itemQuantity);

$cart->addItem($item);
```

#### Remove an item from cart

Pass an instance of `Item` - previously added to cart obvously - to remove it.

```php
use \MrPrompt\ShoppingCart\Item;

$itemId = uniqid();
$itemPrice = 1.99;
$itemQuantity = 30;

$item = new Item($itemId, $itemPrice, $itemQuantity);

$cart = new Cart([ $item ]);
$cart->removeItem($item);
```

#### Cleanup the cart

To remove all items from cart, you can use the `cleanUp` method:

```php
use \MrPrompt\ShoppingCart\Cart;
use \MrPrompt\ShoppingCart\Item;

$itemId = uniqid();
$itemPrice = 1.99;
$itemQuantity = 30;
$item = new Item($itemId, $itemPrice, $itemQuantity);

$cart = new Cart([ $item ]);
echo $cart->count(); // === 1

$cart->cleanUp();

echo $cart->count(); // === 0
```

#### Check if cart is empty

To check if the cart is empty, you can use `isEmpty` method:

```php
use \MrPrompt\ShoppingCart\Cart;
use \MrPrompt\ShoppingCart\Item;

$itemId = uniqid();
$itemPrice = 1.99;
$itemQuantity = 30;
$item = new Item($itemId, $itemPrice, $itemQuantity);

$cart = new Cart([ $item ]);
echo $cart->isEmpty(); // === false

$cart->cleanUp();

echo $cart->isEmpty(); // === true
```

### Testing

```console
phpunit --coverage-text --testdox
```

#### MIT License