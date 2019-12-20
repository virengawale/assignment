<?php

/**
 * @module : customer
 * @controller : Auth
 */
class Customer_AuthController extends Zend_Controller_Action
{
    /**
    * Customer login Action
    * Redirect on success
    * @action login
    * @return void
    */
    public function loginAction()
    {

        $db = $this->_getParam('db');

        /**
         * create object of Customer_Form_Auth_Login class
         */
        $loginForm = new Customer_Form_Auth_Login();
        
        /**
        * Validate Request with forms restriction
        */
        if ($loginForm->isValid($_POST)) {
 
            $adapter = new Zend_Auth_Adapter_DbTable(
                $db,
                'customers',
                'username',
                'password',
                'MD5(CONCAT(?, password_salt))'
                );
 
            $adapter->setIdentity($loginForm->getValue('username'));
            $adapter->setCredential($loginForm->getValue('password'));
 
            $auth   = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);
 
            if ($result->isValid()) {
                $this->view->message='Success';
                $this->_helper->FlashMessenger('Successful Login');
                $this->_redirect('product/truck/list');
             }
            else{
                $this->view->message = 'Failed';
            }
 
        }
        $this->view->loginForm = $loginForm;
        $this->_helper->layout()->disableLayout(); 
     }
}

?>