<?php
namespace Uvinum\Application\Cart\CalculateImport;

class CalculateImportResponse
{
    /** @var float $import */
    private $import;

    /** @var float|null $transformedImport */
    private $transformedImport;

    public function __construct(float $import, ?float $transformedImport = null)
    {
        $this->import = $import;
        $this->transformedImport = $transformedImport;
    }

    public function getImport(): float
    {
        return $this->import;
    }

    public function getTransformedImport(): ?float
    {
        return $this->transformedImport;
    }
}
