<?php
/**
 * Nucleus
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the World Wide Web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the World Wide Web, please send an email
 * to support@nucleuscommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module
 * to newer versions in the future.
 *
 * @category   Nucleus
 * @package    Support
 * @copyright  Copyright (c) 2015 Nucleus Commerce, LLC (http://www.nucleuscommerce.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Nucleus_Support_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Identifier for the Zopim chat JS URL
     *
     * @return string
     */
    public function getZopimUrlId()
    {
        return '2sF4JLXcMGcY0MOynYPeEuV0SzICpKlR';
    }
    
    /**
     * Get email template for transactional email depending on Magento version
     *
     * @return string
     */    
    public function getEmailTemplate()
    {
        $emailTemplateLegacy     = 'nucleus_support_email_email_template';
        $emailTemplateResponsive = 'nucleus_support_email_email_template_responsive';
        
        $emailTemplate = $emailTemplateResponsive;
        if ($this->isModuleEnabled('Enterprise_Enterprise')) {
            if (version_compare(Mage::getVersion(), '1.14.1', '<')) {
                $emailTemplate = $emailTemplateLegacy;
            }
        } else {
            if (version_compare(Mage::getVersion(), '1.9.1', '<')) {
                $emailTemplate = $emailTemplateLegacy;
            }
        }
        return $emailTemplate;
    }
     
    /**
     * Check is module exists and enabled in global config.
     *
     * @param string $moduleName the full module name, example Mage_Core
     * @return boolean
     */
    public function isModuleEnabled($moduleName = NULL)
    {
        if (!Mage::getConfig()->getNode('modules/' . $moduleName)) {
            return false;
        }
        $isActive = Mage::getConfig()->getNode('modules/' . $moduleName . '/active');
        if (!$isActive || !in_array((string)$isActive, array('true', '1'))) {
            return false;
        }
        return true;
    }
}
