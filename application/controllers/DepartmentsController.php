<?php

class DepartmentsController extends Zend_Controller_Action
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
        $this->view->title = "DEPARTMENTS : DEPARTMENTS LIST";
        $dept = new Application_Model_Sector(array('dbh'=>  Zend_Registry::get('dbh')));
        
            $FormData = $dept->listDepartments();
            $paginator =  new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($FormData));
            $paginator->setItemCountPerPage(5)
                        ->setCurrentPageNumber($this->_getParam('page', 1));
        
          $this->view->paginator = $paginator;

        
    }

    public function newAction()
    {
         $this->view->title = "DEPARTMENTS : CREATING A NEW DEPARTMENT";
         
         if($this->_request->isPost()){
             $FormData = $this->_request->getPost();
             $dept = new Application_Model_Sector(array('dbh'=>Zend_Registry::get('dbh')));
             $dept->setSector_name($FormData['sector_name'])
                  ->setSector_description($FormData['sector_description']);
             
             if('success' === $dept->insert()){
                    $this->_flashMessenger->addMessage(array('message'=>"<b>{$FormData['sector_name']}</b> Department/Sector has been added successfully" , 'status'=>'success'));
                    $this->_redirect('departments');
             }else{
                 $this->view->errors = $dept->getErrorMessages();
                 return;
             }
             
         }
    }
    
    public function editAction()
    {
         $this->view->title = "DEPARTMENTS : UPDATING DEPARTMENT`S DATA";
         $dept = new Application_Model_Sector(array('dbh'=>Zend_Registry::get('dbh')));
         
         if($this->_request->isPost()){
             $FormData = $this->_request->getPost();
             
             $dept->setSector_name($FormData['sector_name'])
                  ->setSector_description($FormData['sector_description'])
                  ->setId($FormData['id']);
             
             if('success' === $dept->update('')){
                    $this->_flashMessenger->addMessage(array('message'=>"<b>{$FormData['sector_name']}</b> Department/Sector  has been updated successfully" , 'status'=>'success'));
                    $this->_redirect('departments');
             }else{
                 $this->view->errors = $dept->getErrorMessages();
                 return;
             }
             
         }  else {
             $FormData = $this->_request->getParams();
             $dept->setId($FormData['id']);
             
             if('success' === $dept->fetchOne('')){
                    $this->view->FormData = $dept->getDataSet();
             }else{
                 $this->view->errors = $dept->getErrorMessages();
                 return;
             }             
         }
    }
    public function deleteAction()
    {
         $this->view->title = "DEPARTMENTS : UPDATING DEPARTMENT`S DATA";
         $dept = new Application_Model_Sector(array('dbh'=>Zend_Registry::get('dbh')));
         
         if($this->_request->isPost()){
             
         }  else {
             $FormData = $this->_request->getParams();
             $dept->setId($FormData['id']);
             
             if('success' === $dept->fetchOne('')){
                    $FormData = $dept->getDataSet();
                            if('success' === $dept->delete('')){
                                   $this->_flashMessenger->addMessage(array('message'=>"Department/Sector <b>{$FormData['sector_name']}</b> has been removed from departments" , 'status'=>'success'));
                                   $this->_redirect('departments');
                            }else{
                                $this->view->errors = $dept->getErrorMessages();
                                return;
                            }                    
             }else{
                 $this->view->errors = $dept->getErrorMessages();
                 return;
             }             
         }
    }     
}



