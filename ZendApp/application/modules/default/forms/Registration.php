<?php

class Application_Form_Registration extends Zend_Form
{

    public function init()
    {
        $this->addElement('text', 'name', array('label' => 'Name :', 'required' => 'true'   ));
        $this->addElement('text', 'email', array('label' => 'Email Address', 'required'=>'true'));
        $this->addElement('password', 'password', array('label'=>'Password','required'=>'true'));
        $this->addElement('submit', 'submit', array('label' => 'Register'));
    }


}

