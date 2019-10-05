<?php
namespace Uvinum\Tests\Unit\Application\Cart\DeleteProduct;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\DeleteProduct\DeleteProductValidator;
use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Product\Product;

class DeleteProductValidatorTest extends TestCase
{
    public function testValidate(): void
    {
        $cart = $this->createMock(Cart::class);
        $product = $this->createMock(Product::class);
        $cart->method('getProduct')->willReturn([
            Cart::QUANTITY => 20,
            Cart::ITEM => $product,
        ]);
        $data = [
            DeleteProductValidator::CART => $cart,
            DeleteProductValidator::PRODUCT => $product,
        ];
        $validator = new DeleteProductValidator();

        $this->assertNull($validator->validate($data));
    }
}
