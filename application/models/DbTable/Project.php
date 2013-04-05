<?php

class Application_Model_DbTable_Project extends Zend_Db_Table_Abstract
{
    protected $_name = 'nv_project';

    public function deleteById($id)
    {
        $this->delete($this->_db->quoteInto('id = ?', $id));
    }
}