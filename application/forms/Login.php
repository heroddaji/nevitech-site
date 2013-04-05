<?php

class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAction('/user/login/');

        $username = new Zend_Form_Element_Text('username');
        $username->setRequired(true);
        $username->setAttrib('placeholder', 'Username');
        $username->addValidator(new Zend_Validate_Alnum());
        $username->setDecorators(array('ViewHelper', 'Errors'));
        $this->addElement($username);

        $password = new Zend_Form_Element_Password('password');
        $password->setRequired(true);
        $password->setAttrib('placeholder', 'Password');
        $password->setDecorators(array('ViewHelper', 'Errors'));
        $this->addElement($password);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Login');
        $submit->setDecorators(array('ViewHelper'));
        $this->addElement($submit);

        $this->setDecorators(
            array(
                'FormElements',
                array(
                    'HtmlTag',
                    array(
                        'tag' => 'div'
                    )
                ),
                'Form',
            )
        );
    }

    public function setCallback($callbackUrl)
    {
        if (!empty($callbackUrl)) {
            $callback = new Zend_Form_Element_Hidden('callback');
            $callback->setValue(rawurldecode($callbackUrl));
            $this->addElement($callback);
        }
    }
}