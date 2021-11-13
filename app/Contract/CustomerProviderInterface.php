<?php

namespace CustomersChains\Contract;

use CustomersChains\Models\Resultset\CustomerList;

interface CustomerProviderInterface{
    public function getCustomerList():CustomerList;
}