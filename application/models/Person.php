<?php

class Application_Model_Person implements Application_Model_Interface
{
    
    /**************************
     * Account  details
     **************************/
protected $username  = null;
protected $password  = null;
protected $activation_code = null;
protected $active_flag = 0;

    /**************************
     * Account  details
     **************************/
protected $id= null;
protected $national_id = null;
protected $first_name = null;
protected $last_name = null;
protected $initials = null;
protected $dateofbirth = null;
protected $gender = null;
protected $title = null;
protected $passport_number = null;
protected $nationality = null;
protected $job_title = null;

    /**************************
     * Person Contact details
     **************************/
  protected $contactObject = null;
  protected $postal_address = null;
protected $physical_address = null;
protected $country = null;
protected $city = null;
protected $region = null;
protected $constituency = null;
protected $email_address= null;
protected $telephone_number= null;
protected $fax_number= null;
protected $account_id = null;

protected $create_by = null;
protected $created_on_date = null;
protected $modified_by = null;
protected $modified_on_date = null;

    /**************************
     * Person Dbh details
     **************************/
  protected $dbh = null;


    public function __construct( $db , Application_Model_AddressContact $contact) {
        $this->dbh = $db;
        $this->contactObject = $contact;
    }
    
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function getActivation_code() {
        return $this->activation_code;
    }

    public function setActivation_code($activation_code) {
        $this->activation_code = $activation_code;
        return $this;
    }

    public function getActive_flag() {
        return $this->active_flag;
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

    public function getNational_id() {
        return $this->national_id;
    }

    public function setNational_id($national_id) {
        $this->national_id = $national_id;
        return $this;
    }

    public function getFirst_name() {
        return $this->first_name;
    }

    public function setFirst_name($first_name) {
        $this->first_name = $first_name;
        return $this;
    }

    public function getLast_name() {
        return $this->last_name;
    }

    public function setLast_name($last_name) {
        $this->last_name = $last_name;
        return $this;
    }

    public function getInitials() {
        return $this->initials;
    }

    public function setInitials($initials) {
        $this->initials = $initials;
        return $this;
    }

    public function getDateofbirth() {
        return $this->dateofbirth;
    }

    public function setDateofbirth($dateofbirth) {
        $this->dateofbirth = $dateofbirth;
        return $this;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getPassport_number() {
        return $this->passport_number;
    }

    public function setPassport_number($passport_number) {
        $this->passport_number = $passport_number;
        return $this;
    }

    public function getNationality() {
        return $this->nationality;
    }

    public function setNationality($nationality) {
        $this->nationality = $nationality;
        return $this;
    }

    public function getPostal_address() {
        return $this->postal_address;
    }

    public function setPostal_address($postal_address) {
        $this->postal_address = $postal_address;
        return $this;
    }

    public function getPhysical_address() {
        return $this->physical_address;
    }

    public function setPhysical_address($physical_address) {
        $this->physical_address = $physical_address;
        return $this;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country_id) {
        $this->country = $country_id;
        return $this;
    }

    public function getEmail_address() {
        return $this->email_address;
    }

    public function setEmail_address($email_address) {
        $this->email_address = $email_address;
        return $this;
    }

    public function getTelephone_number() {
        return $this->telephone_number;
    }

    public function setTelephone_number($telephone_number) {
        $this->telephone_number = $telephone_number;
        return $this;
    }

    public function getFax_number() {
        return $this->fax_number;
    }

    public function setFax_number($fax_number) {
        $this->fax_number = $fax_number;
        return $this;
    }

    public function getCreate_by() {
        return $this->create_by;
    }

    public function setCreate_by($create_by) {
        $this->create_by = $create_by;
        return $this;
    }

    public function getCreated_on_date() {
        return $this->created_on_date;
    }

    public function setCreated_on_date($created_on_date) {
        $this->created_on_date = $created_on_date;
        return $this;
    }

    public function getModified_by() {
        return $this->modified_by;
    }

    public function setModified_by($modified_by) {
        $this->modified_by = $modified_by;
        return $this;
    }

    public function getModified_on_date() {
        return $this->modified_on_date;
    }

    public function setModified_on_date($modified_on_date) {
        $this->modified_on_date = $modified_on_date;
        return $this;
    }
    public function getJob_title() {
        return $this->job_title;
    }
    public function setJob_title($job_title) {
        $this->job_title = $job_title;
        return $this;
    }
    public function getContactObject() {
        return $this->contactObject;
    }
    public function setContactObject($contactObject) {
        $this->contactObject = $contactObject;
        return $this;
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
    public function getAccount_id() {
        return $this->account_id;
    }

    public function setAccount_id($account_id) {
        $this->account_id = $account_id;
        return $this;
    }

            
    public function insert() {
    $strSQL = 'INSERT INTO person (
                                        first_name,
                                        last_name,
                                        title,
                                        jobtitle,
                                        account_id,
                                        postal_address,
                                        physical_address,
                                        country,
                                        region,
                                        city,
                                        constituency,
                                        email_address,
                                        telephone_number,
                                        fax_number,
                                        create_by)
                         VALUES(
                                        :first_name,
                                        :last_name,
                                        :title,
                                        :jobtitle,
                                        :account_id,
                                        :postal_address,
                                        :physical_address,
                                        :country,
                                        :region,
                                        :city,
                                        :constituency,
                                        :email_address,
                                        :telephone_number,
                                        :fax_number,                                        
                                        :create_by)';
      
      //$conn = Zend_Registry::get('doctrine_conn');
      //$conn->executeQuery($this->table_name );
      
      //prepare statements
      //$conn = Zend_Registry::get('db');
      $pSQL = $this->dbh->prepare($strSQL);
      $pSQL->bindParam(':first_name' , $this->first_name , pdo::PARAM_STR);
      $pSQL->bindParam(':last_name' , $this->last_name , pdo::PARAM_STR);
      $pSQL->bindParam(':title' , $this->title, pdo::PARAM_STR);
      $pSQL->bindParam(':jobtitle' , $this->job_title, pdo::PARAM_STR);
      $pSQL->bindParam(':account_id' , $this->account_id , pdo::PARAM_INT);
      $pSQL->bindParam(':postal_address' , $this->postal_address , pdo::PARAM_STR);
      $pSQL->bindParam(':physical_address' , $this->physical_address , pdo::PARAM_STR);
      $pSQL->bindParam(':email_address' , $this->email_address , pdo::PARAM_STR);
      $pSQL->bindParam(':country' , $this->country , pdo::PARAM_STR);
      $pSQL->bindParam(':region' , $this->region , pdo::PARAM_STR);
      $pSQL->bindParam(':city' , $this->city , pdo::PARAM_STR);
      $pSQL->bindParam(':constituency' , $this->constituency , pdo::PARAM_STR);
      $pSQL->bindParam(':telephone_number' , $this->telephone_number , pdo::PARAM_STR);
      $pSQL->bindParam(':fax_number' , $this->fax_number , pdo::PARAM_INT);
      $pSQL->bindParam(':account_id' , $this->account_id , pdo::PARAM_INT);
      $pSQL->bindParam(':create_by' , $this->create_by , pdo::PARAM_STR);
      
      try {
          $pSQL->execute();
          $this->id = $this->dbh->lastInsertId();        
          return TRUE;
      } catch (PDOException $exc) {
          $this->dbh->rollBack();
          echo $exc->getMessage(); exit;
          return FALSE;
      }                        
    }
    public function update($value = null) {
        
    }
    public function fetchAll() {
        
    }
    public function fetchOne($value = null) {
        
    }
    public function delete($value = null) {
        
    }

 
}