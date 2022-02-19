<?php

declare(strict_types=1);

namespace Kemana\Superhero\Controller\Superhero;

use Magento\Framework\App\Action\Context;
use Magento\Store\Model\ScopeInterface;

class Universes extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_resultJsonFactory;
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $json;
    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param JsonFactory $resultJsonFactory
     * @param Json $json
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\Serialize\Serializer\Json $json
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->json = $json;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Zend_Http_Client_Exception
     */
    public function execute()
    {
        $universesJson = $this->getConfigValue('checkout/superhero/universes');
        
        $result['universesDropdown'] = $this->json->unserialize($universesJson);
        
        $resultJson = $this->_resultJsonFactory->create();
        return $resultJson->setData($result);
    }
    /**
     * get config value
     *
     * @return string
     * Magento\Framework\App\Config\ScopeConfigInterface
     */
    public function getConfigValue($path)
    {
        return $this->scopeConfig->getValue($path,
            ScopeInterface::SCOPE_STORE
        );
    }
}
