<?php
namespace Uvinum\Application\Cart\DeleteProduct;

use Uvinum\Domain\Cart\Validations\CartValidatorInterface;
use Uvinum\Domain\Cart\Validations\ProductNotInCart;
use Uvinum\Domain\Common\ValidatorInterface;
use Uvinum\Domain\Common\Validator;

class DeleteProductValidator implements CartValidatorInterface
{
    /**
     * @param array $data
     * @return void
     * @throws ProductNotInCart
     */
    public function validate(array $data)
    {
        $validator = $this->buildValidator();
        $validator->validate($data);
    }

    private function buildValidator(): ValidatorInterface
    {
        return new Validator([
            new ProductNotInCart(),
        ]);
    }
}
