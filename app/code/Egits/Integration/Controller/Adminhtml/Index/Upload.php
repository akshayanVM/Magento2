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
    public const UPLOAD_DIR = 'TopBrands';

    public const ADMIN_RESOURCE = 'Magento_Backend::content';

    /**
     * This holds the directory list
     *
     * @var Filesystem\DirectoryList
     */
    private $directoryList;
    /**
     * This holds the result json factory
     *
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $resultJsonFactory;
    /**
     * This holds the uploader factory instance
     *
     * @var \Magento\Framework\File\UploaderFactory
     */
    private $uploaderFactory;
    /**
     * This holds the store manager instance
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;
    /**
     * This holds the top brands images
     *
     * @var \Magento\Cms\Helper\Wysiwyg\Images
     */
    private $cmsTopBrandsImages;
    /**
     * This holds the media directory
     *
     * @var Filesystem\Directory\WriteInterface
     */
    private $mediaDirectory;

    /**
     * Upload constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\File\UploaderFactory $uploaderFactory
     * @param Filesystem\DirectoryList $directoryList
     * @param \Magento\Cms\Helper\Wysiwyg\Images $cmsTopBrandsImages
     * @param Filesystem|null $filesystem
     * @throws \Magento\Framework\Exception\FileSystemException
     */
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

    /**
     * This function returns the file path
     *
     * @param string $path
     * @param string $imageName
     * @return string
     */
    private function getFilePath($path, $imageName)
    {
        return rtrim($path, '/') . '/' . ltrim($imageName, '/');
    }

    /**
     * This function is the default execute method
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
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
            if (!$fileUploader->checkMimeType(['image/png', 'image/jpeg',
                'image/gif', 'image/customtype'])) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('File validation failed.')
                );
            }

            $result = $fileUploader->save($this->getUploadDir());
            $baseUrl = $this->_backendUrl->getBaseUrl(
                ['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]
            );
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

    /**
     * This function returns the directory for uploading the image
     *
     * @return string
     */
    private function getUploadDir()
    {
        return $this->mediaDirectory->getAbsolutePath(self::UPLOAD_DIR);
    }
}
