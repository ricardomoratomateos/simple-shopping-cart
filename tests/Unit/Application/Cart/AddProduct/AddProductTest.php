<?php
namespace Uvinum\Tests\Unit\Application\Cart\AddProduct;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\AddProduct\AddProduct;
use Uvinum\Application\Cart\AddProduct\AddProductRequest;
use Uvinum\Application\Cart\AddProduct\AddProductResponse;
use Uvinum\Application\Cart\AddProduct\AddProductValidator;
use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Cart\CartRepositoryInterface;
use Uvinum\Domain\Product\Product;
use Uvinum\Domain\Product\ProductRepositoryInterface;

class AddProductTest extends TestCase
{
    public function testAddProduct(): void
    {
        $cart = $this->createMock(Cart::class);
        $cart->method('addProduct');
        $cartRepository = $this->createMock(CartRepositoryInterface::class);
        $cartRepository->method('getById')->willReturn($cart);
        $cartRepository->method('save');
        $product = $this->createMock(Product::class);
        $productRepository = $this->createMock(ProductRepositoryInterface::class);
        $productRepository->method('getById')->willReturn($product);
        $validator = $this->createMock(AddProductValidator::class);
        $validator->method('validate')->willReturn(null);
        $request = $this->createMock(AddProductRequest::class);
        $request->method('getCartId')->willReturn(1);
        $request->method('getProductId')->willReturn(2);
        $request->method('getQuantity')->willReturn(3);

        $addProduct = new AddProduct($cartRepository, $productRepository, $validator);

        $this->assertInstanceOf(AddProductResponse::class, $addProduct($request));
    }
}
