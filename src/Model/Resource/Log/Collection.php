<?php

class Zenc_EmailLogger_Model_Resource_Log_Collection
	extends Mage_Core_Model_Resource_Db_Collection
{
    protected function _construct()
    {
        $this->_init('zenc_emaillogger/log');
    }
}
