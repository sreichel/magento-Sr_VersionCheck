<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

/**
 * Download URL column renderer
 */
class Sr_VersionCheck_Block_Renderer_Url_Download extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Decorate stability column values
     *
     * @param  Varien_Object $row   Current row
     * @return string        Cell content
     */
    public function render(Varien_Object $row)
    {
        return sprintf('<a href=%s target="_blank" download>%s</a>',
            $this->helper('sr_version_check')->getConnectExtensionDownloadUrl($row->getName(), $row->getVersion()),
            $this->__('Download')
        );
    }
}
