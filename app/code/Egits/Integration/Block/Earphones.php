<?php

namespace Egits\Integration\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\CategoryFactory;
// use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\Data\Form\FormKey;

class Earphones extends Template
{
    /**
     * Holds an instance of the collection factory
     *
     * @var CollectionFactory
     */
    protected $ProductCollection;
    /**
     * Holds and instance of the category factory
     *
     * @var CategoryFactory
     */
    protected $categoryFactory;
    /**
     * This is an instance of the store manager interface
     *
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Earphones constructor.
     *
     * @param Template\Context $context
     * @param FormKey $formKey
     * @param CollectionFactory $ProductCollection
     * @param CategoryFactory $categoryFactory
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        FormKey $formKey,
        CollectionFactory $ProductCollection,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->formKey = $formKey;
        $this->ProductCollection = $ProductCollection;
        $this->categoryFactory = $categoryFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * This function returns the  products data for the front end
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
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
        // foreach ($products as $product) {

        //     //            var_dump($Product->getData());
        //     //            dd();
        //     $collection[] = $product->getData();
        // }
        return $products;
    }

    /**
     * This function returns the image url from the given path
     *
     * @param string $imagePath
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getImageUrlFromPath($imagePath)
    {
        //  used to get the store url
        return $this->storeManager->getStore()
                ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $imagePath;
    }

    /**
     * This functions returns the url from the earphone array
     *
     * @param array $earphone
     * @return mixed
     */
    public function getUrlForEarphone($earphone) // move it into the utility block
    {
        return $earphone->getProductURL();
    }

    /**
     * This function returns the id from the earphone array
     *
     * @param array $earphone
     * @return mixed
     */
    public function getEarphoneId($earphone)
    {
        return $earphone->getId();
    }

    /**
     * This function generates the form key
     *
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getFormKeyForEarphoneWishlist()
    {
        return $this->formKey->getFormKey();
    }
}
