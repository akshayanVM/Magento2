<?php

namespace Egits\Testmodule\Controller\Cart;

use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Add extends \Magento\Checkout\Controller\Cart\Add
{
    protected $messageManager;
    protected $_pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param ManagerInterface $messageManager
     */
    public function _construct(
        Context $context,
        PageFactory $pageFactory,
        ManagerInterface $messageManager
    ) {


        $this->messageManager = $messageManager;
    }

    public function execute()
    {
        $productId = (int)$this->getRequest()->getParam('product');
        $qty = (int)$this->getRequest()->getParam('qty', 1);

        // Now you have the product ID and quantity
        // You can use this information as needed

        $this->messageManager->addSuccessMessage("Product ID: $productId, Quantity: $qty added to the cart.");

        // The line return parent::execute(); in your overridden execute method is calling the execute method of the parent class (\Magento\Checkout\Controller\Cart\Add). This is a common practice when you override a method in PHP.
        return parent::execute();
    }
}
