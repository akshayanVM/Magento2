<?php

namespace Egits\Testmodule\Plugin;

class AddToCartPlugin
{
    public function __construct()
    {
    }

    public function beforeAddProduct(
        \Magento\Checkout\Model\Cart $subject,
        $productInfo,
        $requestInfo = null
    ) {
        // var_dump($productInfo);
        // dd();
        //        $item = $productInfo->getData('entity_id');
        //        $item['entity_id'];

        $requestInfo['qty'] = 10; // increasing quantity to 10
        return array($productInfo, $requestInfo);
    }
}
