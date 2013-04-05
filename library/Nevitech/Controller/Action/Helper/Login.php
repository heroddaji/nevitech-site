<?php

class Nevitech_Controller_Action_Helper_Login extends Zend_Controller_Action_Helper_Abstract
{
    public function direct()
    {
        if (!$this->getActionController()->getUser()->hasIdentity()) {
            $this->getActionController()->getHelper('Redirector')->direct(
                'login',
                'user',
                'default',
                array(
                    'callback' => rawurlencode($this->getRequest()->getRequestUri())
                )
            );
        }
    }
}