<?php

namespace Egits\Integration\Api\Data;

interface BrandsInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    public const BRAND_ID  = 'id';
    public const BRAND_NAME  = 'brand_name';
    // const EMAIL   = 'email';
    public const IMAGE_URL  = 'image_url';
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
    /**
     * Function is used to get the image url
     *
     * @return mixed
     */
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
     * @param string $brandName
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
}
