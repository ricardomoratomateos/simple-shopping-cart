<?php
namespace Uvinum\Tests\Unit\Application\Cart\CalculateImport;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\CalculateImport\CalculateImportResponse;

class CalculateImportResponseTest extends TestCase
{
    public function testCreateResponseWithoutTransformedValue(): void
    {
        $import = 10.0;
        $response = new CalculateImportResponse($import);

        $this->assertInstanceOf(CalculateImportResponse::class, $response);
        $this->assertSame($import, $response->getImport());
        $this->assertNull($response->getTransformedImport());
    }

    public function testCreateResponseWithTransformedValue(): void
    {
        $import = 10.0;
        $transformedImport = 10.9;
        $response = new CalculateImportResponse($import, $transformedImport);

        $this->assertInstanceOf(CalculateImportResponse::class, $response);
        $this->assertSame($import, $response->getImport());
        $this->assertSame($transformedImport, $response->getTransformedImport());
    }
}
