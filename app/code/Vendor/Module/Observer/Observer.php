<?php

namespace Vendor\Module\Observer;

use Magento\Checkout\Controller\Cart\Add;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Event\ObserverInterface;
// use Magento\Framework\Event\Observer;
use Magento\Framework\App\Request\Http;

class Observer implements ObserverInterface
{
    protected $cart;
    public function __construct(
        Add $cart
    ) {
        $this->cart = $cart;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $myEventData = $observer->getData('myEventData');
    }
}
