<?php
namespace Uvinum\Application\Cart\AddProduct;

use Uvinum\Domain\Cart\Validations\CartValidatorInterface;
use Uvinum\Domain\Cart\Validations\MaxOfProductsInCart;
use Uvinum\Domain\Cart\Validations\MaxUnitsOfProductInCart;
use Uvinum\Domain\Common\ValidatorInterface;
use Uvinum\Domain\Common\Validator;

class AddProductValidator implements CartValidatorInterface
{
    /**
     * @param array $data
     * @return void
     * @throws MaxOfProductsInCartException
     * @throws MaxUnitsOfProductInCartException
     */
    public function validate(array $data)
    {
        $validator = $this->buildValidator();
        $validator->validate($data);
    }

    private function buildValidator(): ValidatorInterface
    {
        return new Validator([
            new MaxOfProductsInCart(),
            new MaxUnitsOfProductInCart(),
        ]);
    }
}
