<?php

class Zenc_EmailLogger_Model_Mail extends Varien_Object
{
    protected $_saveDir;
    protected $_logs = array();
    protected $_bodyText;
    protected $_bodyHtml;
    protected $_emailId;

    /**
     * @SuppressWarnings(PHPMD)
     */
    public static function setDefaultTransport($transport)
    {
        // simply do nothing
    }

    public function __construct($args)
    {
        $this->_log($args);
        $this->_saveDir = BP . DS . 'emails';
        $this->_createSaveDir();
    }

    public function addTo($to)
    {
        $this->_log('To: ' . $to);
        return $this;
    }
    public function addCc($to)
    {
        $this->_log('CC: ' . $to);
        return $this;
    }
    public function addBcc($to)
    {
        $this->_log('BCC: ' . $to);
        return $this;
    }
    public function setReplyTo($to)
    {
        $this->_log('ReplyTo: ' . $to);
        return $this;
    }
    public function setReturnPath($to)
    {
        $this->_log('ReturnPath: ' . $to);
        return $this;
    }

    public function setBodyText($text)
    {
        $this->_bodyText = $text;
        return $this;
    }

    public function setBodyHtml($html)
    {
        $this->_bodyHtml = $html;
        return $this;
    }

    public function setSubject($sub)
    {
        $this->_log('Subject: ' . $sub);
        return $this;
    }

    public function setFrom($email, $senderName)
    {
        $this->_log('From: ' . $email . ', ' . $senderName);
        return $this;
    }

    public function setEmailId($emailId)
    {
        $this->_emailId = (string) $emailId;
        return $this;
    }

    public function hasEmailId()
    {
        return isset($this->_emailId);
    }

    public function send()
    {
        $logs = '';
        foreach ($this->_logs as $var) {
            if (is_string($var)) {
                $logs.= $var;
            } else {
                $logs.= var_export($var, true);
            }
            $logs.= PHP_EOL;
        }
        $baseName = $this->_getBasename();
        $this->_saveFile($baseName . '.log', $logs);
        $this->_saveFile($baseName . '.txt', $this->_bodyText);
        $this->_saveFile($baseName . '.html', $this->_bodyHtml);

        $storeUrl = Mage::app()->getStore()->getBaseUrl();
        $this->_mageLog(
            "mail::send was happened, email could be checked"
            ." with navigating to {$storeUrl}emails/{$baseName}.html"
        );
        return $this;
    }

    protected function _getBasename()
    {
        $baseName = date('ymdHis');
        if (isset($this->_emailId)) {
            $baseName = $this->_emailId;
        }
        return $baseName;
    }

    protected function _log($variable)
    {
        $this->_logs[] = $variable;
    }

    protected function _mageLog($message)
    {
        Mage::log($message, null, 'system.log', true);
    }

    protected function _createSaveDir()
    {
        if (!is_dir($this->_saveDir)) {
            mkdir($this->_saveDir, 0777, true);
        }
    }

    protected function _saveFile($file, $content)
    {
        $saveFile = $this->_saveDir . DS . $file;
        if (is_file($saveFile)) {
            while (!is_file($saveFile)) {
                $saveFile = $this->_getIncrementFileName($saveFile);
            }
        }
        file_put_contents($saveFile, $content);
    }

    protected function _getIncrementFileName($name)
    {
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $fileName = pathinfo($name, PATHINFO_FILENAME);
        $dirName = pathinfo($name, PATHINFO_DIRNAME);
        $increment = 1;
        if (preg_match('/([^-]+)-([0-9]+)/i', $fileName, $matches)) {
            $increment = $matches[2] + 1;
            $fileName = $matches[1];
        }
        return sprintf(
            '%s-%d.%s',
            $dirName . DS . $fileName,
            $increment,
            $ext
        );
    }
}
