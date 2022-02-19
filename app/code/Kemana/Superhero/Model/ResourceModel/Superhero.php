<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Kemana\Superhero\Model\ResourceModel;


class Superhero extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('sales_order', 'entity_id');
    }
    
}