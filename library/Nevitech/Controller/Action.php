<?php

class Nevitech_Controller_Action extends Zend_Controller_Action
{
    public function preDispatch()
    {
        $this->view->messages = $this->_getMessenger()->getMessages();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->_helper->layout()->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);
        }
    }

    public function getUser()
    {
        return Zend_Auth::getInstance();
    }

    protected function _getMessenger()
    {
        return $this->getHelper('FlashMessenger');
    }

    protected function _validatehash($hash)
    {
        if (empty($hash)) {
            return false;
        }
        return $hash === self::generateHash();
    }

    static public function generateHash()
    {
        return md5('Random string' . session_id());
    }
}