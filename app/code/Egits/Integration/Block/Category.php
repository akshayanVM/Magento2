<?php

namespace Egits\Integration\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

class Category extends Template
{
    protected $CategoryCollection;
    public function __construct(
                                Template\Context $context,
                                CollectionFactory $CategoryCollection,
                                array $data = [])
    {
        $this->CategoryCollection = $CategoryCollection;
        parent::__construct($context, $data);
    }
    public function getDataForPHTML(){
        $categories = $this->CategoryCollection->create();
        $categories->addAttributeToSelect('*');
        $categories->addAttributeToFilter('enable_category', 1);
        foreach ($categories as $category) {

//            var_dump($category->getData());
//            dd();
                        $collection[] = $category->getData();
        }

        return $collection;
    }

}
