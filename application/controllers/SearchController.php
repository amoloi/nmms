<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('www');
        // Enable the flash messenger helper so we can send messages.
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
    }

    public function indexAction()
    {
        // action body
    }

    public function typesAction()
    {
        // action body
    }

    public function codesAction()
    {
        // action body
    }

    public function usersAction()
    {
        // action body
    }
    
    public function memberAction(){
        $searchSession = new Zend_Session_Namespace('search');
        
        
        $this->view->title = "MEMBERS : SEARCH RESULTS";
        $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
        
        $searchForm = new Application_Form_SearchForm();
        $this->view->searchForm = $searchForm;
        
        if($this->getRequest()->isPost()){
            $searchSession->keyWord = $this->_request->getPost('q');
        }
            $memberlist = $member->listMembers((string)$searchSession->keyWord);
            $this->view->q = $searchSession->keyWord;
            Zend_Debug::dump($memberlist);
        $paginator =  new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($memberlist));
        $paginator->setItemCountPerPage(5)
                  ->setCurrentPageNumber($this->_getParam('page', 1));
        
          $this->view->paginator = $paginator;        
    }
    public function companyAction(){
        $searchSession = new Zend_Session_Namespace('search');
        
        
        $this->view->title = "COMPANIES : SEARCH RESULTS";
        $company = new Application_Model_Company(array('dbh'=>  Zend_Registry::get('dbh')));
        
        $searchForm = new Application_Form_SearchForm();
        $this->view->searchForm = $searchForm;
        
        if($this->getRequest()->isPost()){
            $searchSession->keyWord = $this->_request->getPost('q');
        }
            $companylist = $company->listCompanies((string)$searchSession->keyWord);
            $this->view->q = $searchSession->keyWord;
        
        $paginator =  new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($companylist));
        $paginator->setItemCountPerPage(5)
                  ->setCurrentPageNumber($this->_getParam('page', 1));
        
          $this->view->paginator = $paginator;         
    }
    public function departmentsAction(){
        $searchSession = new Zend_Session_Namespace('search');
        
        
        $this->view->title = "DEPARTMENTS : SEARCH RESULTS";
        $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
        
        $searchForm = new Application_Form_SearchForm();
        $this->view->searchForm = $searchForm;
        
        if($this->getRequest()->isPost()){
            $searchSession->keyWord = $this->_request->getPost('q');
        }
        $dept = new Application_Model_Sector(array('dbh'=>  Zend_Registry::get('dbh')));
        
            $FormData = $dept->listDepartments();
            $paginator =  new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($FormData));
            $paginator->setItemCountPerPage(5)
                        ->setCurrentPageNumber($this->_getParam('page', 1));
        
          $this->view->paginator = $paginator;        
            $memberlist = $member->listMembers((string)$searchSession->keyWord);
            $this->view->q = $searchSession->keyWord;
        
          $this->view->paginator = $paginator;        
    }    

}