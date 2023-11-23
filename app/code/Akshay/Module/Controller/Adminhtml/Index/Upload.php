<?php

namespace Akshay\Module\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;
use Akshay\Module\Model\Image;
use Magento\Backend\App\Action\Context;
use Akshay\Module\Helper\Data as ModuleHelper;

class Upload extends \Magento\Backend\App\Action
{
    protected $moduleHelper;

    public function __construct(
        Context $context,
        ModuleHelper $moduleHelper
    ) {
        parent::__construct($context);
        $this->moduleHelper = $moduleHelper;
    }
    public function execute()
    {
        try {
            $uploader = $this->_objectManager->create(
                'Magento\MediaStorage\Model\File\Uploader',
                ['fileId' => 'photo']
            );
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $uploader->setAllowCreateFolders(true);
            $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                ->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
            $result = $uploader->save($mediaDirectory->getAbsolutePath('custom_folder')); // pub -> media 
            $result['url'] = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface')
                ->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'custom_folder/' . $result['file'];
            // var_dump($result);
            // dd();
            // $image = $this->_objectManager->create(Image::class); // creating an object of the class: Image
            // $image->setImageUrl($result['url']);


            $this->moduleHelper->setValueToPass($result);


            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(json_encode($result));
        } catch (\Exception $e) {
            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(json_encode(['error' => $e->getMessage()]));
        }
        return $result;
    }
}
