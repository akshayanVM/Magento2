<?php

namespace Egits\Testmodule\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\RequestInterface;
use Psr\Log\LoggerInterface;

class AlertObserver implements ObserverInterface
{
    protected $logger;
    protected $request;
    protected $messageManager;

    public function __construct(LoggerInterface $logger, RequestInterface $request, ManagerInterface $messageManager)
    {
        $this->logger = $logger;
        $this->request = $request;
        $this->messageManager = $messageManager;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $item = $observer->getEvent()->getData('quote_item');
        $item = ($item->getParentItem() ? $item->getParentItem() : $item);
        $price = 100; //set your price here
        $item->setCustomPrice($price);
        $item->setOriginalCustomPrice($price);
        $item->getProduct()->setIsSuperMode(true);
    }


    // public function execute(\Magento\Framework\Event\Observer $observer){
    // // {
    // //     // Log a message for debugging (optional)
    // //     $product = $observer->getEvent()->getProduct();
    // //     var_dump($product);
    // //     dd();
    // //     $this->logger->info('Observer is executed for checkout_cart_product_add_after');
    // //     $this->messageManager->addNoticeMessage(__('Product added to the cart!'));

    // //     // Display an alert message using JavaScript
    // //     // echo "<script>alert('Product added to the cart!');</script>";

    // //     return $this;
    // }
}
