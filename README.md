# ShoppingCart

[![Build Status](https://travis-ci.org/mrprompt/ShoppingCart.svg?branch=master)](https://travis-ci.org/mrprompt/ShoppingCart)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mrprompt/ShoppingCart/?branch=master)

A reusable shopping cart implementation.

### Install

```console
composer require mrprompt/shopping-cart
```

### Using

```php
$items = [ 
    new Item(uniqid()),
    new Item(uniqid(), 1.00),
    new Item(uniqid(), 5.00, 10),
];

$cart = new Cart($items);
```

### Testing

```console
phpunit --coverage-text --testdox
```

#### MIT License