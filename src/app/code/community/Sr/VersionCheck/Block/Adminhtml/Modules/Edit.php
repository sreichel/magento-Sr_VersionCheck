<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */
 
class Sr_VersionCheck_Block_Adminhtml_Modules_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'modules_id';
        // $this->_controller = 'adminhtml_connectmodules';
        $this->_controller = 'adminhtml_modules';
        $this->_blockGroup = 'sr_version_check';
        $this->_headerText = Mage::helper('core')->__('Edit Module');

        parent::__construct();

        $this->_removeButton('reset');
    }

    /**
     *
     */
    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save');
    }
}
