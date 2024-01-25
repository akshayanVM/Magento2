<?php

namespace Egits\Integration\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Egits\Integration\Model\ResourceModel\PostFactory;

/**
 * @param Egits\Integration\Controller\Adminhtml\Index
 */
class DeleteRow extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * DeleteRow constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param PostFactory $postFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        PostFactory $postFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->postFactory = $postFactory;
    }

    /**
     * Delete the top brands based on the given ID
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');

        try {
            $model = $this->postFactory->create()->load($id);
            $model->delete();
            $this->messageManager->addSuccessMessage(__('You have deleted the post.'));
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
        }

        return $resultRedirect->setPath('brands_module/Index');
    }
}
