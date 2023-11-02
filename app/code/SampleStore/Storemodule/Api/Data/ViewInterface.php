<?php

namespace SampleStore\Storemodule\Api\Data;

interface ViewInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const STORE_ID  = 'store_id';
    const CODE  = 'code';
    const WEBSITE_ID   = 'website_id';
    const GROUP_ID  = 'group_id';
    const NAME = 'name';
    const SORT_ORDER = 'sort_order';
    const IS_ACTIVE = 'is_active';

    /**#@-*/


    /**
     * Get Title
     *
     * @return string|null
     */
    public function getCode();

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getWebsiteId();

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getGroupId();

    public function getName();

    public function getSortOrder();
    public function getIsActive();
    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set Title
     *
     * @param string $code
     * @return $this
     */
    public function setCode($code);
    /**
     * Set Title
     *
     * @param string $websiteId
     * @return $this
     */
    public function setWebsiteId($websiteId);

    /**
     * Set Title
     *
     * @param string $groupId
     * @return $this
     */
    public function setGroupId($groupId);

    /**
     * Set Title
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Set Title
     *
     * @param string $sortOrder 
     * @return $this
     */
    public function setSortOrder($sortOrder);

    /**
     * Set Title
     *
     * @param string $isActive
     * @return $this
     */
    public function setIsActive($isActive);
    // /**
    //  * Set Content
    //  *
    //  * @param string $content
    //  * @return $this
    //  */
    // public function setContent($content);

    // /**
    //  * Set Crated At
    //  *
    //  * @param int $createdAt
    //  * @return $this
    //  */
    // public function setCreatedAt($createdAt);

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);
}
