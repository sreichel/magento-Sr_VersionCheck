<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

$installer = $this;

$installer->startSetup();

$this->getConnection()->changeColumn($this->getTable('connect_modules'), 'modules_id', 'module_id', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'identity'  => true,
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
));

if (!$installer->tableExists('sr_version_check/backup')) {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('sr_version_check/backup'))
        ->addColumn('module_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
            ), 'Id')
        ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'  => false,
            ), 'Name')
        ->addColumn('version', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'  => false,
            ), 'Version')
        ->addColumn('stability', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'  => false,
            ), 'Stability')
        ->addColumn('license', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'  => false,
            ), 'License')
        ->addColumn('summary', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
            'nullable'  => false,
            ), 'Summary')
        ->addColumn('author', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'  => false,
            ), 'Author')
        ->addColumn('date', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
            'nullable'  => true,
            ), 'Date');

    $installer->getConnection()->createTable($table);
}

$installer->endSetup();
