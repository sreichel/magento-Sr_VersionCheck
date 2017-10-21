<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

$installer = $this;

$installer->startSetup();

if (!$installer->tableExists('sr_version_check/module')) {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('sr_version_check/module'))
        ->addColumn('modules_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
            ), 'Id')
        ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'  => false,
            ), 'Name')
        ->addColumn('current_version', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'  => true,
            ), 'Current Version')
        ->addColumn('latest_version', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'  => true,
            ), 'Latest Version')
        ->addColumn('type', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'nullable'  => true,
            ), 'Module Type')
        ->addColumn('url', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'  => true,
            ), 'URL')
        ->addColumn('info', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable'  => true,
            ), 'Information');

    $installer->getConnection()->createTable($table);
}

$installer->endSetup();
