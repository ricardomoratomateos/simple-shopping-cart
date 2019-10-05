<?php
namespace Uvinum\Domain\Cart\Validations;

use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Product\Product;
use Uvinum\Domain\Cart\Exceptions\MaxUnitsOfProductInCartException;

class MaxUnitsOfProductInCart implements CartValidatorInterface
{
    const MAX_UNITS_OF_PRODUCT = 50;

    public function validate(array $data)
    {
        /** @var Cart $cart */
        $cart = $data[self::CART];
        /** @var Product $product */
        $product = $data[self::PRODUCT];

        $productInCart = $cart->getProduct($product);
        if ($productInCart[Cart::QUANTITY] >= self::MAX_UNITS_OF_PRODUCT) {
            throw new MaxUnitsOfProductInCartException(
                "",
                MaxUnitsOfProductInCartException::CODE
            );
        }
    }
}
