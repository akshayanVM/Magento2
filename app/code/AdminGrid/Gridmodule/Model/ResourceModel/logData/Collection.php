<?php

namespace Mageplaza\HelloWorld\Model\ResourceModel\Topic;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('AdminGrid\Gridmodule\Model\Topic', 'AdminGrid\Gridmodule\Model\ResourceModel\Topic');
    }
}
