<?php

namespace Vendor\Module\Model;

use Magento\Framework\Model\AbstractModel;
//use Akshay\Module\Api\Data\CustomerViewInterface;
use \Magento\Framework\DataObject\IdentityInterface;

class Post extends AbstractModel
{
    const CACHE_TAG = 'Vendor_Module';

    protected $_cacheTag = 'Vendor_Module';

    protected $_eventPrefix = 'Vendor_Module';

    protected function _construct()

    {
        $this->_init('Vendor\Module\Model\ResourceModel\Post');
    }

    //The IdentityInterface will force Model class define the getIdentities() -
    //method which will return a unique id for the model.
    //You must only use this interface if your model required cache clear after database operation and render information to the frontend page.
//    public function getIdentities()
//    {
//        return [self::CACHE_TAG . '_' . $this->getId()];
//    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
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
