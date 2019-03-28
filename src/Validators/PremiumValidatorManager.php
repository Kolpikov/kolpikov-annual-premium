<?php

namespace Kolpikov\AnnualPremium\Validators;

use Illuminate\Support\Manager;
use Kolpikov\AnnualPremium\Contracts\ValidatorInterface;

/**
 * Class PremiumValidatorManager
 * @package Kolpikov\AnnualPremium\Validators
 */
class PremiumValidatorManager extends Manager implements ValidatorInterface
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'annualPremium';
    }

    /**
     * @param array $data
     * @return bool
     */
    public function isValid(array $data): bool
    {
        $this->driver()->isValid($data);
    }

    /**
     * @return AnnualPremiumValidator
     */
    public function createPremiumDriver(): AnnualPremiumValidator
    {
        return new AnnualPremiumValidator();
    }

    /**
     * @return GenderValidator
     */
    public function createGenderDriver(): GenderValidator
    {
        return new GenderValidator();
    }

    /**
     * @return StateValidator
     */
    public function createStateDriver(): StateValidator
    {
        return new StateValidator();
    }
}
