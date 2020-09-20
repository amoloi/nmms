<?php

class UsersController extends Zend_Controller_Action
{

    private $db = null;

    private $usersalt = null;

    private $encPassword = null;

    public function init()
    {
        // Enable the flash messenger helper so we can send messages.
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->db = Zend_Registry::get('db');
    }

    private function encryptPassword($password)
    {
        if(file_exists(APPLICATION_PATH . DIRECTORY_SEPARATOR .'configs' . DIRECTORY_SEPARATOR .'appsec.ini')){
            $config = new Zend_Config_Ini(APPLICATION_PATH . DIRECTORY_SEPARATOR .'configs' . DIRECTORY_SEPARATOR .'appsec.ini');
            $AUTH_KEY = $config->resources->app->security->auth_key;
        }  else {
            $AUTH_KEY = AUTH_KEY;
        }

            return hash("sha256", $AUTH_KEY . $password);
    }

    private function createSalt()
    {
        if(!defined('MAX_LENGTH')){
            define("MAX_LENGTH", 12);
        }
            
            $intermediateSalt = md5(uniqid(rand(), true));
            $salt = substr($intermediateSalt, 0, MAX_LENGTH);
            
            return hash('sha256', $salt);
    }

    private function createActivationCode($username, $email)
    {
        return hash('sha256', $this->createSalt() . $username . $email);
    }

    public function indexAction()
    {
       
                
        $this->view->title = "Users List";
                $strSql = "SELECT                 
                                    usr_id,
                                    usr_firstname,
                                    usr_lastname,
                                    usr_username,
                                    usr_role,
                                    usr_last_login,
                                    usr_email,
                                    usr_active_f
                            FROM SYS_USERS";

                try{
                    $data = $this->db->query($strSql);
                    
                    $user_data = $data->fetchAll(PDO::FETCH_ASSOC);

                        //pagination
                        /* Get the page number , default 1
                        */
                        $page = $this->_getParam('page',1);
                        /*
                        * Object of Zend_Paginator
                        */
                        $paginator = Zend_Paginator::factory($user_data);
                        /*
                        * Set the number of counts in a page
                        */
                        $paginator->setItemCountPerPage(8);
                        /*
                        * Set the current page number
                        */
                        $paginator->setCurrentPageNumber($page);
                        /*
                        * Assign to view
                        */
                        $this->view->paginator = $paginator;
                        //print_r($paginator); 
                    
                }  catch (PDOException $e){
                    $this->_flashMessenger->addMessage(array('message'=>'The System is Unable to Complete your request ERROR: ' . $e->getMessage() , 'status'=>'error'));
                   // exit($e->getMessage() . ' - ' . $e->getTrace());
                }

    }

    public function saveAction()
    {
        
        $form = new Application_Form_User(array('action'=>'users/create','method'=>'post',));
        $form->removeElement('usr_firstname');
        $form->removeElement('usr_lastname');
        $this->view->form = $form;
    }

    public function createAction()
    {
        
        //exit($this->_request->getActionName());
        $this->view->title = "Creating a New User";
        $form = new Application_Form_User(array('action'=>'/users/create' , 
                                                'method'=>'post', 'name'=>'frmUser'));
        $this->view->form = $form;
        if($this->_request->isPost()){
                if($form->isValid($this->getRequest()->getPost())){
                    
                
                $strFirstname   =   filter_var($this->_request->getPost('usr_firstname'), FILTER_SANITIZE_STRING);
                $strLastname    =   filter_var($this->_request->getPost('usr_lastname'), FILTER_SANITIZE_STRING);
                $strUsername    =   filter_var($this->_request->getPost('usr_username'), FILTER_SANITIZE_STRING);
                $strPassword    =   filter_var($this->_request->getPost('usr_password'), FILTER_SANITIZE_STRING);
                $strUserrole    =   filter_var($this->_request->getPost('usr_role'), FILTER_SANITIZE_STRING);
                $strEmail       =   filter_var($this->_request->getPost('usr_email'), FILTER_VALIDATE_EMAIL);
                
                $this->db = Zend_Registry::get('db');
                
                $activationCode = $this->createActivationCode($strUsername, $strEmail);
                
                $strSql = "INSERT INTO SYS_USERS(
                                                  USR_FIRSTNAME,
                                                  USR_LASTNAME,
                                                  USR_USERNAME,
                                                  USR_PASSWORD,
                                                  USR_ROLE,
                                                  USR_SALT,
                                                  USR_ACTIVATION_CD,
                                                  USR_EMAIL,
                                                  USR_CDATE
                                                  )
                                         VALUES(
                                                  :USR_FIRSTNAME,
                                                  :USR_LASTNAME,
                                                  :USR_USERNAME,
                                                  :USR_PASSWORD,
                                                  :USR_ROLE,
                                                  :USR_SALT,
                                                  :USR_ACTIVATION_CD,
                                                  :USR_EMAIL,
                                                  NOW()
                                         )";
                $this->usersalt = $this->createSalt();
                $this->encPassword = $this->encryptPassword($strPassword);
                
                $pStrSql = $this->db->prepare($strSql);             
                $pStrSql->bindParam(':USR_FIRSTNAME' , $strFirstname , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_LASTNAME' , $strLastname , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_USERNAME' , $strUsername , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_PASSWORD' , $this->encPassword , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_ROLE' , $strUserrole , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_SALT' , $this->usersalt , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_ACTIVATION_CD' , $activationCode , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_EMAIL' , $strEmail , PDO::PARAM_STR);
                
                try{
                    $pStrSql->execute();
                    $this->_flashMessenger->addMessage(array('message'=>'Record has been added successfully' , 'status'=>'success'));
                    $this->_redirect('users');
                }  catch (PDOException $e){
                    exit($e->getMessage() . ' - ' . $e->getTrace());
                }
                }else{
                    $form->populate($form->getValues());
                    $this->view->messages = $form->getErrors();
                    //$this->_flashMessenger->addMessage(array('message'=>'Please Correct your form for the errors bellow.' , 'status'=>'error'));
                    //$this->_redirect('users');
                    //exit('Errors on the form');
                }  
              }
    }

    public function updateAction()
    {
        //exit($this->_request->getActionName());
        $USR_ID = (int)$this->_request->getPost('usr_id');
        
        $form = new Application_Form_User(array('action'=>"/users/update/id/{$USR_ID}" , 
                                                'method'=>'post' , 'name'=>'frmUser') , 'update');
       
        $this->view->form = $form;
        if($this->_request->isPost()){
                if($form->isValid($this->getRequest()->getPost())){
                    
                
                $strFirstname   =   filter_var($this->_request->getPost('usr_firstname'), FILTER_SANITIZE_STRING);
                $strLastname    =   filter_var($this->_request->getPost('usr_lastname'), FILTER_SANITIZE_STRING);
                $strUsername    =   filter_var($this->_request->getPost('usr_username'), FILTER_SANITIZE_STRING);
                $strPassword    =   filter_var($this->_request->getPost('usr_password'), FILTER_SANITIZE_STRING);
                $strUserrole    =   filter_var($this->_request->getPost('usr_role'), FILTER_SANITIZE_STRING);
                $strEmail       =   filter_var($this->_request->getPost('usr_email'), FILTER_VALIDATE_EMAIL);
                
                $activationCode = $this->createActivationCode($strUsername, $strEmail);
                
                $strSql = "UPDATE SYS_USERS SET 
                                                  USR_FIRSTNAME = :USR_FIRSTNAME,
                                                  USR_LASTNAME = :USR_LASTNAME,
                                                  USR_USERNAME = :USR_USERNAME,
                                                  USR_PASSWORD = :USR_PASSWORD,
                                                  USR_ROLE = :USR_ROLE,
                                                  USR_EMAIL = :USR_EMAIL,
                                                  USR_MDATE = NOW()
                           WHERE USR_ID = :USR_ID";
                                                  
                $this->usersalt = $this->createSalt();
                $this->encPassword = $this->encryptPassword($strPassword);
                
                $pStrSql = $this->db->prepare($strSql);             
                $pStrSql->bindParam(':USR_FIRSTNAME' , $strFirstname , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_LASTNAME' , $strLastname , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_USERNAME' , $strUsername , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_PASSWORD' , $this->encPassword , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_ROLE' , $strUserrole , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_EMAIL' , $strEmail , PDO::PARAM_STR);
                $pStrSql->bindParam(':USR_ID' , $USR_ID , PDO::PARAM_INT , 20);
                
                try{
                    $pStrSql->execute();
                    $this->_flashMessenger->addMessage(array('message'=>'Record has been updated successfully' , 'status'=>'success'));
                    $this->_redirect('users');
                }  catch (PDOException $e){
                    exit($e->getMessage() . ' - ' . $e->getTrace());
                }
                }else{
                    $form->populate($form->getValues());
                    $this->view->messages = $form->getMessages();
                   // print_r($form->getMessages());
                    return;
                }
                
              }
    }

    public function editAction()
    {
                $this->view->title = "Editing User - ";
                $USR_ID = (int)$this->_request->getParam('id');
                
                $form = new Application_Form_User(array('action'=>"/users/update/id/{$USR_ID}" , 
                                                        'method'=>'post' , 'name'=>'frmUser') , 'update');
                $this->view->form = $form;
                
                //exit($USR_ID);
                $strSql = "SELECT                 
                                    usr_id,
                                    usr_firstname,
                                    usr_lastname,
                                    usr_username,
                                    usr_role,
                                    usr_email
                                    
                            FROM SYS_USERS
                            
                            WHERE usr_id = :USR_ID";

                try{
                    $pStrSql = $this->db->prepare($strSql);
                    $pStrSql->bindParam(':USR_ID' , $USR_ID , PDO::PARAM_INT , 20);
                    $pStrSql->execute();
                    $form->populate($data = $pStrSql->fetch(PDO::FETCH_ASSOC));
                    $this->view->title = "Editing User - <span>{$data['usr_firstname']} {$data['usr_lastname']}</span>";
                    //print_r($pStrSql->fetch(PDO::FETCH_ASSOC));
                    //$this->view->data = $data->fetch(PDO::FETCH_ASSOC);
                    //$this->_flashMessenger->addMessage(array('message'=>'Thank you for your submission' , 'status'=>'success'));
                }  catch (PDOException $e){
                    $this->_flashMessenger->addMessage(array('message'=>'The System is Unable to Complete your request ERROR: ' . $e->getMessage() , 'status'=>'error'));
                   // exit($e->getMessage() . ' - ' . $e->getTrace());
                }
    }


}









