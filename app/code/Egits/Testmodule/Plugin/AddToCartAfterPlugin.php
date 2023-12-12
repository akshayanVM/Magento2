<?php

namespace Egits\Testmodule\Plugin;


use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Checkout\Model\Cart\CartInterface;
// use Magento\Catalog\Api\ProductRepositoryInterface as ProductRepositoryInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;

class AddToCartAfterPlugin
{
    protected $_eventManager;
    protected $productRepository;
    protected $messageManager;
    public function __construct(\Magento\Framework\Event\ManagerInterface $eventManager, ProductRepositoryInterface $productRepository, \Magento\Framework\Message\ManagerInterface $messageManager,)
    {
        $this->_eventManager = $eventManager;
        $this->messageManager = $messageManager;
        $this->productRepository = $productRepository;
    }

    public function afterAddProduct(
        \Magento\Checkout\Model\Cart $subject,
        $productInfo,
        // $requestInfo = null,
        $result
    ) {

        $productId = $productInfo->getProduct();
        try {
            // Load the product using ProductRepositoryInterface
            $product = $this->productRepository->getById($productId);

            // Access product details
            $productName = $product->getName();
            $productSku = $product->getSku();

            // Add your custom logic with the product details here

            $this->messageManager->addSuccessMessage(__('Your custom success message for product: %1', $productName));
        } catch (NoSuchEntityException $e) {
            // Handle exception if the product is not found
            $this->messageManager->addErrorMessage(__('Error: Product not found.', $e->getMessage()));
        }

        return $result;
        // var_dump($productInfo);
        // var_dump($requestInfo);
        // dd();
        // $this->messageManager->addSuccessMessage(__('Your custom success message.'));
        // return $result;

    }
}
