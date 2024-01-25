<?php

namespace Egits\Swatches\Block;

use Magento\Framework\Pricing\Helper\Data;

/**
 * Class Utilities is used to hold some common functions
 *
 * @param Egits\Swatches\Block
 */
class Utilities extends \Magento\Framework\View\Element\Template
{
    /**
     * @var $priceHelper
     */
    protected $priceHelper;

    /**
     * Utilities constructor.
     * @param Data $priceHelper
     */
    public function __construct(Data $priceHelper)
    {
        $this->priceHelper = $priceHelper;
    }

    /**
     * Function returns the price from string to currency
     *
     * @param int $price
     * @return float|string
     */
    public function getFormattedPrice($price)
    {
        return $this->priceHelper->currency($price, true, false);
    }
}
