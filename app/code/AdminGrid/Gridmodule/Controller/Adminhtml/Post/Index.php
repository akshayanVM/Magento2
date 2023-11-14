<?php

namespace AdminGrid\Gridmodule\Controller\Adminhtml\Post;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    // protected $_postFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \AdminGrid\Gridmodule\Model\PostFactory $postFactory
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
        $resultPage->getConfig()->getTitle()->prepend((__('Posts')));

        return $resultPage;
    }
}
