<?php

class Application_Model_ProjectMapper
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
            $this->setDbTable('Application_Model_DbTable_Project');
        }

        return $this->_dbTable;
    }

    public function save(Application_Model_Project $project)
    {
        $data = array(
            'name'          => $project->name,
            'description'   => $project->description,
            'link'          => $project->link,
            'image'         => $project->image,
            'created'       => $project->created,
            'category'      => $project->category
        );

        if (null === ($id = $project->id)) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id)
    {

    }

    public function delete($projectId)
    {
        $this->getDbTable()->deleteById($projectId);
    }

    public function fetchAll(array $where = null)
    {
        $resultSet = $this->getDbTable()->fetchAll($where);
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Project();
            $entry->setId($row->id)
                  ->setName($row->name)
                  ->setDescription($row->description)
                  ->setLink($row->link)
                  ->setImage($row->image)
                  ->setCreated($row->created)
                  ->setCategory($row->category);
            $entries[] = $entry;
        }

        return $entries;
    }

    public function parseArguments(array $options, array $default)
    {
        return array_merge($options, $default);
    }
}