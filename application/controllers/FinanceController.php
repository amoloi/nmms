<?php

class FinanceController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('www');
    }

    public function indexAction()
    {
        $this->view->title = 'NATAU MEMBERSHIP FINANCE';
        
        //phpinfo();
    }

    public function applicationAction()
    {
        // action body
    }

    public function authenticateAction()
    {
        // action body
    }


}





