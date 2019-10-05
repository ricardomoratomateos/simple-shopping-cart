<?php
namespace Uvinum\Tests\Unit\Domain\Cart;

use PHPUnit\Framework\TestCase;
use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Product\Product;

class CartTest extends TestCase
{
    public function createCartProvider(): array
    {
        $product = $this->createMock(Product::class);

        return [
            'with-values' => [
                'products' => [
                    [
                        Cart::QUANTITY => 1,
                        Cart::ITEM => $product
                    ]
                ],
            ],
            'without-values' => [
                'products' => [],
            ]
        ];
    }

    /** @dataProvider createCartProvider */
    public function testCreateCart(array $products): void
    {
        $cart = new Cart($products);

        $this->assertInstanceOf(Cart::class, $cart);
    }

    public function addProductProvider(): array
    {
        $product = $this->createMock(Product::class);
        $product->method('getId')->willReturn(1);

        return [
            'with-values' => [
                'initial-products' => [
                    1 => [
                        Cart::QUANTITY => 1,
                        Cart::ITEM => $product
                    ]
                ],
                'product' => $product,
                'quantity' => 1,
                'expected' => [
                    Cart::QUANTITY => 2,
                    Cart::ITEM => $product
                ]
            ],
            'without-values' => [
                'initial-products' => [],
                'product' => $product,
                'quantity' => 1,
                'expected' => [
                    Cart::QUANTITY => 1,
                    Cart::ITEM => $product
                ]
            ]
        ];
    }

    /** @dataProvider addProductProvider */
    public function testAddProduct(
        array $initialProducts,
        Product $product,
        int $quantity,
        array $expected
    ): void {
        $cart = new Cart($initialProducts);

        $cart->addProduct($product, $quantity);

        $this->assertEquals($expected, $cart->getProduct($product));
    }

    public function deleteProductProvider(): array
    {
        $product = $this->createMock(Product::class);
        $product->method('getId')->willReturn(1);

        return [
            'with-values' => [
                'initial-products' => [
                    1 => [
                        Cart::QUANTITY => 1,
                        Cart::ITEM => $product
                    ]
                ],
                'product' => $product,
            ],
            'without-values' => [
                'initial-products' => [],
                'product' => $product,
            ]
        ];
    }

    /** @dataProvider deleteProductProvider */
    public function testDeleteProduct(
        array $initialProducts,
        Product $product
    ): void {
        $cart = new Cart($initialProducts);

        $cart->deleteProduct($product);

        $this->assertEmpty($cart->getProduct($product));
    }

    public function getAllProductsProvider(): array
    {
        $product = $this->createMock(Product::class);
        $product->method('getId')->willReturn(1);

        return [
            'with-values' => [
                'products' => [
                    1 => [
                        Cart::QUANTITY => 1,
                        Cart::ITEM => $product
                    ]
                ],
            ],
            'without-values' => [
                'products' => [],
            ]
        ];
    }

    /** @dataProvider getAllProductsProvider */
    public function testGetAllProducts(array $products): void
    {
        $cart = new Cart($products);
        
        $this->assertSame($products, $cart->getAllProducts());
    }
}
