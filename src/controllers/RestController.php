<?php

class Zenc_EmailLogger_RestController extends Zenc_EmailLogger_Controller_Restful
{
    protected $_methods = array('get');

    public function getListAction()
    {
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
        $id = $this->getRequest()->get('id');
        if ($id == 'last') {
            $item = $this->_getCollection()->getLastItem();
        } else {
            $item = Mage::getModel('zenc_emaillogger/log')->load($id);
        }

        $this->render($item->getData());
    }

    private function _getCollection()
    {
        return Mage::getModel('zenc_emaillogger/log')->getCollection();
    }
}
