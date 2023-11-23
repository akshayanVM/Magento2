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
    protected $subDir = 'custom_folder/'; //actual path is pub/media/webkul/image/


    protected $moduleHelper;

    /**
     * url builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $fileSystem;

    protected $imageFullUrl;

    /**
     * @param UrlInterface $urlBuilder
     * @param Filesystem $fileSystem
     */
    public function __construct(
        UrlInterface $urlBuilder,
        Filesystem $fileSystem,
        ModuleHelper $moduleHelper,
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
        // $fullFile = $this->execute();
        // var_dump($fullFile);
        // dd();
        // var_dump($this->$imageFullUrl);
        // dd();

        // $valueFromController = $this->moduleHelper->getValueToPass();
        // var_dump($valueFromController);
        // dd();

        $imageURL = $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . $this->subDir;
        // var_dump($imageURL);
        // dd();
        return $imageURL;
    }
}
