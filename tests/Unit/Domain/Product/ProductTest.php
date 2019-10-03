<?php
namespace Uvinum\Tests\Unit\Domain\Product;

use PHPUnit\Framework\TestCase;
use Uvinum\Domain\Product\Product;

class ProductTest extends TestCase
{
    public function testCreateProduct(): void
    {
        $product = new Product();

        $this->assertInstanceOf(Product::class, $product);
    }
}
