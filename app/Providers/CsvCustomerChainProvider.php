<?php


namespace CustomersChains\Providers;


class CsvCustomerChainProvider
{
    private string $filepath;
    private array $customerChainList;

    /**
     * CsvCustomerChainProvider constructor.
     * @param string $filepath
     */
    public function __construct(string $filepath = '/data/customerChains.csv')
    {
        $this->filepath = $filepath;
    }

    public function save()
    {

    }
}