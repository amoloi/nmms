<?php

class Application_Form_Referencetypes extends Application_Model_Ecbform
{
    protected $formState = null;
    
    public function __construct($options = null , $form_state = 'create') {
        

        $this->setFormState($form_state);
       
        parent::__construct($options);
    }
    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    
    $reference_type_code =  new Zend_Form_Element_Text('rtp_cd');
    $reference_type_code->setLabel('Reference Type Code');
    $reference_type_code->setAttribs(array('class'=>'col_7' , 'max'=>'25'));
    $reference_type_code->setRequired(TRUE);
    $reference_type_code->setErrorMessages(array('Refference Type Code is Required'));
   
    
    $reference_type_desc = new Zend_Form_Element_Textarea('rtp_desc');
    $reference_type_desc->setLabel('Reference Type Description');
    $reference_type_desc->setRequired(TRUE);
    $reference_type_desc->setErrorMessages(array('Reference Type Description is Required'));
    
    $commandbutton = new Zend_Form_Element_Submit('cmdSave' , 'Save Data');
    $commandbutton->setAttribs(array('class'=>'medium green icon-ok'));
    
    if($this->formState == 'update'){
        $rtp_id = new Zend_Form_Element_Hidden('rtp_id');
        $rtp_id->setDecorators(array('ViewHelper'));
        
        $this->addElement($rtp_id);
    }
    
    
    $this->addElements(array($reference_type_code , $reference_type_desc , $commandbutton));
    
    }
    
    public function getFormState() {
        return $this->formState;
    }

    public function setFormState($formState) {
        $this->formState = $formState;
        return $this;
    }

    /*
 * CREATE TABLE `rf_reference_types` (
  `rpt_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `rpt_desc` VARCHAR(4000) NOT NULL,
  `rpt_admin_only_f` SMALLINT(1) NOT NULL DEFAULT '1',
  `rpt_cuser` VARCHAR(15) DEFAULT NULL,
  `rpt_cdate` DATETIME DEFAULT NULL,
  `rpt_muser` VARCHAR(15) DEFAULT NULL,
  `rpt_mdate` DATETIME DEFAULT NULL,
  PRIMARY KEY (`rpt_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8
 */

}

