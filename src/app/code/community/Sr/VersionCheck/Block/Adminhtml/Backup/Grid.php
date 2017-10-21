<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

class Sr_VersionCheck_Block_Adminhtml_Backup_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function _construct()
    {
        parent::_construct();

        $this->setId('backupGrid');
        $this->setDefaultSort('name');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sr_version_check/backup')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('module_id', array(
            'header'         => $this->_getHelper()->__('ID'),
            'width'          => '50px',
            'index'          => 'module_id',
        ));

        $this->addColumn('name', array(
            'header'         => $this->_getHelper()->__('Name'),
            'index'          => 'name',
        ));

        $this->addColumn('version', array(
            'header'         => $this->_getHelper()->__('Version'),
            'width'          => '100px',
            'filter'         => false,
            'sortable'       => false,
            'index'          => 'version',
            'renderer'       => 'sr_version_check/renderer_version_current'
        ));

        $this->addColumn('stability', array(
            'header'         => $this->_getHelper()->__('Stability'),
            'width'          => '100px',
            'index'          => 'stability',
            'renderer'       => 'sr_version_check/renderer_stability'
        ));

        $this->addColumn('license', array(
            'header'         => $this->_getHelper()->__('License'),
            'index'          => 'license',
        ));

        $this->addColumn('summary', array(
            'header'         => $this->_getHelper()->__('Summary'),
            'sortable'       => false,
            'index'          => 'summary',
        ));

        $this->addColumn('author', array(
            'header'         => $this->_getHelper()->__('Author'),
            'index'          => 'author',
        ));

        $this->addColumn('date', array(
            'header'         => $this->_getHelper()->__('Date'),
            'filter'         => false,
            'index'          => 'date',
        ));

        $this->addColumn('download', array(
            'header'         => $this->_getHelper()->__('Download'),
            'width'          => '100px',
            'filter'         => false,
            'sortable'       => false,
            'renderer'       => 'sr_version_check/renderer_url_download'
        ));

        return parent::_prepareColumns();
    }

    /**
     * Get row edit url
     *
     * @param  Sr_VersionCheck_Model_Module $row Current row
     * @return string|boolean Row url | false = no url
     */
    public function getRowUrl($item)
    {
        return false;
    }

    /**
     *
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    /**
     * Wrapper
     *
     * @return Sr_VersionCheck_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('sr_version_check');
    }
}
