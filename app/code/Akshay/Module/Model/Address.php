<?php

namespace Akshay\Module\Model;

use Akshay\Module\Api\Data\AddressViewInterface;
use Magento\Framework\Model\AbstractModel;
use Akshay\Module\Api\Data\CustomerViewInterface;
use \Magento\Framework\DataObject\IdentityInterface;

class Address extends AbstractModel implements AddressViewInterface, IdentityInterface
{
    const CACHE_TAG = 'Akshay_Module';

    protected $_cacheTag = 'Akshay_Module';

    protected $_eventPrefix = 'Akshay_Module';
    protected function _construct()
    {
        $this->_init('Akshay\Module\Model\ResourceModel\Address');
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

    // GETTERS

    public function getAddressId()
    {
        return $this->getData(self::ADDRESS_ID);
    }

    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    // SETTERS 

    public function setAddressId($id)
    {
        return $this->setData(self::ADDRESS_ID, $id);
    }

    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }


    // //GETTERS
    // public function getCustomerId()
    // {
    //     return $this->getData(self::CUSTOMER_ID);
    // }

    // public function getCustomerName()
    // {
    //     return $this->getData(self::NAME);
    // }

    // public function getCustomerEmail()
    // {
    //     return $this->getData(self::EMAIL);
    // }

    // public function getImageUrl()
    // {
    //     return $this->getData(self::IMAGE_URL);
    // }

    // //SETTERS
    // public function setCustomerId($id)
    // {
    //     return $this->setData(self::CUSTOMER_ID, $id);
    // }
    // public function setCustomerName($customerName)
    // {
    //     return $this->setData(self::NAME, $customerName);
    // }

    // public function setCustomerEmail($email)
    // {
    //     return $this->setData(self::EMAIL, $email);
    // }

    // public function setImageUrl($url)
    // {
    //     return $this->setData(self::IMAGE_URL, $url);
    // }


    // // public function getName()
    // // {
    // //     return $this->getData(self::name);
    // // }

    // // public function setName($name)
    // // {
    // //     return $this->setData(self::name, $name);
    // // }
}
