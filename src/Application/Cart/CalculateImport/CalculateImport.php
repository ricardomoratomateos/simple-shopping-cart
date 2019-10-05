<?php
namespace Uvinum\Application\Cart\CalculateImport;

use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Cart\CartRepositoryInterface;
use Uvinum\Domain\Currency\CurrencyRepositoryInterface;
use Uvinum\Domain\Product\Product;

class CalculateImport
{
    /** @var CartRepositoryInterface $cartRepository */
    private $cartRepository;

    /** @var CurrencyRepositoryInterface $currencyRepository */
    private $currencyRepository;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        CurrencyRepositoryInterface $currencyRepository
    ) {
        $this->cartRepository = $cartRepository;
        $this->currencyRepository = $currencyRepository;
    }
    
    /**
     * @param CalculateImportRequest $request
     * @return CalculateImportResponse
     * @throws CartNotFoundException
     * @throws CurrencyNotFoundException
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

        $transformedImport = null;
        if ($request->transformImport()) {
            $transformTo = $request->to();
            $currencyValue = $this->currencyRepository->getValue($transformTo);

            $transformedImport = $import * $currencyValue;
        }

        return new CalculateImportResponse($import, $transformedImport);
    }
}
