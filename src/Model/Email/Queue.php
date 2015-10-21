<?php

/**
 * Extend email queue functionality with logging capability
 */
class Zenc_EmailLogger_Model_Email_Queue extends Mage_Core_Model_Email_Queue
{
    /**
     * Send all messages in a queue
     *
     * Log messages instead of sending if email logging is enabled
     *
     * @return Mage_Core_Model_Email_Queue
     */
    public function send()
    {
        if (!Mage::helper('zenc_emaillogger')->isEnabled()) {
            return parent::send();
        }

        $this->_logQueue();

        if (Mage::helper('zenc_emaillogger')->isPassthruEnabled()) {
            return parent::send();
        }

        return $this;
    }

    /**
     * Log queued emails and mark them as processed
     *
     * @throws Exception Thrown when unable to save message
     */
    private function _logQueue()
    {
        /** @var $collection Mage_Core_Model_Resource_Email_Queue_Collection */
        $collection = Mage::getModel('core/email_queue')->getCollection()
            ->addOnlyForSendingFilter()
            ->setPageSize(self::MESSAGES_LIMIT_PER_CRON_RUN)
            ->setCurPage(1)
            ->load();

        $logger = Mage::getModel('zenc_emaillogger/email_queue_logger');
        foreach ($collection as $message) {
            $logger->save($message);

            $message->setProcessedAt(Varien_Date::formatDate(true));
            $message->save();
        }
    }
}
