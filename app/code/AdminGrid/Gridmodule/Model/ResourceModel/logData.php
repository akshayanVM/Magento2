<?php

namespace AdminGrid\Gridmodule\Model\ResourceModel;

class Topic extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('logger_table', 'id_column');
    }
}
