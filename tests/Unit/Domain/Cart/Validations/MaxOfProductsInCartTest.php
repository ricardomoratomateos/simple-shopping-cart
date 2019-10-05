<?php
namespace Uvinum\Test\Unit\Domain\Cart\Validations;

use PHPUnit\Framework\TestCase;
use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Cart\Validations\MaxOfProductsInCart;
use Uvinum\Domain\Cart\Exceptions\MaxOfProductsInCartException;

class MaxOfProductsInCartTest extends TestCase
{
    public function testValidate(): void
    {
        $cart = $this->createMock(Cart::class);
        $cart->method('getAllProducts')->willReturn([]);
        $data[MaxOfProductsInCart::CART] = $cart;
        $validator = new MaxOfProductsInCart();
        
        $this->assertNull($validator->validate($data));
    }

    public function testValidateThrowsException(): void
    {
        // Create an array with 10 elements
        $products = array_fill(0, MaxOfProductsInCart::MAX_PRODUCTS, []);
        $cart = $this->createMock(Cart::class);
        $cart->method('getAllProducts')->willReturn($products);
        $data[MaxOfProductsInCart::CART] = $cart;
        $validator = new MaxOfProductsInCart();

        $this->expectException(MaxOfProductsInCartException::class);

        $validator->validate($data);
    }
}
