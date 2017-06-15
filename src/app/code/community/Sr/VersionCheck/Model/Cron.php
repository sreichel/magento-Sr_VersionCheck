<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

class Sr_VersionCheck_Model_Cron
{
    public function checkModuleVersion()
    {
        $collection = Mage::getModel('sr_version_check/modules')->getCollection()
            ->addFieldToFilter('url', array('neq' => null))
            ->addFieldToFilter('url', array('neq' => ''));

        foreach ($collection as $module) {
            $module->setLatestVersion(Mage::helper('sr_version_check')->getConnectVersion($module));
        }
        $collection->save();
    }
}
