<?php
namespace Uvinum\Domain\Product;

use Uvinum\Domain\Product\Exceptions\ProductNotFoundException;

interface ProductRepositoryInterface
{
    /**
     * @param integer $id
     * @return Product
     * @throws ProductNotFoundException
     */
    public function getById(int $id): Product;
}
