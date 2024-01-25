<?php

namespace Egits\Swatches\Block;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ResourceModel\CategoryFactory;
// use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\Data\Form\FormKey;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;

//use Magento\Tests\NamingConvention\true\string;

/**
 * Class Products is the controller responsible for displaying the products and its functionality
 *
 * @param Egits\Swatches\Block
 */
class Products extends Template
{
    /**
     * This holds and instance of the collection factory
     *
     * @var CollectionFactory
     */
    protected $ProductCollection;
    /**
     * This holds and instance of the product repository
     *
     * @var ProductRepositoryInterface
     */
    protected $productRepository;
    /**
     * This holds the instance for the configurable products collection
     * @var Configurable
     */
    protected $configurable;
    /**
     * Holds an instance of the category factory
     *
     * @var CategoryFactory
     */
    protected $categoryFactory;
    /**
     * An instance of the store manager interface
     *
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * Products constructor which initializes the default settings
     *
     * @param Template\Context $context
     * @param FormKey $formKey
     * @param CollectionFactory $ProductCollection
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryFactory $categoryFactory
     * @param StoreManagerInterface $storeManager
     * @param Configurable $configurable
     * @param array $data
     */
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
    /**
     * This function is used to get the product data based on the category id
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
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
    /**
     * This function returns the color options
     *
     * @param int $productId
     * @return array
     * @throws NoSuchEntityException
     */
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
    /**
     * This function is responsible for returning the simple products array from configurable products
     *
     * @param int $productId
     * @return array
     * @throws NoSuchEntityException
     */
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
    /**
     * This function returns the image url path from the string
     *
     * @param string $imagePath
     * @return string
     * @throws NoSuchEntityException
     */
    public function getImageUrlFromPath($imagePath)
    {
        //  used to get the store url
        return $this->storeManager->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $imagePath;
    }
    /**
     * This function returns the ID from the products array
     *
     * @param array $product
     * @return mixed
     */
    public function getProductId($product)
    {
        return $product->getId();
    }

    /**
     * This function returns the simple products from the configurable products array
     *
     * @param int $configurableProductSkuOrId
     * @return array
     * @throws NoSuchEntityException
     */
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

    /**
     * This function returns the url for the product from the products array
     *
     * @param array $product
     * @return mixed
     */
    public function getUrlForProduct($product)
    {
        return $product->getProductURL();
    }

    /**
     * This function generates and returns the formkey for the wishlist
     *
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getFormKeyForWishlist()
    {
        return $this->formKey->getFormKey();
    }

    /**
     * This function returns the complete details of the configurable products based on the id
     *
     * @param int $configProductId
     * @return array|string
     */
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
