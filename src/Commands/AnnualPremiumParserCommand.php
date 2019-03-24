<?php

namespace Kolpikov\AnnualPremium\Commands;

use Illuminate\Console\Command;
use Kolpikov\AnnualPremium\Contracts\ScrapableAnnualPremiums;
use Kolpikov\AnnualPremium\Models\AnnualPremium;

/**
 * Class AnnualPremiumParserCommand
 * @package Kolpikov\AnnualPremium\Commands
 */
class AnnualPremiumParserCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'parse:annual-premium';

    /**
     * @var string
     */
    protected $description = 'Parse all annual premium data';

    /**
     * @param ScrapableAnnualPremiums $parser
     * @return void
     */
    public function handle(ScrapableAnnualPremiums $parser): void
    {
        $this->info('Starting to parse Annual premium data');
        $results = $parser->scrape();
        $this->info('Annual premium data was parsed');

        $this->info('Starting to save Annual premium data');
        $this->saveResults($results);
        $this->info('Annual premium data was saved');
    }

    /**
     * @param array $items
     * @return void
     */
    protected function saveResults(array $items): void
    {
        foreach ($items as $item) {
            $this->tryToSaveItem($item);
        }
    }

    /**
     * @param array $item
     * @return void
     */
    protected function tryToSaveItem(array $item): void
    {
        try {
            AnnualPremium::create($item);
        } catch (\Exception $e) {
            $this->error($e);
        }
    }
}
