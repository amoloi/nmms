<?php
class JBlac_Controller_Plugins_Acl extends Zend_Controller_Plugin_Abstract{
protected $_defaultRole = 'guest';
 
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $auth = Zend_Auth::getInstance();
        $ecbsession = new Zend_Session_Namespace('natau');
        if($auth->hasIdentity()) {
        } else {
                $ecbsession->destination_url = $request->getPathInfo();                
                $request->setControllerName('authentication');
                $request->setActionName('login');
        }
    }
}