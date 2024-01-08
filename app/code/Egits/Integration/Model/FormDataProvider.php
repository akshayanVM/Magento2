<?php

namespace Egits\Integration\Model;

use Egits\Integration\Model\ResourceModel\Post\CollectionFactory;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;

class FormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

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
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $id = $this->request->getParam('id');

        if ($id !== null) {
            $items = $this->collection->addFieldToFilter('id', $id)->getItems();
            foreach ($items as $item) {
                $this->_loadedData[$item->getId()] = $item->getData();
            }
        }

        return $this->_loadedData;
    }
}
