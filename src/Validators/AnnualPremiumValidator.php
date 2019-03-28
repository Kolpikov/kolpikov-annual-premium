<?php

namespace Kolpikov\AnnualPremium\Validators;

use Kolpikov\AnnualPremium\Contracts\ValidatorInterface;

/**
 * Class AnnualPremiumValidator
 * @package Kolpikov\AnnualPremium\Validators
 */
class AnnualPremiumValidator extends AbstractValidator implements ValidatorInterface
{
    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            'state_id' => 'required|integer',
            'gender_id' => 'required|integer',
            'zipcode' => 'required|regex:/\b\d{5}\b/',
            'min_ann_prem' => 'required|integer',
            'max_ann_prem' => 'required|integer',
            'age' => 'required|integer|min:20|max:100',
            'name' => 'sometimes|string',
        ];
    }
}
