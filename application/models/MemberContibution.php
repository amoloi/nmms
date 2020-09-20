<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application_Model_Member
 *
 * @author Innocent J Blac
 */
class Application_Model_MemberContibution {
    
    /*
     * ****************************
     * Member Related Data
     * ****************************
     */
				protected $id = null; 
				protected $member_id = null; 
                                
    /*
     * ****************************
     * Months Related Data
     * ****************************
     */                                
				protected $year = null;
                                protected $january = 0.00; 
				protected $february = 0.00; 
				protected $march = 0.00; 
				protected $april = 0.00; 
				protected $may = 0.00; 
				protected $june = 0.00; 
				protected $july = 0.00; 
				protected $august = 0.00; 
				protected $september = 0.00; 
				protected $october = 0.00; 
				protected $november = 0.00; 
				protected $december = 0.00;
    /*
     * ****************************
     * Auditing Data
     * ****************************
     */                                
				protected $created_by = null; 
				protected $created_on = null; 
				protected $modified_by = null; 
				protected $modified_on = null;
                                
                                public function getId() {
                                    return $this->id;
                                }

                                public function getMemberId() {
                                    return $this->member_id;
                                }
                                public function getYear() {
                                    return $this->year;
                                }
                                public function getJanuary() {
                                    return $this->january;
                                }

                                public function getFebruary() {
                                    return $this->february;
                                }

                                public function getMarch() {
                                    return $this->march;
                                }

                                public function getApril() {
                                    return $this->april;
                                }

                                public function getMay() {
                                    return $this->may;
                                }

                                public function getJune() {
                                    return $this->june;
                                }

                                public function getJuly() {
                                    return $this->july;
                                }

                                public function getAugust() {
                                    return $this->august;
                                }

                                public function getSeptember() {
                                    return $this->september;
                                }

                                public function getOctober() {
                                    return $this->october;
                                }

                                public function getNovember() {
                                    return $this->november;
                                }

                                public function getDecember() {
                                    return $this->december;
                                }

                                public function getCreatedBy() {
                                    return $this->created_by;
                                }

                                public function getCreatedOn() {
                                    return $this->created_on;
                                }

                                public function getModifiedBy() {
                                    return $this->modified_by;
                                }

                                public function getModifiedOn() {
                                    return $this->modified_on;
                                }

                                public function setId($id) {
                                    $this->id = $id;
                                    return $this;
                                }

                                public function setMemberId($member_id) {
                                    $this->member_id = $member_id;
                                    return $this;
                                }
                                public function setYear($year) {
                                    $this->year = $year;
                                    return $this;
                                }
                                public function setJanuary($january) {
                                    $this->january =(!empty($january) ? floatval($january) : floatval($this->january));
                                    return $this;
                                }

                                public function setFebruary($february) {
                                    $this->february = (!empty($february) ? floatval($february) : floatval($this->february));
                                    return $this;
                                }

                                public function setMarch($march) {
                                    $this->march = (!empty($march) ? floatval($march) : floatval($this->march));
                                    return $this;
                                }

                                public function setApril($april) {
                                    $this->april = (!empty($april) ? floatval($april) : floatval($this->april));
                                    return $this;
                                }

                                public function setMay($may) {
                                    $this->may = (!empty($may) ? floatval($may) : floatval($this->may));
                                    return $this;
                                }

                                public function setJune($june) {
                                    $this->june = (!empty($june) ? floatval($june) : floatval($this->june));
                                    return $this;
                                }

                                public function setJuly($july) {
                                    $this->july = (!empty($july) ? floatval($july) : floatval($this->july));
                                    return $this;
                                }

                                public function setAugust($august) {
                                    $this->august = (!empty($august) ? floatval($august) : floatval($this->august));
                                    return $this;
                                }

                                public function setSeptember($september) {
                                    $this->september = (!empty($september) ? floatval($september) : floatval($this->september));
                                    return $this;
                                }

                                public function setOctober($october) {
                                    $this->october = (!empty($october) ? floatval($october) : floatval($this->october));
                                    return $this;
                                }

                                public function setNovember($november) {
                                    $this->november = (!empty($november) ? floatval($november) : floatval($this->november));
                                    return $this;
                                }

                                public function setDecember($december) {
                                    $this->december = (!empty($december) ? floatval($december) : floatval($this->december));
                                    return $this;
                                }

                                public function setCreatedBy($created_by) {
                                    $this->created_by = $created_by;
                                    return $this;
                                }

                                public function setCreatedOn($created_on) {
                                    $this->created_on = $created_on;
                                    return $this;
                                }

                                public function setModifiedBy($modified_by) {
                                    $this->modified_by = $modified_by;
                                    return $this;
                                }

                                public function setModifiedOn($modified_on) {
                                    $this->modified_on = $modified_on;
                                    return $this;
                                }

                                public function save(){
                                    $data = [ 
                                                'january' => $this->getJanuary() ,
                                                'february' => $this->getFebruary(),
                                                'march' => $this->getMarch(),
                                                'april' => $this->getApril(),
                                                'may' => $this->getMay(),
                                                'june' => $this->getJune(),
                                                'july' => $this->getJuly(),
                                                'august' => $this->getAugust(),
                                                'september' => $this->getSeptember(),
                                                'october' => $this->getOctober(),
                                                'november' => $this->getNovember(),
                                                'december' => $this->getDecember() ,
                                                'id' => $this->getId(),
                                                'member_id' => $this->getMemberId(),
                                                'year' => $this->getYear()
                                               ] ;
                                    
                                    $dbTable = new Application_Model_DbTable_MemberContribution();
//                                    Zend_Debug::dump($this);
//                                                                        return;
                                    if(null === $this->getId()){
                                        unset($data[id]);
                                        try {
                                            $dbTable->insert($data);
                                        } catch (Exception $exc) {
                                            echo $exc->getTraceAsString();
                                        }

                                        
                                    }else{
                                        $dbTable->update($data , ['id = ?' => $this->getId()]);
                                    }
                                }
                                public static function generateYears(){
                                    $start_date = 1989;
                                    $current_date = intval(date('Y'));
                                    $years = [];

                                    for($x = 0; $x <= (intval(date('Y')) - 1989); $x++){
                                       $years[intval(date('Y')) - $x] = intval(date('Y')) - $x;
                                    }
                                    $years[''] = 'Select Year';
                                    return $years;
                                }
                                
                                public function fetchMemberContributions($member_id){
                                    $dbTable = new Application_Model_DbTable_MemberContributionView();
                                    $db = $dbTable->getDefaultAdapter();
                                    $select = $dbTable->select();
                                    $select->from('contributions_v');
                                    $select->where('member_id = ?' , $member_id);
                                    
                                    try {
                                        return $db->fetchAll($select);
                                    } catch (Exception $exc) {
                                        echo $exc->getTraceAsString();
                                    }
                                                                }
                               
}