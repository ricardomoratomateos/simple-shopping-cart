<?php
namespace Uvinum\Domain\Currency;

use Uvinum\Domain\Currency\Exceptions\CurrencyNotFoundException;

interface CurrencyRepositoryInterface
{
    /**
     * @param string $currency Use one of the constants from the Currency List
     * @return float
     * @throws CurrencyNotFoundException
     */
    public function getValue(string $currency): float;
}
