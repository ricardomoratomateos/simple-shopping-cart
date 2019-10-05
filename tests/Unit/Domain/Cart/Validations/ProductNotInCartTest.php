<?php
namespace Uvinum\Test\Unit\Domain\Cart\Validations;

use PHPUnit\Framework\TestCase;
use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Product\Product;
use Uvinum\Domain\Cart\Validations\ProductNotInCart;
use Uvinum\Domain\Cart\Exceptions\ProductNotInCartException;

class ProductNotInCartTest extends TestCase
{
    public function testValidate(): void
    {
        $product = $this->createMock(Product::class);
        $cart = $this->createMock(Cart::class);
        $cart->method('getProduct')->willReturn([
            Cart::QUANTITY => 1,
            Cart::ITEM => $product
        ]);
        $data[ProductNotInCart::CART] = $cart;
        $data[ProductNotInCart::PRODUCT] = $product;
        $validator = new ProductNotInCart();
        
        $this->assertNull($validator->validate($data));
    }

    public function testValidateThrowsException(): void
    {
        $product = $this->createMock(Product::class);
        $cart = $this->createMock(Cart::class);
        $cart->method('getProduct')->willReturn([]);
        $data[ProductNotInCart::CART] = $cart;
        $data[ProductNotInCart::PRODUCT] = $product;
        $validator = new ProductNotInCart();

        $this->expectException(ProductNotInCartException::class);

        $validator->validate($data);
    }
}
