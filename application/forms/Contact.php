<?php

class Application_Form_Contact extends Zend_Form
{
    public function init()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAction('/index/contact/');
        $this->setAttrib('class', 'contact');

        $name = new Zend_Form_Element_Text('name');
        $name->setRequired(true);
        $name->setAttrib('placeholder', 'Name');
        $name->setDecorators(array('ViewHelper', 'Errors'));
        $this->addElement($name);

        $email = new Zend_Form_Element_Text('email');
        $email->setRequired(true);
        $email->setAttrib('placeholder', 'Email');
        $email->addValidator(new Zend_Validate_EmailAddress());
        $email->setDecorators(array('ViewHelper', 'Errors'));
        $this->addElement($email);

        $message = new Zend_Form_Element_Textarea('message');
        $message->setRequired(true);
        $message->setAttrib('placeholder', 'Message');
        $message->setDecorators(array('ViewHelper', 'Errors'));
        $this->addElement($message);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Send');
        $submit->setAttrib('class', 'btn');
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
}