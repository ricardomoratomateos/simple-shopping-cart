<?php
namespace Uvinum\Tests\Unit\Application\Cart\CalculateImport;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\CalculateImport\CalculateImport;
use Uvinum\Application\Cart\CalculateImport\CalculateImportRequest;
use Uvinum\Application\Cart\CalculateImport\CalculateImportResponse;
use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Cart\CartRepositoryInterface;
use Uvinum\Domain\Product\Product;

class CalculateImportTest extends TestCase
{
    public function productsProvider(): array
    {
        $product = $this->createMock(Product::class);
        $product->method('getPrice')->willReturn(10.0);
        $product->method('isInOffer')->willReturn(false);
        $product->method('getMinOfOfferUnities')->willReturn(0);
        $productInOffer = $this->createMock(Product::class);
        $productInOffer->method('getPrice')->willReturn(10.0);
        $productInOffer->method('isInOffer')->willReturn(true);
        $productInOffer->method('getMinOfOfferUnities')->willReturn(3);
        $productInOffer->method('getPriceInOffer')->willReturn(9.0);

        return [
            'empty' => [
                'products' => [],
                'expected-import' => 0,
            ],
            'empty' => [
                'products' => [
                    [
                        Cart::ITEM => $product,
                        Cart::QUANTITY => 3,
                    ],
                    [
                        Cart::ITEM => $productInOffer,
                        Cart::QUANTITY => 3,
                    ],
                ],
                'expected-import' => 57.0,
            ],
        ];
    }

    /** @dataProvider productsProvider */
    public function testCalculateImport(array $products, float $expectedImport): void
    {
        $cart = $this->createMock(Cart::class);
        $cart->method('getAllProducts')->willReturn($products);
        $cartRepository = $this->createMock(CartRepositoryInterface::class);
        $cartRepository->method('getById')->willReturn($cart);
        $request = $this->createMock(CalculateImportRequest::class);
        $request->method('getCartId')->willReturn(1);

        $deleteProduct = new CalculateImport($cartRepository);

        $request = $deleteProduct($request);
        $this->assertInstanceOf(CalculateImportResponse::class, $request);
        $this->assertEquals($expectedImport, $request->getImport());
    }
}
