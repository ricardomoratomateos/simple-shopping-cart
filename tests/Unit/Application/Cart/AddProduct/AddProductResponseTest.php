<?php
namespace Uvinum\Tests\Unit\Application\Cart\AddProduct;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\AddProduct\AddProductResponse;

class AddProductResponseTest extends TestCase
{
    public function testCreateResponse(): void
    {
        $response = new AddProductResponse();

        $this->assertInstanceOf(AddProductResponse::class, $response);
    }
}
