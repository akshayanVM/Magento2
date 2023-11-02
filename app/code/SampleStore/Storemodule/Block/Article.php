<?php

namespace SampleStore\Storemodule\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \SampleStore\Storemodule\Model\ResourceModel\View\CollectionFactory as ViewCollectionFactory;
use SampleStore\Storemodule\Model\View;

class Article extends Template
{
    /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
    protected $_viewCollectionFactory = null;

    /**
     * Constructor
     *
     * @param Context $context
     * @param ViewCollectionFactory $viewCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        ViewCollectionFactory $viewCollectionFactory,
        array $data = []
    ) {
        $this->_viewCollectionFactory  = $viewCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return Post[]
     */
    public function getCollection()
    {
        /** @var ViewCollection $viewCollection */
        $viewCollection = $this->_viewCollectionFactory->create();
        $viewCollection->addFieldToSelect('*')->load();
        return $viewCollection->getItems();
    }

    /**
     * For a given post, returns its url
     * @param Post $post
     * @return string
     */
    public function getArticleUrl(View $view)
    {
        return '/Storemodule/view/id/' . $view->getId();
        //return $this->getUrl('blog/index/view/' . $viewId, ['_secure' => true]);
    }
}
