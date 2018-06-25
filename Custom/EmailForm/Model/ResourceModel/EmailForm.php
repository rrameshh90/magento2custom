<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Custom\EmailForm\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class EmailForm extends AbstractDb {
    protected function _construct() {
        /* tablename, primarykey*/
        $this->_init('custom_form_details', 'id');
    }
}
