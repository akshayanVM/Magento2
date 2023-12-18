<?php

namespace Magento_Wishlist\Block;

use Magento\Wishlist\Block as OriginalBlock;

class Link extends OriginalBlock
{

    protected $_template = 'Magento_Wishlist::link.phtml';
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param arrayMagento_Wishlist\Block\OriginalBlock
     */
    public function getLabel()
    {
        // Change the text as per your requirement
        return __('My Custom Wishlist');
    }
}
