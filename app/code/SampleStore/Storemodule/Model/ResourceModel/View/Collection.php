<?php

namespace SampleStore\Storemodule\Model\ResourceModel\View;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\SampleStore\Storemodule\Model\View::class, \SampleStore\Storemodule\Model\ResourceModel\View::class);
    }
}
