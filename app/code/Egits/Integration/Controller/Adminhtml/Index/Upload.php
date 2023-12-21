<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Egits\Integration\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Filesystem;

class Upload extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    const UPLOAD_DIR = 'TopBrands';

    const ADMIN_RESOURCE = 'Magento_Backend::content';

    private $directoryList;
    private $resultJsonFactory;
    private $uploaderFactory;
    private $storeManager;
    private $cmsTopBrandsImages;
    private $mediaDirectory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Filesystem\DirectoryList $directoryList,
        \Magento\Cms\Helper\Wysiwyg\Images $cmsTopBrandsImages,
        Filesystem $filesystem = null
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->storeManager = $storeManager;
        $this->uploaderFactory = $uploaderFactory;
        $this->directoryList = $directoryList;
        $this->cmsTopBrandsImages = $cmsTopBrandsImages;
        $filesystem = $filesystem ?? ObjectManager::getInstance()->create(Filesystem::class);
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        parent::__construct($context);
    }

    private function getFilePath($path, $imageName)
    {
        return rtrim($path, '/') . '/' . ltrim($imageName, '/');
    }

    public function execute()
    {
        $fieldName = $this->getRequest()->getParam('param_name');
        $fileUploader = $this->uploaderFactory->create(['fileId' => $fieldName]);

        // Set our parameters
        $fileUploader->setFilesDispersion(false);
        $fileUploader->setAllowRenameFiles(true);
        $fileUploader->setAllowedExtensions(['jpeg', 'jpg', 'png', 'gif', 'customtype']);
        $fileUploader->setAllowCreateFolders(true);

        try {
            if (!$fileUploader->checkMimeType(['image/png', 'image/jpeg', 'image/gif', 'image/customtype'])) {
                throw new \Magento\Framework\Exception\LocalizedException(__('File validation failed.'));
            }

            $result = $fileUploader->save($this->getUploadDir());
            $baseUrl = $this->_backendUrl->getBaseUrl(['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]);
            $result['id'] = $this->cmsTopBrandsImages->idEncode($result['file']);
            $result['image_url'] = $baseUrl . $this->getFilePath(self::UPLOAD_DIR, $result['file']);
        } catch (\Exception $e) {
            $result = [
                'error' => $e->getMessage(),
                'errorcode' => $e->getCode()
            ];
        }
        return $this->resultJsonFactory->create()->setData($result);
    }

    private function getUploadDir()
    {
        return $this->mediaDirectory->getAbsolutePath(self::UPLOAD_DIR);
    }
}
