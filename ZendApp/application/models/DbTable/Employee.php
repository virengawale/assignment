<?php

class Application_Model_DbTable_Employee extends Zend_Db_Table_Abstract
{

    protected $_name = 'employees';
    
    private function getFrontControllerInstance() : Zend_Controller_Front
    {
        return Zend_Controller_Front::getInstance();
    }
    
    public function readAll()
    {
        $select = $this->getDefaultAdapter()->select();
        $select->from($this->_name, '*');
        return $select;
    }
    
    public function createEmployee()
    {
        $front = $this->getFrontControllerInstance();
        $request = $front->getRequest();
        $data = array(
            'name' => $request->getPost('name'),
            'number' => $request->getPost('number'),
            'designation' => $request->getPost('designation')
        );
        $this->insert($data);
    }
    
    public function editEmployee()
    {
        $front = $this->getFrontControllerInstance();
        $request = $front->getRequest();
        $data = array(
            'name' => $request->getPost('name'),
            'number' => $request->getPost('number'),
            'designation' => $request->getPost('designation')
        );
        $where = array('id = ?' => $request->getParam('id'));
        $this->update($data, $where);
    }
    
    public function deleteEmployee()
    {
        $front = $this->getFrontControllerInstance();
        $request = $front->getRequest();
        $where = array('id = ?' => $request->getParam('id'));
        $this->delete($where);
    }

}

