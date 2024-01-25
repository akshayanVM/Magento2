<?php

namespace Egits\Integration\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

class Category extends Template
{
    /**
     * This variable holds an Instance of the collection factory
     *
     * @var CollectionFactory
     */
    protected $CategoryCollection;

    /**
     * Category constructor.
     *
     * @param Template\Context $context
     * @param CollectionFactory $CategoryCollection
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $CategoryCollection,
        array $data = []
    ) {
        $this->CategoryCollection = $CategoryCollection;
        parent::__construct($context, $data);
    }

    /**
     * This function gets the data for the front end
     *
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getDataForPHTML()
    {
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
