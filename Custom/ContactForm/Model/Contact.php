<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Custom\ContactForm\Model;

use Magento\Framework\Model\AbstractModel;

class Contact extends AbstractModel {
    protected function _construct() {
        /* full resource classname */
        $this->_init('Custom\ContactForm\Model\ResourceModel\Contact');
    }
}
