<?php

namespace Kolpikov\AnnualPremium;

use Kolpikov\AnnualPremium\Contracts\ClientInterface;
use Kolpikov\AnnualPremium\Contracts\ScrapableFormOptions;
use Psr\Http\Message\ResponseInterface;
use simplehtmldom_1_5\simple_html_dom;
use simplehtmldom_1_5\simple_html_dom_node;
use Sunra\PhpSimple\HtmlDomParser;

/**
 * Class FormOptionsParser
 * @package Kolpikov\AnnualPremium
 */
class FormOptionsParser implements ScrapableFormOptions
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
     * @param array $selectors
     * @return array
     */
    public function scrape(array $selectors): array
    {
        $response = $this->client->get('/');
        if ($response->getStatusCode() == 200) {
            $htmlDom = $this->tryCovertHtmlToDomObject($response);
            if ($htmlDom) {
                foreach ($selectors as $key => $selector) {
                    $results[$key] = $this->getOptionValues($htmlDom, $selector);
                }
            }
        }

        return $results ?? [];
    }

    /**
     * @param ResponseInterface $response
     * @return simple_html_dom|null
     */
    private function tryCovertHtmlToDomObject(ResponseInterface $response): ?simple_html_dom
    {
        try {
            $dom = HtmlDomParser::str_get_html($response->getBody()->getContents());
        } catch (\Exception $e) {
            $this->error($e);
        }

        return $dom ?? null;
    }

    /**
     * @param simple_html_dom $dom
     * @param string $selector
     * @return array
     */
    protected function getOptionValues(simple_html_dom $dom, string $selector): array
    {
        $results = [];
        $options = $dom->find($selector);

        if ($options !== null) {
            /** @var simple_html_dom_node $option */
            foreach ($options as $option) {
                $results[] = [
                    'code' => $option->attr['value'],
                    'name' => $option->text(),
                ];
            }
        }

        return $results;
    }
}
