<?php
namespace Uvinum\Application\Cart\CalculateImport;

class CalculateImportRequest
{
    /** @var int $cartId */
    private $cartId;

    public function __construct(int $cartId)
    {
        $this->cartId = $cartId;
    }

    public function getCartId(): int
    {
        return $this->cartId;
    }
}
