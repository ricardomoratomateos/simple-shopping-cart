<?php
namespace Uvinum\Domain\Common;

class Validator implements ValidatorInterface
{
    /** @var ValidatorInterface $validators */
    private $validators;

    /**
     * @param ValidatorInterface[] $validators
     */
    public function __construct(array $validators = [])
    {
        $this->validators = $validators;
    }

    /**
     * @param array $data
     * @return void
     * @throws Exception
     */
    public function validate(array $data)
    {
        foreach ($this->validators as $validator) {
            $validator->validate($data);
        }
    }
}
