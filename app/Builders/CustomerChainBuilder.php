<?php


namespace CustomersChains\Builders;


use CustomersChains\Models\CustomerChain;
use CustomersChains\Models\Resultset\CustomerChainList;
use CustomersChains\Models\Resultset\CustomerList;
use http\Params;

class CustomerChainBuilder
{
    public function build(CustomerList $customerList):customerChainList
    {
        $chainLinks = $this->buildChainLinks($customerList);
        $chainLinks = $this->mergeChainLinks($chainLinks);
    }

    public function buildChainLinks(CustomerList $customerList):array
    {
        $chainLinks = [];
        foreach ($customerList->getList() as $customer){
            $chainLinks[$customer->getEmail()][] = $customer->getId();
            $chainLinks[$customer->getCard()][] = $customer->getId();
            $chainLinks[$customer->getPhone()][] = $customer->getId();
        }
        return $chainLinks;
    }

    public function mergeChainLinks(array $chainLinks)
    {
        foreach ($chainLinks as $key1 => $chainLink1){
            foreach ($chainLink1 as $customerId){
                foreach ($chainLinks as $key2 => $chainLink2){
                    if ($key1 == $key2){
                        continue;
                    }
                    if (in_array($customerId, $chainLink2)){
//                        var_dump($key2, $chainLink2);
                        $chainLink1 = array_merge($chainLink1, $chainLink2);
                        $chainLink1 = array_unique($chainLink1);
                    }
                }
            }
        }
//        var_dump($chainLinks);
        die;
    }
    public function buildCustomerChainList(CustomerList $customerList)
    {
        $customerChains = [];
        $customerChainList = new CustomerChainList();
        $customerList->sort();
        $customers = $customerList->getList();
        foreach ($customers as $customer){
            $minParentId = $customer->getId();
            if (!isset($customerChains[$customer->getEmail()])){
                $customerChains[$customer->getEmail()] = $minParentId;
            }
            if (!isset($customerChains[$customer->getCard()])){
                $customerChains[$customer->getCard()] = $minParentId;
            }
            if (!isset($customerChains[$customer->getPhone()])){
                $customerChains[$customer->getPhone()] = $minParentId;
            }
            if ($minParentId > $customerChains[$customer->getEmail()]){
                $minParentId = $customerChains[$customer->getEmail()];
            }
            if ($minParentId > $customerChains[$customer->getCard()]){
                $minParentId = $customerChains[$customer->getCard()];
            }
            if ($minParentId > $customerChains[$customer->getPhone()]){
                $minParentId = $customerChains[$customer->getPhone()];
            }
            $customerChains[$customer->getEmail()] = $minParentId;
            $customerChains[$customer->getCard()] = $minParentId;
            $customerChains[$customer->getPhone()] = $minParentId;
            $customer->setParentId($minParentId);
            $customerChain = new CustomerChain();
            $customerChain->assignArray([
                'ID' => $customer->getId(),
                'PARENT_ID' => $customer->getParentId(),
            ]);
            $customerChainList->add($customerChain);
        }

        return $customerChainList;
    }
}