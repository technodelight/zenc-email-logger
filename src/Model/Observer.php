<?php

class Zenc_EmailLogger_Model_Observer
{
    private $_log;

    public function setAdditionalLogData(Varien_Event_Observer $observer)
    {
        $this->_log = $observer->getEvent()->getLog();
        $this->_setOrderData();
        $this->_setCustomerData();
        $this->_setQuoteData();
    }

    private function _getLog()
    {
        return $this->_log;
    }

    private function _setOrderData()
    {
        $session = Mage::getSingleton('checkout/session');
        if ($orderId = $session->getLastOrderId()) {
            $this->_getLog()->setOrderId($orderId);
        }
    }

    private function _setCustomerData()
    {
        $session = Mage::getSingleton('customer/session');
        if ($session->isLoggedIn()) {
            $this->_getLog()->setCustomerId($session->getCustomerId());
        }
    }

    private function _setQuoteData()
    {
        $session = Mage::getSingleton('checkout/session');
        if ($session->getQuoteId()) {
            $this->_getLog()->setQuoteId($session->getQuoteId());
        }
    }
}
