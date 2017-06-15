<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

class Sr_VersionCheck_Block_Adminhtml_Modules_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    const MAGENTO_CONNECT_DOWNLOAD_URL = 'http://connect20.magentocommerce.com/community/{key}/{version}/{key}-{version}.tgz';

    public function _construct()
    {
        parent::_construct();

        $this->setId('modulesGrid');
        $this->setDefaultSort('name');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sr_version_check/modules')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('name', array(
            'header'         => Mage::helper('sr_version_check')->__('Name'),
            'index'          => 'name',
        ));

        $this->addColumn('current_version', array(
            'header'         => Mage::helper('sr_version_check')->__('Current Version'),
            'width'          => '100px',
            'filter'         => false,
            'sortable'       => false,
            'index'          => 'current_version',
            'frame_callback' => array($this, 'decorateCurrentVersion')
        ));

        $this->addColumn('latest_version', array(
            'header'         => Mage::helper('sr_version_check')->__('Latest Version'),
            'width'          => '100px',
            'filter'         => false,
            'sortable'       => false,
            'index'          => 'latest_version',
            'frame_callback' => array($this, 'decorateLatestVersion')
        ));

        $this->addColumn('url', array(
            'header'         => Mage::helper('sr_version_check')->__('MagentoConnect URL'),
            'filter'         => false,
            'sortable'       => false,
            'index'          => 'url',
        ));

        /*
        $this->addColumn('type', array(
            'header'         => Mage::helper('sr_version_check')->__('Type'),
            'width'          => '60px',
            'index'          => 'type',
        ));
        */

        $this->addColumn('download', array(
            'header'         => Mage::helper('sr_version_check')->__('Download'),
            'width'          => '150px',
            'filter'         => false,
            'sortable'       => false,
            'frame_callback' => array($this, 'decorateDownloadUrl')
        ));

        $this->addColumn('edit', array(
            'header'         => Mage::helper('sr_version_check')->__('Edit'),
            'width'          => '100px',
            'filter'         => false,
            'sortable'       => false,
            'frame_callback' => array($this, 'decorateEditUrl')
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
     * Decorate the version column values
     *
     * @param  string        $value Check result
     * @param  Varien_Object $row   Current row
     * @return string        Cell content
     */
    public function decorateCurrentVersion($value, $row)
    {
        if (!$latestVersion = $row->getLatestVersion()) {
            $latestVersion = 0;
        }
        return $this->_decorateVersion($value, $latestVersion);
    }

    /**
     * Decorate the version column values
     *
     * @param  string        $value Check result
     * @param  Varien_Object $row   Current row
     * @return string        Cell content
     */
    public function decorateLatestVersion($value, $row)
    {
        if ($value) {
            return $this->_decorateVersion($value, $row->getCurrentVersion());
        }
    }

    /**
     * Decorate the version column values
     *
     * @param  string        $value Check result
     * @param  Varien_Object $row   Current row
     * @return string        Cell content
     */
    public function _decorateVersion($a, $b)
    {
        if (version_compare($a, $b, '<')) {
            return '<span class="grid-severity-critical"><span>' . $a . '</span></span>';
        } else {
            return '<span class="grid-severity-notice"><span>' . $a . '</span></span>';
        }
    }

    /**
     * Decorate the download url column values
     *
     * @param  string        $value Check result
     * @param  Varien_Object $row   Current row
     * @return string        Cell content
     */
    public function decorateDownloadUrl($value, $row)
    {
        if (!$latestVersion = $row->getLatestVersion()) {
            return '';
        }

        $url = str_replace(
            array('{key}', '{version}'),
            array($row->getUrl(), $latestVersion),
            self::MAGENTO_CONNECT_DOWNLOAD_URL
        );

        return sprintf('<a href=%s download>%s v%s</a>', $url, $this->__('Download'), $latestVersion);
    }

    /**
     * Decorate the edit url column values
     *
     * @param  string        $value Check result
     * @param  Varien_Object $row   Current row
     * @return string        Cell content
     */
    public function decorateEditUrl($value, $row, $column, $isExport)
    {
        return sprintf('<a href=%s>%s</a>', $this->getUrl('*/*/edit', array('module_id' => $row->getId())), $this->__('Edit'));
    }
}
