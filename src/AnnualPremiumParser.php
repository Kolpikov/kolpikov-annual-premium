<?php

namespace Kolpikov\AnnualPremium;

use Kolpikov\AnnualPremium\Contracts\ClientInterface;
use Kolpikov\AnnualPremium\Contracts\ScrapableAnnualPremiums;
use Kolpikov\AnnualPremium\Models\Gender;
use Kolpikov\AnnualPremium\Models\State;

/**
 * Class AnnualPremiumParser
 * @package Kolpikov\AnnualPremium
 */
class AnnualPremiumParser implements ScrapableAnnualPremiums
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * AnnualPremiumParser constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function scrape(): array
    {
        $states = State::all();
        $genders = Gender::all();

        $results = [];

        foreach ($states as $state) {
            foreach ($genders as $gender) {
                for ($i = 20;; $i += 10) {
                    $data = $this->parseAnnualPremiums([
                        'state' => $state->code,
                        'age' => $i,
                        'gender' => $gender->name,
                    ]);

                    if (empty($data)) {
                        break;
                    }

                    foreach ($data as &$item) {
                        $item['state_id'] = $state->id;
                        $item['gender_id'] = $gender->id;
                    }

                    $results = array_merge($results, $data);
                }
            }
        }

        return $results;
    }

    /**
     * @param array $data
     * @return array
     */
    private function parseAnnualPremiums(array $data): array
    {
        $results = [];
        $formRequestParams = array_merge($data, [
            'type' => 'additional',
            'format' => 'json',
        ]);

        $prevResult = [];
        for ($i = 1;; $i++) {
            $response = $this->client->post("/?p=$i", [
                'form_params' => $formRequestParams,
            ]);

            $currentResult = $response->getBody()->getContents();
            $currentResult = json_decode($currentResult, true);

            if (empty($currentResult)
                || $currentResult === $prevResult
            ) {
                break;
            }

            $prevResult = $currentResult;
            $results = array_merge($results, $currentResult);
        }

        return $results;
    }
}
