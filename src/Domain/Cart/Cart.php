<?php
namespace Uvinum\Domain\Cart;

use Uvinum\Domain\Product\Product;

class Cart
{
    const QUANTITY = 'quantity';
    const ITEM = 'item';

    /** @var array $products */
    private $products;

    public function __construct(array $products = []) {
        $this->products = $products;
    }

    public function addProduct(Product $product, int $quantity): void
    {
        $id = $product->getId();

        if (array_key_exists($id, $this->products)) {
            $rawProduct = $this->products[$id];
            $rawProduct[self::QUANTITY] += $quantity; 
            $rawProduct[self::ITEM] = $product; 
        } else {
            $rawProduct = [
                self::QUANTITY => $quantity,
                self::ITEM => $product,
            ];
        }

        $this->products[$id] = $rawProduct;
    }

    public function deleteProduct(Product $product): void
    {
        $id = $product->getId();

        if (array_key_exists($id, $this->products)) {
            unset($this->products[$id]);
        }
    }

    public function getProduct(Product $product): array
    {
        $id = $product->getId();

        return $this->products[$id] ?? [];
    }

    public function getAllProducts(): array
    {
        return $this->products;
    }
}
