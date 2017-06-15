<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

class Sr_VersionCheck_Helper_Data extends Mage_Core_Helper_Abstract
{
    const MAGENTO_CONNECT_URL = 'http://connect20.magentocommerce.com/community/{key}/releases.xml';

    protected $_moduleName = 'Sr_VersionCheck';

    public function getConnectVersion(Sr_VersionCheck_Model_Modules $module)
    {
        $out = null;

        try {
            $url = str_replace('{key}', $module->getUrl(), self::MAGENTO_CONNECT_URL);
            $xml = new SimpleXMLElement(file_get_contents($url));
            $out = (string) $xml->r[0]->v;
        } catch (Exception $e) {
        }

        return $out;
    }
}
