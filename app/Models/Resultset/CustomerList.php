<?php


namespace CustomersChains\Models\Resultset;


use CustomersChains\Models\Customer;

class CustomerList
{
    private array $list;

    /**
     * CustomerList constructor.
     * @param Customer[] $list
     */
    public function __construct(array $list = [])
    {
        $this->list = $list;
    }

    public function add(Customer $customer):void
    {
        $this->list[] = $customer;
    }

    /**
     * @return Customer[]
     */
    public function getList():array
    {
        return $this->list;
    }

    public function sort():void
    {
        $list = $this->list;

        usort($list, function(Customer $a, Customer $b){
            return $a->getId() > $b->getId();
        });
        $this->list = $list;
    }


}