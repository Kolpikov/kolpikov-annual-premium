<?php

namespace Kolpikov\AnnualPremium\Contracts;

/**
 * Interface ScrapableFormOptions
 * @package Kolpikov\AnnualPremium\Contracts
 */
interface ScrapableFormOptions
{
    /**
     * @param array $selectors
     * @return array
     */
    public function scrape(array $selectors): array;
}
