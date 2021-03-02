<?php

namespace Perspective\HelloWorld\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer =  $setup;
        $installer->startSetup();

        if(version_compare($context->getVersion(), '1.0.4', '<')){
            $installer->getConnection()->addColumn(
                $installer->getTable('helloworld_post'),'Category',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => false,
                    'length' => '255',
                    'comment' => 'test',
                    'after' => 'status'
                ]
            );
        }
        $installer->endSetup();
    }
}
