<?php

/**
 * Customer_Model_DbTable_Customer class will handle db operations for customer
 */
class Customer_Model_DbTable_Customer extends Zend_Db_Table_Abstract
{

    protected $_name = 'customers';
    
    private function getFrontControllerInstance() : Zend_Controller_Front
    {
        return Zend_Controller_Front::getInstance();
    }
   /* public function readAll()
    {
        $select = $this->getDefaultAdapter()->select();
        $select->from($this->_name, '*');
        return $select;
    }
    */
    
    public function createCustomer()
    {
        $front = $this->getFrontControllerInstance();
        $request = $front->getRequest();
        $password_salt = rand(10000,99999);
        $data = array(
            'name' => $request->getPost('name'),
            'username' => $request->getPost('email'),
            'password' => MD5($request->getPost('password').$password_salt),
            'password_salt' => $password_salt
        );
        
        $front->throwExceptions(true);
        try {

            $password1 = $request->getPost('password');
            $password2 = $request->getPost('repassword');
   
            if(SELF::compairePassword($password1,$password2)){
                 $this->insert($data);
                return true;
            }
            else{
                return false;
            }
            
        } catch (Exception $e) {
            if($e->getCode()==1062){
                return false;
                    // Dublicate email address
            }
        }
    }
    public function compairePassword($password1,$password2):bool
    {
        if(strcmp($password1,$password2)==0){
            return true;
        }
        else{
            return false;
        }
    }
    /*
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
    */

}

