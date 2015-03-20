<?php

class Zenc_EmailLogger_Controller_Restful
    extends Mage_Core_Controller_Front_Action
{
    const PARAM_METHOD = '_method';
    const PARAM_FORMAT = '_format';

    protected $_methods = array(
        'get', 'post', 'put', 'delete', 'head'
    );

    protected $_formats = array(
        'html' => 'zenc_emaillogger/render_html',
        'json' => 'zenc_emaillogger/render_json',
    );

    /**
     * Retrieve action method name
     *
     * @param string $action
     * @return string
     */
    public function getActionMethodName($action)
    {
        return join('', array($this->_getRestMethod(), ucfirst($action), 'Action'));
    }

    public function render($value)
    {
        $render = $this->_getRenderer($this->_getRestFormat())->setValue($value);
        $this->getResponse()
            ->setHeader('Content-Type', $render->getContentType())
            ->setBody($render->toHtml());
    }

    private function _getRenderer($format)
    {
        return $this->getLayout()->createBlock($this->_formats[$format]);
    }

    private function _getRestFormat()
    {
        $forcedFormat = strtolower($this->getRequest()->getParam(static::PARAM_FORMAT));

        if ($this->_isAllowed($forcedFormat, array_keys($this->_formats))) {
            return $forcedFormat;
        }
        foreach ($this->_getHttpFormats() as $httpFormat) {
            if ($this->_isAllowed($httpFormat, array_keys($this->_formats))) {
                return $httpFormat;
            }
        }

        throw new InvalidArgumentException('Unsupported format');
    }

    private function _getHttpFormats()
    {
        $header = explode(',', $this->getRequest()->getHeader('Accept'));
        $httpFormats = array();
        foreach ($header as $accept) {
            list(, $format) = explode('/', $accept, 2);
            $httpFormats[] = strtolower($format);
        }

        return $httpFormats;
    }

    private function _getRestMethod()
    {
        $forcedMethod = strtolower($this->getRequest()->getParam(static::PARAM_METHOD));
        $httpMethod = strtolower($this->getRequest()->getMethod());

        $method = $this->_isAllowed($forcedMethod, $this->_methods) ?: $this->_isAllowed($httpMethod, $this->_methods);

        if ($method) {
            return $method;
        }

        throw new InvalidArgumentException('Unsupported method');
    }

    private function _isAllowed($toCheck, $allowed)
    {
        if (!empty($toCheck) && in_array($toCheck, $allowed)) {
            return $toCheck;
        }
    }
}
