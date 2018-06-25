<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Custom\EmailForm\Model;

use Magento\Framework\Model\AbstractModel;

class EmailForm extends AbstractModel {
    protected function _construct() {
        /* full resource classname */
        $this->_init('Custom\EmailForm\Model\ResourceModel\EmailForm');
    }
}
