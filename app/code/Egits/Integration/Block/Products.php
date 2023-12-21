<?php

namespace Egits\Integration\Block;

use Magento\Framework\View\Element\Template;
// use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Products extends Template
{
    protected $ProductCollection;
    public function __construct(
        Template\Context $context,
        CollectionFactory $ProductCollection,
        array $data = []
    ) {
        $this->ProductCollection = $ProductCollection;
        parent::__construct($context, $data);
    }
    public function getDataForPHTML()
    {

        // return "Hello from Products";
        $products = $this->ProductCollection->create();
        // $categories = $this->ProductCollection->create();
        $products->addAttributeToSelect('*');
        // $categories->addAttributeToFilter('enable_Product', 1);
        foreach ($products as $product) {

            //            var_dump($Product->getData());
            //            dd();
            $collection[] = $product->getData();
        }

        return $collection;
    }
}
