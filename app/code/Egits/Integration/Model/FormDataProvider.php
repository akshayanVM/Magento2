<?php

namespace Egits\Integration\Model;

use Egits\Integration\Model\ResourceModel\Post\CollectionFactory;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;

class FormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var $_loadedData
     */
    protected $_loadedData;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * FormDataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param \Magento\Framework\App\RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $employeeCollectionFactory->create();
        $this->request = $request;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {

        // This data provider is responsible for populating the data into the input
        // fields when we click the edit button.
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $id = $this->request->getParam('id');

        if ($id !== null) {
            $items = $this->collection->addFieldToFilter('id', $id)->getItems();
            foreach ($items as $item) {
                $this->_loadedData[$item->getId()] = $item->getData();
                // Ensure 'image_url' is part of the loaded data
                $this->_loadedData[$item->getId()]['image_url'] = $item->getImageUrl();
                // Replace 'getImageUrl()' with the actual method to get image URL
            }
        }
        return $this->_loadedData;
    }
}
