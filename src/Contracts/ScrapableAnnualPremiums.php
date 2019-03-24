<?php

namespace Kolpikov\AnnualPremium\Contracts;

/**
 * Interface ScrapableAnnualPremiums
 * @package Kolpikov\AnnualPremium\Contracts
 */
interface ScrapableAnnualPremiums
{
    /**
     * @return array
     */
    public function scrape(): array;
}
