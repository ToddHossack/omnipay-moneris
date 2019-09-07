<?php

namespace Omnipay\Moneris\Message;

/**
 * Moneris Complete Purchase Request
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        $requestMethod = $this->httpRequest->server->get('REQUEST_METHOD');
        if($requestMethod === 'POST') {
            return $this->httpRequest->request->all();
        } else {
            return $this->httpRequest->query->all();
        }
    }

    public function sendData($data)
    {
        $this->response = new CompletePurchaseResponse($this, $data);
        return $this->response;
    }
}
