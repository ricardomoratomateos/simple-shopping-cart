<?php
namespace Uvinum\Application\Cart\AddProduct;

class AddProductRequest
{
    /** @var int $cartId */
    private $cartId;

    /** @var int $productId */
    private $productId;

    /** @var int $quantity */
    private $quantity;

    public function __construct(int $cartId, int $productId, int $quantity)
    {
        $this->cartId = $cartId;
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function getCartId(): int
    {
        return $this->cartId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
