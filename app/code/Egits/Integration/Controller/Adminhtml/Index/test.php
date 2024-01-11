<?php
//
//namespace Egits\Integration\Controller\Adminhtml\Index;
//
//use Magento\Framework\Controller\ResultFactory;
//
//class AddRow extends \Magento\Backend\App\Action
//{
//    /**
//     * @var \Magento\Framework\Registry
//     */
//    private $coreRegistry;
//
//    /**
//     * @var \Thecoachsmb\Grid\Model\PostFactory
//     */
//    private $postFactory;
//
//    /**
//     * @param \Magento\Backend\App\Action\Context $context
//     * @param \Magento\Framework\Registry $coreRegistry
//     * @param \Egits\Integration\ResourceModel\PostFactory $postFactory
//     */
//    public function __construct(
//        \Magento\Backend\App\Action\Context $context,
//        \Magento\Framework\Registry $coreRegistry,
//        \Egits\Integration\ResourceModel\PostFactory $postFactory
//    ) {
//        parent::__construct($context);
//        $this->coreRegistry = $coreRegistry;
//        $this->postFactory = $postFactory;
//    }
//
//    /**
//     * Mapped Grid List page.
//     * @return \Magento\Backend\Model\View\Result\Page
//     */
//    public function execute()
//    {
//        $rowId = (int) $this->getRequest()->getParam('id');
//        $rowData = $this->postFactory->create(); // Removed extra backtick (`)
//
//        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
//        if ($rowId) {
//            $rowData = $rowData->load($rowId);
//            $rowTitle = $rowData->getTitle();
//            if (!$rowData->getArticleId()) {
//                $this->messageManager->addErrorMessage(__('Row data no longer exists.'));
//                $this->_redirect('egits/integration/rowdata');
//                return;
//            }
//        }
//
//        $this->coreRegistry->register('row_data', $rowData);
//        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
//        $title = $rowId ? __('Edit Row Data ') . $rowTitle : __('Add Row Data');
//        $resultPage->getConfig()->getTitle()->prepend($title);
//        return $resultPage;
//    }
//
//    /**
//     * @return bool
//     */
//    protected function _isAllowed()
//    {
//        return $this->_authorization->isAllowed('Egits_Integration::add_row');
//    }
//}
