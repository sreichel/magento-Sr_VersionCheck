<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

/**
 * Edit URL column renderer
 */
class Sr_VersionCheck_Block_Renderer_Url_Edit extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Decorate the edit url column values
     *
     * @param  Varien_Object $row   Current row
     * @return string        Cell content
     */
    public function render(Varien_Object $row)
    {
        return sprintf('<a href=%s>%s</a>',
            $this->getUrl('*/*/edit', array('module_id' => $row->getId())),
            $this->__('Edit')
        );
    }
}
