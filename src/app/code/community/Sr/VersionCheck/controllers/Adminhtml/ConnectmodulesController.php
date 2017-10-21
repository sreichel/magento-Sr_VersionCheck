<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

class Sr_VersionCheck_Adminhtml_ConnectmodulesController extends Mage_Adminhtml_Controller_Action
{
    protected $_module;

    public function preDispatch()
    {
        parent::preDispatch();

        $this->_title($this->__('System'))->_title($this->__('Connect Modules'));
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
 
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('sr_version_check/adminhtml_backup_grid')->toHtml()
        );
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sr_version_check/module_backup');
    }
}
