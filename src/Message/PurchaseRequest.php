<?php
namespace Omnipay\Moneris\Message;

/**
 * Moneris Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{

    public function getData()
    {
        // Required data
        $data = $this->getRequiredData();
        
        // Billing data
        $this->addBillingData($data);
        
        // Shipping data
        $this->addShippingData($data);
        
        // Optional data
        $this->addOptionalData($data);
        
        // Rvar data
        $this->addRvarData($data);

        return $data;
    }
    
    /**
     * Gather basic data required by Moneris
     * @return array
     */
    protected function getRequiredData()
    {
        return [
            'ps_store_id' => $this->getPsStoreId(),
            'hpp_key' => $this->getHppKey(),
            'charge_total' => $this->getAmount()
        ];
    }
    
    /**
     * Add optional data
     * @param array $data
     */
    protected function addOptionalData(&$data)
    {
        // Order ID
        $data['order_id'] = $this->getTransactionId();
        
        // Email
        $card = $this->getCard();
        if($card && $card->getEmail()) {
            $data['email'] = $card->getEmail();
        }
        // Customer ID
        if($this->getCustId() !== null) {
            $data['cust_id'] = $this->getCustId();
        }
        // Note
        if($this->getNote() !== null) {
            $data['note'] = $this->getNote();
        }
    }
    
    /**
     * Add billing details
     * @param array $data
     */
    protected function addBillingData(&$data)
    {
        $card = $this->getCard();
        if(!is_object($card)) {
            return;
        }
        
        if(null !== ( $card->getBillingCompany() ) ) {
            $data['bill_company_name'] = $card->getBillingCompany();
        }
                
        $data['bill_first_name'] = $card->getFirstname();
        $data['bill_last_name'] = $card->getLastname();
        $data['bill_address_one'] = $card->getAddress1();
        $data['bill_city'] = $card->getCity();
        $data['bill_postal_code'] = $card->getPostcode();
        $data['bill_state_or_province'] = $card->getState();
        $data['bill_country'] = $card->getCountry();
        $data['bill_phone'] = $card->getPhone();

    }
    
    /**
     * Add shipping details
     * @param array $data
     */
    protected function addShippingData(&$data)
    {
        $card = $this->getCard();
        if(!is_object($card)) {
            return;
        }

        if(null !== ( $card->getShippingCompany() ) ) {
            $data['ship_company_name'] = $card->getShippingCompany();
        }

        $data['ship_first_name'] = $card->getShippingFirstname();
        $data['ship_last_name'] = $card->getShippingLastname();
        $data['ship_address_one'] = $card->getShippingAddress1();
        $data['ship_city'] = $card->getShippingCity();
        $data['ship_postal_code'] = $card->getShippingPostcode();
        $data['ship_state_or_province'] = $card->getShippingState();
        $data['ship_country'] = $card->getShippingCountry();
        $data['ship_phone'] = $card->getShippingPhone();

    }
    
    /**
     * Add custom response variables
     * @param array $data
     */
    protected function addRvarData(&$data)
    {
        $rvar = $this->getRvar();

        if(!is_array($rvar)) {
            return;
        }
        
        foreach($rvar as $key => $value) {
            $data['rvar'.$key] = $value;
        }
    
    }
        
        
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}