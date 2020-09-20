<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminLoginRequired
 *
 * @author Innocent J Blac
 */
class JBlac_Controller_Action_Helper_AdminLoginRequired extends Zend_Controller_Action_Helper_Abstract {
  public function direct()
  {

    $auth = Zend_Auth::getInstance();

    if (! $auth->hasIdentity()) {
      $flash = Zend_Controller_Action_HelperBroker::getStaticHelper('flashMessenger');
      $flash->addMessage(Zend_Registry::get('config')->messages->login->required);
      $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector'); 
      $redirector->gotoUrl('/error/loginrequired');
      return 1;
    }else{
        $user_data = Zend_Auth::getInstance()->getStorage()->read();
        if($user_data->profile == Zend_Registry::get('config')->roles->default){
            $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector'); 
            $redirector->gotoUrl('/error/permissionrequired');
        }else{
            
        }
    }
  }
}
