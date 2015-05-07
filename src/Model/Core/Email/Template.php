<?php

class Zenc_EmailLogger_Model_Core_Email_Template extends Mage_Core_Model_Email_Template
{
    const XML_PATH_ENABLED = 'dev/email_logger/enabled';

    /**
     * Retrieve mail object instance
     *
     * @return Zend_Mail
     */
    public function getMail()
    {
        if (! Mage::getStoreConfigFlag(self::XML_PATH_ENABLED)) {
            return parent::getMail();
        }

        if (is_null($this->_mail)) {
            $this->_mail = Mage::getModel('zenc_emaillogger/zend_mail_logger');
        }
        return $this->_mail;
    }
}
