<?php

class Application_Model_Company extends JBlac_Model implements Application_Model_Interface
{
    		protected $id                   =          null; 
		protected $company_name         =          null; 
		protected $sector               =          null; 
		protected $postal_address       =          null; 
		protected $telephone_number     =          null; 
		protected $fax_number           =          null; 
		protected $email_address        =          null; 
		protected $contact_person       =          null; 
		protected $branch               =          null;
                
                public function __construct(array $options) {
                    parent::__construct($options);
                }
                public function getId() {
                    return $this->id;
                }

                public function getCompany_name() {
                    return $this->company_name;
                }

                public function getSector() {
                    return $this->sector;
                }

                public function getPostal_address() {
                    return $this->postal_address;
                }

                public function getTelephone_number() {
                    return $this->telephone_number;
                }

                public function getFax_number() {
                    return $this->fax_number;
                }

                public function getEmail_address() {
                    return $this->email_address;
                }

                public function getContact_person() {
                    return $this->contact_person;
                }

                public function getBranch() {
                    return $this->branch;
                }

                public function setId($id) {
                    $this->id = $id;
                    return $this;
                }

                public function setCompany_name($company_name) {
                    $this->company_name = $company_name;
                    return $this;
                }

                public function setSector($sector) {
                    $this->sector = $sector;
                    return $this;
                }

                public function setPostal_address($postal_address) {
                    $this->postal_address = $postal_address;
                    return $this;
                }

                public function setTelephone_number($telephone_number) {
                    $this->telephone_number = $telephone_number;
                    return $this;
                }

                public function setFax_number($fax_number) {
                    $this->fax_number = $fax_number;
                    return $this;
                }

                public function setEmail_address($email_address) {
                    $this->email_address = $email_address;
                    return $this;
                }

                public function setContact_person($contact_person) {
                    $this->contact_person = $contact_person;
                    return $this;
                }

                public function setBranch($branch) {
                    $this->branch = $branch;
                    return $this;
                }

                public function insert() {
                        $sql = 'INSERT INTO old_company 
                                                         (
                                                                 company_name, 
                                                                 sector, 
                                                                 postal_address, 
                                                                 telephone_number, 
                                                                 fax_number, 
                                                                 email_address, 
                                                                 contact_person, 
                                                                 branch
                                                         )
                                                         values
                                                         (
                                                                 :company_name, 
                                                                 :sector, 
                                                                 :postal_address, 
                                                                 :telephone_number, 
                                                                 :fax_number, 
                                                                 :email_address, 
                                                                 :contact_person, 
                                                                 :branch
                                                         )';

                                             $stmt = $this->dbh->prepare($sql);    
                                             $stmt->bindParam(':company_name' , $this->company_name , pdo::PARAM_STR);
                                             $stmt->bindParam(':sector' , $this->sector , pdo::PARAM_STR);
                                             $stmt->bindParam(':postal_address' , $this->postal_address , pdo::PARAM_STR);
                                             $stmt->bindParam(':telephone_number' , $this->telephone_number , pdo::PARAM_STR); 
                                             $stmt->bindParam(':fax_number' , $this->fax_number , pdo::PARAM_STR);
                                             $stmt->bindParam(':email_address' , $this->email_address , pdo::PARAM_STR);
                                             $stmt->bindParam(':contact_person' , $this->contact_person , pdo::PARAM_INT);
                                             $stmt->bindParam(':branch' , $this->email_address , pdo::PARAM_STR);
                                
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
                                  $sql = 'SELECT * from companies_v';
                                  $stmt = $this->dbh->prepare($sql);
                                try {
                                    $stmt->execute();
                                    $this->setDataSet($stmt->fetchAll(PDO::FETCH_ASSOC));
                                    return 'success';
                                } catch (PDOException $exc) {
                                    $this->setErrorMessages($exc->getMessage());
                                    return 'error';
                                }                                   
                                }
                                public function listCompanies($search = null){
                                
                                    $db = Zend_Db_Table::getDefaultAdapter();
                                    $selectCompanies = new Zend_Db_Select($db);
                                    $selectCompanies ->from('companies_v');
                                    if($search !== null){
                                        $search = filter_var($search , FILTER_SANITIZE_STRING);
                                        $search = preg_replace('/[^a-zA-Z0-9 ]/', '', $search);
                                        $selectCompanies ->where('company_name LIKE :search');
                                        
                                        $selectCompanies ->bind(array(
                                                                    ':search' => "%{$search}%",
                                        ));
                                    }
                                    $selectCompanies ->order('company_name ASC');
                                    
                                    return $selectCompanies ;
                                }                                
                                public function fetchOne($value) {
                                    $sql = 'SELECT * FROM companies_v WHERE id=:id';
                                    $stmt = $this->dbh->prepare($sql);
                                    $stmt->bindParam(':id',  $this->id , PDO::PARAM_INT);
                                    try {
                                        $stmt->execute();
                                        $this->setDataSet($stmt->fetch(PDO::FETCH_ASSOC));
                                        return 'success';
                                    } catch (PDOException $exc) {
                                        $this->setErrorMessages($exc->getMessage());
                                        return 'error';
                                    }                                     
                                }
                                public function fetchTotalCompanies($value) {
                                    $sql = 'SELECT COUNT(id) total_member FROM companies_v';
                                    $stmt = $this->dbh->prepare($sql);
                                    try {
                                    $stmt->execute();
                                    $this->setDataSet($stmt->fetch(PDO::FETCH_ASSOC));
                                    return 'success';
                                    } catch (PDOException $exc) {
                                        $this->setErrorMessages($exc->getMessage());
                                        return 'error';
                                    }                                     
                                }
                                public function fetchCompanyFinance($member_id){
                                    $total_contribution = null;
                                    $sql = 'SELECT * FROM companies_v WHERE company_name = :company_name';
                                    $stmt = $this->dbh->prepare($sql);
                                    $stmt->bindParam(':company_name' , $this->company_name , PDO::PARAM_STR);
                                    try {
                                    $stmt->execute();
                                    $months = $stmt->fetch(PDO::FETCH_ASSOC);
                                    
                                    foreach ($months as $key => $value) {
                                        $total_contribution = floatval($total_contribution) + floatval($value); 
                                    }
                                     $months['total'] = $total_contribution;
                                    return $months;
                                        } catch (PDOException $exc) {
                                            echo $exc->getMessage();
                                            return 'failure';
                                        }
                                        }
                                public function update($value) {
                                    $sql = 'UPDATE old_company 
                                                                SET
                                                                                company_name        = :company_name, 
                                                                                sector              = :sector, 
                                                                                postal_address      = :postal_address, 
                                                                                telephone_number    = :telephone_number, 
                                                                                fax_number          = :fax_number, 
                                                                                email_address       = :email_address, 
                                                                                contact_person      = :contact_person, 
                                                                                branch              = :branch

                                                                WHERE
                                                                        id = :id ';
                                             $stmt = $this->dbh->prepare($sql);    
                                             $stmt->bindParam(':company_name' , $this->company_name , pdo::PARAM_STR);
                                             $stmt->bindParam(':sector' , $this->sector , pdo::PARAM_STR);
                                             $stmt->bindParam(':postal_address' , $this->postal_address , pdo::PARAM_STR);
                                             $stmt->bindParam(':telephone_number' , $this->telephone_number , pdo::PARAM_STR); 
                                             $stmt->bindParam(':fax_number' , $this->fax_number , pdo::PARAM_STR);
                                             $stmt->bindParam(':email_address' , $this->email_address , pdo::PARAM_STR);
                                             $stmt->bindParam(':contact_person' , $this->contact_person , pdo::PARAM_STR);
                                             $stmt->bindParam(':branch' , $this->branch , pdo::PARAM_STR);
                                             $stmt->bindParam(':id' , $this->id , pdo::PARAM_INT);
                                
                                try {
                                    $stmt->execute();
                                    return 'success';
                                } catch (PDOException $exc) {
                                    $this->setErrorMessages($exc->getMessage());
                                    return 'error';
                                }             
        }

                                public function delete($value) {
                                    $sql = 'DELETE FROM companies_v WHERE id = :id';
                                    $stmt = $this->dbh->prepare($sql);
                                    $stmt->bindParam(':id',  $this->id , PDO::PARAM_INT);
	                            try {
	                                    $stmt->execute();
	                                    return 'success';
	                                } catch (PDOException $exc) {
	                                    $this->setErrorMessages($exc->getMessage());
	                                    return 'error';
	                                }                                    
                                }


}

