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
    /**
     * Holds an instance of the collection factory
     *
     * @var CollectionFactory
     */
    protected CollectionFactory $ProductCollection;
    /**
     * Holds an instance of the product repository
     *
     * @var ProductRepositoryInterface
     */
    protected $productRepository;
    /**
     * Holds an instance of the configurable products collection
     *
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
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Products constructor.
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
     * This function is used to get the products details based on id
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

        foreach ($products as $product) {
            $a = $product;
        }

        // Debugging: Log the generated SQL query
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $logger = $objectManager->get(\Psr\Log\LoggerInterface::class);
        $logger->info($products->getSelect()->__toString());

        return $products;
    }

    //colors from configurable products

    /**
     * This function returns the color options for the simple products
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
        $associatedProducts = $configurableProduct->getTypeInstance()
            ->getUsedProducts($configurableProduct);

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
     * This function returns the simple products from configurable products
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
        $associatedProducts = $configurableProduct->getTypeInstance()
            ->getUsedProducts($configurableProduct);
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

        }
        return $productDetails;
    }

    /**
     * This function returns the image path
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
     * This functions returns the ID's from the product array
     *
     * @param array $product
     * @return mixed
     */
    public function getProductId($product)
    {
        return $product->getId();
    }

    /**
     * This function also returns the simple products from configurable products
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
        $associatedProducts = $configurableProduct->getTypeInstance()
            ->getUsedProducts($configurableProduct);

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

    /**
     * This function returns the URL for the product
     *
     * @param array $product
     * @return mixed
     */
    public function getUrlForProduct($product)
    {
        return $product->getProductURL();
    }

    /**
     * This function is used to generate the form key
     *
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getFormKeyForWishlist()
    {
        return $this->formKey->getFormKey();
    }

    /**
     * This function returns the details of the simple products
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
