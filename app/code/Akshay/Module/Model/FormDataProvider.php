<?php

namespace Akshay\Module\Model;

use Akshay\Module\Model\ResourceModel\Post\CollectionFactory;

class FormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $employeeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return [];
        // if (isset($this->loadedData)) {
        //     return $this->loadedData;
        // }

        // $items = $this->collection->getItems();
        // $this->loadedData = array();
        // /** @var Customer $customer */
        // foreach ($items as $contact) {
        //     // notre fieldset s'apelle "contact" d'ou ce tableau pour que magento puisse retrouver ses datas :
        //     $this->loadedData[$contact->getId()]['contact'] = $contact->getData();
        // }


        // return $this->loadedData;

    }
}
