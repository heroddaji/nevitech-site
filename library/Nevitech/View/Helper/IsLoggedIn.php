<?php
/**
 * Nevitech
 *
 * @category    Nevitech
 * @package     Index
 * @copyright   2012 Nevitech
 * @version     1.0
 */

 class Nevitech_View_Helper_IsLoggedIn extends Zend_View_Helper_Abstract
 {
    public function isLoggedIn()
    {
        return Zend_Auth::getInstance()->hasIdentity();
    }
 }