<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Address
 *
 * @author Innocent J Blac
 */
class Application_Model_AddressContact implements Application_Model_Interface {
    //Address Related
    private $id = null;
    private $type; //Corporate or Individual
    private $physicalAddress;
    private $postalAddress;
    private $city; // or town
    private $region; // or province or state...
    private $constituency;
    private $postalCode;
    private $country;
    
    //Contact Related
    private $emailAddress;
    private $telphoneNumber;
    private $mobileNumber; // or town
    private $faxNumber; // 

    //System Related
    private $created_by = null;
    private $created_on_date = null;
    private $modified_by = null;
    private $modified_on_date = null;
    private $active_flag = 0;
    
    protected $dbh = null;


    //Referential Related
    protected $belongsto_id;
            
    function __construct($db) {
        $this->dbh = $db;
    }
    public function getPhysicalAddress() {
        return $this->physicalAddress;
    }

    public function getPostalAddress() {
        return $this->postalAddress;
    }

    public function getAddressLine2() {
        return $this->addressLine2;
    }

    public function getCity() {
        return $this->city;
    }

    public function getRegion() {
        return $this->region;
    }

    public function getConstituency() {
        return $this->constituency;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setPhysicalAddress($physicalAddress) {
        $this->physicalAddress = $physicalAddress;
        return $this;
    }

    public function setPostalAddress($postalAddress) {
        $this->postalAddress = $postalAddress;
        return $this;
    }

    public function setAddressLine2($addressLine2) {
        $this->addressLine2 = $addressLine2;
        return $this;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function setRegion($region) {
        $this->region = $region;
        return $this;
    }

    public function setConstituency($constituency) {
        $this->constituency = $constituency;
        return $this;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }
    public function getBelongsto_id() {
        return $this->belongsto_id;
    }

    public function setBelongsto_id($belongsto_id) {
        $this->belongsto_id = $belongsto_id;
        return $this;
    }
    public function getType() {
        return $this->type;
    }

    public function getEmailAddress() {
        return $this->emailAddress;
    }

    public function getTelphoneNumber() {
        return $this->telphoneNumber;
    }

    public function getMobileNumber() {
        return $this->mobileNumber;
    }

    public function getFaxNumber() {
        return $this->faxNumber;
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

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setEmailAddress($emailAddress) {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function setTelphoneNumber($telphoneNumber) {
        $this->telphoneNumber = $telphoneNumber;
        return $this;
    }

    public function setMobileNumber($mobileNumber) {
        $this->mobileNumber = $mobileNumber;
        return $this;
    }

    public function setFaxNumber($faxNumber) {
        $this->faxNumber = $faxNumber;
        return $this;
    }

    public function setCreated_by($created_by) {
        $this->created_by = $created_by;
        return $this;
    }

    public function setCreated_on_date($created_on_date) {
        $this->created_on_date = $created_on_date;
        return $this;
    }

    public function setModified_by($modified_by) {
        $this->modified_by = $modified_by;
        return $this;
    }

    public function setModified_on_date($modified_on_date) {
        $this->modified_on_date = $modified_on_date;
        return $this;
    }

    public function setActive_flag($active_flag) {
        $this->active_flag = $active_flag;
        return $this;
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

        public function insert() {
$strSQL = 'INSERT INTO address_contact (
                                    type,
                                    physical_address,
                                    postal_address,
                                    city,
                                    region,
                                    constituency,
                                    postal_code,
                                    country,
                                    email_address,
                                    telphone_number,
                                    mobile_number,
                                    fax_number,
                                    created_by,
                                    active_flag,
                                    belongsto_id)
                         VALUES(
                                    :type,
                                    :physical_address,
                                    :postal_address,
                                    :city,
                                    :region,
                                    :constituency,
                                    :postal_code,
                                    :country,
                                    :email_address,
                                    :telphone_number,
                                    :mobile_number,
                                    :fax_number,
                                    :created_by,
                                    :active_flag,
                                    :belongsto_id)';
      
      //$conn = Zend_Registry::get('doctrine_conn');
      //$conn->executeQuery($this->table_name );
      
      //prepare statements
      $pSQL = $this->dbh->prepare($strSQL);
                                    $pSQL->bindParam(':type' , $this->type , pdo::PARAM_STR);
                                    $pSQL->bindParam(':physical_address' , $this->physicalAddress , pdo::PARAM_STR);
                                    $pSQL->bindParam(':postal_address' , $this->postalAddress , pdo::PARAM_STR);
                                    $pSQL->bindParam(':city' , $this->city , pdo::PARAM_STR);
                                    $pSQL->bindParam(':region' , $this->region , pdo::PARAM_STR);
                                    $pSQL->bindParam(':constituency' , $this->constituency , pdo::PARAM_STR);
                                    $pSQL->bindParam(':postal_code' , $this->postalCode , pdo::PARAM_STR);
                                    $pSQL->bindParam(':country' , $this->country , pdo::PARAM_STR);
                                    $pSQL->bindParam(':email_address' , $this->emailAddress , pdo::PARAM_STR);
                                    $pSQL->bindParam(':telphone_number' , $this->telphoneNumber , pdo::PARAM_STR);
                                    $pSQL->bindParam(':mobile_number' , $this->mobileNumber , pdo::PARAM_STR);
                                    $pSQL->bindParam(':fax_number' , $this->faxNumber , pdo::PARAM_STR);
                                    $pSQL->bindParam(':created_by' , $this->created_by , pdo::PARAM_STR);
                                    $pSQL->bindParam(':active_flag' , $this->active_flag , pdo::PARAM_INT);
                                    $pSQL->bindParam(':belongsto_id' , $this->belongsto_id , pdo::PARAM_STR);     
      try {
          $pSQL->execute();
          $this->setId($this->dbh->lastInsertId());
          return TRUE;
      } catch (PDOException $exc) {
          //echo $exc->getMessage();
          return FALSE;
      }        
    }
    public function update($value = null) {
  $strSQL = 'UPDATE address_contact SET 
                                    type = :type,
                                    physical_address = :physical_address,
                                    postal_address = :postal_address,
                                    city = :city,
                                    region = :region,
                                    constituency = :constituency,
                                    postal_code = :postal_code,
                                    country = :country,
                                    email_address = :email_address,
                                    telphone_number = :telphone_number,
                                    mobile_number = :mobile_number,
                                    fax_number = :fax_number,
                                    modified_by = :modified_by

                         WHERE id = :id and belongsto_id = :belongsto_id';
      
      //$conn = Zend_Registry::get('doctrine_conn');
      //$conn->executeQuery($this->table_name );
      
      //prepare statements
      $stmt = $this->dbh->query($strSQL);
                                    $pSQL->bindParam(':type' , $this->type , pdo::PARAM_STR);
                                    $pSQL->bindParam(':physical_address' , $this->physicalAddress , pdo::PARAM_STR);
                                    $pSQL->bindParam(':postal_address' , $this->postalAddress , pdo::PARAM_STR);
                                    $pSQL->bindParam(':city' , $this->city , pdo::PARAM_STR);
                                    $pSQL->bindParam(':region' , $this->region , pdo::PARAM_STR);
                                    $pSQL->bindParam(':constituency' , $this->constituency , pdo::PARAM_STR);
                                    $pSQL->bindParam(':postal_code' , $this->postalCode , pdo::PARAM_STR);
                                    $pSQL->bindParam(':country' , $this->country , pdo::PARAM_STR);
                                    $pSQL->bindParam(':email_address' , $this->emailAddress , pdo::PARAM_STR);
                                    $pSQL->bindParam(':telphone_number' , $this->telphoneNumber , pdo::PARAM_STR);
                                    $pSQL->bindParam(':mobile_number' , $this->mobileNumber , pdo::PARAM_STR);
                                    $pSQL->bindParam(':fax_number' , $this->faxNumber , pdo::PARAM_STR);
                                    $pSQL->bindParam(':created_by' , $this->created_by , pdo::PARAM_STR);
                                    $pSQL->bindParam(':active_flag' , $this->active_flag , pdo::PARAM_INT);
                                    $pSQL->bindParam(':belongsto_id' , $this->belongsto_id , pdo::PARAM_STR);
                                    $pSQL->bindParam(':id' , $this->id , pdo::PARAM_INT);
      try {
          $pSQL->execute();
          return TRUE;
      } catch (PDOException $exc) {
          //echo $exc->getMessage();
          return FALSE;
      }       
    }
    public function fetchAll() {
 $strSQL = 'SELECT                  type,
                                    physical_address,
                                    postal_address,
                                    city,
                                    region,
                                    constituency,
                                    postal_code,
                                    country,
                                    email_address,
                                    telphone_number,
                                    mobile_number,
                                    fax_number,
                                    created_by,
                                    created_on_date,
                                    modified_by,
                                    modified_on_date,
                                    active_flag,
                                    belongsto_id
                         FROM address_contact 
                         WHERE 1';
      
      //$conn = Zend_Registry::get('doctrine_conn');
      //$conn->executeQuery($this->table_name );
           
      try {
          $stmt = $this->dbh->query($strSQL);
          return $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $exc) {
          //echo $exc->getMessage();
          return FALSE;
      }              
    }
    public function fetchOne($value = null) {
        $strSQL = 'SELECT           type,
                                    physical_address,
                                    postal_address,
                                    city,
                                    region,
                                    constituency,
                                    postal_code,
                                    country,
                                    email_address,
                                    telphone_number,
                                    mobile_number,
                                    fax_number,
                                    created_by,
                                    created_on_date,
                                    modified_by,
                                    modified_on_date,
                                    active_flag,
                                    belongsto_id
                         FROM address_contact 
                         WHERE 1 AND (id = :id AND belongsto_id = :belongsto_id)';
              //prepare statements
                $stmt = $this->dbh->query($strSQL);
                                    $stmt->bindParam(':belongsto_id' , $this->belongsto_id , pdo::PARAM_STR);
                                    $stmt->bindParam(':id' , $this->id , pdo::PARAM_INT);
      try {
          $stmt->execute();
          return $stmt->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $exc) {
          //echo $exc->getMessage();
          return FALSE;
      } 
    }
    public function delete($value = null) {
        
    }

}
