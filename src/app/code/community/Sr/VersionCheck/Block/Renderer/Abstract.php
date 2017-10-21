<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

/**
 * Extension version column renderer
 */
abstract class Sr_VersionCheck_Block_Renderer_Abstract extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Decorate the version column values
     *
     * @param  string        $value Check result
     * @param  Varien_Object $row   Current row
     * @return string        Cell content
     */ 
    public function decorateVersion($a, $b)
    {
        if (version_compare($a, $b, '<')) {
            return '<span class="grid-severity-critical"><span>' . $a . '</span></span>';
        } else {
            return '<span class="grid-severity-notice"><span>' . $a . '</span></span>';
        }
    }
}
