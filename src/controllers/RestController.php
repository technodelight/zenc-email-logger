<?php

class Zenc_EmailLogger_RestController extends Zenc_EmailLogger_Controller_Restful
{
    const PAGE_SIZE = 20;

    protected $_methods = array('get');

    public function getListAction()
    {
        $this->_formats['html'] = 'zenc_emaillogger/render_dump';

        $data = $this->_getRestData();
        $this->render(array(
            'count' => $this->_getCollection()->getSize(),
            'itemsCount' => $this->_getCollection()->getSize(),
            'items' => $data,
            'data' => array_values($data),
        ));
    }

    public function getReadAction()
    {
        $item = $this->_getItem();
        $this->render($item->getData());
    }

    private function _getRestData()
    {
        return $this->_getCollection()->walk(function($item) {
            return array(
                'id' => $item->getId(),
                'subject' => $item->getSubject(),
                'to_email' => $item->getToEmail(),
                'to_name' => $item->getToName(),
                'created_at' => $item->getCreatedAt(),
            );
        });
    }

    private function _getCollection()
    {
        $collection = Mage::getModel('zenc_emaillogger/log')->getCollection()
            ->orderByTimeDesc();
        if ($index = $this->getRequest()->getParam('pageIndex')) {
            $collection->setCurPage($index);
            $collection->setPageSize($this->getRequest()->getParam('pageSize') ?: self::PAGE_SIZE);
        }

        return $collection;
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
