<?php

namespace ThemeVendor\ThemeModule\Block\Widget;

use Magento\Widget\Block\BlockInterface;

class CustomWidget extends \Magento\Framework\View\Element\Template implements BlockInterface
{

    protected $_template = "widget/custom_widget.phtml";
    //     /**
    //      * @param \Magento\Framework\View\Element\Template\Context $context
    //      * @param array $data
    //      */
    //     public function __construct(
    //         \Magento\Framework\View\Element\Template\Context $context,
    //         array $data = []
    //     ) {
    //         parent::__construct($context, $data);
    //     }
    // }
}
