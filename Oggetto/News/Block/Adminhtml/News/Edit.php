<?php
/**
 * Oggetto Web extension for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the Oggetto Sales module to newer versions in the future.
 * If you wish to customize the Oggetto Sales module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Oggetto
 * @package   Oggetto_News
 * @copyright Copyright (C) 2014, Oggetto Web (http://oggettoweb.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin edit
 *
 * @category   Oggetto
 * @package    Oggetto_News
 * @subpackage Adminhtml
 * @author     Denis Belov <dbelov@oggettoweb.com>
 */
class Oggetto_News_Block_Adminhtml_News_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Constructor
     *
     * @return Oggetto_News_Block_Adminhtml_News_Edit
     */
    public function __construct()
    {
        $this->_blockGroup = 'oggetto_news';
        $this->_controller = 'adminhtml_news';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('oggetto_news/data')->__('Save News'));
        $this->_updateButton('delete', 'label', Mage::helper('oggetto_news/data')->__('Delete News'));
    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('oggetto_news')->getNewsId()) {
            return Mage::helper('oggetto_news/data')->__('Edit News');
        } else {
            return Mage::helper('oggetto_news/data')->__('New News');
        }
    }
}