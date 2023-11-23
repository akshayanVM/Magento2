<?php

namespace Akshay\Module\Model\ResourceModel\Address;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    // protected $_idFieldName = 'post_id';
    // protected $_eventPrefix = 'mageplaza_helloworld_post_collection';
    // protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Akshay\Module\Model\Address', 'Akshay\Module\Model\ResourceModel\Address');
    }
}
