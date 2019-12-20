<?php

class Customer_Helper_Registation extends Zend_Controller_Action_Helper_Abstract
{

    public function verifyPassword($password1,$password2)
    {
        if(strcmp($password1,$password2)==0){
            return true;
        }
        else{
            return false;
        }

    }

}

?>