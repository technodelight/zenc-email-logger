<?php

class Zenc_EmailLogger_Block_Render_Html
    extends Mage_Core_Block_Abstract
    implements Zenc_EmailLogger_Block_Render_Interface
{
    public function getContentType()
    {
        return 'text/html';
    }

    protected function _toHtml()
    {
        return '<pre>' . var_export($this->getValue(), true) . '</pre>';
    }
}
