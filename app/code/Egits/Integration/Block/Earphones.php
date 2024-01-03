<?php

namespace Egits\Integration\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\CategoryFactory;
// use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;


class Earphones extends Template
{
    protected $ProductCollection;
    protected $categoryFactory;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        Template\Context $context,
        CollectionFactory $ProductCollection,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->ProductCollection = $ProductCollection;
        $this->categoryFactory = $categoryFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }
    public function getDataForPHTML()
    {
        $categoryId = 53;

        // $productName = 'Bag';
        $category = $this->categoryFactory->create()->load($categoryId);
        $collection = [];
        // return "Hello from Products";
        $products = $this->ProductCollection->create();
        // $category->getProductCollection()->addAttributeToSelect('*');
        // $categories = $this->ProductCollection->create();
        $products->addAttributeToSelect('*');
        // $products->addAttributeToFilter('name', ['like' => '%' . $productName . '%']);
        // $products->setPageSize(2000);
        // $products->addCategoriesFilter(['in' => $categoryId]);
        $products->addCategoryFilter($category);
        // $products->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH);
        // $products->addAttributeToFilter('name', 1);
        // $categories->addAttributeToFilter('enable_Product', 1);
        foreach ($products as $product) {

            //            var_dump($Product->getData());
            //            dd();
            $collection[] = $product->getData();
        }
        return $collection;
    }

    public function getImageUrlFromPath($imagePath)
    {
        //  used to get the store url
        return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $imagePath;
    }
}
