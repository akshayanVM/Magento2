<?php

namespace Egits\Integration\Block\Adminhtml\Edit\Button;

use Magento\Backend\Block\Widget\Context;

class Generic
{
    /**
     *  Used in Magento 2 to provide contextual information and services within adminhtml blocks
     * @var Context
     */
    protected $context;
    /**
     * Holds and instance of the page repository class
     *
     * @var $pageRepository
     */
    protected $pageRepository;

    /**
     * Generic constructor.
     *
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    /**
     * This function returns the url
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
