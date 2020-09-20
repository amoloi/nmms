<?php

class Application_Form_Referencecodes extends Zend_Form
{
    protected $formState = null;
    
    public function __construct($options = null , $form_state = 'create') {
        

        $this->setFormState($form_state);
       
        parent::__construct($options);
    }
    public function getFormState() {
        return $this->formState;
    }

    public function setFormState($formState) {
        $this->formState = $formState;
        return $this;
    }

        public function init()
    {
        /* Form Elements & Other Definitions Here ... */    
"CREATE TABLE `rf_reference_codes` (
  `ref_rtp_cd` VARCHAR(20) NOT NULL,
  `ref_id` BIGINT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ref_cd` VARCHAR(10) NOT NULL,
  `ref_desc` VARCHAR(100) NOT NULL,
  `ref_active_f` SMALLINT(1) NOT NULL DEFAULT 1,
  `ref_cuser` VARCHAR(15) NOT NULL,
  `ref_cdate` DATETIME NOT NULL,
  `ref_muser` VARCHAR(15) DEFAULT NULL,
  `ref_mdate` DATETIME DEFAULT NULL
)";
/*
 * Creating Refference Types
 */     $db = Zend_Registry::get('db');
        $strSql =         "SELECT 	`rtp_cd`, 
                                        `rtp_desc`
                                        FROM 
                                        `ecb`.`rf_reference_types` ";

                try{
                    $data = $db->query($strSql);
                    $typesData = array();
                    $refTypesData = $data->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($refTypesData as $key => $value) {
                        if(is_array($value)){
                            $typesData[$value['rtp_cd']] = $value['rtp_desc'];
                        }
                    }
                }  catch (PDOException $e){
                    $this->_flashMessenger->addMessage(array('message'=>'The System is Unable to Complete your request ERROR: ' . $e->getMessage() , 'status'=>'error'));
                   // exit($e->getMessage() . ' - ' . $e->getTrace());
                }


    $reference_reference_type_cd = new Zend_Form_Element_Select('ref_rtp_cd');
    $reference_reference_type_cd->setLabel('Reference Type Code');
    $reference_reference_type_cd->setAttribs(array('class'=>'col_7' , 'max'=>'25'));
    $reference_reference_type_cd->setMultiOptions($typesData);
    $reference_reference_type_cd->setRequired(TRUE);
    $reference_reference_type_cd->setErrorMessages(array('Reference Type Code is requires'));
    
    $reference_code =  new Zend_Form_Element_Text('ref_cd');
    $reference_code->setLabel('Refference Code Code');
    $reference_code->setRequired(TRUE);
    $reference_code->setAttribs(array('class'=>'col_7' , 'max'=>'25'));
    $reference_code->setErrorMessages(array('Refference Code is Required'));
    $reference_code->removeDecorator('Errors');
   
    
    $reference_desc = new Zend_Form_Element_Textarea('ref_desc');
    $reference_desc->setLabel('Refference Code Description');
    $reference_desc->setRequired(TRUE);
    $reference_desc->removeDecorator('Errors');
    
    $commandbutton = new Zend_Form_Element_Submit('cmdSave' , 'Save Data');
    $commandbutton->setAttribs(array('class'=>'medium green icon-ok'));
    
    
    
    if($this->formState == 'update'){
        $ref_id = new Zend_Form_Element_Hidden('ref_id');
        $ref_id->setDecorators(array('ViewHelper'));
        
        $this->addElement($ref_id);
    }
    $this->addElements(array($reference_reference_type_cd , $reference_code , $reference_desc , $commandbutton));
    }
    
}

