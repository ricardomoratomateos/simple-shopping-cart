<?php
namespace Uvinum\Tests\Unit\Application\Cart\CalculateImport;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\CalculateImport\CalculateImportResponse;

class CalculateImportResponseTest extends TestCase
{
    public function testCreateResponse(): void
    {
        $import = 10.0;
        $response = new CalculateImportResponse($import);

        $this->assertInstanceOf(CalculateImportResponse::class, $response);
        $this->assertSame($import, $response->getImport());
    }
}
