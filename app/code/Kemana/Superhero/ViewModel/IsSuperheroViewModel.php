<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kemana\Superhero\ViewModel;

use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
/**
 * View model for Login as Customer Shopping Assistance block.
 */
class IsSuperheroViewModel implements ArgumentInterface
{
    /**
     * @var Session
     */
    private $session;
    /**
     * @var CustomerMetadataInterface
     */
    protected $customerRepositoryInterface;
    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerMetadata;
    /**
     * @param Session $session
     * @param CustomerMetadataInterface $customerMetadata
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     */
    public function __construct(
        Session $session,
        CustomerMetadataInterface $customerMetadata,
        CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->session = $session;
        $this->customerMetadata = $customerMetadata;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
    }

    /**
     * Check if is_superhero attribute enabled in system
     *
     * @return bool
     * Magento\Customer\Model\Attribute
     */
    public function isEnabled()
    {
        return $this->_getCustomAttribute('is_superhero')->getIsVisible() ? (bool)$this->_getCustomAttribute('is_superhero')->getIsVisible() : false;
    }

    /**
     * Check if is_superhero attribute marked as required
     *
     * @return bool
     * Magento\Customer\Model\Attribute
     */
    public function isRequired()
    {
        return $this->_getCustomAttribute('is_superhero')->getIsRequired() ? 'true' : 'false';
    }

    /**
     * Retrieve is_superhero attribute label
     *
     * @return string
     * \Magento\Eav\Model\Entity\Attribute\Frontend\DefaultFrontend
     */
    public function getIsSuperheroLabel()
    {
        $attribute = $this->_getCustomAttribute('is_superhero')->getFrontend();
        return $attribute ? __($attribute->getLabel()) : '';
    }

    /**
     * Retrieve is_superhero attribute value
     *
     * @return bool
     */
    public function getIsSuperheroValue()
    {
        $is_superhero = $this->_getCustomerAttribVaue('is_superhero');
        return $is_superhero ? (bool)__($is_superhero) : false;
    }
    
    /**
     * Retrieve custom customer attribute instance
     *
     * @param string $attributeCode
     * @return \Magento\Eav\Model\Entity\Attribute\Frontend\DefaultFrontend|null
     */
    protected function _getCustomAttribute($attributeCode)
    {
        $customer = $this->session->getCustomer();
        try {
            return $customer->getResource()->getAttribute($attributeCode);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }
    }
    /**
     * Retrieve customer attribute instance
     *
     * @param string $attributeCode
     * @return \Magento\Customer\Api\Data\AttributeMetadataInterface|null
     */
    protected function _getAttribute($attributeCode)
    {
        try {
            return $this->customerMetadata->getAttributeMetadata($attributeCode);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }
    }
    /**
     * Retrieve customer data
     *
     * @return \Magento\Customer\Api\CustomerRepositoryInterface|null
     */
    protected function _getCustomerData()
    {
        try {
            $customer_id = $this->session->getCustomer()->getId();
            if($customer_id){
                return $this->customerRepositoryInterface->getById($customer_id);
            }
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }
    }
    /**
     * Retrieve customer attribute value
     *
     * @param string $attributeCode
     * @return \Magento\Framework\Api\AttributeValue|null
     */
    protected function _getCustomerAttribVaue($attributeCode)
    {
        try {
            if(null !== $this->_getCustomerData()){
                $customAttributeValue = $this->_getCustomerData()->getCustomAttribute($attributeCode);
                if (null !== $customAttributeValue) {
                    return $customAttributeValue->getValue();
                }
            }
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }
    }
}
