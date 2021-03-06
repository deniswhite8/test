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
 * Index controller
 *
 * @category   Oggetto
 * @package    Oggetto_Question
 * @subpackage Controllers
 * @author     Denis Belov <dbelov@oggettoweb.com>
 */
class Oggetto_Question_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Index action
     *
     * @return void
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Send action
     *
     * @return void
     */
    public function sendAction()
    {
        $post = $this->getRequest()->getPost();
        unset($post['question_id']);

        $question = Mage::getModel('question/question');
        $question->setData($post);
        $question->setStatusId(Oggetto_Question_Model_Question::STATUS_NOT_ANSWERED);

        $question->save();

        $this->_redirectReferer();
    }
}
