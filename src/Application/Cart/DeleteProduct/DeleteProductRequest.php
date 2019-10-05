<?php
namespace Uvinum\Application\Cart\DeleteProduct;

class DeleteProductRequest
{
    /** @var int $cartId */
    private $cartId;

    /** @var int $productId */
    private $productId;

    public function __construct(int $cartId, int $productId)
    {
        $this->cartId = $cartId;
        $this->productId = $productId;
    }

    public function getCartId(): int
    {
        return $this->cartId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}
