<?php
namespace Uvinum\Tests\Unit\Domain\Product;

use PHPUnit\Framework\TestCase;
use Uvinum\Domain\Product\Product;

class ProductTest extends TestCase
{
    public function createProductProvider(): array
    {
        return [
            'with-values' => [
                'id' => 1,
                'price' => 10.0,
                'isInOffer' => true,
                'minOfOfferUnities' => 3,
                'priceInOffer' => 9.0,
            ],
            'without-values' => [
                'id' => null,
                'price' => null,
                'isInOffer' => null,
                'minOfOfferUnities' => null,
                'priceInOffer' => null,
            ]
        ];
    }

    /** @dataProvider createProductProvider */
    public function testCreateProduct(
        $id,
        $price,
        $isInOffer,
        $minOfOfferUnities,
        $priceInOffer
    ): void {
        $product = new Product(
            $id,
            $price,
            $isInOffer,
            $minOfOfferUnities,
            $priceInOffer
        );

        $this->assertInstanceOf(Product::class, $product);
        $this->assertSame($id, $product->getId());
        $this->assertSame($price, $product->getPrice());
        $this->assertSame($isInOffer, $product->isInOffer());
        $this->assertSame($minOfOfferUnities, $product->getMinOfOfferUnities());
        $this->assertSame($priceInOffer, $product->getPriceInOffer());
    }
}
