<?php

namespace Akshay\Module\Model;

use Magento\Framework\UrlInterface;
use Magento\Framework\Filesystem;
use Akshay\Module\Helper\Data as ModuleHelper;

class Image
{
    /**
     * media sub folder
     * @var string
     */
    protected $subDir = 'custom_folder_2/'; //actual path is pub/media/webkul/image/

    protected $moduleHelper;

    /**
     * url builder
     *
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Filesystem
     */
    protected $fileSystem;

    protected $imageFullUrl;

    /**
     * @param UrlInterface $urlBuilder
     * @param Filesystem $fileSystem
     * @param ModuleHelper $moduleHelper
     */
    public function __construct(
        UrlInterface $urlBuilder,
        Filesystem $fileSystem,
        ModuleHelper $moduleHelper
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->fileSystem = $fileSystem;
        $this->moduleHelper = $moduleHelper;
    }

    public function setImageUrl($url)
    {
        $this->imageFullUrl = $url;
    }

    /**
     * get images base url
     *
     * @return string
     */
    public function getBaseUrl()
    {
        // Uncommented lines of code here if needed

        $imageURL = $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . $this->subDir;

        return $imageURL;
    }
}
