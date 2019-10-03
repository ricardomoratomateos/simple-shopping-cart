<?php
namespace Uvinum\Domain\Product;

class Product
{
    /** @var int|null $id */
    private $id;

    /** @var float|null $price */
    private $price;

    /** @var bool|null $isInOffer */
    private $isInOffer;

    /** @var int|null $minOfOfferUnities */
    private $minOfOfferUnities;

    /** @var float|null $priceInOffer */
    private $priceInOffer;

    public function __construct(
        ?int $id = null,
        ?float $price = null,
        ?bool $isInOffer = null,
        ?int $minOfOfferUnities = null,
        ?float $priceInOffer = null
    ) {
        $this->id = $id;
        $this->price = $price;
        $this->isInOffer = $isInOffer;
        $this->minOfOfferUnities = $minOfOfferUnities;
        $this->priceInOffer = $priceInOffer;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function isInOffer(): ?bool
    {
        return $this->isInOffer;
    }

    public function getMinOfOfferUnities(): ?int
    {
        return $this->minOfOfferUnities;
    }

    public function getPriceInOffer(): ?float
    {
        return $this->priceInOffer;
    }
}
