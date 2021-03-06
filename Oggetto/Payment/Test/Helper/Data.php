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
 * Helper data test
 *
 * @category   Oggetto
 * @package    Oggetto_Payment
 * @subpackage Helper
 * @author     Denis Belov <dbelov@oggettoweb.com>
 */
class Oggetto_Payment_Test_Helper_Data extends EcomDev_PHPUnit_Test_Case_Controller
{

    /**
     * Set up function
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $orderIncId = 145000052;

        $session = $this->getModelMock('checkout/session', array('getLastRealOrderId'));
        $session->expects($this->any())
            ->method('getLastRealOrderId')
            ->will($this->returnValue($orderIncId));

        $order = $this->getModelMock('sales/order', array('getAllVisibleItems', 'getBaseGrandTotal', 'getId'));
        $order->expects($this->any())
            ->method('getAllVisibleItems')
            ->will($this->returnValue(array(
                new Varien_Object(array(
                    'qty_ordered' => 1,
                    'name' => 'lol'
                )),
                new Varien_Object(array(
                    'qty_ordered' => 3,
                    'name' => 'qwe'
                )),
            )));
        $order->expects($this->any())
            ->method('getBaseGrandTotal')
            ->will($this->returnValue(123.123));
        $order->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(123));

        $this->replaceByMock('singleton', 'checkout/session', $session);
        $this->replaceByMock('model', 'sales/order', $order);
    }

    /**
     * Test get config
     *
     * @return void
     */
    public function testGetConfig()
    {
        $helper = Mage::helper('oggetto_payment/data');

        $this->assertEquals(Mage::getStoreConfig('payment/oggettopayment/order_status'), $helper->getOrderStatus());
        $this->assertEquals(Mage::getStoreConfig('payment/oggettopayment/submit_url'), $helper->getGatewayUrl());
        $this->assertEquals(Mage::getStoreConfig('payment/oggettopayment/secret_key'), $helper->getSecretKey());
    }

    /**
     * Test get url
     *
     * @return void
     */
    public function testGetUrl()
    {
        $helper = Mage::helper('oggetto_payment/data');

        $this->assertEquals(Mage::getUrl('checkout/onepage/success',
            array('_secure' => true)), $helper->getSuccessUrl());
        $this->assertEquals(Mage::getUrl('oggetto_payment/payment/cancel/',
            array('_secure' => true)), $helper->getFailureUrl());
        $this->assertEquals(Mage::getUrl('oggetto_payment/payment/response',
            array('_secure' => true)), $helper->getReportUrl());
    }

    /**
     * Test get params
     *
     * @return void
     */
    public function testGetParams()
    {
        $helper = Mage::helper('oggetto_payment/data');

        $hash = md5(
            "error_url:{$helper->getFailureUrl()}|" .
            "items:lol, qwe (3)|" .
            "order_id:123|" .
            "payment_report_url:{$helper->getReportUrl()}|" .
            "success_url:{$helper->getSuccessUrl()}|" .
            "total:123,12|" .
            $helper->getSecretKey()
        );

        $this->assertEquals(array(
            'order_id' => 123,
            'total' => '123,12',
            'items' => 'lol, qwe (3)',
            'success_url' => $helper->getSuccessUrl(),
            'error_url' => $helper->getFailureUrl(),
            'payment_report_url' => $helper->getReportUrl(),
            'hash' => $hash
        ), $helper->getParams());
    }
}