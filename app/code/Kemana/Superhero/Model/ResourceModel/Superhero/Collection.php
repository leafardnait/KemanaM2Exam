<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Kemana\Superhero\Model\ResourceModel\Superhero;
 
/* use required classes */
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Kemana\Superhero\Model\Superhero',
            'Kemana\Superhero\Model\ResourceModel\Superhero'
        );
    }

    protected function _initSelect()
    {
        parent::_initSelect();

            $query = $this->getSelect()->reset(\Zend_Db_Select::COLUMNS)
            //my main table fields
            ->columns('main_table.increment_id')
            ->columns('main_table.superhero_universes')
            ->columns(new \Zend_Db_Expr('COUNT(`main_table`.`superhero_universes`) as universes_order_count'))
            ->where('main_table.superhero_universes !=""')
            ->group('main_table.superhero_universes');

            return $this;

    }
    
}