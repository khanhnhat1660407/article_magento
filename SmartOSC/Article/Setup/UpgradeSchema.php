<?php
namespace SmartOSC\Article\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;

        $installer->startSetup();

        if(version_compare($context->getVersion(), '1.3.0', '<')) {
            if (!$installer->tableExists('sm_article')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('sm_article')
                )
                    ->addColumn(
                        'article_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'Article ID'
                    )
                    ->addColumn(
                        'title',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Article Name'
                    )
                    ->addColumn(
                        'content',
                        Table::TYPE_TEXT,
                        '100K',
                        ['nullable => false'],
                        'Article content'
                    )
                    ->addColumn(
                        'image',
                        Table::TYPE_TEXT,
                        '1M',
                        [],
                        'Article image'
                    )
                    ->addColumn(
                        'created_at',
                        Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                        'Created At'
                    )->addColumn(
                        'updated_at',
                        Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                        'Updated At')
                    ->setComment('Article Table');
                $installer->getConnection()->createTable($table);

                $installer->getConnection()->addIndex(
                    $installer->getTable('sm_article'),
                    $setup->getIdxName(
                        $installer->getTable('sm_article'),
                        [ 'title', 'content'],
                        AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['title', 'content'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }
        }

        $installer->endSetup();
    }
}