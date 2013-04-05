<?php

class Application_Model_Project extends Application_Model_Abstract
{
    public $_id;
    public $_name;
    public $_description;
    public $_link;
    public $_image;
    public $_created;
    public $_category;

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescription($description)
    {
        $this->_description = (string) $description;
        return $this;
    }

    public function getLink()
    {
        return $this->_link;
    }

    public function setLink($link)
    {
        $this->_link = (string) $link;
        return $this;
    }

    public function getImage()
    {
        return $this->_image;
    }

    public function setImage($image)
    {
        $this->_image = (string) $image;
        return $this;
    }

    public function getCreated()
    {
        return $this->_created;
    }

    public function setCreated($timestamp)
    {
        $this->_created = $timestamp;
        return $this;
    }

    public function getCategory()
    {
        return $this->_category;
    }

    public function setCategory($category)
    {
        $this->_category = $category;
        return $this;
    }

}