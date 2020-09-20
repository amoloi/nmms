<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
    }

    public function indexAction()
    {
        $layout = $this->_helper->getHelper('layout');
        $layout->setLayout('layout_single_column');
        $this->_forward('login');
        
    }

    public function loginAction()
    {
        
        /******
        
        */
        $this->view->title = 'Login Section';
        $form = new Application_Form_User(array('action'=>'/auth/authenticate/',
                                                'method'=>'post',
                                                'name'=>'frmECB'));
        $form->removeElement('usr_firstname');
        $form->removeElement('usr_lastname');
        $form->removeElement('usr_passwordConfirmation');
        $form->removeElement('usr_email');
        $form->removeElement('usr_role');
        $form->removeElement('cmdSave');
        
        
        $submit = new Zend_Form_Element_Submit('cmdSave');
        $submit->setLabel('Login');
        $submit->setAttribs(array('class'=>'medium green icon-ok'));
        $form->addElement($submit);
        $this->view->form = $form;      
                
    }

    public function dashboardAction()
    {
               $this->view->title = 'Application Control Dashboard';
        //echo APPLICATION_PATH . DIRECTORY_SEPARATOR .'config' . DIRECTORY_SEPARATOR .'appsec.ini';
    if(file_exists(APPLICATION_PATH . DIRECTORY_SEPARATOR .'configs' . DIRECTORY_SEPARATOR .'appsec.ini')){
            $config = new Zend_Config_Ini(APPLICATION_PATH . DIRECTORY_SEPARATOR .'configs' . DIRECTORY_SEPARATOR .'appsec.ini');
            $AUTH_KEY = $config->resources->app->security->auth_key;
        }  else {
            $AUTH_KEY = AUTH_KEY;
        }
    }


}





