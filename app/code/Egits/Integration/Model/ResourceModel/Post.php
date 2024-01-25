<?php

namespace Egits\Integration\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{

    /**
     * Constructor function
     */
    protected function _construct()
    {
        $this->_init('top_brands', 'id');
    }
}
