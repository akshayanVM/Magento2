<?php

namespace Egits\Integration\Block;

use Magento\Framework\Exception\NoSuchEntityException;
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
        // foreach ($products as $product) {
        //     $simpleProductValues = [];
        //     $configurableProductId = $product->getData()['entity_id'];
        //     $associatedProductIds = $this->configurable->getChildrenIds($configurableProductId);
        //     // var_dump($associatedProductIds);
        //     // dd();
        //     foreach ($associatedProductIds[0] as $simpleProductId) {
        //         // Step 1: Load Simple Product by ID
        //         $simpleProduct = $this->productRepository->getById($simpleProductId);

        //         // Step 2: Fetch Color Attribute Value


        //         // Step 3: Retrieve SKU and ID
        //         $simpleProductSku = $simpleProduct->getSku();
        //         $simpleProductValueId = $simpleProduct->getId();

        //         $colorAttributeValue = $simpleProduct->getAttributeText('color'); // Replace 'color' with your actual attribute code if different
        //         // var_dump($colorAttributeValue);
        //         $simpleProductValues = [
        //             'color' => $colorAttributeValue,
        //             'sku' => $simpleProductSku,
        //             'id' => $simpleProductValueId
        //         ];
        //         // Step 4: Display or Store Color Attribute Value
        //         // if ($colorAttributeValue) {
        //         //     echo "Simple Product ID: " . $simpleProductId . ", Color Attribute Value: " . $colorAttributeValue . PHP_EOL;
        //         // } else {
        //         //     echo "Simple Product ID: " . $simpleProductId . ", Color Attribute Value Not Available" . PHP_EOL;
        //         // }
        //         // var_dump($simpleProductId); // can use this id to get the simple product colors
        //     }
        //     return $simpleProductValues;
        // }

        return $products;
    }

    // public function getSimpleProductDetails($productsCollection)
    // {
    //     foreach ($productsCollection as $product) {
    //         $simpleProductValues = [];
    //         $configurableProductId = $product->getId();
    //         $associatedProductIds = $this->configurable->getChildrenIds($configurableProductId);
    //         // var_dump($associatedProductIds);
    //         // dd();
    //         foreach ($associatedProductIds[0] as $simpleProductId) {
    //             // Step 1: Load Simple Product by ID
    //             $simpleProduct = $this->productRepository->getById($simpleProductId);

    //             // Step 2: Fetch Color Attribute Value


    //             // Step 3: Retrieve SKU and ID
    //             $simpleProductSku = $simpleProduct->getSku();
    //             $simpleProductValueId = $simpleProduct->getId();

    //             $colorAttributeValue = $simpleProduct->getAttributeText('color'); // Replace 'color' with your actual attribute code if different
    //             // var_dump($colorAttributeValue);
    //             $simpleProductValues = [
    //                 'color' => $colorAttributeValue,
    //                 'sku' => $simpleProductSku,
    //                 'id' => $simpleProductValueId
    //             ];
    //             // Step 4: Display or Store Color Attribute Value
    //             // if ($colorAttributeValue) {
    //             //     echo "Simple Product ID: " . $simpleProductId . ", Color Attribute Value: " . $colorAttributeValue . PHP_EOL;
    //             // } else {
    //             //     echo "Simple Product ID: " . $simpleProductId . ", Color Attribute Value Not Available" . PHP_EOL;
    //             // }
    //             // var_dump($simpleProductId); // can use this id to get the simple product colors
    //         }
    //     }
    //     return $simpleProductValues;
    // }

    //colors from configurable products
    public function getColorOptions($productId)
    {

        // Step 2: Load Configurable Product
        $configurableProduct = $this->productRepository->getById($productId);

        // Step 3: Fetch Associated Simple Products
        $associatedProducts = $configurableProduct->getTypeInstance()->getUsedProducts($configurableProduct);
        // var_dump($associatedProducts);

        foreach ($associatedProducts as $product) {
            $productId = $product->getId(); // Entity ID
            $productSku = $product->getSku(); // SKU
            $productPrice = $product->getPrice();
            $productColor = $product->getAttributeText('color'); // Price

            // Collect attributes into an array for each product
            $productDetails[] = [
                'entity_id' => $productId,
                'sku' => $productSku,
                'price' => $productPrice,
                'color' => $productColor
            ];

            // You can also output or process each product's details here
            echo "Entity ID: " . $productId . "<br>";
            echo "SKU: " . $productSku . "<br>";
            echo "Price: " . $productPrice . "<br>";
            echo "Price: " . $productColor . "<br>";
            echo "--------------------------<br>";
        }
        dd();

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
                'color' => $simpleProduct->getAttributeText('color'),
            ];
        }
        //    var_dump($simpleProducts);

        return $simpleProducts;
    }

    // public function getColorOptionsFromSimpleProducts($configurableProductSkuOrId)
    // {
    //     // Step 1: Load Configurable Product
    //     $configurableProduct = $this->productRepository->get($configurableProductSkuOrId);

    //     // Step 2: Fetch Associated Simple Products
    //     $associatedProducts = $configurableProduct->getTypeInstance()->getUsedProducts($configurableProduct);

    //     // Step 3: Initialize Array to Store Color Options
    //     $colorOptions = [];

    //     // Step 4: Iterate through each Simple Product to fetch Color Attribute
    //     foreach ($associatedProducts as $simpleProduct) {
    //         $simpleProductId = $simpleProduct->getId();
    //         $simpleProductSku = $simpleProduct->getSku();

    //         // Fetch Color Attribute Value
    //         $colorAttributeValue = $simpleProduct->getAttributeText('color'); // Replace 'color' with your actual attribute code if different

    //         // Store Color Attribute Value in Array with Simple Product ID and SKU
    //         $colorOptions[] = [
    //             'simple_product_id' => $simpleProductId,
    //             'simple_product_sku' => $simpleProductSku,
    //             'color_attribute_value' => $colorAttributeValue,
    //         ];
    //     }

    //     return $colorOptions;
    // }


    public function getUrlForProduct($product)
    {
        return $product->getProductURL();
    }

    public function getFormKeyForWishlist()
    {
        return $this->formKey->getFormKey();
    }


    public function getSimpleProductDetails($configProductId)
    {
        $simpleProductId = $this->configurable->getChildrenIds($configProductId);
        $singleSimpleProduct = [];
        try {
            $simpleProduct = $this->productRepository->getById((int)$simpleProductId);
            $simpleProductId = $simpleProduct->getId();
            $simpleProductSku = $simpleProduct->getSku();
            $simpleProductColor = $simpleProduct->getAttributeText('color');
            $singleSimpleProduct = [
                'color' => $simpleProductColor,
                'id' => $simpleProductId,
                'sku' => $simpleProductSku
            ];
        } catch (NoSuchEntityException $e) {
            return "Error" . $e;
        }
        // var_dump($simpleProduct);
        return $singleSimpleProduct;
    }

    // get a single simple product
    // public function getSimpleProduct($configurableProductId)
    // {
    //     $configurableProduct = $this->productRepository->get($configurableProductId);
    //     $associatedProducts = $configurableProduct->getTypeInstance()->getUsedProducts($configurableProduct);
    //     return $associatedProducts;
    // }

    // public function getSimpleProductDetails($simpleProductId)
    // {
    //     $simpleProductValues = [];
    //     // $simpleProductId = $this->configurable->getChildrenIds($configProductId);
    //     try {
    //         $simpleProduct = $this->productRepository->getById((int)$simpleProductId);
    //         $simpleProductValues = [
    //             'sku' => $simpleProduct->getSku(),
    //             'color' => $simpleProduct->getAttributeText('color'),
    //         ];
    //     } catch (NoSuchEntityException $e) {
    //         return "Error" . $e;
    //     }
    //     //    var_dump($simpleProduct);
    //     return $simpleProductValues;
    // }

    //        foreach ($products as $product) {
    //            $simpleProductValues = [];
    //            $configurableProductId = $product->getData()['entity_id'];
    //            $associatedProductIds = $this->configurable->getChildrenIds($configurableProductId);
    //            // var_dump($associatedProductIds);
    //            // dd();
    //            foreach ($associatedProductIds[0] as $simpleProductId) {
    //                // Step 1: Load Simple Product by ID
    //                $simpleProduct = $this->productRepository->getById($simpleProductId);
    //
    //                // Step 2: Fetch Color Attribute Value
    //
    //
    //                // Step 3: Retrieve SKU and ID
    //                $simpleProductSku = $simpleProduct->getSku();
    //                $simpleProductValueId = $simpleProduct->getId();
    //
    //                $colorAttributeValue = $simpleProduct->getAttributeText('color'); // Replace 'color' with your actual attribute code if different
    //                // var_dump($colorAttributeValue);
    //                $simpleProductValues = [
    //                    'color' => $colorAttributeValue,
    //                    'sku' => $simpleProductSku,
    //                    'id' => $simpleProductValueId
    //                ];
    //                // Step 4: Display or Store Color Attribute Value
    //                // if ($colorAttributeValue) {
    //                //     echo "Simple Product ID: " . $simpleProductId . ", Color Attribute Value: " . $colorAttributeValue . PHP_EOL;
    //                // } else {
    //                //     echo "Simple Product ID: " . $simpleProductId . ", Color Attribute Value Not Available" . PHP_EOL;
    //                // }
    //                // var_dump($simpleProductId); // can use this id to get the simple product colors
    //            }
    //            return $simpleProductValues;
    //        }
    //    }














}
