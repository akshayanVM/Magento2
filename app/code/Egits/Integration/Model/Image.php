<?php

namespace Egits\Integration\Model;

use Magento\Framework\UrlInterface;
use Magento\Framework\Filesystem;

// use Egits\Integration\Helper\Data as ModuleHelper;

class Image
{
    /**
     * Media sub folder
     * @var string
     */
    protected $subDir = 'TopBrands/'; //actual path is pub/media/webkul/image/

    /**
     * Helper
     *
     * @var $moduleHelper
     */
    protected $moduleHelper;

    /**
     * Store the built url
     *
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Filesystem
     */
    protected $fileSystem;

    /**
     * Full url for the image
     *
     * @var $imageFullUrl
     */
    protected $imageFullUrl;

    /**
     * Constructor function
     *
     * @param UrlInterface $urlBuilder
     * @param Filesystem $fileSystem
     */
    public function __construct(
        UrlInterface $urlBuilder,
        Filesystem $fileSystem
        // ModuleHelper $moduleHelper
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->fileSystem = $fileSystem;
        // $this->moduleHelper = $moduleHelper;
    }

    /**
     * Image url setter
     *
     * @param string $url
     */
    public function setImageUrl($url)
    {
        $this->imageFullUrl = $url;
    }

    /**
     * Get images base url
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
