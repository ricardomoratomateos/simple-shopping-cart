<?php
namespace Uvinum\Application\Cart\CalculateImport;

class CalculateImportRequest
{
    /** @var int $cartId */
    private $cartId;

    /** @var bool $transformImport */
    private $transformImport;

    /** @var string|null $to */
    private $to;

    /**
     * @param integer $cartId
     * @param boolean $transformImport
     * @param string|null $to Use one of the constants from the Currency List
     */
    public function __construct(
        int $cartId,
        bool $transformImport = false,
        ?string $to = null
    ) {
        $this->cartId = $cartId;
        $this->transformImport = $transformImport;
        $this->to = $to;
    }

    public function getCartId(): int
    {
        return $this->cartId;
    }

    public function transformImport(): bool
    {
        return $this->transformImport;
    }

    public function to(): ?string
    {
        return $this->to;
    }
}
