<?php

class Zenc_EmailLogger_Model_Zend_Mail_Logger extends Zend_Mail
{
    /**
     * @var Zenc_EmailLogger_Model_Log
     */
    private $_log;

    /**
     * Public constructor
     *
     * @param string $charset
     */
    public function __construct($charset = null)
    {
        if ($charset == null) {
            $charset = 'utf-8';
        }

        parent::__construct($charset);
    }

    /**
     * @return Zenc_EmailLogger_Model_Log
     */
    public function getLog()
    {
        if (!isset($this->_log)) {
            $this->_log = Mage::getModel('zenc_emaillogger/log');
        }

        return $this->_log;
    }

    /**
     * @todo this method could use a factory to support other transport types
     *
     * @return Zenc_EmailLogger_Model_Zend_Mail_Transport_Logger
     */
    public function getTransportLoggerInstance()
    {
        return Mage::getModel('zenc_emaillogger/zend_mail_transport_logger');
    }

    /**
     * Sends this email using the given transport or a previously
     * set DefaultTransport or the internal mail function if no
     * default transport had been set.
     *
     * @param Zend_Mail_Transport_Abstract $transport
     *
     * @return Zenc_EmailLogger_Zend_Mail_Logger Provides fluent interface
     */
    public function send($transport = null)
    {
        return parent::send($this->getTransportLoggerInstance());
    }

    /**
     * Adds To-header and recipient, $email can be an array, or a single string address
     *
     * @param string|array $email
     * @param string $name
     *
     * @return Zenc_EmailLogger_Zend_Mail_Logger Provides fluent interface
     */
    public function addTo($email, $name='')
    {
        if (!$this->getLog()->hasToEmail()) {
            $this->getLog()->setToEmail($email);
            $this->getLog()->setToName($this->_decodeBase64Header($name));
        }

        return parent::addTo($email, $name);
    }

    /**
     * Helper function for adding a recipient and the corresponding header
     *
     * @param string $headerName
     * @param string $email
     * @param string $name
     */
    protected function _addRecipientAndHeader($headerName, $email, $name)
    {
        $this->getLog()->addRecipient(
            $headerName,
            $email,
            $this->_decodeBase64Header($name)
        );

        parent::_addRecipientAndHeader($headerName, $email, $name);
    }

    /**
     * Sets the subject of the message
     *
     * @param string $subject
     *
     * @return Zenc_EmailLogger_Zend_Mail_Logger Provides fluent interface
     *
     * @throws Zend_Mail_Exception
     */
    public function setSubject($subject)
    {
        $this->getLog()->setSubject(
            $this->_decodeBase64Header($subject)
        );

        return parent::setSubject($subject);
    }

    /**
     * Sets From-header and sender of the message
     *
     * @param string $email
     * @param string $name
     *
     * @return Zenc_EmailLogger_Zend_Mail_Logger Provides fluent interface
     *
     * @throws Zend_Mail_Exception if called subsequent times
     */
    public function setFrom($email, $name = null)
    {
        $this->getLog()->setFromEmail($email);
        $this->getLog()->setFromName($name);

        return parent::setFrom($email, $name);
    }

    /**
     * Sets the Return-Path header of the message
     *
     * @param string $email
     * @return Zenc_EmailLogger_Zend_Mail_Logger Provides fluent interface
     *
     * @throws Zend_Mail_Exception if set multiple times
     */
    public function setReturnPath($email)
    {
        $this->getLog()->setReturnPath($email);

        return parent::setReturnPath($email);
    }

    /**
     * Set Reply-To Header
     *
     * @param string $email
     * @param string $name
     *
     * @return Zenc_EmailLogger_Zend_Mail_Logger
     *
     * @throws Zend_Mail_Exception if called more than one time
     */
    public function setReplyTo($email, $name = null)
    {
        $this->getLog()->setReplyToEmail($email);
        $this->getLog()->setReplyToName($name);

        return parent::setReplyTo($email, $name);
    }

    /**
     * Sets the text body for the message.
     *
     * @param string $txt
     * @param string $charset
     * @param string $encoding
     *
     * @return Zenc_EmailLogger_Zend_Mail_Logger Provides fluent interface
    */
    public function setBodyText($txt, $charset = null, $encoding = Zend_Mime::ENCODING_QUOTEDPRINTABLE)
    {
        $this->getLog()->setBodyText($txt);

        return parent::setBodyText($txt, $charset, $encoding);
    }

    /**
     * Sets the HTML body for the message
     *
     * @param string $html
     * @param string $charset
     * @param string $encoding
     *
     * @return Zenc_EmailLogger_Zend_Mail_Logger Provides fluent interface
     */
    public function setBodyHtml($html, $charset = null, $encoding = Zend_Mime::ENCODING_QUOTEDPRINTABLE)
    {
        $this->getLog()->setBodyHtml($html);

        return parent::setBodyHtml($html, $charset, $encoding);
    }

    private function _decodeBase64Header($header)
    {
        $prefix = '=?' . $this->getCharset() . '?B?';
        $suffix = '?=';
        if (strpos($prefix, $header) !== false) {
            $base64 = substr($header, strlen($prefix), strlen($header) - strlen($suffix));
            return base64_decode($base64);
        }

        return $header;
    }
}
