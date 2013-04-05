<?php

class Nevitech_Controller_Plugin_LayoutSwitcher extends Zend_Controller_Plugin_Abstract
{
    const KIND_IPHONE     = 'iphone';
    const KIND_DEFAULT    = 'layout';
    const KIND_ANDROID    = 'android';
    const KIND_BLACKBERRY = 'blackberry';

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        Zend_Layout::getMvcInstance()->setLayout($this->getUserAgent());
    }

    private function getUserAgent()
    {
         $userAgent = self::KIND_DEFAULT;
         $httpUserAgent = $this->getRequest()->getServer('HTTP_USER_AGENT');

         if (strpos($httpUserAgent, 'iPhone')) {
            $userAgent = self::KIND_IPHONE;
         }

         if (strpos($httpUserAgent, 'android')) {
            $userAgent = self::KIND_ANDROID;
         }

         if (strpos($httpUserAgent, 'blackberry')) {
            $userAgent = self::KIND_BLACKBERRY;
         }

         return self::KIND_DEFAULT;
    }
}