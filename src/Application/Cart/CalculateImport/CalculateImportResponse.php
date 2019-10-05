<?php
namespace Uvinum\Application\Cart\CalculateImport;

class CalculateImportResponse
{
    /** @var float $import */
    private $import;

    public function __construct(float $import)
    {
        $this->import = $import;
    }

    public function getImport(): float
    {
        return $this->import;
    }
}
