<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Zend_View_Helper_LoggedIn extends Zend_View_Helper_Abstract
{
public function loggedIn ()
{
    $auth = Zend_Auth::getInstance();
    if ($auth->hasIdentity()) {
            $username = ucfirst($auth->getIdentity()->usr_username);
            $first_name = ucfirst($auth->getIdentity()->usr_firstname);
            $last_name = ucfirst($auth->getIdentity()->usr_lastname);
            $fullname = $first_name . ' ' . $last_name;
            $logoutUrl = '#';//$this->view->url(array('controller'=>'auth','action'=>'logout'), null, true);
            return '<p>Hi ' . $fullname . ' | <a href="'. $logoutUrl. '"><i class="icon-unlock"></i> Logout</a></p>';
        }

    $request = Zend_Controller_Front::getInstance()->getRequest();
    $controller = $request->getControllerName();
    $action = $request->getActionName();
    
    if($controller == 'auth' && $action == 'index') {
    return '';
    }
    
    $loginUrl = '';//$this->view->url(array('controller'=>'admin', 'action'=>'index'), null , true);
    $loginUrl = '#';// $this->view->url(array('controller'=>'admin', 'action'=>'index'), null , true);
    
    return 'Hi , Welcome Visitor';// . ' | <a href="'. $loginUrl. '"><i class="icon-lock"></i> Login</a>';
    }
}
?>
