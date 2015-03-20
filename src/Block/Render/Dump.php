<?php

class Zenc_EmailLogger_Block_Render_Dump
    extends Mage_Core_Block_Abstract
    implements Zenc_EmailLogger_Block_Render_Interface
{
    /**
     * Block html frame open tag
     * @var string
     */
    protected $_frameOpenTag = 'pre';

    /**
     * Block html frame close tag
     * @var string
     */
    protected $_frameCloseTag = 'pre';

    public function getContentType()
    {
        return 'text/html';
    }

    protected function _toHtml()
    {
        return var_export($this->getValue(), true);
    }
}
