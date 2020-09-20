<?php

/**
 * Description of HeadScript
 *
 * @author Innocent
 */
class JBlac_Controller_Plugins_HeadScript extends Zend_Controller_Plugin_Abstract {
    //put your code here
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        parent::preDispatch($request);
        
        //echo $this->baseUrl();
        $filename = APPLICATION_PATH . '/../public/js/' . $request->getControllerName() . '.js';
        if(!file_exists($filename)){
            if(fopen($filename, 'x+')){

            }  else {
                
            }
        }
        $view = Zend_Controller_Action_HelperBroker::getStaticHelper('layout')->getView();
        $view->headScript()->appendFile('/js/' .$request->getControllerName() .'.js');
       
    }
        public function routeStartup(Zend_Controller_Request_Abstract $request)
    {

    }
}