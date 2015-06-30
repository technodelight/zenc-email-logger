<?php

class Zenc_EmailLogger_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLED = 'dev/email_logger/enabled';

    public function isEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED);
    }
}
