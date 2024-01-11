<?php

namespace Egits\Integration\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\CategoryFactory;
// use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\Data\Form\FormKey;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;


class Products extends Template
{
    protected CollectionFactory $ProductCollection;
    protected $productRepository;
    protected $configurable;

    protected $categoryFactory;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(

        Template\Context $context,
        FormKey $formKey,
        CollectionFactory $ProductCollection,
        ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        StoreManagerInterface $storeManager,
        Configurable $configurable,

        array $data = []
    ) {
        $this->formKey = $formKey;
        $this->productRepository = $productRepository;
        $this->ProductCollection = $ProductCollection;
        $this->categoryFactory = $categoryFactory;
        $this->storeManager = $storeManager;
        $this->configurable = $configurable;

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
        $products->addAttributeToSelect('color');

        $products->addCategoryFilter($category);


        foreach ($products as $product) {
            $a = $product;
        }

        // foreach ($products as $product) {
        //     $color = $product->getResource()->getAttribute('color'); // Assuming 'color' is the attribute code for the color attribute
        //     if ($color) {
        //         echo "Color: " . $color . "<br>";
        //     } else {
        //         echo "Color not available for product ID: " . $product->getId() . "<br>";
        //     }
        // }


        // Debugging: Log the generated SQL query
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $logger = $objectManager->get(\Psr\Log\LoggerInterface::class);
        $logger->info($products->getSelect()->__toString());

        // very important nested foreach example
        foreach ($products as $product) {
            $configurableProductId = $product->getData()['entity_id'];
            $associatedProductIds = $this->configurable->getChildrenIds($configurableProductId);
            // var_dump($associatedProductIds);
            // dd();
            foreach ($associatedProductIds[0] as $simpleProductId) {
                var_dump($simpleProductId);
            }
        }

        return $products;
    }

    public function getColorOptions($productId)
    {
        $product = $this->productRepository->getById($productId);
        if ($product->getTypeId() === 'configurable') {
            $colorOptions = [];
            $attributes = $product->getTypeInstance()->getConfigurableAttributesAsArray($product);
            foreach ($attributes as $attribute) {
                if ($attribute['attribute_code'] == 'color') { // Assuming 'color' is your attribute code
                    foreach ($attribute['values'] as $value) {
                        $colorOptions[] = $value['store_label'];
                    }
                    break;
                }
            }
            return $colorOptions;
        }
        return [];
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

    public function getSimpleProductsFromConfigurable($configurableProductSkuOrId)
    {
        // Step 2: Load Configurable Product
        $configurableProduct = $this->productRepository->get($configurableProductSkuOrId);

        // Step 3: Fetch Associated Simple Products
        $associatedProducts = $configurableProduct->getTypeInstance()->getUsedProducts($configurableProduct);

        // Step 4: Process and return the Simple Products
        $simpleProducts = [];
        foreach ($associatedProducts as $simpleProduct) {
            $simpleProducts[] = [
                'id' => $simpleProduct->getId(),
                'sku' => $simpleProduct->getSku(),
                // Add other attributes if needed
            ];
        }

        return $simpleProducts;
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
