<?php

namespace Egits\Integration\Controller\Adminhtml\Index;

class DeleteRow extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    protected $blogFactory;
    protected $postFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Egits\Integration\Model\PostFactory $postFactory
    ) {
        $this->postFactory = $postFactory;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        //  echo $id; exit;
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
