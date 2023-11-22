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
        // try {
        $data = (array)$this->getRequest()->getParams();
        // var_dump($data);
        $test = $data['customer_name'];
        $test1 = $data['email'];
        // var_dump($test);
        // dd();
        // dd();
        // print_r($data);
        // if ($data) {
        $model = $this->collectionFactory->create();
        // print_r($model);
        // dd();
        $model->setData(['name' => $test, 'email' => $test1])->save();
        // $model->setData()->save();
        $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
        // }
        // } catch (\Exception $e) {
        //     $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        // }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('custom_module/Index');
        // $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
