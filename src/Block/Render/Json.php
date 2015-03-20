<?php

class Zenc_EmailLogger_Block_Render_Json
    extends Mage_Core_Block_Abstract
    implements Zenc_EmailLogger_Block_Render_Interface
{
    public function getContentType()
    {
        return 'application/json';
    }

    public function toHtml()
    {
        return parent::toHtml();
    }

    protected function _toHtml()
    {
        return json_encode($this->getValue());
    }
}
