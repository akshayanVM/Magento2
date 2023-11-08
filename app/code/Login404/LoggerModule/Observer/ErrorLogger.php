<?php
// echo "testing";
// exit;

namespace Login404\LoggerModule\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Request\Http;

class ErrorLogger implements ObserverInterface
{
    protected $logger;
    //protected $counter;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
        // $this->counter = 0;
    }

    public function execute(Observer $observer)
    {
        // $response = $observer->getEvent()->getResponse();
        // if ($response && $response->getHttpResponseCode() == 404) {
        //     $this->logger->error('404 Page Not Found: ' . $this->getCurrentUrl());
        //     $this->counter++;
        // }
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('Observer executed' . print_r($observer->getEvent()->debug(), true));
    }
    // protected function getCurrentUrl()
    // {
    //     return isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    // }
}
