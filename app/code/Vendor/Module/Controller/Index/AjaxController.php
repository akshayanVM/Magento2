<?php

namespace Vendor\Module\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class AjaxController extends Action
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;
    /**
     * @var \Magento\Quote\Model\QuoteFactory
     */
    protected $quoteFactory;


    /**
     * Index constructor.
     *
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param \Magento\Quote\Model\QuoteFactory $quoteFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        \Magento\Quote\Model\QuoteFactory $quoteFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->quoteFactory = $quoteFactory;
    }

    /**
     * Execute controller action
     */
    public function execute()
    {
        $id = 1;
        $quote = $this->quoteFactory->create();
        $items = $quote->getItemsQty();

        $result = $this->resultJsonFactory->create();
        $testId = $this->getRequest()->getParam('buttonData', null);
        $data = ['message' => 'Hello from the controller!', 'test_id_passed' => $testId];




        return $result->setData($data);
    }

//    public function displayData()
//    {
//        $quote = $this->quoteFactory->create();
//        $items = $quote->getAllItems();
//        $output = ''; // Initialize an empty string
//
//        foreach ($items as $item) {
//            $output .= $item->getId() . "
//";
//            $output .= $item->getName() . "
//";
//            $output .= $item->getProductId() . "
//";
//        }
//
//        return $output;
//
//    }

}
