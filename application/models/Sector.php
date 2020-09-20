<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application_Model_Sector
 *
 * @author Innocent J Blac
 */
class Application_Model_Sector extends JBlac_Model implements Application_Model_Interface {
    
	protected $id = null;
	protected $sector_name = null;
	protected $sector_description = null;

        
        public function __construct(array $options) {
            parent::__construct($options);
        }
        
        public function getId() {
            return $this->id;
        }

        public function getSector_name() {
            return $this->sector_name;
        }

        public function getSector_description() {
            return $this->sector_description;
        }

        public function setId($id) {
            if(!$this->validateNotnull->isValid($id)){
                $this->setErrorMessages('Sector ID is required');
            }else{
               $this->id = filter_var($id , FILTER_SANITIZE_NUMBER_INT); 
            }
            
            return $this;
        }

        public function setSector_name($sector_name) {
            if(!$this->validateNotnull->isValid($sector_name)){
                $this->setErrorMessages('Sector name is required');
            }else{
                $this->sector_name = filter_var($sector_name , FILTER_SANITIZE_STRING);
            }                       
            return $this;
        }

        public function setSector_description($sector_description) {
            if(!$this->validateNotnull->isValid($sector_description)){
                $this->setErrorMessages('Sector discription is required');
            }else{
                $this->sector_description = filter_var($sector_description , FILTER_SANITIZE_STRING);
            }            
            
            return $this;
        }

        
        public function insert() {
            if(count($this->ErrorMessages) > 0){
                return 'error';
            }
                        $sql = 'INSERT INTO old_sector 
                                                    (
                                                        sector_name, 
                                                        sector_description
                                                    )
                                                VALUES
                                                    (
                                                        :sector_name, 
                                                        :sector_description
                                                    )';

                                             $stmt = $this->dbh->prepare($sql);    
                                             $stmt->bindParam(':sector_name' , $this->sector_name , pdo::PARAM_STR);
                                             $stmt->bindParam(':sector_description' , $this->sector_description , pdo::PARAM_STR);
                                
                                try {
                                    $stmt->execute();
                                    $this->setId($this->dbh->lastInsertId());
                                    return 'success';
                                } catch (PDOException $exc) {
                                    $this->setErrorMessages($exc->getMessage());
                                    return 'error';
                                }             
        } 
        
                                public function fetchAll() {
                                  $sql = 'SELECT * from sectors_v';
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
                                public function fetchOne($value) {
                                    $sql = 'SELECT * FROM sectors_v WHERE id=:id';
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
                             public function update($value) {
                                    $sql = 'UPDATE old_sector 
                                                                SET
                                                                                sector_name        = :sector_name, 
                                                                                sector_description = :sector_description

                                                                WHERE
                                                                        id = :id ';
                                             $stmt = $this->dbh->prepare($sql);    
                                             $stmt->bindParam(':sector_name' , $this->sector_name , pdo::PARAM_STR);
                                             $stmt->bindParam(':sector_description' , $this->sector_description , pdo::PARAM_STR);
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
                                    $sql = 'DELETE FROM old_sector 
                                                                WHERE
                                                                        id = :id ';
                                             $stmt = $this->dbh->prepare($sql);    
                                             $stmt->bindParam(':id' , $this->id , pdo::PARAM_INT);
                                try {
                                    $stmt->execute();
                                    return 'success';
                                } catch (PDOException $exc) {
                                    $this->setErrorMessages($exc->getMessage());
                                    return 'error';
                                } 
        }
                                public function listDepartments($search = null){
                                
                                    $db = Zend_Db_Table::getDefaultAdapter();
                                    $selectMembers = new Zend_Db_Select($db);
                                    $selectMembers->from('old_sector');
                                    if(null !== $search){
                                        //$search = filter_var($search , FILTER_SANITIZE_STRING);
                                        //$search = preg_replace('/[^a-zA-Z0-9 ]/', '', $search);
                                        $selectMembers->where('sector_name LIKE :search');
                                        $selectMembers->orWhere('sector_description LIKE :search');
                                        
                                        $selectMembers->bind(array(
                                                                    ':search' => "{$search}%",
                                        ));
                                    }
                                    $selectMembers->order('sector_name ASC');
                                    
                                    return $selectMembers;
                                }        
}
