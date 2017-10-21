<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */
 
/**
 * SQL setup
 */
class Sr_VersionCheck_Model_Resource_Module_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Set location of the resource file
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('sr_version_check/module');
    }
}
