<?php

class Application_Form_User extends Zend_Form
{
    protected $formState = null;



    public function __construct($options = null , $form_state = 'create') {
        
        
        $this->setAction($options['action']);
        $this->setMethod($options['method']);
        $this->setName($options['name']);
        $this->formState = $form_state;
        
        parent::__construct($options);
    }
    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	//$this->setAction("/users/create");
        //$this->setMethod('post');
    	       
        /*
         * User name form element
         */
        $username = new Zend_Form_Element_Text('usr_username');
        $username->setLabel('Username')
                     ->setOptions(array('size'=>25 , 'class'=>'textbox col_7'))
                     ->setRequired(TRUE)
                     ->addValidator('StringLength' ,false , array(4,15))
                    ->addErrorMessage('Username Cannot be Empty');
        
        /*
         * Firstname form element
         */
        $firstname = new Zend_Form_Element_Text('usr_firstname');
        $firstname->setLabel('First Name')
                     ->setOptions(array('size'=>25 , 'class'=>'textbox col_7'))
                     ->setRequired(TRUE)
                     ->addErrorMessage('Firstname Cannot be Empty');
//                    ->addValidator('Alpha', false, array(
//                        'messages' => array(
//                        Zend_Validate_Alpha::INVALID => "ERROR: Invalid name",
//                        Zend_Validate_Alpha::NOT_ALPHA => "ERROR: Name cannot contain non-alpha characters",
//                        Zend_Validate_Alpha::STRING_EMPTY => "ERROR: Name cannot be empty" ,
//                        )));
        
        /*
         * Laststname form element
         */
        $lastname = new Zend_Form_Element_Text('usr_lastname');
        $lastname->setLabel('Last Name')
                     ->setOptions(array('size'=>25 , 'class'=>'textbox col_7'))
                     ->setRequired(TRUE)
                     ->addErrorMessage('Lastname Cannot be Empty');
        
        /*
         * Password form element
         */
        $password = new Zend_Form_Element_Password('usr_password');
        $password->setLabel('Password')
                     ->setOptions(array('size'=>25 , 'class'=>'textbox col_7'))
                     ->setRequired(TRUE)
                     ->addErrorMessage('Password Cannot be Empty');
                
        /*
         * Password Confirmation form element
         */
        $cpassword = new Zend_Form_Element_Password('usr_passwordConfirmation');
        $cpassword->setLabel('Confirm Password')
                     ->setOptions(array('size'=>25 , 'class'=>'textbox col_7'))
                     ->setRequired(TRUE)
                     ->addErrorMessage('Password Confirmation Cannot be Empty');
        

        /*
         * Laststname form element
         */
        $email = new Zend_Form_Element_Text('usr_email');
        $email->setLabel('E-mail')
                     ->setOptions(array('size'=>120 , 'class'=>'textbox col_8'))
                     ->setRequired(TRUE)
                    ->addErrorMessage('E-mail Cannot be Empty');
        $submit = new Zend_Form_Element_Submit('cmdSave');
        $submit->setLabel('Save Data');
        $submit->setAttribs(array('class'=>'medium green icon-ok'));
        
        $role = new Zend_Form_Element_Select('usr_role');
        $role->setLabel('User Role:')
        ->setMultiOptions(array(
        'A' => 'Admin',
        'AD' => 'Administrator/Distribution',
        'AS' => 'Administrator/Suppy',
        'AG' => 'Administrator/Generation',
        'AT' => 'Administrator/Transmission'
        ));
        $csrf = new Zend_Form_Element_Hash('csrf');
        $csrf->setDecorators(array('ViewHelper'));

//        $this->addElement('hash', 'csrf', array(
//                'ignore' => true,
//                ));
        //$this->addElement('hidden', 'usr_id', array());
        
        
        if($this->formState == 'update'){
            $usr_id = new Zend_Form_Element_Hidden('usr_id');
            $usr_id->setDecorators(array('ViewHelper'));
        
            $this->addElement($usr_id);
    }
        $this->addElements(array($csrf , $firstname , $lastname , $username , $password , $cpassword , $email , $role , $submit));
    }
    
    public function getFormState() {
        return $this->formState;
    }

    public function setFormState($formState) {
        $this->formState = $formState;
        return $this;
    }


}