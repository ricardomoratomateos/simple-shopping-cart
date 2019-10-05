<?php
namespace Uvinum\Tests\Unit\Domain\Common;

use PHPUnit\Framework\TestCase;
use Uvinum\Domain\Common\Validator;

class ValidatorTest extends TestCase
{
    public function validatorsProvider(): array
    {
        $validator = $this->createMock(Validator::class);
        $validator->method('validate')->willReturn(null);

        return [
            'with-validators' => [
                'validators' => [$validator, $validator],
            ],
            'without-validators' => [
                'validators' => [],
            ]
        ];
    }

    /** @dataProvider validatorsProvider */
    public function testValidate(array $validators): void
    {
        $validator = new Validator($validators);

        $this->assertNull($validator->validate([]));
    }
}
