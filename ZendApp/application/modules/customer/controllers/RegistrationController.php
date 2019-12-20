<?php

/**
 * Controller : RegistrationController
 * 
 */

class Customer_RegistrationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {        
        // action body
    }

    /**
     * Register user action
     */
    public function registerAction()
    {   
        $message ='';
        $registerForm = new Customer_Form_Registration();
        $request = $this->getRequest();

        if($request->isPost()) {
            if($registerForm->isValid($request->getPost())) {
                $employeeModel = new Customer_Model_DbTable_Customer();
                $status = $employeeModel->createCustomer();
                if ( !$status ){
                    $message = "Failed";
                    $opstatus = -1;
                }
                else{
                    
                    $message = "Success";
                    $opstatus = 0;
                   // self::registrationEmail();
                   // $this->redirect('customer/auth/login');
                }
            }
            else{
                $message = "Validation Error";
                $opstatus = -1;
            }
        }

        $this->view->message = $message;
        $this->view->registerForm = $registerForm;
        $this->_helper->layout()->disableLayout();
    }
    /**
     *  
     */
    public function emailAction()
    {
    }

}

