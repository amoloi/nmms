<?php

class AjaxController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
    }

    public function indexAction()
    {
        //echo 'Testing Zend Framework Ajax';
        $addrestemplate = $this->view->partial('/partials/address.phtml' , array('data'=>1,
                                                                                 'address_type'=>'AC'));
        echo $addrestemplate;
    }
        public function yearsRowAction()
    {
        $rowId = intval($this->getParam('rowId', 1)) + 1 ;
        //Ajaxify years';
                $years = Application_Model_MemberContibution::generateYears();
                            
                $yearsRow = $this->view->partial('/partials/year_row.phtml' , array('data'=>1,
                                                                                    'years'=>$years,
                                                                                    'rowId' => $rowId));
                echo $yearsRow;
    }
    
    public function companyAction(){
         $company = new Application_Model_Company(array('dbh'=>  Zend_Registry::get('dbh')));
         $FormData = $_POST;
         foreach ($FormData as $key => $value) {
             $FormData[$key] = $value;
             
         }
        if($this->_request->isPost()){
                $company->setCompany_name($FormData['company_name'])
                        ->setSector($FormData['sector'])
                        ->setTelephone_number($FormData['telephone_number'])
                        ->setFax_number($FormData['fax_number'])
                        ->setContact_person($FormData['contact_person'])
                        ->setEmail_address($FormData['email_address'])
                        ->setPostal_address($FormData['postal_address']);
                if(is_array($company->insert())){
                    $this->view->errors = $company->getErrorMessages();
        }else{
            echo 'success';
        }
        }
    }
    public function deptAction(){
         $company = new Application_Model_Company(array('dbh'=>  Zend_Registry::get('dbh')));
         $FormData = $_POST;
         foreach ($FormData as $key => $value) {
             $FormData[$key] = $value;
             
         }
         if($this->_request->isPost()){
             $FormData = $this->_request->getPost();
             $dept = new Application_Model_Sector(array('dbh'=>Zend_Registry::get('dbh')));
             $dept->setSector_name($FormData['sector_name'])
                  ->setSector_description($FormData['sector_description']);
             
             if('success' === $dept->insert()){
                 echo 'success';
             }else{
                 $this->view->errors = $dept->getErrorMessages();
                 return;
             } 
        }
    }

}

