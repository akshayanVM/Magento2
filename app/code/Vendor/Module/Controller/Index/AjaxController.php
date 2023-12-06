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
     * Index constructor.
     *
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
    }

    /**
     * Execute controller action
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $testId = $this->getRequest()->getParam('buttonData', null);
        $data = ['message' => 'Hello from the controller!', 'test_id_passed' => $testId];

        return $result->setData($data);
    }
}
