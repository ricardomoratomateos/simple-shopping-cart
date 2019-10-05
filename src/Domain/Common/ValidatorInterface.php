<?php
namespace Uvinum\Domain\Common;

interface ValidatorInterface
{
    const CART_REPOSITORY = 'cart-repository';
    const PRODUCT_REPOSITORY = 'product-repository';

    public function validate(array $data);
}
