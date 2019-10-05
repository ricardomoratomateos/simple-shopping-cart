<?php
namespace Uvinum\Tests\Unit\Application\Cart\DeleteProduct;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\DeleteProduct\DeleteProduct;
use Uvinum\Application\Cart\DeleteProduct\DeleteProductRequest;
use Uvinum\Application\Cart\DeleteProduct\DeleteProductResponse;
use Uvinum\Application\Cart\DeleteProduct\DeleteProductValidator;
use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Cart\CartRepositoryInterface;
use Uvinum\Domain\Product\Product;
use Uvinum\Domain\Product\ProductRepositoryInterface;

class DeleteProductTest extends TestCase
{
    public function testDeleteProduct(): void
    {
        $cart = $this->createMock(Cart::class);
        $cart->method('deleteProduct');
        $cartRepository = $this->createMock(CartRepositoryInterface::class);
        $cartRepository->method('getById')->willReturn($cart);
        $cartRepository->method('save');
        $product = $this->createMock(Product::class);
        $productRepository = $this->createMock(ProductRepositoryInterface::class);
        $productRepository->method('getById')->willReturn($product);
        $validator = $this->createMock(DeleteProductValidator::class);
        $validator->method('validate')->willReturn(null);
        $request = $this->createMock(DeleteProductRequest::class);
        $request->method('getCartId')->willReturn(1);
        $request->method('getProductId')->willReturn(2);

        $deleteProduct = new DeleteProduct($cartRepository, $productRepository, $validator);

        $this->assertInstanceOf(DeleteProductResponse::class, $deleteProduct($request));
    }
}
