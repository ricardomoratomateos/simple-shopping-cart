<?php
namespace Uvinum\Domain\Cart;

use Uvinum\Domain\Cart\Exceptions\CartNotFoundException;
use Uvinum\Domain\Cart\Exceptions\UnexpectedErrorSavingCartException;

interface CartRepositoryInterface
{
    /**
     * @param integer $id
     * @return Cart
     * @throws CartNotFoundException
     */
    public function getById(int $id): Cart;

    /**
     * @param Cart $cart
     * @return void
     * @throws UnexpectedErrorSavingCartException
     */
    public function save(Cart $cart): void;
}
