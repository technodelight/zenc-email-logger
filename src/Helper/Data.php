<?php

class Zenc_EmailLogger_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLED = 'dev/email_logger/enabled';
    const XML_PATH_PASSTHRU_ENABLED = 'dev/email_logger/enable_passthru';

    public function isEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED);
    }

    public function isPassthruEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_PASSTHRU_ENABLED);
    }
}
