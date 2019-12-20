<?php

/**
 * Creating registration form attributes
 */
class Customer_Form_Registration extends Zend_Form
{

    public function init()
    {
        $this->addElement(
            'text', 'name', array(
                'label' => 'Name',
                'required' => true,
                'filters'    => array('StringTrim'),
        ));

        $this->addElement(
            'text', 'email', array(
                'label' => 'Email Address',
                'required' => true,
                'filters'    => array('StringTrim'),
        ));

        $this->addElement('password', 'password', array(
            'label'      => 'Password:',
            'required'   => true
        ));
        $this->addElement('password', 'repassword', array(
            'label'      => 'Verify Password:',
            'required'   => true,
            'validators' => array(
                array('identical', true, array('password'))
            )
        ));
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Register',
        ));   
    }
}

