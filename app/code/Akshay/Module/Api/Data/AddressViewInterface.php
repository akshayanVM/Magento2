<?php

namespace Akshay\Module\Api\Data;

interface AddressViewInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    // const CUSTOMER_ID  = 'customer_id';
    const ADDRESS_ID  = 'address_id';
    const ADDRESS   = 'address';
    // const IMAGE_URL  = 'photo';
    // const NAME = 'name';
    // const SORT_ORDER = 'sort_order';
    // const IS_ACTIVE = 'is_active';

    /**#@-*/


    /**
     * Get Title
     *
     * @return string|null
     */
    public function getAddressId();

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getAddress();


    public function setAddressId($id);
    /**
     * Set Title
     *
     * @param string $customerName
     * @return $this
     */
    public function setAddress($address);


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
