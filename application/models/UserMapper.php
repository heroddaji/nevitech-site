<?php

class Application_Model_UserMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable;
        }

        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }

        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_User');
        }

        return $this->_dbTable;
    }

    public function save(Application_Model_User $user)
    {
        $data = array(
            'firstname'     => $user->firstname,
            'lastname'      => $user->lastname,
            'username'      => $user->username,
            'password'      => $user->password,
            'email'         => $user->email,
            'description'   => $user->description,
            'image'         => $user->image
        );

        $user->id = $this->getDbTable()->insert($data);
    }

    public function find($id, Application_Model_User $user)
    {
        $result = $this->getDbTable()->find($id);
        if (count($result) == 0) {
            return;
        }
        $row = $result->current();
        $user->setId($row->id)
             ->setFirstname($row->firstname)
             ->setLastname($row->lastname)
             ->setUsername($row->username)
             ->setEmail($row->email)
             ->setDescription($row->description)
             ->setImage($row->image)
             ->setCreated($row->created);
    }

    public function userExists(Application_Model_User $user)
    {
        return $this->getDbTable()->usernameExists($user->username);
    }
}