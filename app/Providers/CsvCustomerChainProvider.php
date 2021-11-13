<?php


namespace CustomersChains\Providers;


use CustomersChains\Models\Resultset\CustomerChainList;

class CsvCustomerChainProvider
{
    private string $filepath;
    private array $customerChainList;
    private const HEADER = 'ID, PARENT_ID';

    /**
     * CsvCustomerChainProvider constructor.
     * @param string $filepath
     */
    public function __construct(string $filepath = '/data/customerChains.csv')
    {
        $this->filepath = $filepath;
    }

    public function getFilepath():string
    {
        return $this->filepath;
    }

    public function save(CustomerChainList $customerChainList):void
    {
        $handle = fopen($this->filepath, 'a');
        fwrite($handle, self::HEADER);
        fwrite($handle, PHP_EOL);
        foreach ($customerChainList->getList() as $customerChain){
            fwrite($handle, implode(',', $customerChain->toArray()));
            fwrite($handle, PHP_EOL);
        }
        fclose($handle);
    }
}