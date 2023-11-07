<?php

namespace PluginTest\Pluginmodule\Plugin;

class ProductPlugin
{
    protected $_storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_storeManager = $storeManager;
    }

    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $websiteName = $this->_storeManager->getWebsite()->getName();
        return $websiteName . ' - ' . $result;
    }
}
