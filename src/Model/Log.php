<?php

/**
 * @method Mage_Core_Model_Resource_Design _getResource()
 * @method Mage_Core_Model_Resource_Design getResource()
 * @method int getEmailId()
 * @method Zenc_EmailLogger_Model_Log setEmailId(int $value)
 * @method string getFromEmail()
 * @method Zenc_EmailLogger_Model_Log setFromEmail(string $value)
 * @method string getFromName()
 * @method Zenc_EmailLogger_Model_Log setFromName(string $value)
 * @method string getToEmail()
 * @method Zenc_EmailLogger_Model_Log setToEmail(string $value)
 * @method string getToName()
 * @method Zenc_EmailLogger_Model_Log setToName(string $value)
 * @method string getReplyToEmail()
 * @method Zenc_EmailLogger_Model_Log setReplyToEmail(string $value)
 * @method string getReplyToName()
 * @method Zenc_EmailLogger_Model_Log setReplyToName(string $value)
 * @method Zenc_EmailLogger_Model_Log setRecipients(array $value)
 * @method string getReturnPath()
 * @method Zenc_EmailLogger_Model_Log setReturnPath(string $value)
 * @method string getSubject()
 * @method Zenc_EmailLogger_Model_Log setSubject(string $value)
 * @method string getBodyText()
 * @method Zenc_EmailLogger_Model_Log setBodyText(string $value)
 * @method string getBodyHtml()
 * @method Zenc_EmailLogger_Model_Log setBodyHtml(string $value)
 * @method string getRaw()
 * @method Zenc_EmailLogger_Model_Log setRaw(string $value)
 * @method Zenc_EmailLogger_Model_Log setHeaders(array $value)
 * @method int getCustomerId()
 * @method Zenc_EmailLogger_Model_Log setCustomerId(int $value)
 * @method int getQuoteId()
 * @method Zenc_EmailLogger_Model_Log setQuoteId(int $value)
 * @method int getOrderId()
 * @method Zenc_EmailLogger_Model_Log setOrderId(int $value)
 * @method string getCreatedAt()
 * @method Zenc_EmailLogger_Model_Log setCreatedAt(string $value)
 */
class Zenc_EmailLogger_Model_Log extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('zenc_emaillogger/log');
    }

    public function hasToEmail()
    {
        $toEmail = $this->getToEmail();
        return !empty($toEmail);
    }

    /**
     * @return array
     */
    public function getRecipients()
    {
        $recipients = $this->getData('recipients');
        if (!is_array($recipients)) {
            $this->setRecipients(array());
            return array();
        }

        return $recipients;
    }

    /**
     * @param string $type
     * @param string $email
     * @param string $name defaults to empty string
     *
     * @return Zenc_EmailLogger_Model_Log
     */
    public function addRecipient($type, $email, $name = '')
    {
        $recipients = $this->getRecipients();
        array_push($recipients, array('type' => $type, 'email' => $email, 'name' => $name));
        return $this->setRecipients($recipients);
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers = $this->getData('headers');
        if (!is_array($headers)) {
            $this->setHeaders(array());
            return array();
        }

        return $headers;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return Zenc_EmailLogger_Model_Log
     */
    public function addHeader($name, $value)
    {
        $headers = $this->getHeaders();
        array_push($headers, array('name' => $name, 'value' => $value));
        return $this->setHeaders($headers);
    }

    protected function _beforeSave()
    {
        if ($this->isObjectNew()) {
            $this->setData('created_at', date('Y-m-d H:i:s'));
        }
    }
}
