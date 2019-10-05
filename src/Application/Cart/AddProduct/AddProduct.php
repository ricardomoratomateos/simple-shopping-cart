<?php
namespace Uvinum\Application\Cart\AddProduct;

use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Cart\CartRepositoryInterface;
use Uvinum\Domain\Cart\Validations\CartValidatorInterface;
use Uvinum\Domain\Product\Product;
use Uvinum\Domain\Product\ProductRepositoryInterface;

class AddProduct
{
    /** @var CartRepositoryInterface $cartRepository */
    private $cartRepository;

    /** @var ProductRepositoryInterface $productRepository */
    private $productRepository;

    /** @var CartValidatorInterface $validator */
    private $validator;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        ProductRepositoryInterface $productRepository,
        CartValidatorInterface $validator
    ) {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->validator = $validator;
    }
    
    /**
     * @param AddProductRequest $request
     * @return AddProductResponse
     * @throws CartNotFoundException
     * @throws ProductNotFoundException
     * @throws UnexpectedErrorSavingCartException
     * @throws MaxOfProductsInCartException
     * @throws MaxUnitsOfProductInCartException
     */
    public function __invoke(AddProductRequest $request): AddProductResponse
    {
        $cartId = $request->getCartId();
        $productId = $request->getProductId();
        $quantity = $request->getQuantity();

        /** @var Cart $cart */
        $cart = $this->cartRepository->getById($cartId);
        /** @var Product $product */
        $product = $this->productRepository->getById($productId);

        $cart->addProduct($product, $quantity);
        $this->validator->validate([
            CartValidatorInterface::CART => $cart,
            CartValidatorInterface::PRODUCT => $product,
        ]);

        $this->cartRepository->save($cart);

        return new AddProductResponse();
    }
}
