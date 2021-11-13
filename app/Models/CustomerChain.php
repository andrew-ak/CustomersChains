<?php


namespace CustomersChains\Models;


class CustomerChain
{
    private int $id;
    private int $parentId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     */
    public function setParentId(int $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function assignArray(array $customerChainData)
    {
        if (isset($customerChainData['ID']))
            $this->setId($customerChainData['ID']);
        if (isset($customerChainData['PARENT_ID']))
            $this->setParentId($customerChainData['PARENT_ID']);
    }

    public function toArray()
    {
        return [
            'ID' => $this->getId(),
            'PARENT_ID' => $this->getParentId(),
        ];
    }
}