<?php
namespace Omnipay\Moneris\Message;

/**
 * Moneris Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://www3.moneris.com/HPPDP/index.php';
    protected $testEndpoint = 'https://esqa.moneris.com/HPPDP/index.php';
    
    public function getPsStoreId()
    {
        return $this->getParameter('psStoreId');
    }

    public function setPsStoreId($value)
    {
        return $this->setParameter('psStoreId', $value);
    }

    public function getHppKey()
    {
        return $this->getParameter('hppKey');
    }

    public function setHppKey($value)
    {
        return $this->setParameter('hppKey', $value);
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
    
    /**
     * Set test end point - allow for local development / mock gateways
     * @param string $url
     */
    public function setTestEndpoint($url)
    {
        $this->testEndpoint = $url;
    }
    
    public function getCustId()
    {
        return $this->getParameter('custId');
    }

    public function setCustId($value)
    {
        return $this->setParameter('custId', $value);
    }
    
    public function getNote()
    {
        return $this->getParameter('note');
    }

    public function setNote($value)
    {
        return $this->setParameter('note', $value);
    }
    
    public function getLang()
    {
        return $this->getParameter('lang');
    }

    public function setLang($value)
    {
        return $this->setParameter('lang', $value);
    }
    
    public function getRvar()
    {
        return $this->getParameter('rvar');
    }

    public function setRvar($arr)
    {
        return $this->setParameter('rvar', $arr);
    }
}
