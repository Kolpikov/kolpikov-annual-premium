<?php

namespace Kolpikov\AnnualPremium\Validators;

use Kolpikov\AnnualPremium\Contracts\ValidatorInterface;

/**
 * Class GenderValidator
 * @package Kolpikov\AnnualPremium\Validators
 */
class GenderValidator extends AbstractValidator implements ValidatorInterface
{

    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
