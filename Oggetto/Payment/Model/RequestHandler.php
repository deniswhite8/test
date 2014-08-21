<?php
/**
 * Oggetto Payment extension for Magento
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
 * the Oggetto Payment module to newer versions in the future.
 * If you wish to customize the Oggetto Sales module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Oggetto
 * @package   Oggetto_Payment
 * @copyright Copyright (C) 2014, Oggetto Web (http://oggettoweb.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Observer
 *
 * @category   Oggetto
 * @package    Oggetto_Payment
 * @subpackage Model
 * @author     Denis Belov <dbelov@oggettoweb.com>
 */
class Oggetto_Payment_Model_RequestHandler extends Varien_Object
{
    /**
     * Init handler
     *
     * @param array $data Request data
     * @return void
     */
    public function init($data)
    {
        $params = array(
            'status' => $data['status'],
            'order_id' => $data['order_id'],
            'total' => $data['total']
        );

        $this->setData($params);
        $this->setData(array(
            'hash' => $data['hash'],
            'params' => $params,
            'order' => Mage::getModel('sales/order')->load($data['order_id'])
        ));
    }

    /**
     * Validate data
     *
     * @return bool
     */
    public function validate()
    {
        $helper = Mage::helper('oggetto_payment/data');
        $order = $this->getOrder();
        if ($order->getId() == $this->getOrderId() && $helper->getHash($this->getParams()) == $this->getHash()
            && $helper->getOrderTotal($order) == $this->getOrderTotal()) {
            return true;
        }
        return false;
    }
}
