<?php

// app/code/Custom/Module/Block/Example.php

namespace ThemeVendor\ThemeModule\Block;

use Magento\Framework\View\Element\Template;

class Example extends Template
{
    protected $_template = 'ThemeVendor_ThemeModule::example.phtml';

    public function getItem1()
    {
        return $this->_getData('item1');
    }

    public function isItem2Enabled()
    {
        return $this->_getData('item2');
    }
}
