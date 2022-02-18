<?php
namespace Kemana\Superhero\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class UniversesDynamicField
 */
class UniversesDynamicField extends AbstractFieldArray
{
    /**
     * @var TaxColumn
     */
    private $taxRenderer;

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('value', ['label' => __('Value')]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
}