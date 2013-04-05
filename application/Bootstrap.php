<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initConfig()
    {
        Zend_Registry::set('config', $this->getOptions());
    }

    protected function _initNevitechActionHelpers()
    {
        Zend_Controller_Action_HelperBroker::addPrefix('Nevitech_Controller_Action_Helper');
    }

    protected function _initNevitechErrorHandler()
    {
        Zend_Controller_Front::getInstance()->registerPlugin(new Zend_Controller_Plugin_ErrorHandler());
    }

    public function _initLocale()
    {
        $config = $this->getOptions();

        try {
            $locale = new Zend_Locale(Zend_Locale::BROWSER);
        } catch (Zend_Locale_Exception $e) {
            $locale = new Zend_Locale($config['resources']['locale']['default']);
        }

        Zend_Registry::set('Zend_Locale', $locale);
    }
}

