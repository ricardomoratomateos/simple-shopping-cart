<?php
namespace Uvinum\Tests\Unit\Application\Cart\CalculateImport;

use PHPUnit\Framework\TestCase;
use Uvinum\Application\Cart\CalculateImport\CalculateImportRequest;
use Uvinum\Domain\Currency\CurrencyList;

class CalculateImportRequestTest extends TestCase
{
    public function testCreateRequestForNotTransformedValue(): void
    {
        $cartId = 1;
        $request = new CalculateImportRequest($cartId);

        $this->assertInstanceOf(CalculateImportRequest::class, $request);
        $this->assertSame($cartId, $request->getCartId());
        $this->assertFalse($request->transformImport());
        $this->assertNull($request->to());
    }

    public function testCreateRequestForTransformedValue(): void
    {
        $cartId = 1;
        $transform = true;
        $to = CurrencyList::DOLLAR;
        $request = new CalculateImportRequest($cartId, $transform, $to);

        $this->assertInstanceOf(CalculateImportRequest::class, $request);
        $this->assertSame($cartId, $request->getCartId());
        $this->assertTrue($request->transformImport());
        $this->assertSame($to, $request->to());
    }
}
