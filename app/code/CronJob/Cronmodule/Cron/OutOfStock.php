<?php

namespace CronJob\Cronmodule\Cron;

use Psr\Log\LoggerInterface;
use Magento\Framework\Logger\Monolog;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\CatalogInventory\Api\Data\StockItemInterface;

class OutOfStock
{
    protected $stockRegistry;
    protected $logger;
    protected $monolog;

    public function __construct(
        LoggerInterface $logger,
        StockRegistryInterface $stockRegistry,
        Monolog $monolog
    ) {
        $this->logger = $logger;
        $this->monolog = $monolog;
    }

public function execute()
{
    // error_log('execute method called', 3, 'var/log/debug.log');

    $logFilePath = BP . '/var/log/loggerTest.log'; // Path relative to the Magento root directory

    $this->logger->info('Logging text to custom log file.');

    $out_of_stock = implode(", ", $this->getOutOfStockProducts()); // Convert the array to a string for logging purposes

    // Custom logging method using Monolog
    $writer = new \Monolog\Handler\StreamHandler($logFilePath);
    $this->monolog->pushHandler($writer);
    $this->monolog->info('Custom log text: ' . $out_of_stock);
}


    public function getOutOfStockProducts()
    {
        $outOfStockProducts = [];
        $collection = $this->stockRegistry->getStockStatusCollection();
        foreach ($collection as $item) {
            if ($item->getStockStatus() == StockItemInterface::STOCK_OUT_OF_STOCK) {
                $outOfStockProducts[] = $item->getProduct()->getName();
            }
        }
        return $outOfStockProducts;
    }
}
