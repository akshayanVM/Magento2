<?php

namespace Egits\Integration\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\CategoryFactory;
// use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\Data\Form\FormKey;

class Products extends Template
{
    protected $ProductCollection;
    protected $categoryFactory;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

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
    public function getDataForPHTML()
    {
        $categoryId = 55;


        $category = $this->categoryFactory->create()->load($categoryId);
        $collection = [];

        $products = $this->ProductCollection->create();

        // $products->addAttributeToFilter('type_id', ['eq' => \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE]);

        // $products->getData();
        $products->addAttributeToSelect('*');

        $products->addCategoryFilter($category);


        //        foreach ($products as $product) {
        //
        //
        //            $collection[] = $product->getData();
        //        }

        // Debugging: Log the generated SQL query
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $logger = $objectManager->get(\Psr\Log\LoggerInterface::class);
        $logger->info($products->getSelect()->__toString());

        return $products;
    }

    public function getImageUrlFromPath($imagePath)
    {
        //  used to get the store url
        return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $imagePath;
    }

    public function getProductId($product)
    {
        //        $productId = '';
        //        $collection = $this->ProductCollection->create();
        //        foreach ($collection as $item){
        //            if ($item['entity_id'] == $product['entity_id'])
        //            {
        //                $productId = $item->getProductURL();
        //
        //                break;
        //            }
        //        }
        //        var_dump($productId);
        //        dd();
        //        return $productId;

        return $product->getId();
    }

    public function getUrlForProduct($product)
    {
        return $product->getProductURL();
    }

    public function getFormKeyForWishlist()
    {
        return $this->formKey->getFormKey();
    }
}
