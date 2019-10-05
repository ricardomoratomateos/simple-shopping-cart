<?php
namespace Uvinum\Tests\Unit\Application\Cart\AddProduct;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\AddProduct\AddProductRequest;

class AddProductRequestTest extends TestCase
{
    public function testCreateRequest(): void
    {
        $cartId = 1;
        $productId = 2;
        $quantity = 3;

        $request = new AddProductRequest(
            $cartId,
            $productId,
            $quantity
        );

        $this->assertInstanceOf(AddProductRequest::class, $request);
        $this->assertSame($cartId, $request->getCartId());
        $this->assertSame($productId, $request->getProductId());
        $this->assertSame($quantity, $request->getQuantity());
    }
}
