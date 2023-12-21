<?php

namespace Egits\Integration\Model;

use Magento\Framework\Model\AbstractModel;
// use Egits\Integration\Api\Data\CustomerViewInterface;
use Egits\Integration\Api\Data\BrandsInterface;
use \Magento\Framework\DataObject\IdentityInterface;

class Post extends AbstractModel implements BrandsInterface,  IdentityInterface
{
    const CACHE_TAG = 'Egits_Integration';

    protected $_cacheTag = 'Egits_Integration';

    protected $_eventPrefix = 'Egits_Integration';
    protected function _construct()
    {
        $this->_init('Egits\Integration\Model\ResourceModel\Post');
    }

    //The IdentityInterface will force Model class define the getIdentities() -
    //method which will return a unique id for the model. 
    //You must only use this interface if your model required cache clear after database operation and render information to the frontend page.
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    //Getters

    public function getBrandId()
    {
        return $this->getData(self::BRAND_ID);
    }

    public function getBrandName()
    {
        return $this->getData(self::BRAND_NAME);
    }



    public function getImageUrl()
    {
        return $this->getData(self::IMAGE_URL);
    }

    //SETTERS
    public function setBrandId($id)
    {
        return $this->setData(self::BRAND_ID, $id);
    }
    public function setBrandName($brandName)
    {
        return $this->setData(self::BRAND_NAME, $brandName);
    }



    public function setImageUrl($url)
    {
        return $this->setData(self::IMAGE_URL, $url);
    }
}
