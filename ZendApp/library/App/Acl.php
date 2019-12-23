<?php
class App_Acl extends Zend_Acl
{
  public static function checkRoleRestrication($role, $resource) : bool
  {
      $acl = new Zend_Acl();
      $acl->addRole(new Zend_Acl_Role(App_Roles::USER))
          ->addRole(new Zend_Acl_Role(App_Roles::ADMIN));
        
      $acl->add(new Zend_Acl_Resource(App_Resources::USER_SECTION))
          ->add(new Zend_Acl_Resource(App_Resources::ADMIN_SECTION));
        
      $acl->allow(App_Roles::USER, App_Resources::USER_SECTION);
      $acl->allow(App_Roles::ADMIN, App_Resources::ADMIN_SECTION, App_Resources::USER_SECTION);
        
      if( $acl->isAllowed($role,$resource)){
          return true;
      } else {
          return false;
      }
  }  
}