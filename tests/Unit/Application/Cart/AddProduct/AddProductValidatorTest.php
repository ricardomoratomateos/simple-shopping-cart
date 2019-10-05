<?php
namespace Uvinum\Tests\Unit\Application\Cart\AddProduct;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\AddProduct\AddProductValidator;
use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Product\Product;

class AddProductValidatorTest extends TestCase
{
    public function testValidate(): void
    {
        $cart = $this->createMock(Cart::class);
        $product = $this->createMock(Product::class);
        $cart->method('getAllProducts')->willReturn([]);
        $cart->method('getProduct')->willReturn([
            Cart::QUANTITY => 20,
            Cart::ITEM => $product,
        ]);
        $data = [
            AddProductValidator::CART => $cart,
            AddProductValidator::PRODUCT => $product,
        ];
        $validator = new AddProductValidator();

        $this->assertNull($validator->validate($data));
    }
}
