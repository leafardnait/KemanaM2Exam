<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Kemana\Superhero\Model;

class Superhero extends \Magento\Framework\Model\AbstractModel {
    /**
     * Initialize resources
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Kemana\Superhero\Model\ResourceModel\Superhero');
    }
}