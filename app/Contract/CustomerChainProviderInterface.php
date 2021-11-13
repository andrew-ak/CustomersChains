<?php


namespace CustomersChains\Contract;


use CustomersChains\Models\Resultset\CustomerChainList;

interface CustomerChainProviderInterface
{
    public function getFilepath():string;
    public function save(CustomerChainList $customerChainList):void;
}