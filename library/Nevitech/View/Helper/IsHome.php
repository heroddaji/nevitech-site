<?php
/**
 * Nevitech
 *
 * @category    Nevitech
 * @package     Index
 * @copyright   2012 Nevitech
 * @version     1.0
 */

 class Nevitech_View_Helper_IsHome extends Zend_View_Helper_Abstract
 {
    public function isHome()
    {
        return (
            Zend_Controller_Front::getInstance()->getDefaultControllerName() ===
            Zend_Controller_Front::getInstance()->getRequest()->getControllerName()
        );
    }
 }