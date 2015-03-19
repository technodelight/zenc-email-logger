<?php

class Zenc_EmailLogger_RestController extends Zenc_EmailLogger_Controller_Restful
{
    protected $_methods = array('get');

    public function getListAction()
    {
        $this->render(array(
            'count' => $this->_getCollection()->count()
        ));
    }

    public function getReadAction()
    {
        $log = Mage::getModel('zenc_emaillogger/log')->load($this->getRequest()->get('id'));

        $this->render($log->getData());
    }

    private function _getCollection()
    {
        return Mage::getModel('zenc_emaillogger/log')->getCollection();
    }
}
