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
        $customerChainList = $this->buildChainList($customerList, $chainLinks);
        return $customerChainList;
    }

    public function buildChainLinks(CustomerList $customerList):array
    {
        $chainLinks = [];
        foreach ($customerList->getList() as $customer){
            $chainLinks[$customer->getEmail()][] = $customer->getId();
            $chainLinks[$customer->getCard()][] = $customer->getId();
            $chainLinks[$customer->getPhone()][] = $customer->getId();
            $tmpChainLink = array_merge($chainLinks[$customer->getEmail()], $chainLinks[$customer->getCard()], $chainLinks[$customer->getPhone()]);
            $tmpChainLink = array_unique($tmpChainLink);
            $chainLinks[$customer->getEmail()] = $tmpChainLink;
            $chainLinks[$customer->getCard()] = $tmpChainLink;
            $chainLinks[$customer->getPhone()] = $tmpChainLink;
        }
        foreach ($chainLinks as $key => $chainLink){
            foreach ($chainLinks as $key2 => $chainLink2){
                if (count(array_intersect($chainLink, $chainLink2))){
                    $tmpChainLink = array_merge($chainLink, $chainLink2);
                    $tmpChainLink = array_unique($tmpChainLink);
                    $chainLinks[$key] = $tmpChainLink;
                }
            }
        }
        return $chainLinks;
    }

    public function buildChainList(CustomerList $customerList, array $chainLinks):CustomerChainList
    {
        foreach ($chainLinks as $key => $chainLink){
            sort($chainLink);
            $chainLinks[$key] = $chainLink;
        }
        $customerChainList = new CustomerChainList();
        foreach ($customerList->getList() as $customer){
            $minId = $chainLinks[$customer->getEmail()][0];
            $minId = $minId > $chainLinks[$customer->getCard()][0] ? $chainLinks[$customer->getCard()][0] : $minId;
            $minId = $minId > $chainLinks[$customer->getPhone()][0] ? $chainLinks[$customer->getPhone()][0] : $minId;
            $customer->setParentId($minId);
            $customerChain = new CustomerChain();
            $customerChain->assignArray([
                'ID' => $customer->getId(),
                'PARENT_ID' => $customer->getParentId(),
            ]);
            $customerChainList->add($customerChain);
        }
        return $customerChainList;
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
