<?php

class Zenc_EmailLogger_Model_Zend_Mail_Transport_Logger
    extends Zend_Mail_Transport_Abstract
{
    protected function _sendMail()
    {
        $log = $this->_mail->getLog();

        $log->setHeaders($this->_mail->getHeaders());
        $log->setRaw($this->header . $this->EOL . $this->body);

        $this->_dispatchEvent();

        $log->save();
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
