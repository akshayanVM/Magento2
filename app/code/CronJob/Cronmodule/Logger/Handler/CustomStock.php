<?php

namespace CronJob\Cronmodule\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;

class CustomStock extends Base
{
    /**
     * File name
     *
     * @var string
     */
    protected $fileName = '/var/log/custom_stock_log.log';
}
