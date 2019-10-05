<?php
namespace Uvinum\Application\Cart\CalculateImport;

use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Cart\CartRepositoryInterface;
use Uvinum\Domain\Product\Product;

class CalculateImport
{
    /** @var CartRepositoryInterface $cartRepository */
    private $cartRepository;

    public function __construct(
        CartRepositoryInterface $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
    }
    
    /**
     * @param CalculateImportRequest $request
     * @return CalculateImportResponse
     * @throws CartNotFoundException
     */
    public function __invoke(CalculateImportRequest $request): CalculateImportResponse
    {
        $cartId = $request->getCartId();

        /** @var Cart $cart */
        $cart = $this->cartRepository->getById($cartId);

        $import = 0;
        $products = $cart->getAllProducts();
        foreach ($products as $productInCart) {
            /** @var Product $product */
            $product = $productInCart[Cart::ITEM];
            $quantity = $productInCart[Cart::QUANTITY];
            $price = $product->getPrice();
            if (
                $product->isInOffer() &&
                $quantity >= $product->getMinOfOfferUnities()
            ) {
                $price = $product->getPriceInOffer();
            }

            $import += $quantity * $price;
        }

        return new CalculateImportResponse($import);
    }
}
