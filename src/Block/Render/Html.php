<?php

class Zenc_EmailLogger_Block_Render_Html
    extends Mage_Core_Block_Abstract
    implements Zenc_EmailLogger_Block_Render_Interface
{
    public function getContentType()
    {
        return 'text/html';
    }

    public function toHtml()
    {
        return parent::toHtml();
    }

    protected function _toHtml()
    {
        $data = $this->getValue();

        switch (true) {
            case !empty($data['body_html']):
                return $data['body_html'];
            case !empty($data['body_text']):
                return $data['body_text'];
            default:
                return 'Email has no visible content';
        }
    }
}
