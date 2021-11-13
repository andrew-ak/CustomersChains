<?php


namespace CustomersChains\Providers;


use CustomersChains\Contract\CustomerProviderInterface;
use CustomersChains\Models\Customer;
use CustomersChains\Models\Resultset\CustomerList;

class CsvCustomerProvider implements CustomerProviderInterface
{

    private string $filepath;

    private int $ID_POS = 0;
    private int $PARENT_ID_POS = 0;
    private int $EMAIL_POS = 0;
    private int $CARD_POS = 0;
    private int $PHONE_POS = 0;

    /**
     * CsvCustomerProvider constructor.
     * @param string $filepath
     */
    public function __construct(string $filepath = '')
    {
        $this->filepath = $filepath;
    }

    public function getCustomerList():CustomerList
    {
        if (!file_exists($this->filepath)){
            return new CustomerList();
        }

        $handle = fopen($this->filepath, 'r');

        $firstLine = fgets($handle);
        if ($firstLine){
            $headKeys = explode(',', $firstLine);
            $this->ID_POS = array_search('ID', $headKeys);
            $this->PARENT_ID_POS = array_search('PARENT_ID', $headKeys);
            $this->EMAIL_POS = array_search('EMAIL', $headKeys);
            $this->CARD_POS = array_search('CARD', $headKeys);
            $this->PHONE_POS = array_search('PHONE', $headKeys);
        }
        $customerList = new CustomerList();
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = explode(',', $line);
                $customer = new Customer();
                $customer->assignArray([
                    'ID' => $line[$this->ID_POS],
                    'PARENT_ID' => (int)$line[$this->PARENT_ID_POS],
                    'EMAIL' => $line[$this->EMAIL_POS],
                    'CARD' => $line[$this->CARD_POS],
                    'PHONE' => $line[$this->PHONE_POS],
                ]);
                $customerList->add($customer);
            }
            fclose($handle);
        }
        return $customerList;
    }

}