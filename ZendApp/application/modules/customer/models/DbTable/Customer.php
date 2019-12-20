<?php

/**
 * Customer_Model_DbTable_Customer class will handle db operations for customer
 * @module : customer
 */
class Customer_Model_DbTable_Customer extends Zend_Db_Table_Abstract
{

    protected $_name = 'customers';
    
    private function getFrontControllerInstance() : Zend_Controller_Front
    {
        return Zend_Controller_Front::getInstance();
    }
 
    /**
     * @action : create 
     * @method : POST
     * @Exception : 1062 : Email address is already exist
     * 
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
            }
        }
    }

    /**
     * @param string $password1
     * @param string $password2
     * @return bool
     */
    public function compairePassword($password1,$password2):bool
    {
        if(strcmp($password1,$password2)==0){
            return true;
        }
        else{
            return false;
        }
    }
}

