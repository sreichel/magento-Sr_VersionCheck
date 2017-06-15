<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

class Sr_VersionCheck_Block_Adminhtml_Modules_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('module_edit_form');
    }

    /**
     *
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post')
        );

        $form->setData('use_container', true);
        $this->setForm($form);

        $formData = $this->_getModule()->getData();

        $this->_addBaseFieldset();

        $form->setValues($formData);

        return parent::_prepareForm();
    }

    /**
     * @return Sr_VersionCheck_Model_Modules
     */
    protected function _getModule()
    {
        return Mage::registry('current_module');
    }

    /**
     * Add form fields
     */
    protected function _addBaseFieldset()
    {
        $fieldset = $this->getForm()->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('sr_version_check')->__('General'),
        ));

        $fieldset->addField('modules_id', 'hidden', array(
            'name'      => 'module[modules_id]',
        ));

        $fieldset->addField('name', 'text', array(
            'name'      => 'module[name]',
            'readonly'  => true,
            'label'     => Mage::helper('sr_version_check')->__('Name'),
        ));

        $fieldset->addField('url', 'text', array(
            'name'      => 'module[url]',
            'label'     => Mage::helper('sr_version_check')->__('MagentoConnect URL'),
        ));
    }
}
