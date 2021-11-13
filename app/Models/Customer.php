<?php
namespace CustomersChains\Models;

class Customer
{
    private int $id;
    private ?int $parentId;
    private string $email;
    private string $card;
    private string $phone;

//    /**
//     * Customer constructor.
//     * @param int $id
//     * @param int|null $parentId
//     * @param string $email
//     * @param string $card
//     * @param string $phone
//     */
//    public function __construct(int $id, ?int $parentId, string $email, string $card, string $phone)
//    {
//        $this->id = $id;
//        $this->parentId = $parentId;
//        $this->email = $email;
//        $this->card = $card;
//        $this->phone = $phone;
//    }

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
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * @param int|null $parentId
     */
    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getCard(): string
    {
        return $this->card;
    }

    /**
     * @param string $card
     */
    public function setCard(string $card): void
    {
        $this->card = $card;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function assignArray(array $customerData):void
    {
        if (isset($customerData['ID']))
            $this->setId($customerData['ID']);
        if (isset($customerData['PARENT_ID']))
            $this->setParentId($customerData['PARENT_ID']);
        if (isset($customerData['EMAIL']))
            $this->setEmail($customerData['EMAIL']);
        if (isset($customerData['CARD']))
            $this->setCard($customerData['CARD']);
        if (isset($customerData['PHONE']))
            $this->setPhone($customerData['PHONE']);
    }

    public function toArray():array
    {
        return [
            'ID' => $this->getId(),
            'PARENT_ID' => $this->getParentId(),
            'EMAIL' => $this->getEmail(),
            'CARD' => $this->getCard(),
            'PHONE' => $this->getPhone()
        ];
    }
}