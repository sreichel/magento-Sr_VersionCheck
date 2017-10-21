<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

class Sr_VersionCheck_Helper_Data extends Mage_Core_Helper_Abstract
{
    const CONNECT_PACKAGES_URL = 'http://connect20.magentocommerce.com/community/packages.xml';
    const CONNECT_RELEASES_URL = 'http://connect20.magentocommerce.com/community/{key}/releases.xml';
    const CONNECT_DETAILS_URL  = 'http://connect20.magentocommerce.com/community/{key}/{version}/package.xml';
    const CONNECT_DOWNLOAD_URL = 'http://connect20.magentocommerce.com/community/{key}/{version}/{key}-{version}.tgz';

    protected $_moduleName = 'Sr_VersionCheck';

    /**
     * Get last version of an extension
     *
     * @param $module Sr_VersionCheck_Model_Module
     * @return string|null
     */
    public function getLatestVersion(Sr_VersionCheck_Model_Module $module)
    {
        $url = $this->getConnectExtensionReleasesUrl($module->getUrl());
        if ($xml = $this->_getConnectResponseXml($url)) {
            return (string) $xml->r[0]->v;
        }
    }

    /**
     * Get connect XML
     *
     * @param $uri Connect URL
     * @return SimpleXMLElement|null
     */
    private function _getConnectResponseXml($uri)
    {
        if (filter_var($uri, FILTER_VALIDATE_URL)) {
            $client = new Zend_Http_Client();
            $client->setUri($uri);
            $request = $client->request();
            if ($request->isSuccessful()) {
                return new SimpleXMLElement($request->getBody());
            }
        }
    }

    /**
     * Get connec packages URL
     *
     * @return string
     */
    public function getConnectPackagesUrl()
    {
        return self::CONNECT_PACKAGES_URL;
    }

    /**
     * Get extension releases URL
     *
     * @param $key string Extension key
     * @return string
     */
    public function getConnectExtensionReleasesUrl($key)
    {
        $url = str_replace('{key}', $key, self::CONNECT_RELEASES_URL);
    }

    /**
     * Get extension details URL
     *
     * @param $key string Extension key
     * @param $version string Extension version
     * @return string
     */
    public function getConnectExtensionDetailsUrl($key, $version)
    {
        return str_replace(array('{key}', '{version}'), array($key, $version), self::CONNECT_DETAILS_URL);
    }

    /**
     * Get extension download URL
     *
     * @param $key string Extension key
     * @param $version string Extension version
     * @return string
     */
    public function getConnectExtensionDownloadUrl($key, $version)
    {
        return str_replace(array('{key}', '{version}'), array($key, $version), self::CONNECT_DOWNLOAD_URL);
    }
}
