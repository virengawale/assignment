<?php

class Application_Form_Employee extends Zend_Form
{

    public function init()
    {
        $this->addElement('text', 'name', array('label' => 'Name :', 'required' => 'true'));
        $this->addElement('text', 'number', array('label' => 'Number :', 'required' => 'true'));
        $this->addElement('text', 'designation', array('label' => 'Designation : ', 'required' => 'true'));
         $this->addElement('submit', 'submit', array('label' => 'Add Employee'));
    }


}

