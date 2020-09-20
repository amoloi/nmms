<?php

class Application_Form_Applicant extends Application_Model_Ecbform
{
    protected $form_state = null;
    protected $applicant_type = null;

    public function __construct($options = null , $extras = array('form_state'=>'create',
                                                                  'applicant_type'=>'IND')) {
        $this->form_state = $extras['form_state'];
        $this->applicant_type = $extras['applicant_type'];
        parent::__construct($options);
    }
    
//$a = "$per_personType, 
//	$per_firstName, 
//	$per_lastName, 
//	$per_gender, 
//	$per_birthDate, 
//	$per_nationalIdNo, 
//	$per_passportNo, 
//          per_cuser, 
//	`per_cdate`, 
//	`per_muser`, 
//	`per_mdate`
//    ";
    public function init()
    {
        $per_personType = new Zend_Form_Element_Hidden('per_personType');
        $per_personType->removeDecorator('viewHelper');        
        $per_firstName = new Zend_Form_Element_Text('per_firstName');
        $per_firstName->setLabel('First Name');
        $per_firstName->setRequired(TRUE);
        $per_firstName->addErrorMessage('First Name is required');
        $per_firstName->setAttribs(array('class'=>'col_7'));
        
       
        $per_lastName = new Zend_Form_Element_Text('per_lastName');
        $per_lastName->setLabel('Last Name');
        $per_lastName->setRequired(TRUE);
        $per_lastName->addErrorMessage('Last Name is required');
        $per_lastName->setAttribs(array('class'=>'col_7'));
        
        $per_gender = new Zend_Form_Element_Select('per_genger');
        $per_gender->setLabel('Gender');
        $per_gender->setRequired(TRUE);
        $per_gender->addErrorMessage('Gender is required');
        $per_gender->setAttribs(array('class'=>'col_7'));
        $per_gender->addMultiOptions(array('M'=>'Male',
                                           'F'=>'Female'));
        
        $per_birthDate = new Zend_Form_Element_Text('per_birthDate');
        $per_birthDate->setLabel('Date of birth');
        $per_birthDate->setAttribs(array('class' => 'col_3 hasdatepicker'));
        $per_birthDate->setRequired(TRUE);
        
        $per_nationalIdNo = new Zend_Form_Element_Text('per_nationalIdNo');
        $per_nationalIdNo->setLabel('National Identity No');
        $per_nationalIdNo->setRequired(TRUE);
        $per_nationalIdNo->addErrorMessage('National Identity Required');
        $per_nationalIdNo->setAttribs(array('class'=>'col_7'));
        
        $per_registrationNo = new Zend_Form_Element_Text('per_registrationNo');
        $per_registrationNo->setLabel('Registration Number');
        $per_registrationNo->setRequired(TRUE);
        $per_registrationNo->addErrorMessage('Registration Number Required');
        $per_registrationNo->setAttribs(array('class'=>'col_7'));
        
        $per_passportNo = new Zend_Form_Element_Text('per_passportNo');
        $per_passportNo->setLabel('Passport No');
        $per_passportNo->setRequired(TRUE);
        $per_passportNo->addErrorMessage('Passport Number is Required');
        $per_passportNo->setAttribs(array('class'=>'col_7'));

        $per_Country = new Zend_Form_Element_Select('per_Country');
        $per_Country->setLabel('Country');
        $per_Country->setRequired(TRUE);
        $per_Country->addErrorMessage('Country is required');
        $per_Country->addMultiOptions(array('TZ'=>'TAnzania',
                                            'NAM'=>'Namibia'));
        $per_Country->setAttribs(array('class'=>'col_7'));
        
        $per_Nationality = new Zend_Form_Element_Select('per_Nationality');
        $per_Nationality->setLabel('Nationality');
        $per_Nationality->setRequired(TRUE);
        $per_Nationality->addErrorMessage('Nationality is required');
        $per_Nationality->addMultiOptions(array('TZ'=>'TAnzanian',
                                                'NAM'=>'Namibian'));
        $per_Nationality->setAttribs(array('class'=>'col_7'));
        
        $legalformationbody = new Zend_Form_Element_Text('app_legalformationbody_date');
        $legalformationbody->setLabel('In the case of authority created by law , the name of the law in terms of which that authority was created/established');
        $legalformationbody->setAttribs(array('class' => 'col_11'));
        $legalformationbody->setRequired(TRUE);
        
        $submit = new Zend_Form_Element_Submit('cmd_save');
        
        $submit->setLabel('Save');
        $submit->setAttribs(array('class'=>'col_4'));
        $this->addElements(array(   $per_personType ,
                                    $per_firstName ,
                                    $per_lastName,
                                    $per_gender,
                                    $per_birthDate,
                                    $per_nationalIdNo,
                                    $per_registrationNo,
                                    $per_passportNo,
                                    $per_Country,
                                    $per_Nationality,
                                    $legalformationbody,
                                    $submit
                                    ));
        
        
    }

    public function getForm_state() {
        return $this->form_state;
}

public function setForm_state($form_state) {
        $this->form_state = $form_state;
        return $this;
}

public function getApplicant_type() {
        return $this->applicant_type;
}

public function setApplicant_type($applicant_type) {
        $this->applicant_type = $applicant_type;
        return $this;
}


}

