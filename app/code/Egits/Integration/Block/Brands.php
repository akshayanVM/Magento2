<?php

namespace Egits\Integration\Block;

use Magento\Framework\View\Element\Template;
use Egits\Integration\Model\ResourceModel\Post\CollectionFactory;

class Brands extends Template
{
    protected $brandsCollection;
    public function __construct(
        Template\Context $context,
        CollectionFactory $brandsCollection,
        array $data = []
    ) {
        $this->brandsCollection = $brandsCollection;
        parent::__construct($context, $data);
    }
    public function getDataForPHTML()
    {
        $brands = $this->brandsCollection->create();

        // return "brands collection";
        // $categories->addAttributeToSelect('*');
        // $categories->addAttributeToFilter('enable_category', 1);
        // foreach ($brands as $brand) {

        //     //            var_dump($category->getData());
        //     //            dd();
        //     $collection[] = $brand->getData();
        // }

        return $brands;
    }

    public function getUrlForBrand($brand)
    {
        return $brand->getProductURL();
    }
}
