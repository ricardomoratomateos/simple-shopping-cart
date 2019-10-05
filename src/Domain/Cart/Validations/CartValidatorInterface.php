<?php
namespace Uvinum\Domain\Cart\Validations;

use Uvinum\Domain\Common\ValidatorInterface;

interface CartValidatorInterface extends ValidatorInterface
{
    const CART= 'cart';
    const PRODUCT= 'product';
}
