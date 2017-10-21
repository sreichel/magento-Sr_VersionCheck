<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */
 
/**
 * SQL setup
 */
class Sr_VersionCheck_Model_Module extends Mage_Core_Model_Abstract
{
    protected $_eventPrefix = 'sr_version_check_module';

    /**
     * Set location of the resource file
     */
    public function _construct()
    {
        $this->_init('sr_version_check/module');
    }
}
