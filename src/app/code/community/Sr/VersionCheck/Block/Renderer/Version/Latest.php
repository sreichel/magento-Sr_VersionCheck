<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

/**
 * Extension stability column renderer
 */
class Sr_VersionCheck_Block_Renderer_Version_Latest extends Sr_VersionCheck_Block_Renderer_Abstract
{
    /**
     * Decorate the version column values
     *
     * @param  string        $value Check result
     * @param  Varien_Object $row   Current row
     * @return string        Cell content
     */
    public function render(Varien_Object $row)
    {
        if ($value = $row->getData($this->getColumn()->getIndex())) {
            return $this->decorateVersion($value, $row->getCurrentVersion());
        }
    }
}
