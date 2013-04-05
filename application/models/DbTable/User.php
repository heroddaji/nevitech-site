<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'nv_users';

    public function usernameExists($username)
    {
        $select = $this->select()->where('username = ?', $username);
        return ($this->fetchRow($select) !== null);
    }
}