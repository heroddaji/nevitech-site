<?php

class Application_Model_MapperAbstract
{
    protected $_dbTable;

    protected function _getDbTable()
    {

    }

    protected function _setDbTable($dbTable)
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
}
