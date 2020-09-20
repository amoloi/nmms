<?php

class Application_Model_Contribution extends JBlac_Model implements Application_Model_Interface
{
	protected $contribution_id     =     null; 
	protected $contribution_year     =     null; 
	protected $contribution_month     =     null; 
	protected $contribution_amount     =     null; 
	protected $contribution_is_active_flag     =     null; 
	protected $members_member_id     =     null; 


        public function __construct(array $options) {
            parent::__construct($options);
        }
        
        public function getContribution_id() {
            return $this->contribution_id;
        }

        public function getContribution_year() {
            return $this->contribution_year;
        }

        public function getContribution_month() {
            return $this->contribution_month;
        }

        public function getContribution_amount() {
            return $this->contribution_amount;
        }

        public function getContribution_is_active_flag() {
            return $this->contribution_is_active_flag;
        }

        public function getMembers_member_id() {
            return $this->members_member_id;
        }

        public function getMonths_moth_id() {
            return $this->months_moth_id;
        }

        public function setContribution_id($contribution_id) {
            $this->contribution_id = $contribution_id;
            return $this;
        }

        public function setContribution_year($contribution_year) {
            $this->contribution_year = $contribution_year;
            return $this;
        }

        public function setContribution_month($contribution_month) {
            $this->contribution_month = $contribution_month;
            return $this;
        }

        public function setContribution_amount($contribution_amount) {
            $this->contribution_amount = $contribution_amount;
            return $this;
        }

        public function setContribution_is_active_flag($contribution_is_active_flag) {
            $this->contribution_is_active_flag = $contribution_is_active_flag;
            return $this;
        }

        public function setMembers_member_id($members_member_id) {
            $this->members_member_id = $members_member_id;
            return $this;
        }

        public function setMonths_moth_id($months_moth_id) {
            $this->months_moth_id = $months_moth_id;
            return $this;
        }
        
        public function insert() {
           $sql = 'INSERT INTO contribution 
						(
								contribution_year, 
								contribution_month, 
								contribution_amount, 
								members_member_id, 
								created_by  
								
						)
						VALUES
						(
	
								:contribution_year, 
								:contribution_month, 
								:contribution_amount,
                                                                :members_member_id
								:created_by  
								
						)';
           
                                $stmt = $this->dbh->prepare($sql);    
                                $stmt->bindParam(':contribution_year' , $this->salary_code , pdo::PARAM_STR);
                                $stmt->bindParam(':contribution_month' , $this->salary_code , pdo::PARAM_STR);
                                $stmt->bindParam(':contribution_amount' , $this->salary_code , pdo::PARAM_INT);
                                $stmt->bindParam(':members_member_id' , $this->salary_code , pdo::PARAM_INT); 
                                $stmt->bindParam(':created_by' , $this->created_by , pdo::PARAM_STR);
                                
                                try {
                                    $stmt->execute();
                                    $this->setId($this->dbh->lastInsertId());
                                    return 'success';
                                } catch (PDOException $exc) {
                                    echo $exc->getMessage();
                                    return 'failure';
                                }             
        } 
        
        public function fetchAll() {
            ;
        }
        
        public function fetchOne($value) {
            ;
        }
        public function update($value) {
            ;
        }

        public function delete($value) {
            ;
        }


}

