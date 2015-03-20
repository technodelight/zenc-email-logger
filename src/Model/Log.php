<?php

class Zenc_EmailLogger_Model_Log extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('zenc_emaillogger/log');
    }

    public function getEmailId()
    {
        return $this->getData('email_id');
    }

    public function setEmailId($id)
    {
        return $this->setData('email_id', $id);
    }

    public function getFromEmail()
    {
        return $this->getData('from_email');
    }

    public function setFromEmail($email)
    {
        return $this->setData('from_email', $email);
    }

    public function getFromName()
    {
        return $this->getData('from_name');
    }

    public function setFromName($name)
    {
        return $this->setData('from_name', $name);
    }

    public function hasToEmail()
    {
        $toEmail = $this->getToEmail();
        return !empty($toEmail);
    }

    public function getToEmail()
    {
        return $this->getData('to_email');
    }

    public function setToEmail($email)
    {
        return $this->setData('to_email', $email);
    }

    public function getToName()
    {
        return $this->getData('to_name');
    }

    public function setToName($name)
    {
        return $this->setData('to_name', $name);
    }

    public function getReplyToEmail()
    {
        return $this->getData('reply_to_email');
    }

    public function setReplyToEmail($email)
    {
        return $this->setData('reply_to_email', $email);
    }

    public function getReplyToName()
    {
        return $this->getData('reply_to_name');
    }

    public function setReplyToName($name)
    {
        return $this->setData('reply_to_name', $name);
    }

    public function getRecipients()
    {
        $recipients = $this->getData('recipients');
        if (!is_array($recipients)) {
            $this->setRecipients(array());
            return array();
        }

        return $recipients;
    }

    public function setRecipients(array $recipients)
    {
        return $this->setData('recipients', $recipients);
    }

    public function addRecipient($type, $email, $name = '')
    {
        $recipients = $this->getRecipients();
        array_push($recipients, array('type' => $type, 'email' => $email, 'name' => $name));
        return $this->setRecipients($recipients);
    }

    public function getReturnPath()
    {
        return $this->getData('return_path');
    }

    public function setReturnPath($email)
    {
        return $this->setData('return_path', $email);
    }

    public function getSubject()
    {
        return $this->getData('subject');
    }

    public function setSubject($subject)
    {
        return $this->setData('subject', $subject);
    }

    public function getBodyText()
    {
        return $this->getData('body_text');
    }

    public function setBodyText($text)
    {
        return $this->setData('body_text', $text);
    }

    public function getBodyHtml()
    {
        return $this->getData('body_html');
    }

    public function setBodyHtml($html)
    {
        return $this->setData('body_html', $html);
    }

    public function getHeaders()
    {
        $headers = $this->getData('headers');
        if (!is_array($headers)) {
            $this->setHeaders(array());
            return array();
        }

        return $headers;
    }

    public function setHeaders(array $headers)
    {
        return $this->setData('headers', $headers);
    }

    public function addHeader($name, $value)
    {
        $headers = $this->getHeaders();
        array_push($headers, array('name' => $name, 'value' => $value));
        return $this->setHeaders($headers);
    }

    public function getRaw()
    {
        return $this->getData('raw');
    }

    public function setRaw($raw)
    {
        return $this->setData('raw', $raw);
    }

    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    public function setCustomerId($id)
    {
        return $this->setData('customer_id', $id);
    }

    public function getQuoteId()
    {
        return $this->getData('quote_id');
    }

    public function setQuoteId($id)
    {
        return $this->setData('quote_id', $id);
    }

    public function getOrderId()
    {
        return $this->getData('order_id');
    }

    public function setOrderId($id)
    {
        return $this->setData('order_id', $id);
    }

    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    protected function _beforeSave()
    {
        if ($this->isObjectNew()) {
            $this->setData('created_at', date('Y-m-d H:i:s'));
        }
    }
}
