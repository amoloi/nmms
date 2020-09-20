<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('www');
    }

    public function indexAction()
    {
        $this->view->title = 'Welcome to the NATAU Membership Management System';
        $this->view->headTitle('Overview' , 'APPEND');
        $company = new Application_Model_Company(array('dbh'=>  Zend_Registry::get('dbh')));
        $company->fetchTotalCompanies('');
        $this->view->TotalCompany = $company->getDataSet(); 
                
        $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
        
        $member->totalFinance();
        $this->view->TotalRevenue = $member->getDataSet();
        
        
        $member->fetchTotalMembers('');
        $this->view->TotalMembers = $member->getDataSet();        
        $member->setWorking_state('active');
        if ('success' === $member->fetchTotalPerWorkState('')){
            $this->view->TotalActive = $member->getDataSet();
        }else{
            exit($member->getErrorMessages());
        }
        $member->setWorking_state('dismissed');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalDismiss = $member->getDataSet();
        $member->setWorking_state('lost');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalLost = $member->getDataSet();
        $member->setWorking_state('resigned');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalResigned = $member->getDataSet();

        $member->setWorking_state('retired');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalRetired = $member->getDataSet();
        $member->setWorking_state('retrenched');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalRetrenched = $member->getDataSet()    ;
        $member->setWorking_state('deceased');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalDeceased = $member->getDataSet()    ;
                
        $member->setGender('male');
        $member->fetchTotalPerGender('');
        $this->view->TotalMale = $member->getDataSet();
        
        $member->setGender('female');
        $member->fetchTotalPerGender('');
        $this->view->TotalFemale = $member->getDataSet();         
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





