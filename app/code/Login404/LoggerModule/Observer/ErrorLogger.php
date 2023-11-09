<?php
// echo "testing";
// exit;

namespace Login404\LoggerModule\Observer;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Request\Http;

class ErrorLogger implements ObserverInterface
{
    protected $logger;
    protected $counter;
    protected $resource;

    public function __construct(\Psr\Log\LoggerInterface $logger, ResourceConnection $resource)
    {
        $this->logger = $logger;
        $this->counter = 0;
        $this->resource = $resource;
    }

    public function execute(Observer $observer)
    {
        $response = $observer->getEvent()->getResponse();
        if ($response && $response->getHttpResponseCode() == 404) {
            $this->counter++;
            // $this->logger->error('404 Page Not Found: ' . $this->getCurrentUrl());
            $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
            $logger = new \Zend_Log();
            $logger->addWriter($writer);
            $url = $this->getCurrentUrl();
            $this->logToDatabase($url, $this->counter);
            $logger->info('404 Page Not Foundd: ' . $url . " " . 'Count: ' . $this->counter);
        }

        //  $logger->info('404 Page Not Foundd: ' . print_r($observer->getEvent()->debug(), true));
    }
    protected function logToDatabase($url, $count)
    {
        $connection = $this->resource->getConnection();
        $tableName = $this->resource->getTableName('logger_table');

        $data = [
            'url' => $url,
            'count' => $count,
        ];
        $connection->insert($tableName, $data);
    }

    protected function getCurrentUrl()
    {
        // returns the current URL if its set
        return isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    }
}
