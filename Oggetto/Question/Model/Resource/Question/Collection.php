<?php
/**
 * Oggetto question extension for Magento
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
 * @package   Oggetto_Question
 * @copyright Copyright (C) 2014, Oggetto Web (http://oggettoweb.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Admin edit form
 *
 * @category   Oggetto
 * @package    Oggetto_Question
 * @subpackage Model_Resource
 * @author     Denis Belov <dbelov@oggettoweb.com>
 */
class Oggetto_Question_Model_Resource_Question_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Constructor
     *
     * @return Oggetto_Question_Model_Resource_Question_Collection
     */
    protected function _construct()
    {
        $this->_init('question/question');
    }
}