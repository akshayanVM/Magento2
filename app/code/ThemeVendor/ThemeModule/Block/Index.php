<?php

namespace ThemeVendor\ThemeModule\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    // Your block logic here

    /**
     * Get AJAX URL for the button click
     *
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('module/index/index');
    }
}
