<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */
 
/**
 * SQL setup
 */
class Sr_VersionCheck_Model_Resource_Module extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Set DB tables primary key
     */
    public function _construct()
    {
        $this->_init('sr_version_check/module', 'module_id');
    }
}
