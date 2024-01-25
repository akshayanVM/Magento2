<?php

namespace Egits\Integration\Model;

use Magento\Framework\Model\AbstractModel;
// use Egits\Integration\Api\Data\CustomerViewInterface;
use Egits\Integration\Api\Data\BrandsInterface;
use \Magento\Framework\DataObject\IdentityInterface;

class Post extends AbstractModel implements BrandsInterface, IdentityInterface
{
    public const CACHE_TAG = 'Egits_Integration';
    /**
     * The cache tag for module
     *
     * @var string $_cacheTag
     */
    protected $_cacheTag = 'Egits_Integration';

    /**
     * define some default values
     *
     * @var string $_eventPrefix
     */
    protected $_eventPrefix = 'Egits_Integration';

    /**
     * The constructor method
     */
    protected function _construct()
    {
        $this->_init('Egits\Integration\Model\ResourceModel\Post');
    }

    //The IdentityInterface will force Model class define the getIdentities() -
    //method which will return a unique id for the model.
    //You must only use this interface if your model required cache clear after database operation and
    // render information to the frontend page.
    /**
     * Identities Getter
     *
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Default values getter
     *
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    //Getters

    /**
     * Get the brands id
     *
     * @return mixed|string|null
     */
    public function getBrandId()
    {
        return $this->getData(self::BRAND_ID);
    }

    /**
     * Get the brands name
     *
     * @return mixed|string|null
     */
    public function getBrandName()
    {
        return $this->getData(self::BRAND_NAME);
    }

    /**
     * Get the image url
     *
     * @return mixed|string|null
     */
    public function getImageUrl()
    {
        return $this->getData(self::IMAGE_URL);
    }

    //SETTERS

    /**
     * Set the brand id
     *
     * @param string $id
     * @return BrandsInterface|Post
     */
    public function setBrandId($id)
    {
        return $this->setData(self::BRAND_ID, $id);
    }

    /**
     * Set the brand name
     *
     * @param string $brandName
     * @return BrandsInterface|Post
     */
    public function setBrandName($brandName)
    {
        return $this->setData(self::BRAND_NAME, $brandName);
    }

    /**
     * Set the image url
     *
     * @param string $url
     * @return BrandsInterface|Post
     */
    public function setImageUrl($url)
    {
        return $this->setData(self::IMAGE_URL, $url);
    }
}
