<?php

class IndexController extends Nevitech_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mapper = new Application_Model_ProjectMapper();

        $this->view->projects = $mapper->fetchAll();
    }

    public function contactAction()
    {
        $request = $this->getRequest();

        $form = new Application_Form_Contact();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $mail = new Zend_Mail();
                $mail->setBodyText($request->message);
                $mail->setFrom($request->email, $request->name);
                $mail->addTo('info@nevitech.com', 'Nevitech');
                $mail->setSubject('Submitted by contact form');

                try {
                    $mail->send();
                    $this->_getMessenger()->addMessage('Your message is sent.');
                } catch (Exception $e) {
                    $this->_getMessenger()->addMessage('Something went wrong. Pleae try later.');
                }
            }
        }

        $this->_redirect('/');
    }

    public function headerAction()
    {

    }

    public function footerAction()
    {

    }

    public function slideshowAction()
    {

    }

    public function subcontentAction()
    {

    }
}

