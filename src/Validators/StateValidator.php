<?php

namespace Kolpikov\AnnualPremium\Validators;

use Kolpikov\AnnualPremium\Contracts\ValidatorInterface;

/**
 * Class StateValidator
 * @package Kolpikov\AnnualPremium\Validators
 */
class StateValidator extends AbstractValidator implements ValidatorInterface
{

    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string|max:2',
        ];
    }
}
