<?php

class CompaniesController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('www');
        $this->_helper->LoginRequired();
        // Enable the flash messenger helper so we can send messages.
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');        
    }

    public function indexAction()
    {
        $company = new Application_Model_Company(array('dbh'=>  Zend_Registry::get('dbh')));
        $q = $this->_request->getParam('q');
        if(isset($q)){
            $companylist = $company->listCompanies($this->_request->getParam('q'));
            $this->view->q = $q;
        }else{
            $companylist = $company->listCompanies();
        }
        
        $paginator =  new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($companylist));
        $paginator->setItemCountPerPage(5)
                  ->setCurrentPageNumber($this->_getParam('page', 1));
        
          $this->view->paginator = $paginator;        
       
        $this->view->title = "COMPANIES : LIST OF MEMBER COMPANIES";   
    }

    public function newAction()
    {
         $this->view->title = "COMPANIES : CREATING A NEW COMPANY";
         $company = new Application_Model_Company(array('dbh'=>  Zend_Registry::get('dbh')));
         $FormData = $this->_request->getPost();
        if($this->_request->isPost()){
            
                $company->setCompany_name($FormData['company_name'])
                        ->setTelephone_number($FormData['telephone_number'])
                        ->setFax_number($FormData['fax_number'])
                        ->setContact_person($FormData['contact_person'])
                        ->setEmail_address($FormData['email_address'])
                        ->setPostal_address($FormData['postal_address']);
                if('success' !== ($company->insert())){
                    $this->view->errors = $company->getErrorMessages();
                }else{
                    $this->_flashMessenger->addMessage(array('message'=>"Company with a name <b>{$FormData['company_name']}</b> has been added successfully" , 'status'=>'success'));
                    $this->_redirect('/companies/');
                }
                
            
        } 
    }
    public function financeAction()
    {
         $this->view->title = "COMPANIES : COMPANY`S FINANCIAL DETAILS"; 
    } 
    public function editAction()
    {
         $this->view->title = "COMPANIES : EDIT COMPANY`S DETAILS";
         $company = new Application_Model_Company(array('dbh'=>  Zend_Registry::get('dbh')));
         $id = filter_var($this->_request->getParam('id'), FILTER_SANITIZE_NUMBER_INT);
         $company->setId($id);
         if('success' === $company->fetchOne('')){
             $this->view->FormData = $FormData = $company->getDataSet();
         }else{
             $this->view->errors = $company->getErrorMessages();
         }
         
         
        if($this->_request->isPost()){
         $FormData = $_POST;
         $id = filter_var($this->_request->getPost('id'), FILTER_SANITIZE_NUMBER_INT);
         $FormData['id'] = $id;
                $company->setCompany_name($FormData['company_name'])
                        ->setTelephone_number($FormData['telephone_number'])
                        ->setFax_number($FormData['fax_number'])
                        ->setContact_person($FormData['contact_person'])
                        ->setEmail_address($FormData['email_address'])
                        ->setPostal_address($FormData['postal_address'])
                        ->setId($FormData['id']);
                
                if('error' === $company->update('')){
                    $this->view->errors = $company->getErrorMessages();
                }else{
                    $this->_flashMessenger->addMessage(array('message'=>"Company with a name <b>{$FormData['company_name']}</b> has been updated successfully" , 'status'=>'success')); 
                    $this->_redirect('/companies/');
                }
            
        }
    }
    public function terminateAction()
    {
         $this->view->title = "COMPANIES : COMPANIES TERMINATION SECTION";
         	 $company = new Application_Model_Company(array('dbh'=>  Zend_Registry::get('dbh')));
                $id = filter_var($this->_request->getParam('id'), FILTER_SANITIZE_NUMBER_INT);

         if($id !== null){
             $company ->setId($id);
             
             if('success' === $company ->delete('')){
                 $this->_flashMessenger->addMessage(array('message'=>"Membership has been terminated  successfully" , 'status'=>'success'));
                 $this->_redirect('/companies/');
             }else{
                 $this->view->errors = $member->getErrorMessages();
                 return;
             }                
    }
    }    
}



