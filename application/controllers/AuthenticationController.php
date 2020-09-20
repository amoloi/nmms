<?php

class AuthenticationController extends Zend_Controller_Action
{

    public function init()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('login');
    }

    public function indexAction()
    {
       $this->_forward('login');
    }

    public function loginAction()
    {
        
        if(Zend_Auth::getInstance()->hasIdentity()){
            $this->_redirect('/reports/overview');
        }
        $form =  new Application_Form_LoginForm();
        $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($this->_request->getPost())){
                    $authAdapter = $this->getAuthAdapter();
                    $username = $form->getValue('username');
                    $password = $form->getValue('password');
                    $authAdapter->setIdentity($username)
                                ->setCredential($password);

                    $auth = Zend_Auth::getInstance();
                    $result = $auth->authenticate($authAdapter);

                    if($result->isValid()){
                        $identity = $authAdapter->getResultRowObject();
                        $authStorage = $auth->getStorage();
                        $authStorage->write($identity);

                        $this->_redirect('/');
                    }  else {
                        //echo 'Invalid';
                    }                
            }
        }
        
        $this->view->form = $form;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/authentication/login');
    }
    private function getAuthAdapter(){
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('sys_users')
                    ->setIdentityColumn('usr_username')
                    ->setCredentialColumn('usr_password');
                
                    return $authAdapter;
    }


}





