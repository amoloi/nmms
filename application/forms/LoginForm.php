<?php

class Application_Form_LoginForm extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    }
    public function __construct($options = null) {
        parent::__construct($options);
        
        $this->setName('login');
        $this->setMethod('post');
        $this->setAction('/authentication/login');
        
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username')
                 ->setRequired()
                 ->setAttribs(array(
                     'class'=>'form-control',
                     'required' => 'required',
                     'title' => 'User name is required.'
                 ));
        
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
                ->setRequired()
                ->setAttribs(array(
                    'class'=>'form-control',
                     'required' => 'required',
                     'title' => 'Password is required.'                    
                ));
        
        $login = new Zend_Form_Element_Button('login');
        $login->setLabel('Login')
                ->setAttribs(array('class'=>'btn btn-primary',
                                   'type'=>'submit'));
        
                       $this->addElements(array(
                           $username,
                           $password,
                           $login,
                       ));
    }


}

