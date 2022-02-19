<?php

namespace Kemana\Superhero\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Customer\Model\Session;
use Magento\Customer\Api\CustomerRepositoryInterface;

class IsSuperheroConfigProvider implements ConfigProviderInterface
{
    /**
     * @var Session
     */
    private $session;
    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepositoryInterface;
    /**
     * @param Session $session
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     */
    public function __construct(
        Session $session,
        CustomerRepositoryInterface $customerRepositoryInterface
    ) {
        $this->session = $session;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $dataConfig = [];
        $dataConfig['is_superhero'] = $this->getIsSuperheroValue();
        return $dataConfig;
    }
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
     * Retrieve is_superhero attribute value
     *
     * @return bool
     */
    public function getIsSuperheroValue()
    {
        $is_superhero = $this->_getCustomerAttribValue('is_superhero');
        return $is_superhero ? (bool)__($is_superhero) : false;
    }
    /**
     * Retrieve customer attribute value
     *
     * @param string $attributeCode
     * @return \Magento\Framework\Api\AttributeValue|null
     */
    protected function _getCustomerAttribValue($attributeCode)
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
