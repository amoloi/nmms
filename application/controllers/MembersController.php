<?php

class MembersController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('www');
        
       $this->_helper->LoginRequired();
       
        $this->view->companies = Zend_Registry::get('companies');
        $this->view->sectors = Zend_Registry::get('sectors');
        //$this->view->titles = Zend_Registry::get('titles'); 
        // Enable the flash messenger helper so we can send messages.
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');        
    }

    public function indexAction()
    {
        $this->view->title = "MEMBERS : NATAU MEMBER`S LIST";
        $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
        $this->view->MemberData = $member->fetchAll();
        
        $searchForm = new Application_Form_SearchForm();
        $this->view->searchForm = $searchForm;
        $q = $this->_request->getParam('q');
        if(isset($q)){
            $memberlist = $member->listMembers($this->_request->getParam('q'));
            $this->view->q = $q;
        }else{
            $memberlist = $member->listMembers();
        }
        
        $paginator =  new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($memberlist));
        $paginator->setItemCountPerPage(5)
                  ->setCurrentPageNumber($this->_getParam('page', 1));
        
          $this->view->paginator = $paginator;
        
        
        
        $member->setWorking_state('Active');
        if ('success' === $member->fetchTotalPerWorkState('')){
            $this->view->TotalActive = $member->getDataSet();
        }else{
            exit($member->getErrorMessages());
        }
        
        
        
        
        
        
        
        $member->setWorking_state('Dismiss');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalDismiss = $member->getDataSet();
        $member->setWorking_state('Lost');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalLost = $member->getDataSet();
        $member->setWorking_state('Resign');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalResign = $member->getDataSet();

        $member->setWorking_state('Retired');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalRetired = $member->getDataSet();
        $member->setWorking_state('Retrenched');
        $member->fetchTotalPerWorkState('');
        $this->view->TotalRetrenched = $member->getDataSet()    ;
        
        $member->setGender('M');
        $member->fetchTotalPerGender('');
        $this->view->TotalMale = $member->getDataSet();
        
        $member->setGender('F');
        $member->fetchTotalPerGender('');
        $this->view->TotalFemale = $member->getDataSet();        
    }
    public function statusAction()
    {
         $this->view->title = "MEMBERS : CHANGING MEMBER`S STATUS"; 
                 if($this->_request->isPost()){
            $this->_redirect('/members/');
        } 
    }

    public function newAction()
    {
         $this->view->title = "MEMBERS : CREATING A NEW MEMBER";
            if($this->_request->isPost()){
                $FormData = $_POST;
                
                $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
                $member->setMember_name($FormData['member_name'])
                        ->setMember_surname($FormData['member_surname'])
                        ->setInitials($FormData['initials'])
                        ->setNid_no($FormData['nid_no'])
                        ->setDate_of_birth($FormData['date_of_birth'])
                        ->setGender($FormData['gender'])
                        ->setWorking_state($FormData['working_state'])
                        ->setContact($FormData['contact'])
                        ->setCompany_name($FormData['company_name'])
                        ->setWork_description($FormData['work_description'])
                        ->setSalary_or_wage($FormData['salary_or_wage'])
                        ->setSalary_code($FormData['salary_code'])
                        ->setSector($FormData['sector'])
                        ->setOffice_date($FormData['office_date'])
                        ->setCompany_telephone($FormData['company_telephone'])
                        ->setCompany_fax($FormData['company_fax'])
                        ->setDeduction($FormData['deduction']);
                
                if(is_array($member->insert())){
                    $this->view->FormData = $FormData;
                    $this->view->errors = $member->getErrorMessages();
                    return;
                }
            $this->_redirect('/members/');
        } 
    }

    public function deleteAction()
    {
         $this->view->title = "MEMBERS : DELETE MEMBER FROM THE SYSTEM"; 
    }

    public function terminateAction()
    {
         $this->view->title = "MEMBERS : MEMBERSHIP TERMINATION SECTION";
         	$member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
                $id = filter_var($this->_request->getParam('id'), FILTER_SANITIZE_NUMBER_INT);

         if($id !== null){
             $member->setId($id);
             
             if('success' === $member->delete('')){
                 $this->_flashMessenger->addMessage(array('message'=>"Membership has been terminated  successfully" , 'status'=>'success'));
                 $this->_redirect('/members/');
             }else{
                 $this->view->errors = $member->getErrorMessages();
                 return;
             }                
    }
    }
    public function financeAction()
    {
         $this->view->title = "MEMBERS : MEMBERSHIP FINANCE SECTION";
         $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
         
         if($this->_request->isPost()){


                    $data = $this->getRequest()->getPost();
                    for($x = 0 ; $x < count($data['year']) ; $x++){
                        $c = new Application_Model_MemberContibution();
                        $c->setId($data['id'][$x])
                                ->setMemberId($data['member_id'])
                                ->setJanuary(filter_var($data['january'][$x] , FILTER_SANITIZE_NUMBER_INT))
                                ->setFebruary(filter_var($data['february'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setMarch(filter_var($data['march'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setApril(filter_var($data['april'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setMay(filter_var($data['may'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setJune(filter_var($data['june'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setJuly(filter_var($data['july'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setAugust(filter_var($data['august'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setSeptember(filter_var($data['september'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setOctober(filter_var($data['october'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setNovember(filter_var($data['november'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setDecember(filter_var($data['december'][$x] , FILTER_SANITIZE_NUMBER_FLOAT))
                                ->setYear($data['year'][$x]);

                        $c->save();
                    }

                 $this->_flashMessenger->addMessage(array('message'=>"<b>{$FormData['member_name']}</b> finance details have been updated  successfully" , 'status'=>'success'));
                 $this->_redirect('/members/');
    
         }else{
                $id = filter_var($this->_request->getParam('id'), FILTER_SANITIZE_NUMBER_INT);
                $this->view->id = $id;
                $member->setId($id);
                
                $contribution = new Application_Model_MemberContibution();

                $this->view->contribution = $contribution->fetchMemberContributions($member->getId());
                
                $this->view->MemberDetails = $member->fetchOne('');

                $this->view->years = Application_Model_MemberContibution::generateYears();                
                $this->view->months = $member->fetchMemberFinance('');             
         }
    } 
    
    public function editAction()
    {
         $this->view->title = "MEMBERS : EDIT MEMBERS`S DETAILS";
         $member = new Application_Model_Member(array('dbh'=>  Zend_Registry::get('dbh')));
         
         $id = filter_var($this->_request->getParam('id'), FILTER_SANITIZE_NUMBER_INT);
         $member->setId($id);
         $FormData = $member->fetchOne('');
         $this->view->FormData = $FormData;
         
        if($this->_request->isPost()){
         $FormData = $_POST;
         $id = filter_var($this->_request->getPost('id'), FILTER_SANITIZE_NUMBER_INT);
         $FormData['id'] = $id;
         foreach ($FormData as $key => $value) {
             $FormData[$key] = $value;
             
         }   
                $member->setMember_name($FormData['member_name'])
                        ->setMember_surname($FormData['member_surname'])
                        ->setInitials($FormData['initials'])
                        ->setNid_no($FormData['nid_no'])
                        ->setDate_of_birth($FormData['date_of_birth'])
                        ->setGender($FormData['gender'])
                        ->setWorking_state($FormData['working_state'])
                        ->setContact($FormData['contact'])
                        ->setCompany_name($FormData['company_name'])
                        ->setWork_description($FormData['work_description'])
                        ->setSalary_or_wage($FormData['salary_or_wage'])
                        ->setSalary_code($FormData['salary_code'])
                        ->setSector($FormData['sector'])
                        ->setOffice_date($FormData['office_date'])
                        ->setCompany_telephone($FormData['company_telephone'])
                        ->setCompany_fax($FormData['company_fax'])
                        ->setDeduction($FormData['deduction'])
                        ->setId($FormData['id']);
                
                
                
                if('success' === $member->update('')){
                 $this->_flashMessenger->addMessage(array('message'=>"<b>{$FormData['member_name']}</b> details have been  successfully updated" , 'status'=>'success'));
                 $this->_redirect('/members/');                    
                }else{
                    exit('Error');
                    $this->view->errors = $member->getErrorMessages();                    
                }
        }
    }
    
    public function terminationAction(){
        $this->view->title = "MEMBERS : MEMBERSHIP TERMINATION";
    }
    
    public function testingAction(){
       // Zend_Debug::dump($this->getRequest()->getPost());
        
        $data = $this->getRequest()->getPost();
        for($x = 0 ; $x < count($data['year']) ; $x++){
            $c = new Application_Model_MemberContibution();
            $c->setId($data['contribution_id'][$x])
                    ->setMemberId($data['member_id'][$x])
                    ->setJanuary($data['january'][$x])
                    ->setFebruary($data['february'][$x])
                    ->setMarch($data['march'][$x])
                    ->setApril($data['april'][$x])
                    ->setMay($data['may'][$x])
                    ->setJune($data['june'][$x])
                    ->setJuly($data['july'][$x])
                    ->setAugust($data['august'][$x])
                    ->setSeptember($data['september'][$x])
                    ->setOctober($data['october'][$x])
                    ->setNovember($data['november'][$x])
                    ->setDecember($data['december'][$x])
                    ->setYear($data['year'][$x]);

            $c->save();
            //echo $data['january'][$x] . '<br>';
        }
    }
}



