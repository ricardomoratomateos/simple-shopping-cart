<?php
namespace Uvinum\Tests\Unit\Application\Cart\DeleteProduct;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\DeleteProduct\DeleteProductRequest;

class DeleteProductRequestTest extends TestCase
{
    public function testCreateRequest(): void
    {
        $cartId = 1;
        $productId = 2;

        $request = new DeleteProductRequest(
            $cartId,
            $productId
        );

        $this->assertInstanceOf(DeleteProductRequest::class, $request);
        $this->assertSame($cartId, $request->getCartId());
        $this->assertSame($productId, $request->getProductId());
    }
}
