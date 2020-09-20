<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of publicLoginOrRegister
 *
 * @author Innocent J Blac
 */
class Zend_View_Helper_PublicLoginOrRegister extends Zend_View_Helper_Abstract {
public function PublicLoginOrRegister ()
{
    $auth = Zend_Auth::getInstance();
    $registerUrl = '#';//$this->view->url(array('controller'=>'account','action'=>'register'), null, true);
    if ($auth->hasIdentity()) {
            $username = ucfirst($auth->getIdentity()->usr_username);
            //$first_name = ucfirst($auth->getIdentity()->firstname);
            //$last_name = ucfirst($auth->getIdentity()->usr_lastname);
            //$fullname = $first_name . ' ' . $last_name;
            $logoutUrl = '#';// $this->view->url(array('controller'=>'account','action'=>'logout'), null, true);
            
            return '<p>Hi ' . $username . ' | <a href="'. $logoutUrl. '"><i class="icon-unlock"></i> Logout</a></p>';
        }

    $request = Zend_Controller_Front::getInstance()->getRequest();
    $controller = $request->getControllerName();
    $action = $request->getActionName();
    
    if($controller == 'account' && $action == 'index') {
    return '';
    }
    
    $loginUrl = '#'; //$this->view->url(array('controller'=>'account', 'action'=>'login'), null , true);
    $loginUrl = '#';//$this->view->url(array('controller'=>'account', 'action'=>'login'), null , true);
    
    return '<a href="'. $loginUrl. '"><i class="icon-lock"></i> Login</a>' . ' | <a href="'. $registerUrl. '"><i class=""></i> Register</a>';
    }
}
