<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

class Sr_VersionCheck_Block_Adminhtml_Module_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function _construct()
    {
        parent::_construct();

        $this->setId('moduleGrid');
        $this->setDefaultSort('name');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sr_version_check/module')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('name', array(
            'header'         => $this->_getHelper()->__('Name'),
            'index'          => 'name',
        ));

        $this->addColumn('current_version', array(
            'header'         => $this->_getHelper()->__('Current Version'),
            'width'          => '100px',
            'filter'         => false,
            'sortable'       => false,
            'index'          => 'current_version',
            'renderer'       => 'sr_version_check/renderer_version_current'
        ));

        $this->addColumn('latest_version', array(
            'header'         => $this->_getHelper()->__('Latest Version'),
            'width'          => '100px',
            'filter'         => false,
            'sortable'       => false,
            'index'          => 'latest_version',
            'renderer'       => 'sr_version_check/renderer_version_latest'
        ));

        $this->addColumn('url', array(
            'header'         => $this->_getHelper()->__('MagentoConnect URL'),
            'filter'         => false,
            'sortable'       => false,
            'index'          => 'url',
        ));

        /*
        $this->addColumn('type', array(
            'header'         => $this->_getHelper()->__('Type'),
            'width'          => '60px',
            'index'          => 'type',
        ));
        */

        $this->addColumn('download', array(
            'header'         => $this->_getHelper()->__('Download'),
            'width'          => '150px',
            'filter'         => false,
            'sortable'       => false,
            'renderer'       => 'sr_version_check/renderer_url_download'
        ));

        $this->addColumn('edit', array(
            'header'         => $this->_getHelper()->__('Edit'),
            'width'          => '100px',
            'filter'         => false,
            'sortable'       => false,
            'renderer'       => 'sr_version_check/renderer_url_edit'
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
