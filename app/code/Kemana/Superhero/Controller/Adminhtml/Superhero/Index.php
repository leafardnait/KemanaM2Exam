<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Kemana\Superhero\Controller\Adminhtml\Superhero;

class Index extends \Kemana\Superhero\Controller\Adminhtml\Superhero
{

    /**
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {

        $resultPage = $this->_resultPageFactory->create();

        /**
         * Set active menu item
         */
        $resultPage->setActiveMenu("Kemana_Superhero::core");
        $resultPage->getConfig()->getTitle()->prepend(__('Superhero Universes Orders'));

        /**
         * Add breadcrumb item
         */
        $resultPage->addBreadcrumb(__('Superhero'),__('Universes Orders'));

        return $resultPage;
    }
}
