<?php

namespace Egits\Swatches\Block;

use Magento\Framework\Pricing\Helper\Data;


class Utilities extends \Magento\Framework\View\Element\Template
{
    protected $priceHelper;
    public function __construct(Data $priceHelper)
    {
        $this->priceHelper = $priceHelper;
    }
    public function getFormattedPrice($price)
    {
        return $this->priceHelper->currency($price, true, false);
    }
}
