<?php

namespace Kolpikov\AnnualPremium;

use Illuminate\Support\ServiceProvider;

/**
 * Class AnnualPremiumServiceProvider
 * @package Kolpikov\AnnualPremium
 */
class AnnualPremiumServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
            $this->registerResources();
        }
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/annualpremium.php', 'annualpremium');

        $this->app->bind(
            'Kolpikov\AnnualPremium\Contracts\ClientInterface',
            function () {
                return new Client(config('annualpremium.config'));
            }
        );

        $this->app->bind(
            'Kolpikov\AnnualPremium\Contracts\ScrapableAnnualPremiums',
            'Kolpikov\AnnualPremium\AnnualPremiumParser'
        );

        $this->app->bind(
            'Kolpikov\AnnualPremium\Contracts\ScrapableFormOptions',
            'Kolpikov\AnnualPremium\FormOptionsParser'
        );

        $this->commands([
            Commands\AnnualPremiumParserCommand::class,
            Commands\FormOptionsParserCommand::class,
        ]);
    }

    /**
     * @return void
     */
    private function registerResources(): void
    {
        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
    }

    /**
     * @return void
     */
    protected function registerPublishing(): void
    {
        $this->publishes([
            __DIR__ . '/../config/annualpremium.php' => config_path('annualpremium.php'),
        ], 'annual-premium-config');
    }
}
