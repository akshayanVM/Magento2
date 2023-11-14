<?php

namespace AdminGrid\Gridmodule\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('AdminGrid\Gridmodule\Model\ResourceModel\Post');
    }
}

// class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
// {
//     const CACHE_TAG = 'logger_table';

//     protected $_cacheTag = 'logger_table';

//     protected $_eventPrefix = 'logger_table';

//     protected function _construct()
//     {
//         $this->_init('AdminGrid\Gridmodule\Model\ResourceModel\Post');
//     }

//     public function getIdentities()
//     {
//         return [self::CACHE_TAG . '_' . $this->getId()];
//     }

//     public function getDefaultValues()
//     {
//         $values = [];

//         return $values;
//     }
// }
