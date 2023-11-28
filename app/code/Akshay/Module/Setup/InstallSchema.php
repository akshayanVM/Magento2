<?php

namespace Akshay\Module\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable('customer_details');
        // $tableName2 = $installer->getTable('customer_address');
        //Check for the existence of the table
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'customer_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Name'
                )
                ->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Email'
                )
                ->addColumn(
                    'photo',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Photo'
                )
                //Set comment for magetop_blog table
                ->setComment('Custom Customer Table')
                //Set option for magetop_blog table
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);

            // $table2 = $installer->getConnection()
            //     ->newTable($tableName2)
            //     ->addColumn(
            //         'address_id',
            //         Table::TYPE_INTEGER,
            //         null,
            //         [
            //             'identity' => true,
            //             'unsigned' => true,
            //             'nullable' => false,
            //             'primary' => true
            //         ],
            //         'ID'
            //     )
            //     ->addColumn(
            //         'address',
            //         Table::TYPE_TEXT,
            //         null,
            //         ['nullable' => false, 'default' => ''],
            //         'Address'
            //     )
            //     ->addColumn(
            //         'customer_id',
            //         \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            //         null,
            //         ['nullable' => true],
            //         'Foreign Key to First Table Entity ID'
            //     )->addForeignKey(
            //         $installer->getFkName(
            //             'akshay_module_second_table',
            //             'customer_id',
            //             'akshay_module_first_table',
            //             'address_id'
            //         ),
            //         'customer_id',
            //         $installer->getTable('akshay_module_first_table'),
            //         'address_id',
            //         \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            //     )

            //     //Set comment for magetop_blog table
            //     ->setComment('Custom Address Table')
            //     //Set option for magetop_blog table
            //     ->setOption('type', 'InnoDB')
            //     ->setOption('charset', 'utf8');
            // $installer->getConnection()->createTable($table2);
        }
        $installer->endSetup();
    }
}
