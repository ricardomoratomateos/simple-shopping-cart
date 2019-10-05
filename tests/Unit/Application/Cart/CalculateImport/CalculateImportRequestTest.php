<?php
namespace Uvinum\Tests\Unit\Application\Cart\CalculateImport;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\CalculateImport\CalculateImportRequest;

class CalculateImportRequestTest extends TestCase
{
    public function testCreateRequest(): void
    {
        $cartId = 1;
        $request = new CalculateImportRequest($cartId);

        $this->assertInstanceOf(CalculateImportRequest::class, $request);
        $this->assertSame($cartId, $request->getCartId());
    }
}
