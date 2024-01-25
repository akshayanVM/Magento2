<?php

namespace Egits\Integration\Block\Adminhtml\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

class Add extends Generic implements ButtonProviderInterface
{
    /**
     * This function creates the add button
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Add'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'brands_module_listing.brands_module_listing',
                                'actionName' => 'save',
                                'params' => [
                                    false,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
