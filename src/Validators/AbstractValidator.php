<?php

namespace Kolpikov\AnnualPremium\Validators;

use Illuminate\Support\Facades\Validator;

/**
 * Class AbstractValidator
 * @package Kolpikov\AnnualPremium\Validators
 */
abstract class AbstractValidator
{

    /**
     * @param array $data
     * @return bool
     */
    public function isValid(array $data): bool
    {
        return !Validator::make($data, $this->getRules())->fails();
    }

    /**
     * @return array
     */
    abstract protected function getRules(): array;
}
