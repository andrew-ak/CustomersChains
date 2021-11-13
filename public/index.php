<?php

use CustomersChains\Builders\CustomerChainBuilder;
use CustomersChains\Providers\CsvCustomerProvider;

defined('BASE_PATH') || define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH.'/vendor/autoload.php';


$csv_provider = new CsvCustomerProvider(BASE_PATH.'/data/customers.csv');
$customerList = $csv_provider->getCustomerList();
$chainBuilder = new CustomerChainBuilder();
$customerChainList = $chainBuilder->build($customerList);
//$customerChainList = $chainBuilder->buildCustomerChainList($customerList);
//var_dump($customerChainList->toArray());
echo 'ok'.PHP_EOL;
echo BASE_PATH.PHP_EOL;
//composer dump-autoload -o