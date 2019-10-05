<?php
namespace Uvinum\Test\Unit\Domain\Cart\Validations;

use PHPUnit\Framework\TestCase;
use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Product\Product;
use Uvinum\Domain\Cart\Validations\MaxUnitsOfProductInCart;
use Uvinum\Domain\Cart\Exceptions\MaxUnitsOfProductInCartException;

class MaxUnitsOfProductInCartTest extends TestCase
{
    public function testValidate(): void
    {
        $product = $this->createMock(Product::class);
        $cart = $this->createMock(Cart::class);
        $cart->method('getProduct')->willReturn([
            Cart::QUANTITY => 10,
            Cart::ITEM => $product
        ]);
        $data[MaxUnitsOfProductInCart::CART] = $cart;
        $data[MaxUnitsOfProductInCart::PRODUCT] = $product;
        $validator = new MaxUnitsOfProductInCart();
        
        $this->assertNull($validator->validate($data));
    }

    public function testValidateThrowsException(): void
    {
        $product = $this->createMock(Product::class);
        $cart = $this->createMock(Cart::class);
        $cart->method('getProduct')->willReturn([
            Cart::QUANTITY => MaxUnitsOfProductInCart::MAX_UNITS_OF_PRODUCT,
            Cart::ITEM => $product
        ]);
        $data[MaxUnitsOfProductInCart::CART] = $cart;
        $data[MaxUnitsOfProductInCart::PRODUCT] = $product;
        $validator = new MaxUnitsOfProductInCart();

        $this->expectException(MaxUnitsOfProductInCartException::class);

        $validator->validate($data);
    }
}
