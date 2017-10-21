<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

class Sr_VersionCheck_Block_Adminhtml_Module extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Class constructor
     */
    public function _construct()
    {
        $this->_controller = 'adminhtml_installedmodules';
        $this->_blockGroup = 'sr_version_check';
        $this->_headerText = Mage::helper('sr_version_check')->__('Installed Modules');
        $this->_addButtonLabel = Mage::helper('sr_version_check')->__('Refresh');
 
        parent::_construct();
    }
    
    protected function _prepareLayout()
    {
        return Mage_Adminhtml_Block_Widget_Container::_prepareLayout();
    }
}
