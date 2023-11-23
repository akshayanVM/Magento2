<?php

namespace Akshay\Module\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Akshay\Module\Model\AddressFactory;
use Akshay\Module\Model\ResourceModel\Address as AddressResource;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

class SaveAddress extends Action
{
    protected $addressResource;
    protected $resultPageFactory;
    protected $addressFactory;

    public function __construct(
        Context $context,
        AddressResource $addressResource,
        PageFactory $resultPageFactory,
        AddressFactory $addressFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->addressFactory = $addressFactory;
        $this->addressResource = $addressResource;
        parent::__construct($context);
    }

    public function execute()
    {
        // try {
        $data = (array)$this->getRequest()->getParams();
        // var_dump($data);
        // dd();
        $test = $data['customer_address'];
        // $test = $data['customer_name'];
        // $test1 = $data['email'];
        // $test3 = $data['photo'][0]['url'];
        // var_dump($test);
        // dd();
        // dd();
        // print_r($data);
        // if ($data) {
        $model = $this->addressFactory->create();
        // print_r($model);
        // dd();
        $model->setAddress($test);
        // $model->setCustomerEmail($test1);
        // $model->setImageUrl($test3);
        // var_dump($model['name']);
        // dd();
        $this->addressResource->save($model);

        // $model->setData(['name' => $test, 'email' => $test1, 'photo' => $test3])->save();
        // $model->setData()->save();
        $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
        // }
        // } catch (\Exception $e) {
        //     $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        // }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('custom_module/Index');
        // $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
