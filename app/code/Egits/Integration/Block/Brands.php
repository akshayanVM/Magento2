<?php

namespace Egits\Integration\Block;

use Magento\Framework\View\Element\Template;
use Egits\Integration\Model\ResourceModel\Post\CollectionFactory;

class Brands extends Template
{
    /**
     * This variable holds an instance of the collection factory
     *
     * @var CollectionFactory
     */
    protected $brandsCollection;

    /**
     * Brands constructor.
     *
     * @param Template\Context $context
     * @param CollectionFactory $brandsCollection
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $brandsCollection,
        array $data = []
    ) {
        $this->brandsCollection = $brandsCollection;
        parent::__construct($context, $data);
    }

    /**
     * This function returns the data for the phtml
     *
     * @return \Egits\Integration\Model\ResourceModel\Post\Collection
     */
    public function getDataForPHTML()
    {
        $brands = $this->brandsCollection->create();

        return $brands;
    }

    /**
     * This function returns the url for the brand
     *
     * @param array $brand
     * @return mixed
     */
    public function getUrlForBrand($brand)
    {
        return $brand->getProductURL();
    }
}
