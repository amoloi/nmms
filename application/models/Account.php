<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account
 *
 * @author Innocent J Blac
 */
class Application_Model_Account{
  protected $table_name = 'account';
  protected $db_connection = null;
  private $id = null;
  private $username = null;
  private $email_address = null;
  private $password = null;
  private $raw_password = null;
  private $is_active_flag = null;
  private $activation_code = null;
  private $user_salt_hash = null;
  private $person_id = null;
  private $created_by = null;
  private $created_on_date = null;
  private $modified_by = null;
  private $modified_on_date = null;

  function __construct($db_connection) {
      $this->db_connection = $db_connection;
      $this->setUser_salt_hash();
  }

  public function getTable_name() {
      return $this->table_name;
  }

  public function getId() {
      return $this->id;
  }

  public function getUsername() {
      return $this->username;
  }

  public function getEmail_address() {
      return $this->email_address;
  }

  public function getPassword() {
      return $this->password;
  }

  public function getIs_active_flag() {
      return $this->status_flag;
  }
  public function getRaw_password() {
      return $this->raw_password;
  }

  public function setRaw_password($raw_password) {
      $this->raw_password = $raw_password;
      return $this;
  }

    public function getActivation_code() {
      return $this->activation_code;
  }

  public function getUser_salt_hash() {
      return $this->user_salt_hash;
  }

  public function getPerson_id() {
      return $this->person_id;
  }

  public function getCreate_by() {
      return $this->create_by;
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

  public function setTable_name($table_name) {
      $this->table_name = $table_name;
      return $this;
  }

  public function setId($id) {
      $this->id = $id;
      return $this;
  }

  public function setUsername($username) {
      $this->username = $username;
      return $this;
  }

  public function setEmail_address($email_address) {
      $this->email_address = $email_address;
      return $this;
  }

  public function setPassword($password) {
      $this->raw_password = $password;
      $this->password = hash("sha256", $password);
      return $this;
  }

  public function setIs_active_flag($status_flag) {
      $this->status_flag = $status_flag;
      return $this;
  }

  public function setActivation_code($activation_code) {
      $this->activation_code = $activation_code;
      return $this;
  }

  private function setUser_salt_hash() {
        if(!defined('MAX_LENGTH')){
            define("MAX_LENGTH", 12);
        }
            
            $intermediateSalt = md5(uniqid(rand(), true));
            $salt = substr($intermediateSalt, 0, MAX_LENGTH);
      $this->user_salt_hash = hash('sha256', $salt);
      return $this;
  }

  public function setPerson_id($person_id) {
      $this->person_id = $person_id;
      return $this;
  }

  public function setCreated_by($create_by) {
      $this->create_by = $create_by;
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
  public function getCreate_set() {
      return $this->create_set;
  }

  public function getUpdate_set() {
      return $this->update_set;
  }

  public function setUpdate_set($update_set) {
      $this->update_set = $update_set;
      return $this;
  }
 private function randomString( $len=32 ){
    // Initialise a string
    $s = '';
    // Possible characters
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    for( $i=0 ; $i<$len ; $i++ ){
      // Grab a random letter for $letters
      $char = $letters[mt_rand( 0 , strlen( $letters )-1 )];
      $s .= $char; //Add it to the string
    }
    return $s;
  }

  public function createActivationCode()
    {
        
        $this->setActivation_code(hash('sha256', $this->user_salt_hash . $this->username . $this->email_address));
    }
    
  public function create() {
      $strSQL = 'INSERT INTO account (
                                        username,
                                        email_address,
                                        password,
                                        activation_code,
                                        user_salt_hash,
                                        created_by)
                         VALUES(
                                        :username,
                                        :email_address,
                                        :password,
                                        :activation_code,
                                        :user_salt_hash,
                                        :created_by)';
      
      //$conn = Zend_Registry::get('doctrine_conn');
      //$conn->executeQuery($this->table_name );
      
      //prepare statements
      $pSQL = $this->db_connection->prepare($strSQL);
      $pSQL->bindParam(':username' , $this->username , pdo::PARAM_STR);
      $pSQL->bindParam(':email_address' , $this->email_address , pdo::PARAM_STR);
      $pSQL->bindParam(':password' , $this->password , pdo::PARAM_STR);
      $pSQL->bindParam(':activation_code' , $this->activation_code , pdo::PARAM_STR);
      $pSQL->bindParam(':user_salt_hash' , $this->user_salt_hash , pdo::PARAM_STR);
      $pSQL->bindParam(':created_by' , $this->created_by , pdo::PARAM_STR);
      
      try {
          $pSQL->execute();
          $this->setId($this->db_connection->lastInsertId());
          return TRUE;
      } catch (PDOException $exc) {
          echo $exc->getMessage();
          return FALSE;
      }
    }
  
  public function delete($table, $idName, $id) {
      
  }
  public function update($table, $fields, $values, $idName, $id) {
      
  }
  
  public function query() {
      $strSQL = 'SELECT                 username,
                                        email_address,
                                        password,
                                        activation_code,
                                        user_salt_hash,
                                        create_by)
                         FROM account 
                         WHERE 
                                        username = :username
                         AND            id = :id,
                                        :modified_by)';
  }
  
  public function fetchRow() {
       $strSQL = 'SELECT                username,
                                        email_address
                         FROM account 
                         WHERE   id = :id';
      $pSQL = $this->db_connection->prepare($strSQL);
      $pSQL->bindParam(':id' , $this->id , pdo::PARAM_INT);   
      try {
          $pSQL->execute();
          return $pSQL->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $exc) {
          //echo $exc->getMessage();
          return FALSE;
      }
  }
    public function fetchRelatedDetails() {
       $strSQL = 'SELECT                a.username,
                                        a.email_address,
                                        a.is_active_flag,
                                        p.first_name,
                                        p.last_name,
                                        p.title,
                                        p.jobtitle,
                                        p.account_id,
                                        p.postal_address,
                                        p.physical_address,
                                        p.country,
                                        p.region,
                                        p.city,
                                        p.constituency,
                                        p.telephone_number,
                                        p.fax_number                                        
                         FROM account a INNER JOIN person p
                         ON a.id = p.account_id
                         WHERE   a.email_address = :email_address'
              ;
      $pSQL = $this->db_connection->prepare($strSQL);
      $pSQL->bindParam(':email_address' , $this->email_address , pdo::PARAM_STR);   
      try {
          $pSQL->execute();
          return $pSQL->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $exc) {
          echo $exc->getMessage();
          return FALSE;
      }
  }
  
  public function activate($options = array(
                                            'email'=>null,
                                            'activation_code'=>null,
                                            )){
      $strSQL = 'UPDATE account SET 

                                        is_active_flag = 1 - is_active_flag,
                                        modified_by = :modified_by
                         WHERE 1 
                         AND email_address = :email_address
                         AND activation_code = :activation_code';

      //prepare statements
      $pSQL = $this->db_connection->prepare($strSQL);
      $pSQL->bindParam(':email_address' , $this->email_address , pdo::PARAM_STR);
      $pSQL->bindParam(':activation_code' , $this->activation_code , pdo::PARAM_STR);
      $pSQL->bindParam(':modified_by' , $this->modified_by , pdo::PARAM_STR);
      
      try {
          $pSQL->execute();
          return TRUE;
      } catch (PDOException $exc) {
          echo $exc->getMessage();
          return FALSE;
      }      
      
  }
}
