<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ecb_Model
 *
 * @author Innocent J Blac
 */
class JBlac_Model {
                protected $ErrorMessages        = array();
                protected $dbh                  = null;
                protected $id                   = null;
	protected $created_by = null;
	protected $created_on_date = null;
	protected $modified_by = null;
	protected $modified_on_date = null;
	protected $active_flag = null;
        protected $DataSet = array();
        
        
                protected $validateNotnull              = false;
                protected $validateEmail                = false;
                protected $validateBetween              = false;
                protected $validateAlnum                = false;
                protected $validateMax                  = false;
                protected $validateLength               = false;
                protected $validateDate                 = false;
                protected $validateDigits               = false;
                protected $validateGreaterthan          = false;
                protected $validateLessthan             = false;
                protected $validateAlpha                = false;
                protected $validateAlphaAllowWhteSpace  = false;
                        
                protected $filterNotnull                = false;
                protected $filterStringToLower          = false;
                protected $filterStringToUpper          = false;
                protected $filterHtmlEntities           = false;
                protected $filterAlnum                  = false;
                protected $filterStripTags              = false;
                protected $filterNewLines               = false;
                protected $filterInt                    = false;
                protected $filterDigits                 = false;
                protected $filterStingTrim              = false;
                protected $filterLessthan               = false;
                protected $filterAlpha                  = false;
                protected $filterAlnumAllowWhiteSpace   = false;
                
                function __construct(array $options) {
                    $this->setDbh($options['dbh']);
                    //Validation Options
                    $this->validateNotnull              = new Zend_Validate_NotEmpty();
                    $this->validateEmail                = new Zend_Validate_EmailAddress();
                    $this->validateBetween              = new Zend_Validate_Between(array('min'=>6 , 'max'=>6000));
                    $this->validateAlnum                = new Zend_Validate_Alnum();
                    $this->validateAlpha                = new Zend_Validate_Alpha();
                    $this->validateAlphaAllowWhteSpace  = new Zend_Validate_Alpha(array('allowwhitespace'=>TRUE));
                    $this->validateLength               = new Zend_Validate_StringLength(array('min'=>6 , 'max'=>7000));
                    $this->validateDate                 = new Zend_Validate_Date();
                    $this->validateDigits               = new Zend_Validate_Digits();
                    $this->validateLessthan             = new Zend_Validate_LessThan(18);
                    
                    //Filtering Options
                    $filterStringToLower            = new Zend_Filter_StringToLower();
                    $filterStringToUpper            = new Zend_Filter_StringToUpper();
                    $filterHtmlEntities             = new Zend_Filter_HtmlEntities();
                    $filterAlnum                    = new Zend_Filter_Alnum;
                    $filterAlnumAllowWhiteSpace     = new Zend_Filter_Alnum(array('allowwhitespace'=>TRUE));
                    $filterStripTags                = new Zend_Filter_StripTags();
                    $filterNewLines                 = new Zend_Filter_StripNewlines();
                    $filterInt                      = new Zend_Filter_Int();
                    $filterDigits                   = new Zend_Filter_Digits();
                    $filterStingTrim                = new Zend_Filter_StringTrim();
                    $filterLessthan                 = new Zend_Filter_StringTrim();
                    $filterAlpha                    = new Zend_Filter_Alpha();                    
                }
                
                public function getErrorMessages() {
                    return $this->ErrorMessages;
                }

                public function setErrorMessages($error) {
                    if(!$this->validateNotnull->isValid($error)){
                        $this->setErrorMessages('Error message is required.');
                    }else{
                                $this->ErrorMessages[] = $error;               
                    }                    
                    return;
                }
                
                public function setDbh($dbh) {

                                $this->dbh = $dbh;               


                    return $this;                     
                    
                }

                public function getCreated_by() {
                    return $this->created_by;
                }

                public function getCreated_on_date() {
                    return $this->created_on_date;
                }

                public function getModified_by() {
                    return $this->modified_by;
                }

                public function getModified_on_date() {
                    return $this->modified_on_date;
                }

                public function getActive_flag() {
                    return $this->active_flag;
                }

                public function setId($id) {
                    if(!$this->validateNotnull->isValid($id)){
                        $this->setErrorMessages('Id sequence is required.');
                        return $this;
                    }else{   
                        $this->id = filter_var($id , FILTER_SANITIZE_NUMBER_INT);
                    }                     
                    
                }                

                public function setCreated_by($created_by) {
                    if(!$this->validateNotnull->isValid($created_by)){
                        $this->setErrorMessages('Created by is required.');
                    }else{   
                        $this->created_by = $created_by;
                    }            
                    return $this;              

                }

                public function setCreated_on_date($created_on_date) {
                    if(!$this->validateNotnull->isValid($created_on_date)){
                        $this->setErrorMessages('Created date is required.');
                    }else{   
                        $this->created_on_date = $created_on_date;
                    }            
                    return $this;             

                }

                public function setModified_by($modified_by) {
                    if(!$this->validateNotnull->isValid($modified_by)){
                        $this->setErrorMessages('Modified by is required.');
                    }else{   
                        $this->modified_by = $modified_by;
                    }            
                    return $this;             

                }

                public function setModified_on_date($modified_on_date) {
                    if(!$this->validateNotnull->isValid($modified_on_date)){
                        $this->setErrorMessages('Modified date is required.');
                    }else{   
                        $this->modified_on_date = $modified_on_date;
                    }            
                    return $this;             

                }
                public function getDataSet() {
                    return $this->DataSet;
                }

                public function setDataSet($DataSet) {
                    if(!$this->validateNotnull->isValid($DataSet)){
                        $this->setErrorMessages('A dataset must be set for this model.');
                    }else{   
                        $this->DataSet = $DataSet;
                    }                     
                    
                    return $this;
                }



}