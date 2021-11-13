<?php


namespace CustomersChains\Models\Resultset;


use CustomersChains\Models\CustomerChain;

class CustomerChainList
{
    private array $list;


    /**
     * CustomerChainList constructor.
     * @param CustomerChain[] $list
     */
    public function __construct(array $list = [])
    {
        $this->list = $list;
    }

    public function add(CustomerChain $customerChain)
    {
        $this->list[] = $customerChain;
    }

    public function getList():array
    {
        return $this->getList();
    }

    public function toArray()
    {
        $list = [];
        foreach ($this->list as $customerChain){
            $list[] = $customerChain->toArray();
        }
        return $list;
    }
}