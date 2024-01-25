<?php

namespace Egits\Integration\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Egits\Integration\Model\PostFactory;

class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    public const NAME = 'thumbnail';

    public const ALT_FIELD = 'name';

    /**
     * This variable holds an instance of the image helper
     *
     * @var $imageHelper
     */
    protected $imageHelper;

    /**
     * This variable holds an instance of the URL builder
     *
     * @var $urlBuilder
     */
    protected $urlBuilder;
    /**
     * This is an instance of the post factory class
     *
     * @var $postFactory
     */
    protected $postFactory;

    /**
     * Thumbnail constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Egits\Integration\Model\Image $imageHelper
     * @param \Egits\Integration\Model\Post $postFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Egits\Integration\Model\Image $imageHelper,
        \Egits\Integration\Model\Post $postFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->imageHelper = $imageHelper;
        $this->urlBuilder = $urlBuilder;
        $this->postFactory = $postFactory;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        // $fullUrlFromDB = $this->postFactory->getImageUrl();
        // var_dump($dataSource);
        // dd();
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                // var_dump($item['photo']);
                // dd();
                $filename = 'File-1672040965.png';
                $item[$fieldName . '_src'] = $item['image_url'];
                $item[$fieldName . '_alt'] = $this->getAlt($item) ?: $filename;
                $item[$fieldName . '_orig_src'] = $item['image_url'];
            }
        }
        return $dataSource;
    }

    /**
     * This function is used to check and update the field
     *
     * @param array $row
     * @return null|string
     */
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return isset($row[$altField]) ? $row[$altField] : null;
    }
}
