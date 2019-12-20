<?php

class Customer_AuthController extends Zend_Controller_Action
{
    /**
    * Customer login Action
    * Redirect on success
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

            /* 
                $acl =  new Zend_Acl();
                //setup the various roles in our system
                $acl->addRole('guest');
                // owner inherits all of the rules of guest
                $acl->addRole('owner', 'guest');
                
                // add the resources
                $acl->addResource('blogPost');
                
                // add privileges to roles and resource combinations
                $acl->allow('guest', 'blogPost', 'view');
                $acl->allow('owner', 'blogPost', 'post');
                $acl->allow('owner', 'blogPost', 'publish');
            */

                $this->_redirect('/');
                return;
            }
            else{
                $this->view->message = 'Failed';
            }
 
        }
        $this->view->loginForm = $loginForm;
        $this->_helper->layout()->disableLayout(); 
       // $this->_helper->viewRenderer->setNoRender(true);
    }
}

?>