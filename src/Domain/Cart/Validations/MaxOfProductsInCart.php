<?php
namespace Uvinum\Domain\Cart\Validations;

use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Cart\Exceptions\MaxOfProductsInCartException;

class MaxOfProductsInCart implements CartValidatorInterface
{
    const MAX_PRODUCTS = 10;

    public function validate(array $data)
    {
        /** @var Cart $cart */
        $cart = $data[self::CART];

        $productsInCart = $cart->getAllProducts();
        if (count($productsInCart) >= self::MAX_PRODUCTS) {
            throw new MaxOfProductsInCartException(
                "",
                MaxOfProductsInCartException::CODE
            );
        }
    }
}
