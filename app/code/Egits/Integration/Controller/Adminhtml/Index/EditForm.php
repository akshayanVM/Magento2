<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Egits\Integration\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

// use Magento\Framework\Message\ManagerInterface;
/**
 * This class is the controller for the new form used to edit the top brands data
 *
 */
class EditForm extends \Magento\Cms\Controller\Adminhtml\Block implements HttpGetActionInterface
{
    /**
     * An instance of the page factory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * An instance of the post factory
     *
     * @var \Egits\Integration\Model\PostFactory
     */
    private $postFactory;

    /**
     * An instance of the core registry
     *
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    // protected $messageManager;

    /**
     * The default construct method for the class
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Egits\Integration\Model\PostFactory $postFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Egits\Integration\Model\PostFactory $postFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->postFactory = $postFactory;
        $this->coreRegistry = $coreRegistry;
        // $this->messageManager = $messageManager;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * This default execute method for edit form
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
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
