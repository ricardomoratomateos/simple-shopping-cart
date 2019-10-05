<?php
namespace Uvinum\Test\Unit\Domain\Cart\Validations;

use PHPUnit\Framework\TestCase;
use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Product\Product;
use Uvinum\Domain\Cart\Validations\ProductAlreadyInCart;
use Uvinum\Domain\Cart\Exceptions\ProductAlreadyInCartException;

class ProductAlreadyInCartTest extends TestCase
{
    public function testValidate(): void
    {
        $product = $this->createMock(Product::class);
        $cart = $this->createMock(Cart::class);
        $cart->method('getProduct')->willReturn([]);
        $data[ProductAlreadyInCart::CART] = $cart;
        $data[ProductAlreadyInCart::PRODUCT] = $product;
        $validator = new ProductAlreadyInCart();
        
        $this->assertNull($validator->validate($data));
    }

    public function testValidateThrowsException(): void
    {
        $product = $this->createMock(Product::class);
        $cart = $this->createMock(Cart::class);
        $cart->method('getProduct')->willReturn([
            Cart::QUANTITY => 1,
            Cart::ITEM => $product
        ]);
        $data[ProductAlreadyInCart::CART] = $cart;
        $data[ProductAlreadyInCart::PRODUCT] = $product;
        $validator = new ProductAlreadyInCart();

        $this->expectException(ProductAlreadyInCartException::class);

        $validator->validate($data);
    }
}
