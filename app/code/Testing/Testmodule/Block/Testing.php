<?php

namespace Testing\Testmodule\Block;

use Magento\Framework\View\Element\Template;

class Testing extends Template
{
    public function getHelloWorldText()
    {
        return 'Hello world!';
    }
}

// write a function to override the search bar