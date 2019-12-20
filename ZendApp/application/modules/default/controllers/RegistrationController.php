<?php

class RegistrationController extends Zend_Controller_Action 
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {        
        // action body
    }

    public function registerAction()
    {   

        $registerForm = new Application_Form_Registration();
        
      /*  $request = $this->getRequest();
        if($request->isPost()) {
            if($employeeForm->isValid($request->getPost())) {
                $employeeModel = new Application_Model_DbTable_Employee();
                $employeeModel->createEmployee();
                $this->redirect('employee');
            }
        }
        */
        $this->view->registerForm = $registerForm;

    }
    public function purchaseAction()
    {

        echo "This is purchase action";

    }
        

}

