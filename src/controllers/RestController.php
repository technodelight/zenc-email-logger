<?php

class Zenc_EmailLogger_RestController extends Zenc_EmailLogger_Controller_Restful
{
    protected $_methods = array('get');

    public function getListAction()
    {
        $this->_formats['html'] = 'zenc_emaillogger/render_dump';

        $this->render(array(
            'count' => $this->_getCollection()->count(),
            'items' => $this->_getCollection()->walk(function($item) {
                return array(
                    'id' => $item->getId(),
                    'subject' => $item->getSubject(),
                    'created_at' => $item->getCreatedAt(),
                );
            })
        ));
    }

    public function getReadAction()
    {
        $item = $this->_getItem();
        $this->render($item->getData());
    }

    private function _getCollection()
    {
        return Mage::getModel('zenc_emaillogger/log')->getCollection();
    }

    private function _getItem()
    {
        $id = $this->getRequest()->get('id');
        if ($id == 'last') {
            $id = $this->_getCollection()->getLastItem()->getId();
        }

        return Mage::getModel('zenc_emaillogger/log')->load($id);
    }
}
