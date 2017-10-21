<?php
/**
 * @category    Sr
 * @package     Sr_VersionCheck
 * @author      Sven Reichel <github-sr@hotmail.com>
 */

/**
 * Extension stability column renderer
 */
class Sr_VersionCheck_Block_Renderer_Version_Current extends Sr_VersionCheck_Block_Renderer_Abstract
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
        if (!$latestVersion = $row->getLatestVersion()) {
            $latestVersion = 0;
        }
        
        $value = $row->getData($this->getColumn()->getIndex());
        return $this->decorateVersion($value, $latestVersion);
    }
}
