<?php

namespace Chandu\Bannerslider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Create table 'banner_slider'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('banner_slider'))
            ->addColumn(
                'banner_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Banner ID'
            )
            ->addColumn(
                'isactive',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                null,
                ['default' => true],
                'is Active'
            )
            ->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'title'
            )
            ->addColumn(
                'url',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'URL'
            )
            ->addColumn(
                'bannerimage',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'Banner Image'
            )->setComment("Banner Slider table");
        $setup->getConnection()->createTable($table);
    }
}