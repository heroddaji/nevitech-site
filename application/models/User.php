<?php

class Application_Model_User extends Application_Model_Abstract
{
    protected $_id;
    protected $_firstname;
    protected $_lastname;
    protected $_username;
    protected $_password;
    protected $_email;
    protected $_description;
    protected $_image;
    protected $_created;

    public function getId()
    {
        return $this->_id;
    }

    public function getFirstname()
    {
        return $this->_firstname;
    }

    public function getLastname()
    {
        return $this->_lastname;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getImage()
    {
        return $this->_image;
    }

    public function getCreated()
    {
        return $this->_created;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function setFirstname($firstname)
    {
        $this->_firstname = (string) $firstname;
        return $this;
    }

    public function setLastname($lastname)
    {
        $this->_lastname = (string) $lastname;
        return $this;
    }

    public function setUsername($username)
    {
        $this->_username = (string) $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->_password = md5($password);
        return $this;
    }

    public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }

    public function setDescription($description)
    {
        $this->_description = (string) $description;
        return $this;
    }

    public function setImage($image)
    {
        $this->_image = (string) $image;
        return $this;
    }

    public function setCreated($timestamp)
    {
        $this->_created = $timestamp;
        return $this;
    }
}