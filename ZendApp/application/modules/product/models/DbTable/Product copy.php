<?php

/**
 * Customer_Model_DbTable_Customer class will handle db operations for customer
 */
class Product_Model_DbTable_Product extends Zend_Db_Table_Abstract
{

    protected $_name = 'product';
    
    private function getFrontControllerInstance() : Zend_Controller_Front
    {
        return Zend_Controller_Front::getInstance();
    }

    public function orderDetail($productId)
    {
        $params = array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => 'root',
            'dbname'   => 'zendApp'
        );
  
        $db = Zend_Db::factory('PDO_MYSQL', $params);
        $stmt = $db->query("select * from $this->_name WHERE id='$productId'");
        $result = $stmt->fetchAll();

        return $result;
    }

    public function placeOrder($productId)
    {
        $params = array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => 'root',
            'dbname'   => 'zendApp'
        );

        $productDetail = SELF::orderDetail($productId);
    }

    public function selectAllProduct()
    {
        $params = array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => 'root',
            'dbname'   => 'zendApp'
        );
 
        $db = Zend_Db::factory('PDO_MYSQL', $params);
        $stmt = $db->query("select * from $this->_name");
        $result = $stmt->fetchAll();

        return $result;
    }
    /*
    public function orderDetail1($productId)
    {
       $params = array(
            'host'     => '127.0.0.1',
            'username' => 'root',
            'password' => 'root',
            'dbname'   => 'zendApp'
        );
         
        $db = Zend_Db::factory('PDO_MYSQL', $params);
        // Create the Zend_Db_Select object
        $select = $db->select();
 
        // Add a FROM clause
        $select->from($this->_name, '*');
 
        // Add a WHERE clause
         $select->where("id = '$productId'");
        return $select;
    }

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

