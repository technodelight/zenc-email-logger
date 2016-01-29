<?php

class Zenc_EmailLogger_Model_Resource_Log_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('zenc_emaillogger/log');
    }

    public function orderByTimeDesc()
    {
        $this->addOrder('created_at', self::SORT_ORDER_DESC);
        return $this;
    }
}
