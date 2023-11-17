<?php

namespace Akshay\Module\Controller\Adminhtml\Index;

class Details extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    // protected $_postFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
    ) {

        $this->resultPageFactory = $resultPageFactory;
        // $this->_postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // $collection =  $this->_postFactory->create();
        // $data = $collection->getCollection();
        // print_r($data->getData());
        // die();
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('The Address Page')));

        return $resultPage;
    }
}