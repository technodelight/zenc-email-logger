<?php

class Zenc_EmailLogger_Model_Zend_Mail_Transport_Logger
    extends Zend_Mail_Transport_Sendmail
{
    /**
     * Configuration flag for enabling passthrough (sending email in addition to saving it)
     */
    const XML_PATH_ENABLE_PASSTHRU = 'dev/email_logger/enable_passthru';

    /**
     * @var Zend_Mail_Transport_Abstract
     */
    private $_originalTransport;

    public function __construct(Zend_Mail_Transport_Abstract $transport = null)
    {
        $this->_originalTransport = $transport;
    }

    /**
     * @return Zend_Mail_Transport_Abstract|null
     */
    public function getOriginalTransport()
    {
        return $this->_originalTransport;
    }

    public function _sendMail()
    {
        $log = $this->_mail->getLog();

        $log->setHeaders($this->_mail->getHeaders());
        $log->setRaw($this->header . $this->EOL . $this->body);

        $this->_dispatchEvent();

        $log->save();

        if (Mage::getStoreConfigFlag(self::XML_PATH_ENABLE_PASSTHRU)) {
            parent::_sendMail();
        }
    }

    protected function _dispatchEvent()
    {
        Mage::dispatchEvent(
            'zenc_emaillogger_send_mail',
            array(
                'log' => $this->_mail->getLog(),
                'mail' => $this->_mail,
                'transport' => $this,
            )
        );
    }
}
