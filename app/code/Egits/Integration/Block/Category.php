<?php

namespace Egits\Integration\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

class Category extends Template
{
    protected $CategoryCollection;
    public function __construct(
                                Template\Context $context,
                                CollectionFactory $CategoryCollection,
                                array $data = [])
    {
        $this->CategoryCollection = $CategoryCollection;
        parent::__construct($context, $data);
    }
    public function getDataForPHTML(){
        $Collection = $this->CategoryCollection->create();
        return $Collection->getData()[0]['entity_id'];
    }

}
