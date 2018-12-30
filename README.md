# ShoppingCart

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