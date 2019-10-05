<?php
namespace Uvinum\Application\Cart\DeleteProduct;

use Uvinum\Domain\Cart\Cart;
use Uvinum\Domain\Cart\CartRepositoryInterface;
use Uvinum\Domain\Cart\Validations\CartValidatorInterface;
use Uvinum\Domain\Product\Product;
use Uvinum\Domain\Product\ProductRepositoryInterface;

class DeleteProduct
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
     * @param DeleteProductRequest $request
     * @return DeleteProductResponse
     * @throws CartNotFoundException
     * @throws ProductNotFoundException
     * @throws UnexpectedErrorSavingCartException
     * @throws ProductNotInCart
     */
    public function __invoke(DeleteProductRequest $request): DeleteProductResponse
    {
        $cartId = $request->getCartId();
        $productId = $request->getProductId();

        /** @var Cart $cart */
        $cart = $this->cartRepository->getById($cartId);
        /** @var Product $product */
        $product = $this->productRepository->getById($productId);

        $this->validator->validate([
            CartValidatorInterface::CART => $cart,
            CartValidatorInterface::PRODUCT => $product,
        ]);
        $cart->deleteProduct($product);

        $this->cartRepository->save($cart);

        return new DeleteProductResponse();
    }
}
