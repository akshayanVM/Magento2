<?php

namespace Egits\Swatches\Block;

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


        $products->addAttributeToSelect('*');
        $products->addAttributeToSelect('color');

        $products->addCategoryFilter($category);



        // Debugging: Log the generated SQL query
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $logger = $objectManager->get(\Psr\Log\LoggerInterface::class);
        $logger->info($products->getSelect()->__toString());

        return $products;
    }



    //colors from configurable products
    public function getColorOptions($productId)
    {

        // Step 2: Load Configurable Product
        $configurableProduct = $this->productRepository->getById($productId);

        // Step 3: Fetch Associated Simple Products
        $associatedProducts = $configurableProduct->getTypeInstance()->getUsedProducts($configurableProduct);


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

    public function getSimpleProductArray($productId)
    {
        // Step 2: Load Configurable Product
        $configurableProduct = $this->productRepository->getById($productId);

        // Step 3: Fetch Associated Simple Products
        $associatedProducts = $configurableProduct->getTypeInstance()->getUsedProducts($configurableProduct);


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
        }

        return $productDetails;
    }

    public function getImageUrlFromPath($imagePath)
    {
        //  used to get the store url
        return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $imagePath;
    }

    public function getProductId($product)
    {


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


    public function getSimpleProductDetails($configProductId)
    {
        $simpleProductId = $this->configurable->getChildrenIds($configProductId);
        $singleSimpleProduct = [];
        try {
            $simpleProduct = $this->productRepository->getById((int)$simpleProductId);
            // var_dump($simpleProduct);
            // dd();
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
}