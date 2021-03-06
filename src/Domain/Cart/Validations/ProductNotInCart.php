<?php
namespace Uvinum\Domain\Cart\Validations;

use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Product\Product;
use Uvinum\Domain\Cart\Exceptions\ProductNotInCartException;

class ProductNotInCart implements CartValidatorInterface
{
    public function validate(array $data)
    {
        /** @var Cart $cart */
        $cart = $data[self::CART];
        /** @var Product $product */
        $product = $data[self::PRODUCT];

        $productInCart = $cart->getProduct($product);
        if (empty($productInCart)) {
            throw new ProductNotInCartException(
                "",
                ProductNotInCartException::CODE
            );
        }
    }
}
