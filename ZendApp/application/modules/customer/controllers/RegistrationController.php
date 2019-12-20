<?php

/**
 * @controller : RegistrationController
 * @module : customer
 * 
 */

class Customer_RegistrationController extends Zend_Controller_Action
{

    private $customer;
   /**
     * @param string 
     * @return array
     */
    public function getCustomerModel(): Customer_Model_DbTable_Customer
    {
        if (!$this->customer) {
            $this->customer = new Customer_Model_DbTable_Customer();
        }

        return $this->customer;
    }

    public function setCustomerModel(Customer_Model_DbTable_Customer $customer)
    {
            $this->customer = $customer;
    }

    /**
     * Register user action
     * @method GET
     * @return void
     */
    public function registerAction()
    {   
        $message ='';
        $registerForm = new Customer_Form_Registration();
        $request = $this->getRequest();

        if($request->isPost()) {
            if($registerForm->isValid($request->getPost())) {
                $employeeModel = SELF::getCustomerModel();
                $status = $employeeModel->createCustomer();
                if ( !$status ){
                    $message = "Failed";
                    $opstatus = -1;
                }
                else{
                    $message = "Success";
                    $opstatus = 0;
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
    
}

