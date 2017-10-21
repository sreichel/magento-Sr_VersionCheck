<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

class Sr_VersionCheck_Adminhtml_InstalledmodulesController extends Mage_Adminhtml_Controller_Action
{
    protected $_module;

    public function preDispatch()
    {
        parent::preDispatch();

        $this->_title($this->__('System'))->_title($this->__('Installed Modules'));
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
 
    public function newAction()
    {
        $model      = Mage::getModel('sr_version_check/module');
        $collection = $model->getCollection();

        $urls       = array_combine($collection->getColumnValues('name'), $collection->getColumnValues('url'));

        $resource   = $model->getResource();
        $connection = $resource->getReadConnection();
        $connection->truncateTable($resource->getMainTable());
        $connection->changeTableAutoIncrement($resource->getMainTable(), 1);

        $modules = array();
        $io      = new Varien_Io_File();
        $config  = Mage::getConfig();

        foreach ($config->getNode('modules')->children() as $moduleName => $item) {
            $active = ($item->active == 'true') ? true : false;
            if (!$active) {
                continue;
            }

            $codePool = (string) $config->getModuleConfig($item->getName())->codePool;
            if ($codePool === 'core') {
                continue;
            }

            $path = $config->getOptions()->getCodeDir() . DS . $codePool . DS . uc_words($item->getName(), DS);
            if (!$io->fileExists($path . '/etc/config.xml')) {
                continue;
            }

            $version = (string)$config->getModuleConfig($item->getName())->version;

            $module = clone $model;
            $module->setData(array(
                'id'                => null,
                'name'              => $item->getName(),
                'current_version'   => $version,
                'url'               => isset($urls[$item->getName()]) ? $urls[$item->getName()] : null,
            ));

            if (isset($urls[$item->getName()])) {
                $module->setLatestVersion(Mage::helper('sr_version_check')->getLatestVersion($module));
            }

            try {
                $collection->addItem($module);
            } catch (Mage_Core_Exception $e) {
                Mage::log($e->getMessage());
            }
        }

        try {
            $collection->save();
        } catch (Mage_Core_Exception $e) {
            Mage::log($e->getMessage());
        }

        $this->_redirect('*/*/');
    }
 
    public function editAction()
    {
        Mage::register('current_module', $this->_getModule());
        $this->_title($this->__('Edit: %s', $this->_getModule()->getName()));

        $this->loadLayout();
        $this->renderLayout();
    }
 
    public function saveAction()
    {
        $module = $this->_getModule();
        $postData = array_map('trim', $this->getRequest()->getParam('module'));
        $module->addData($postData);

        if (!empty($postData)) {
            $module->setLatestVersion(Mage::helper('sr_version_check')->getLatestVersion($module));
        }

        $module->save();

        $this->_getSession()->addSuccess(
            $this->__('Saved module: %s', $module->getName())
        );

        $this->_redirect('*/installedmodules');

        return $this;
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('sr_version_check/adminhtml_module_grid')->toHtml()
        );
    }

    /**
     * @return Sr_VersionCheck_Model_Module
     */
    protected function _getModule()
    {
        if (isset($this->_module)) {
            return $this->_module;
        }

        $module = Mage::getModel('sr_version_check/module');
        if ($id = $this->getRequest()->getParam('module_id')) {
            $module->load($id);
        }
        $this->_module = $module;
        return $this->_module;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sr_version_check/module');
    }
}
