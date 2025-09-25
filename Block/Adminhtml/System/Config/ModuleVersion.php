<?php
/**
 * Mavenbird Technologies Private Limited
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://mavenbird.com/Mavenbird-Module-License.txt
 *
 * =================================================================
 *
 * @category    Mavenbird
 * @package     Mavenbird_CancelOrder
 * @author      Mavenbird Team
 * @copyright   Copyright (c) 2018-2024 Mavenbird Technologies Private Limited ( http://mavenbird.com )
 * @license     http://mavenbird.com/Mavenbird-Module-License.txt
 */
namespace Mavenbird\CancelOrder\Block\Adminhtml\System\Config;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Module\ModuleListInterface;
use Magento\Framework\Module\ModuleResource;

class ModuleVersion extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * @var ModuleListInterface
     */
    protected $moduleList;

    /**
     * @var ModuleResource
     */
    protected $moduleResource;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param ModuleListInterface $moduleList
     * @param ModuleResource $moduleResource
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        ModuleListInterface $moduleList,
        ModuleResource $moduleResource,
        array $data = []
    ) {
        $this->moduleList = $moduleList;
        $this->moduleResource = $moduleResource;
        parent::__construct($context, $data);
    }

    /**
     * Render element HTML
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $moduleName = $this->getModuleNameFromConfig($element);

        $version = $this->getModuleVersion($moduleName);

        $html = '<div style="padding:6px 0;">';
        $html .= '<strong>Module:</strong> ' . $moduleName . '<br/>';
        $html .= '<strong>Version:</strong> ' . $version . '<br/>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Get module version from module.xml
     *
     * @param string $moduleName
     * @return string
     */
    protected function getModuleVersion($moduleName)
    {
        $moduleInfo = $this->moduleList->getOne($moduleName);
        return isset($moduleInfo['setup_version']) ? $moduleInfo['setup_version'] : 'N/A';
    }

    /**
     * Extract module name from system.xml field config
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function getModuleNameFromConfig($element)
    {
        $configPath = $element->getFieldConfig()['path'] ?? '';
        if (!$configPath) {
            return 'Unknown';
        }
        if (isset($element->getFieldConfig()['module'])) {
            return $element->getFieldConfig()['module'];
        }
        if (strpos($configPath, 'cancelorder') !== false) {
            return 'Mavenbird_CancelOrder';
        }

        return 'Unknown';
    }
}
