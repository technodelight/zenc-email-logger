<?php

class Zenc_EmailLogger_Model_Email_Queue_Logger
{
    /**
     * Save email queue to log
     *
     * @param Mage_Core_Model_Email_Queue $queue
     *
     * @throws Exception Thrown when unable to save the log
     */
    public function save(Mage_Core_Model_Email_Queue $queue)
    {
        $log = $this->_covertEmailQueueToLog($queue);
        $log->save();
    }

    /**
     * @param Mage_Core_Model_Email_Queue $queue
     *
     * @return Zenc_EmailLogger_Model_Log
     */
    private function _covertEmailQueueToLog(Mage_Core_Model_Email_Queue $queue)
    {
        $log = Mage::getModel('zenc_emaillogger/log');
        $parameters = $queue->getMessageParameters();

        if ($parameters['is_plain']) {
            $log->setBodyText($queue->getMessageBody());
        } else {
            $log->setBodyHtml($queue->getMessageBody());
        }
        $log->setRecipients($queue->getRecipients());
        $log->setSubject($parameters['subject']);
        $log->setFromEmail($parameters['from_email']);
        $log->setFromName($parameters['from_name']);
        $log->setReplyToEmail($parameters['reply_to']);
        $log->setReturnPath($parameters['return_to']);

        return $log;
    }
}
