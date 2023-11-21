<?php

namespace Akshay\Module\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Akshay\Module\Model\PostFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

class Save extends Action
{
    protected $resultPageFactory;
    protected $collectionFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        PostFactory $collectionFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getParams();
            $name = $data['name'];
            $email = $data['email'];
            print_r($data);
            if ($name && $email) {
                $model = $this->collectionFactory->create();
                // print_r($model);
                $model->setData($data)->save();
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
