<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Egits\Integration\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

// use Magento\Framework\Message\ManagerInterface;

class EditForm extends \Magento\Cms\Controller\Adminhtml\Block implements HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    private $postFactory;

    private $coreRegistry;

    // protected $messageManager;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Egits\Integration\Model\PostFactory $postFactory,
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->postFactory = $postFactory;
        $this->coreRegistry = $coreRegistry;
        // $this->messageManager = $messageManager;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    // public function execute()
    // {
    //     $rowId = (int) $this->getRequest()->getParam('id');
    //     $rowData = $this->postFactory->create();
    //     $resultPage = $this->resultPageFactory->create();
    //     $resultPage->getConfig()->getTitle()->prepend((__('Edit Brand Page')));
    //     return $resultPage;
    // }

    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        if ($rowId) {
            $rowData = $this->postFactory->create()->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getId()) {
                $this->messageManager->addErrorMessage(__('Row data no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Row Data ') . $rowTitle : __('Add Row Data');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }
}
