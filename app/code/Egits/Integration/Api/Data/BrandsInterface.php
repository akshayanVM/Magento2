<?php

namespace Egits\Integration\Api\Data;

interface BrandsInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const BRAND_ID  = 'id';
    const BRAND_NAME  = 'brand_name';
    // const EMAIL   = 'email';
    const IMAGE_URL  = 'image_url';
    // const NAME = 'name';
    // const SORT_ORDER = 'sort_order';
    // const IS_ACTIVE = 'is_active';

    /**#@-*/


    /**
     * Get Title
     *
     * @return string|null
     */
    public function getBrandId();

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getBrandName();

    /**
     * Get Created At
     *
     * @return string|null
     */
    // public function getCustomerEmail();

    public function getImageUrl();


    /**
     * Set Title
     *
     * @param string $id
     * @return $this
     */
    public function setBrandId($id);
    /**
     * Set Title
     *
     * @param string $customerName
     * @return $this
     */
    public function setBrandName($brandName);

    /**
     * Set Title
     *
     * @param string $email
     * @return $this
     */
    // public function setCustomerEmail($email);

    /**
     * Set Title
     *
     * @param string $url
     * @return $this
     */
    public function setImageUrl($url);

    // /**
    //  * Set Title
    //  *
    //  * @param string $sortOrder 
    //  * @return $this
    //  */
    // public function setSortOrder($sortOrder);

    // /**
    //  * Set Title
    //  *
    //  * @param string $isActive
    //  * @return $this
    //  */
    // public function setIsActive($isActive);
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

    // /**
    //  * Set ID
    //  *
    //  * @param int $id
    //  * @return $this
    //  */
    // public function setId($id);
}
