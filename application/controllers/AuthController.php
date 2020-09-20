<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        // Enable the flash messenger helper so we can send messages.
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->db = Zend_Registry::get('db');
        $this->dbadapter = Zend_Registry::get('dbadapter');
    }

    public function indexAction()
    {
        // action body
    }

    protected function getAuthAdapter($form_data)
    {
        if(file_exists(APPLICATION_PATH . DIRECTORY_SEPARATOR .'configs' . DIRECTORY_SEPARATOR .'appsec.ini')){
            $config = new Zend_Config_Ini(APPLICATION_PATH . DIRECTORY_SEPARATOR .'configs' . DIRECTORY_SEPARATOR .'appsec.ini');
            $AUTH_KEY = $config->resources->app->security->auth_key;
        }  else {
            $AUTH_KEY = AUTH_KEY;
        }
        
        
        $dbadapter = Zend_Registry::get('dbAdapter');

        $authAdapter = new Zend_Auth_Adapter_DbTable($dbadapter);
        $authAdapter->setTableName('sys_users')
                    ->setIdentityColumn('usr_username')
                    ->setCredentialColumn('usr_password');
        
        $strUsername    =   filter_var($form_data['usr_username'], FILTER_SANITIZE_STRING);
        $strPassword    =   filter_var($form_data['usr_password'], FILTER_SANITIZE_STRING);
        
            try {
                $authAdapter->setIdentity($strUsername)
                            ->setCredential(hash('sha256', $AUTH_KEY . $strPassword));
            } catch (Zend_Auth_Adapter_Exception $exc) {
                echo $exc->getMessage();
            }
            
            return $authAdapter;
    }

    public function authenticateAction()
    {
        $success = FALSE;
        
        $message = null;
        
        $form = new Application_Form_User(array('action'=>'/auth/authenticate/',
                                                'method'=>'post',
                                                'name'=>'frmECB'));
        
        $form->removeElement('usr_firstname');
        $form->removeElement('usr_lastname');
        $form->removeElement('usr_passwordConfirmation');
        $form->removeElement('usr_email');
        $form->removeElement('usr_role');

        $this->view->form = $form;         
        
        
        if($this->_request->isPost()){
            if($form->isValid($this->getRequest()->getPost())){

            }
            $form_data = $_POST;
            
            $adapter = $this->getAuthAdapter($form_data);
            $auth = Zend_Auth::getInstance();
            
            $result = $auth->authenticate($adapter);
            
            if($result->isValid()){
                $userdata = $adapter->getResultRowObject(null, array('usr_password'));
                $auth->getStorage()->write($userdata);
                
                $this->_flashMessenger->addMessage(array('message'=>'You have successfuly loggedin', 'status'=>'success'));
                if($userdata->usr_role == Zend_Registry::get('config')->roles->admin){
                    $nextPage = '/admin/dashboard/';
                }else{
                    $nextPage = '/clients/myprofile/';
                }
                
            }  else {               
                $this->_flashMessenger->addMessage(array('message'=>'Login request Failed ','status'=>'error'));
                $nextPage = '/admin/';
            }
        }
        
        $this->_redirect($nextPage);
                                
    }

    public function logoutAction()
    {
       $auth = Zend_Auth::getInstance();
       $auth->clearIdentity();
       $this->_redirect('/');
    }


}





