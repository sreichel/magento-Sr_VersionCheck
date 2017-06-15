<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */
 
/**
 * SQL setup
 */
class Sr_VersionCheck_Model_Modules extends Mage_Core_Model_Abstract
{
    const MAGENTO_CONNECT_URL = 'http://connect20.magentocommerce.com/community/{key}/releases.xml';

    /**
     * Set location of the resource file
     */
    public function _construct()
    {
        $this->_init('sr_version_check/modules');
    }
}
