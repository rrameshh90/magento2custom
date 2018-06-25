<?php
/**
 * @category   Custom
 * @package    Custom_EmailForm
 * @copyright  Copyright (c) 2017 NU Technology Inc. (http://nutechnologyinc.com/)
 */

namespace Custom\EmailForm\Model\ResourceModel\EmailForm;

/**
 * Class Collection
 * @package Custom\EmailForm\Model\ResourceModel\EmailForm
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Custom\EmailForm\Model\EmailForm','Custom\EmailForm\Model\ResourceModel\EmailForm');
    }
}
