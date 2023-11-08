<?php

namespace Custom\EventLogger\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class CustomerRegistrationLogger implements ObserverInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        // Retrieve the customer data
        $customer = $observer->getEvent()->getCustomer();

        // Log the customer registration event
        $this->logger->info('New customer registered. Customer ID: ' . $customer->getId() . ', Email: ' . $customer->getEmail());
    }
}
