<?php

class Application_Form_Project extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setAction('/portfolio/new/');
        $this->setAttrib('enctype', 'multipart/form-data');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name:');
        $name->setRequired(true);
        $name->addFilter(new Zend_Filter_StringTrim());
        $this->addElement($name);

        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Description:');
        $description->setRequired(false);
        $description->setAttrib('cols', 20);
        $description->setAttrib('rows', 5);
        $this->addElement($description);

        $link = new Zend_Form_Element_Text('link');
        $link->setLabel('Link:');
        $this->addElement($link);

        $image = new Zend_Form_Element_File('image');
        $image->setLabel('Image:');
        $image->setDestination(APPLICATION_PATH . '/../uploads');
        $image->addValidator('Count', false, 1);
        $image->addValidator('Extension', false, 'jpg,jpeg,png,gif');
        $image->addValidator('Size', false, 10485760);
        $this->addElement($image);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add to portfolio');
        $this->addElement($submit);
    }
}