<?php
/**
 * @category   Custom
 * @package    Custom_EmailForm
 * @copyright  Copyright (c) 2017 NU Technology Inc.
 */

namespace Custom\EmailForm\Model\Mail;

/**
 * Class TransportBuilder
 * @package Priceshoes\Career\Model\Mail
 */
class TransportBuilder extends \Magento\Framework\Mail\Template\TransportBuilder
{
    /**
     * @param $pdfString
     * @param $filename
     * @return $this
     */
    public function addAttachment($pdfString, $filename)
    {
       $this->message->createAttachment(
           $pdfString,
           \Zend_Mime::TYPE_OCTETSTREAM,
           \Zend_Mime::DISPOSITION_ATTACHMENT,
           \Zend_Mime::ENCODING_BASE64,
           $filename
       );
       return $this;
    }
}
