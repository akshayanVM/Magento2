<?php

namespace Egits\Integration\Block;

use Magento\Framework\Pricing\Helper\Data;

class Utilities extends \Magento\Framework\View\Element\Template
{
    /**
     * This variable holds an instance of the price helper class
     * @var $priceHelper
     */
    protected $priceHelper;

    /**
     * Utilities constructor.
     *
     * @param Data $priceHelper
     */
    public function __construct(Data $priceHelper)
    {
        $this->priceHelper = $priceHelper;
    }

    /**
     * This function returns the price in currency format
     *
     * @param string $price
     * @return float|string
     */
    public function getFormattedPrice($price)
    {
        return $this->priceHelper->currency($price, true, false);
    }
}
