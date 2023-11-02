<?php

namespace SampleStore\Storemodule\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \SampleStore\Storemodule\Api\Data\ViewInterface;

/**
 * Class File
 * @package Thecoachsmb\Mymodule\Model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class View extends AbstractModel implements ViewInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'samplestore_storemodule_view';

    /**
     * Post Initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('SampleStore\Storemodule\Model\ResourceModel\View');
    }


    /**
     * Get Title
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->getData(self::CODE);
    }

    /**
     * Get Title
     *
     * @return string|null
     */
    public function getWebsiteId()
    {
        return $this->getData(self::WEBSITE_ID);
    }

    /**
     * Get Title
     *
     * @return string|null
     */
    public function getGroupId()
    {
        return $this->getData(self::GROUP_ID);
    }

    /**
     * Get Title
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get Title
     *
     * @return string|null
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

    /**
     * Get Title
     *
     * @return string|null
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    // /**
    //  * Get Content
    //  *
    //  * @return string|null
    //  */
    // public function getContent()
    // {
    //     return $this->getData(self::CONTENT);
    // }

    // /**
    //  * Get Created At
    //  *
    //  * @return string|null
    //  */
    // public function getCreatedAt()
    // {
    //     return $this->getData(self::CREATED_AT);
    // }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * Return identities
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setCode($code)
    {
        return $this->setData(self::CODE, $code);
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setWebsiteId($websiteId)
    {
        return $this->setData(self::WEBSITE_ID, $websiteId);
    }

    public function setGroupId($groupId)
    {
        return $this->setData(self::GROUP_ID, $groupId);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }

    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::STORE_ID, $id);
    }
}
