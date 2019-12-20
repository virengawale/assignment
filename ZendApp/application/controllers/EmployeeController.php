<?php

class EmployeeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $page = $this->getRequest()->getParam('page','10');
        $employeeModel = new Application_Model_DbTable_Employee();
        $data = $employeeModel->readAll();
        $adapter = new Zend_Paginator_Adapter_DbSelect($data);
        $paginator = new Zend_Paginator($adapter);
        $paginator->setItemCountPerPage(1);
        $paginator->setCurrentPageNumber($page);
        $this->view->data = $paginator;
    }

    public function createAction()
    {
        $employeeForm = new Application_Form_Employee();
        $request = $this->getRequest();
        if($request->isPost()) {
            if($employeeForm->isValid($request->getPost())) {
                $employeeModel = new Application_Model_DbTable_Employee();
                $employeeModel->createEmployee();
                $this->redirect('employee');
            }
        }
        $this->view->employeeForm = $employeeForm;
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $employeeModel = new Application_Model_DbTable_Employee();
        $employee = $employeeModel->fetchRow('id = '.$id);
        $employeeForm = new Application_Form_Employee();
        if($request->isPost()) {
            if($employeeForm->isValid($request->getPost())){
                $employeeModel->editEmployee();
                $this->redirect('employee');   
            }
        }
        $this->view->employee = $employee;
        $this->view->employeeForm = $employeeForm;
    }

    public function deleteAction()
    {
        $employeeModel = new Application_Model_DbTable_Employee();
        $employeeModel->deleteEmployee();
        $this->redirect('employee');
    }
    
}
