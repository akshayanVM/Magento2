<?php

namespace Akshay\Module\Api\Data;

interface CustomerViewInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const CUSTOMER_ID  = 'customer_id';
    const NAME  = 'name';
    const EMAIL   = 'email';
    const IMAGE_URL  = 'photo';
    // const NAME = 'name';
    // const SORT_ORDER = 'sort_order';
    // const IS_ACTIVE = 'is_active';

    /**#@-*/


    /**
     * Get Title
     *
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getCustomerName();

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCustomerEmail();

    public function getImageUrl();

    /**
     * Set Title
     *
     * @param string $id
     * @return $this
     */
    public function setCustomerId($id);
    /**
     * Set Title
     *
     * @param string $customerName
     * @return $this
     */
    public function setCustomerName($customerName);

    /**
     * Set Title
     *
     * @param string $email
     * @return $this
     */
    public function setCustomerEmail($email);

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
