<?php

namespace Kolpikov\AnnualPremium\Commands;

use Illuminate\Console\Command;
use Kolpikov\AnnualPremium\Contracts\ScrapableFormOptions;
use Kolpikov\AnnualPremium\Models\Gender;
use Kolpikov\AnnualPremium\Models\State;

/**
 * Class FormOptionsParserCommand
 * @package Kolpikov\AnnualPremium\Commands
 */
class FormOptionsParserCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'parse:form-options';

    /**
     * @var string
     */
    protected $description = 'Parse main form options: states and genders list';

    /**
     * @param ScrapableFormOptions $parser
     * @return void
     */
    public function handle(ScrapableFormOptions $parser): void
    {
        $this->info('Starting to parse main form options');

        $optionSelectors = [
            'states' => 'select[name="state"] option',
            'genders' => 'select[name="gender"] option',
        ];

        $options = $parser->scrape($optionSelectors);
        $this->info('Main form options were parsed');

        $this->info('Starting to save main form options');
        $this->saveStates($options);
        $this->saveGenders($options);
        $this->info('Main form options were saved');
    }

    /**
     * @param array $options
     * @return void
     */
    protected function saveStates(array $options): void
    {
        if (isset($options['states'])) {
            foreach ($options['states'] as $option) {
                $this->tryToSaveState($option);
            }
        }
    }

    /**
     * @param $option
     * @return void
     */
    protected function tryToSaveState($option): void
    {
        State::updateOrCreate(['code' => $option['code']], $option);
    }

    /**
     * @param array $options
     * @return void
     */
    protected function saveGenders(array $options): void
    {
        if (isset($options['genders'])) {
            foreach ($options['genders'] as $option) {
                $this->tryToSaveGender($option);
            }
        }
    }

    /**
     * @param $option
     * @return void
     */
    protected function tryToSaveGender($option): void
    {
        Gender::updateOrCreate(['name' => $option['name']], $option);
    }
}
