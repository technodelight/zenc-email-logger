<?php

class Zenc_EmailLogger_Model_Resource_Log
    extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('zenc_emaillogger/log', 'mail_id');
    }
}
