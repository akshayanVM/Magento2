<?php

namespace Akshay\Module\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Akshay\Module\Model\ResourceModel\Post');
    }

    // public function getName()
    // {
    //     return $this->getData(self::name);
    // }

    // public function setName($name)
    // {
    //     return $this->setData(self::name, $name);
    // }
}
