<?php

namespace Egits\Integration\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    // protected $_idFieldName = 'post_id';
    // protected $_eventPrefix = 'mageplaza_helloworld_post_collection';
    // protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {

        $this->_init('Egits\Integration\Model\Post::class', 'Egits\Integration\Model\ResourceModel\Post::class');
    }

    // public function addTable2Join()
    // {
    //     $this->getSelect()->joinLeft(
    //         ['table2' => $this->getTable('table2')],
    //         'main_table.table1_id = table2.table1_id',
    //         ['table2_field']
    //     );

    //     return $this;
    // }
}
