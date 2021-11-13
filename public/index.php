<?php

use CustomersChains\Builders\CustomerChainBuilder;
use CustomersChains\Providers\CsvCustomerChainProvider;
use CustomersChains\Providers\CsvCustomerProvider;

defined('BASE_PATH') || define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH.'/vendor/autoload.php';


$csvCustomerProvider = new CsvCustomerProvider(BASE_PATH.'/data/customers.csv');
$customerList = $csvCustomerProvider->getCustomerList();
$chainBuilder = new CustomerChainBuilder();
//$customerChainList = $chainBuilder->build($customerList);
$customerChainList = $chainBuilder->buildCustomerChainList($customerList);
$csvCustomerChainProvider = new CsvCustomerChainProvider(BASE_PATH.'/data/customer-chain.csv');
$csvCustomerChainProvider->save($customerChainList);
//var_dump($customerChainList->toArray());
echo 'ok'.PHP_EOL;
echo BASE_PATH.PHP_EOL;
//composer dump-autoload -o