<?php

class ReportsController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('www');
        
       $this->_helper->LoginRequired();
    }

    public function indexAction()
    {
        $this->view->title = "REPORTS : NATAU REPORTS";

    }
    public function deleteAction()
    {
         $this->view->title = "MEMBERS : DELETE MEMBER FROM THE SYSTEM"; 
    }

    public function overviewAction()
    {
         $this->view->title = "REPORTS : SUMMARY NMMS REPORT SUMMARY"; 
    }
    public function financeAction()
    {
         $this->view->title = "MEMBERS : MEMBERSHIP TERMINATION SECTION";
         $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
         
         $id = filter_var($this->_request->getParam('id'), FILTER_SANITIZE_NUMBER_INT);
         $member->setId($id);
         $this->view->MemberDetails = $member->fetchOne('');
        
         //print_r($member->fetchMonths());
         $this->view->months = $member->fetchMemberFinance('');
    }   
}



