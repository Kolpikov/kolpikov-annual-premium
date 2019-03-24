<?php

namespace Kolpikov\AnnualPremium;

use Kolpikov\AnnualPremium\Contracts\ClientInterface;
use \GuzzleHttp\Client as BaseClient;

/**
 * Class Client
 * @package Kolpikov\AnnualPremium
 */
class Client extends BaseClient implements ClientInterface
{

}
