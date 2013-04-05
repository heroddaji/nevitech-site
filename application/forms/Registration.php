<?php

class Application_Form_Registration extends Zend_Form
{
    public function init()
    {
        $this->setMethod(Zend_Form::METHOD_POST);
        $this->setAction('/user/register/');
        $this->setAttrib('enctype', 'multipart/form-data');

        $firstname = new Zend_Form_Element_Text('firstname');
        $firstname->setLabel('First Name:');
        $firstname->setRequired(false);

        $lastname = new Zend_Form_Element_Text('lastname');
        $lastname->setLabel('Last Name:');
        $lastname->setRequired(false);

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username: *');
        $username->setRequired();
        $username->addValidator(new Zend_Validate_Alnum());

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password: *');
        $password->setRequired();
        $password->addValidator(new Zend_Validate_Alnum());

        $confirmPassword = new Zend_Form_Element_Password('confirmPassword');
        $confirmPassword->setLabel('Confirm Password: *');
        $confirmPassword->setRequired();

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email: *');
        $email->setRequired();
        $email->addValidator(new Zend_Validate_EmailAddress());

        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Description:');
        $description->setRequired(false);

        $image = new Zend_Form_Element_File('image');
        $image->setLabel('Profile Picture:');
        $image->setDestination(APPLICATION_PATH . '/../uploads/users/');
        $image->setRequired(false);
        $image->addValidator('Count', false, 1);
        $image->addValidator('Extension', false, 'jpg,jpeg,png,gif');
        $image->addValidator('Size', false, 10485760);

        $register = new Zend_Form_Element_Submit('submit');
        $register->setLabel('Sign up');
        $register->setIgnore(true);

        $this->addElements(array(
            $firstname,
            $lastname,
            $username,
            $password,
            $confirmPassword,
            $email,
            $description,
            $image,
            $register
        ));
    }
}