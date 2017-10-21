<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

/**
 * Extension stability column renderer
 */
class Sr_VersionCheck_Block_Renderer_Stability extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Decorate stability column values
     *
     * @param  Varien_Object $row   Current row
     * @return string        Cell content
     */
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        return "<span class=\"grid-severity-{$this->getLabelByStability($value)}\"><span>{$value}</span></span>";
    }

    /**
     * Get CSS class by extensions stability
     *
     * @param string $stability
     * @return string
     */
    public function getLabelByStability($stability)
    {
        $labels = array(
            'stable' => 'notice',
            'beta'   => 'minor',
            'alpha'  => 'major'
        );

        if (isset($labels[$stability])) {
            return $labels[$stability];
        }

        return 'critical';
    }
}
