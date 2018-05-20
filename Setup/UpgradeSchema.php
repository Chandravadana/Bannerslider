<?php

namespace Chandu\Bannerslider\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;


class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->addTableIndex($setup);
        }

        $setup->endSetup();
    }

    /**
     * Adding Indexing for 'title' and 'url' to 'banner_slider' table
     *
     * @param SchemaSetupInterface $setup
     * @return void
     */
    private function addTableIndex(SchemaSetupInterface $setup)
    {

        $setup->getConnection()->addIndex(
            $setup->getTable('banner_slider'),
            $setup->getIdxName('banner_slider',
                ['title', 'url'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['title', 'url'],
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
        );
    }

}
