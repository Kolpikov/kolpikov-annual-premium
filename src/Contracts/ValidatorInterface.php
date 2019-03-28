<?php

namespace Kolpikov\AnnualPremium\Contracts;

/**
 * Interface ValidatorInterface
 * @package Kolpikov\AnnualPremium\Contracts
 */
interface ValidatorInterface
{
    /**
     * @param array $data
     * @return bool
     */
    public function isValid(array $data): bool;
}
