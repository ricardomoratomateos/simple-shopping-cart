<?php
namespace Uvinum\Tests\Unit\Application\Cart\DeleteProduct;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\DeleteProduct\DeleteProductResponse;

class DeleteProductResponseTest extends TestCase
{
    public function testCreateResponse(): void
    {
        $response = new DeleteProductResponse();

        $this->assertInstanceOf(DeleteProductResponse::class, $response);
    }
}
