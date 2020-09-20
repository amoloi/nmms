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
class Application_Model_Member extends JBlac_Model implements Application_Model_Interface {
    
    /*
     * ****************************
     * Member Related Data
     * ****************************
     */
				protected $id = null; 
				protected $salary_code = null; 
				protected $nid_no = null; 
				protected $contact = null; 
				protected $initials = null; 
				protected $member_name = null; 
				protected $member_surname = null; 
				protected $gender = null; 
				protected $date_of_birth = null; 
				protected $working_state = null;
    /*
     * ****************************
     * Company Related Data
     * ****************************
     */                                
                                
				protected $work_description = null; 
				protected $salary_or_wage = null; 
				protected $member_fee = null; 
				protected $retirement_date = null; 
				protected $membership_date = null; 
				protected $witness_date = null; 
				protected $first_witness = null; 
				protected $second_witness = null;
                                
    /*
     * ****************************
     * Months Related Data
     * ****************************
     */                                
				protected $january = null; 
				protected $february = null; 
				protected $march = null; 
				protected $april = null; 
				protected $may = null; 
				protected $june = null; 
				protected $july = null; 
				protected $august = null; 
				protected $september = null; 
				protected $october = null; 
				protected $november = null; 
				protected $december = null;
    /*
     * ****************************
     * Company still Related Data
     * ****************************
     */                                
				protected $company_name = null; 
				protected $company_address = null; 
				protected $company_telephone = null; 
				protected $company_fax = null; 
				protected $company_email = null; 
				protected $branch = null; 
				protected $sector = null; 
				protected $office_date = null; 
				protected $general_secretary = null; 
				protected $employer = null; 
				protected $deduction = null; 
				protected $created_by = null; 
				protected $created_on_date = null; 
				protected $modified_by = null; 
				protected $modified_on_by = null;
                                
                                
                                public function getId() {
                                    return $this->id;
                                }

                                public function getSalary_code() {
                                    return $this->salary_code;
                                }

                                public function getNid_no() {
                                    return $this->nid_no;
                                }

                                public function getContact() {
                                    return $this->contact;
                                }

                                public function getInitials() {
                                    return $this->initials;
                                }

                                public function getMember_name() {
                                    return $this->member_name;
                                }

                                public function getMember_surname() {
                                    return $this->member_surname;
                                }

                                public function getGender() {
                                    return $this->gender;
                                }

                                public function getDate_of_birth() {
                                    return $this->date_of_birth;
                                }

                                public function getWorking_state() {
                                    return $this->working_state;
                                }

                                public function getWordk_description() {
                                    return $this->wordk_description;
                                }

                                public function getSalary_or_wage() {
                                    return $this->salary_or_wage;
                                }

                                public function getMember_fee() {
                                    return $this->member_fee;
                                }

                                public function getRetirement_date() {
                                    return $this->retirement_date;
                                }

                                public function getMembership_date() {
                                    return $this->membership_date;
                                }

                                public function getWitness_date() {
                                    return $this->witness_date;
                                }

                                public function getFirst_witness() {
                                    return $this->first_witness;
                                }

                                public function getSecond_witness() {
                                    return $this->second_witness;
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

                                public function getCompany_name() {
                                    return $this->company_name;
                                }

                                public function getCompany_address() {
                                    return $this->company_address;
                                }

                                public function getCompany_telephone() {
                                    return $this->company_telephone;
                                }

                                public function getCompany_fax() {
                                    return $this->company_fax;
                                }

                                public function getCompany_email() {
                                    return $this->company_email;
                                }

                                public function getBranch() {
                                    return $this->branch;
                                }

                                public function getSector() {
                                    return $this->sector;
                                }

                                public function getOffice_date() {
                                    return $this->office_date;
                                }

                                public function getGeneral_secretary() {
                                    return $this->general_secretary;
                                }

                                public function getEmployer() {
                                    return $this->employer;
                                }

                                public function getDeduction() {
                                    return $this->deduction;
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

                                public function getModified_on_by() {
                                    return $this->modified_on_by;
                                }

                                public function setId($id) {
                                    $this->id = $id;
                                    return $this;
                                }

                                public function setSalary_code($salary_code) {
                                    $this->salary_code = $salary_code;
                                    return $this;
                                }

                                public function setNid_no($nid_no) {
                                    $this->nid_no = $nid_no;
                                    return $this;
                                }

                                public function setContact($contact) {
                                    $this->contact = $contact;
                                    return $this;
                                }

                                public function setInitials($initials) {
                                    $this->initials = $initials;
                                    return $this;
                                }

                                public function setMember_name($member_name) {
                                    $this->member_name = $member_name;
                                    return $this;
                                }

                                public function setMember_surname($member_surname) {
                                    $this->member_surname = $member_surname;
                                    return $this;
                                }

                                public function setGender($gender) {
                                    $this->gender = $gender;
                                    return $this;
                                }

                                public function setDate_of_birth($date_of_birth) {
                                    if(!$this->validateNotnull->isValid($date_of_birth)){
                                        $this->setErrorMessages('Date of birth is required.');
                                    }else{
                                     list($dd , $mm ,$yyyy) = explode('/', $date_of_birth);
                                        $date_of_birth = $yyyy . '-' . $mm . '-' .$dd;                        
                                        $this->date_of_birth = $date_of_birth;
                                    }                                     
                                    
                                    return $this;
                                }

                                public function setWorking_state($working_state) {
                                    $this->working_state = $working_state;
                                    return $this;
                                }

                                public function setWork_description($work_description) {
                                    $this->work_description = $work_description;
                                    return $this;
                                }

                                public function setSalary_or_wage($salary_or_wage) {
                                    $this->salary_or_wage = $salary_or_wage;
                                    return $this;
                                }

                                public function setMember_fee($member_fee) {
                                    $this->member_fee = $member_fee;
                                    return $this;
                                }

                                public function setRetirement_date($retirement_date) {
                                    if(!$this->validateNotnull->isValid($retirement_date)){
                                        $this->setErrorMessages('Date of retirement is required.');
                                    }else{
                                     list($dd , $mm ,$yyyy) = explode('/', $retirement_date);
                                        $retirement_date = $yyyy . '-' . $mm . '-' .$dd;                        
                                        $this->retirement_date = $retirement_date;
                                    }                                    
                                    
                                    return $this;
                                }

                                public function setMembership_date($membership_date) {
                                    if(!$this->validateNotnull->isValid($retirement_date)){
                                        $this->setErrorMessages('Membership date is required.');
                                    }else{
                                     list($dd , $mm ,$yyyy) = explode('/', $membership_date);
                                        $membership_date = $yyyy . '-' . $mm . '-' .$dd;                        
                                        $this->membership_date = $membership_date;
                                    }                                      
                                    
                                    return $this;
                                }

                                public function setWitness_date($witness_date) {
                                    if(!$this->validateNotnull->isValid($witness_date)){
                                        $this->setErrorMessages('Witness date is required.');
                                    }else{
                                     list($dd , $mm ,$yyyy) = explode('/', $witness_date);
                                        $witness_date = $yyyy . '-' . $mm . '-' .$dd;                        
                                        $this->witness_date = $witness_date;
                                    }                                      
                                    
                                    return $this;
                                }

                                public function setFirst_witness($first_witness) {
                                    $this->first_witness = $first_witness;
                                    return $this;
                                }

                                public function setSecond_witness($second_witness) {
                                    $this->second_witness = $second_witness;
                                    return $this;
                                }

                                public function setJanuary($january) {
                                    $this->january = $january;
                                    return $this;
                                }

                                public function setFebruary($february) {
                                    $this->february = $february;
                                    return $this;
                                }

                                public function setMarch($march) {
                                    $this->march = $march;
                                    return $this;
                                }

                                public function setApril($april) {
                                    $this->april = $april;
                                    return $this;
                                }

                                public function setMay($may) {
                                    $this->may = $may;
                                    return $this;
                                }

                                public function setJune($june) {
                                    $this->june = $june;
                                    return $this;
                                }

                                public function setJuly($july) {
                                    $this->july = $july;
                                    return $this;
                                }

                                public function setAugust($august) {
                                    $this->august = $august;
                                    return $this;
                                }

                                public function setSeptember($september) {
                                    $this->september = $september;
                                    return $this;
                                }

                                public function setOctober($october) {
                                    $this->october = $october;
                                    return $this;
                                }

                                public function setNovember($november) {
                                    $this->november = $november;
                                    return $this;
                                }

                                public function setDecember($december) {
                                    $this->december = $december;
                                    return $this;
                                }

                                public function setCompany_name($company_name) {
                                    $this->company_name = $company_name;
                                    return $this;
                                }

                                public function setCompany_address($company_address) {
                                    $this->company_address = $company_address;
                                    return $this;
                                }

                                public function setCompany_telephone($company_telephone) {
                                    $this->company_telephone = $company_telephone;
                                    return $this;
                                }

                                public function setCompany_fax($company_fax) {
                                    $this->company_fax = $company_fax;
                                    return $this;
                                }

                                public function setCompany_email($company_email) {
                                    $this->company_email = $company_email;
                                    return $this;
                                }

                                public function setBranch($branch) {
                                    $this->branch = $branch;
                                    return $this;
                                }

                                public function setSector($sector) {
                                    $this->sector = $sector;
                                    return $this;
                                }

                                public function setOffice_date($office_date) {
                                    if(!$this->validateNotnull->isValid($office_date)){
                                        $this->setErrorMessages('Date of starting employment is required.');
                                    }else{
                                     list($dd , $mm ,$yyyy) = explode('/', $office_date);
                                        $office_date = $yyyy . '-' . $mm . '-' .$dd;                        
                                        $this->office_date = $office_date;
                                    }                                     
                                    
                                    return $this;
                                }

                                public function setGeneral_secretary($general_secretary) {
                                    $this->general_secretary = $general_secretary;
                                    return $this;
                                }

                                public function setEmployer($employer) {
                                    $this->employer = $employer;
                                    return $this;
                                }

                                public function setDeduction($deduction) {
                                    $this->deduction = $deduction; 
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

                                public function setModified_on_by($modified_on_by) {
                                    $this->modified_on_by = $modified_on_by;
                                    return $this;
                                }

                                
                                public function insert() {
                                    $sql = 'INSERT INTO old_members 
                                                                    (
                                                                            salary_code,nid_no,	contact,initials,member_name,member_surname,gender,	date_of_birth,	working_state,	work_description,
                                                                            salary_or_wage,	member_fee,	retirement_date,membership_date,witness_date,first_witness,	second_witness,	
                                                                            january,february,march,	april,may,june,july,august,september,october,november,december,
                                                                            company_name,company_address,company_telephone,	company_fax,company_email,branch,sector,office_date,general_secretary,employer,
                                                                            deduction,created_by
                                                                    )
                                                                    VALUES
                                                                    (
                                                                            :salary_code,:nid_no,:contact,:initials,:member_name,:member_surname,:gender,:date_of_birth,:working_state,:work_description, 
                                                                            :salary_or_wage,:member_fee,:retirement_date,:membership_date,:witness_date,:first_witness,:second_witness, 
                                                                            :january,:february,:march,:april,:may,:june,:july,:august,:september,:october,:november,:december, 
                                                                            :company_name,:company_address,:company_telephone,:company_fax,:company_email,:branch,:sector,:office_date,:general_secretary,:employer, 
                                                                            :deduction,:created_by
                                                                    )';
                                $stmt = $this->dbh->prepare($sql);    
                                $stmt->bindParam(':salary_code' , $this->salary_code , pdo::PARAM_STR);
                                $stmt->bindParam(':nid_no' , $this->nid_no , pdo::PARAM_STR);
                                $stmt->bindParam(':contact' , $this->contact , pdo::PARAM_STR);
                                $stmt->bindParam(':initials' , $this->initials , pdo::PARAM_STR);
                                $stmt->bindParam(':member_name' , $this->member_name , pdo::PARAM_STR);
                                $stmt->bindParam(':member_surname' , $this->member_surname , pdo::PARAM_STR);
                                $stmt->bindParam(':gender' , $this->gender , pdo::PARAM_STR);
                                $stmt->bindParam(':date_of_birth' , $this->date_of_birth , pdo::PARAM_STR);
                                $stmt->bindParam(':working_state' , $this->working_state , pdo::PARAM_STR);
                                $stmt->bindParam(':work_description' , $this->work_description , pdo::PARAM_STR);
                                $stmt->bindParam(':salary_or_wage' , $this->salary_or_wage , pdo::PARAM_STR);
                                $stmt->bindParam(':member_fee' , $this->member_fee , pdo::PARAM_STR);
                                $stmt->bindParam(':retirement_date' , $this->retirement_date , pdo::PARAM_STR);
                                $stmt->bindParam(':membership_date' , $this->membership_date , pdo::PARAM_STR);
                                $stmt->bindParam(':witness_date' , $this->witness_date , pdo::PARAM_STR);
                                $stmt->bindParam(':first_witness' , $this->first_witness , pdo::PARAM_STR);
                                $stmt->bindParam(':second_witness' , $this->second_witness , pdo::PARAM_STR);
                                $stmt->bindParam(':january' , $this->january , pdo::PARAM_STR);
                                $stmt->bindParam(':february' , $this->february , pdo::PARAM_STR);
                                $stmt->bindParam(':march' , $this->march , pdo::PARAM_STR);
                                $stmt->bindParam(':april' , $this->april , pdo::PARAM_STR);
                                $stmt->bindParam(':may' , $this->may , pdo::PARAM_STR);
                                $stmt->bindParam(':june' , $this->june , pdo::PARAM_STR);
                                $stmt->bindParam(':july' , $this->july , pdo::PARAM_STR);
                                $stmt->bindParam(':august' , $this->august , pdo::PARAM_STR);
                                $stmt->bindParam(':september' , $this->september , pdo::PARAM_STR);
                                $stmt->bindParam(':october' , $this->october , pdo::PARAM_STR);
                                $stmt->bindParam(':november' , $this->november , pdo::PARAM_STR);
                                $stmt->bindParam(':december' , $this->december , pdo::PARAM_STR);
                                $stmt->bindParam(':company_name' , $this->company_name , pdo::PARAM_STR);
                                $stmt->bindParam(':company_address' , $this->company_address , pdo::PARAM_STR);
                                $stmt->bindParam(':company_telephone' , $this->company_telephone , pdo::PARAM_STR);
                                $stmt->bindParam(':company_fax' , $this->company_fax , pdo::PARAM_STR);
                                $stmt->bindParam(':company_email' , $this->company_email , pdo::PARAM_STR);
                                $stmt->bindParam(':branch' , $this->branch , pdo::PARAM_STR);
                                $stmt->bindParam(':sector' , $this->sector , pdo::PARAM_STR);
                                $stmt->bindParam(':office_date' , $this->office_date , pdo::PARAM_STR);
                                $stmt->bindParam(':general_secretary' , $this->general_secretary , pdo::PARAM_STR);
                                $stmt->bindParam(':employer' , $this->employer , pdo::PARAM_STR);
                                $stmt->bindParam(':deduction' , $this->deduction , pdo::PARAM_STR); 
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
                                public function update($value) {

                                   $sql = 'UPDATE old_members 
                                                            SET
                                                                    salary_code = :salary_code, 
                                                                    nid_no = :nid_no, 
                                                                    contact = :contact, 
                                                                    initials = :initials, 
                                                                    member_name = :member_name, 
                                                                    member_surname = :member_surname, 
                                                                    gender = :gender, 
                                                                    date_of_birth = :date_of_birth, 
                                                                    working_state = :working_state, 
                                                                    work_description = :work_description, 
                                                                    salary_or_wage = :salary_or_wage, 
                                                                    member_fee = :member_fee, 
                                                                    retirement_date = :retirement_date, 
                                                                    membership_date = :membership_date, 
                                                                    witness_date = :witness_date, 
                                                                    first_witness = :first_witness, 
                                                                    second_witness = :second_witness, 
                                                                    company_name = :company_name, 
                                                                    company_address = :company_address, 
                                                                    company_telephone = :company_telephone, 
                                                                    company_fax = :company_fax, 
                                                                    company_email = :company_email, 
                                                                    branch = :branch, 
                                                                    sector = :sector, 
                                                                    office_date = :office_date, 
                                                                    general_secretary = :general_secretary, 
                                                                    employer = :employer, 
                                                                    deduction = :deduction

                                                            WHERE
                                                                    id = :id';
                                $stmt = $this->dbh->prepare($sql);    
                                $stmt->bindParam(':salary_code' , $this->salary_code , pdo::PARAM_STR);
                                $stmt->bindParam(':nid_no' , $this->nid_no , pdo::PARAM_STR);
                                $stmt->bindParam(':contact' , $this->contact , pdo::PARAM_STR);
                                $stmt->bindParam(':initials' , $this->initials , pdo::PARAM_STR);
                                $stmt->bindParam(':member_name' , $this->member_name , pdo::PARAM_STR);
                                $stmt->bindParam(':member_surname' , $this->member_surname , pdo::PARAM_STR);
                                $stmt->bindParam(':gender' , $this->gender , pdo::PARAM_STR);
                                $stmt->bindParam(':date_of_birth' , $this->date_of_birth , pdo::PARAM_STR);
                                $stmt->bindParam(':working_state' , $this->working_state , pdo::PARAM_STR);
                                $stmt->bindParam(':work_description' , $this->work_description , pdo::PARAM_STR);
                                $stmt->bindParam(':salary_or_wage' , $this->salary_or_wage , pdo::PARAM_STR);
                                $stmt->bindParam(':member_fee' , $this->member_fee , pdo::PARAM_STR);
                                $stmt->bindParam(':retirement_date' , $this->retirement_date , pdo::PARAM_STR);
                                $stmt->bindParam(':membership_date' , $this->membership_date , pdo::PARAM_STR);
                                $stmt->bindParam(':witness_date' , $this->witness_date , pdo::PARAM_STR);
                                $stmt->bindParam(':first_witness' , $this->first_witness , pdo::PARAM_STR);
                                $stmt->bindParam(':second_witness' , $this->second_witness , pdo::PARAM_STR);
                                $stmt->bindParam(':company_name' , $this->company_name , pdo::PARAM_STR);
                                $stmt->bindParam(':company_address' , $this->company_address , pdo::PARAM_STR);
                                $stmt->bindParam(':company_telephone' , $this->company_telephone , pdo::PARAM_STR);
                                $stmt->bindParam(':company_fax' , $this->company_fax , pdo::PARAM_STR);
                                $stmt->bindParam(':company_email' , $this->company_email , pdo::PARAM_STR);
                                $stmt->bindParam(':branch' , $this->branch , pdo::PARAM_STR);
                                $stmt->bindParam(':sector' , $this->sector , pdo::PARAM_STR);
                                $stmt->bindParam(':office_date' , $this->office_date , pdo::PARAM_STR);
                                $stmt->bindParam(':general_secretary' , $this->general_secretary , pdo::PARAM_STR);
                                $stmt->bindParam(':employer' , $this->employer , pdo::PARAM_STR);
                                $stmt->bindParam(':deduction' , $this->deduction , pdo::PARAM_STR);
                                $stmt->bindParam(':id' , $this->id , pdo::PARAM_INT);
                                
                                try {
                                    $stmt->execute();
                                    return 'success';
                                } catch (PDOException $exc) {
                                    echo $exc->getMessage();
                                    return 'failure';
                                }                                    
                                }
                                public function update_members_finance($value) {

                                   $sql = 'UPDATE old_members 
                                                            SET
                                                                    january = :january, 
                                                                    february = :february, 
                                                                    march = :march, 
                                                                    april = :april, 
                                                                    may = :may, 
                                                                    june = :june, 
                                                                    july = :july, 
                                                                    august = :august, 
                                                                    september = :september, 
                                                                    october = :october, 
                                                                    november = :november, 
                                                                    december = :december

                                                            WHERE
                                                                    id = :id';
                                $stmt = $this->dbh->prepare($sql); 
                                
                                $stmt->bindParam(':january' , $this->january , pdo::PARAM_INT);
                                $stmt->bindParam(':february' , $this->february , pdo::PARAM_INT);
                                $stmt->bindParam(':march' , $this->march , pdo::PARAM_INT);
                                $stmt->bindParam(':april' , $this->april , pdo::PARAM_INT);
                                $stmt->bindParam(':may' , $this->may , pdo::PARAM_INT);
                                $stmt->bindParam(':june' , $this->june , pdo::PARAM_INT);
                                $stmt->bindParam(':july' , $this->july , pdo::PARAM_INT);
                                $stmt->bindParam(':august' , $this->august , pdo::PARAM_INT);
                                $stmt->bindParam(':september' , $this->september , pdo::PARAM_INT);
                                $stmt->bindParam(':october' , $this->october , pdo::PARAM_INT);
                                $stmt->bindParam(':november' , $this->november , pdo::PARAM_INT);
                                $stmt->bindParam(':december' , $this->december , pdo::PARAM_INT);

                                $stmt->bindParam(':id' , $this->id , pdo::PARAM_INT);
                                
                                try {
                                    $stmt->execute();
                                    return 'success';
                                } catch (PDOException $exc) {
                                    $this->setErrorMessages($exc->getMessage());
                                    return 'error';
                                }                                    
                                }
                                //member_name , initials , member_surname , company_name , (january + february,march + april + may + june + july + august + september + october + november + december) contribution
                                public function fetchContributionTotal() {
                                  $sql = 'SELECT * from members_contribution_v';
                                  $stmt = $this->dbh->prepare($sql);
                                try {
                                    $stmt->execute();
                                    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    return $members;
                                } catch (PDOException $exc) {
                                    echo $exc->getMessage();
                                    return 'failure';
                                }                                   
                                }                                
                                public function fetchAll() {
                                  $sql = 'SELECT * from members_v';
                                  $stmt = $this->dbh->prepare($sql);
                                try {
                                    $stmt->execute();
                                    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    return $members;
                                } catch (PDOException $exc) {
                                    echo $exc->getMessage();
                                    return 'failure';
                                }                                   
                                }
                                public function totalFinance() {
                                    $total_revenue = 0;
                                  $sql = 'SELECT * from revenue_months_v';
                                  $stmt = $this->dbh->prepare($sql);
                                try {
                                    $stmt->execute();
                                    $this->setDataSet($stmt->fetchAll(PDO::FETCH_ASSOC));
                                    
                                    
                                    foreach($this->DataSet as $k => $v){
                                        if(is_array($v)){
                                            foreach($v as $key => $value){
                                                if($value !== null){
                                                  $total_revenue = floatval($total_revenue) + floatval($value); 
                                                }
                                                
                                            }
                                            
                                        }
                                    }
                                    $revenue = array('total_revenue'=>$total_revenue);
                                    $this->setDataSet($revenue);
                                    
                                    return 'success';
                                } catch (PDOException $exc) {
                                    $this->setErrorMessages($exc->getMessage());
                                    return 'error';
                                }                                   
                                }                                
                                public function fetchOne($value) {
                                    $sql = 'SELECT * FROM member_details_v WHERE id=:id';
                                    $stmt = $this->dbh->prepare($sql);
                                    $stmt->bindParam(':id',  $this->id , PDO::PARAM_INT);
                                    try {
                                    $stmt->execute();
                                    return $stmt->fetch(PDO::FETCH_ASSOC);
                                    } catch (PDOException $exc) {
                                        echo $exc->getMessage();
                                        return 'failure';
                                    }                                     
                                }
                                public function fetchTotalPerWorkState($value) {
                                    $sql = 'SELECT COUNT(id) total_member FROM member_details_v WHERE working_state=:working_state';
                                    $stmt = $this->dbh->prepare($sql);
                                    $stmt->bindParam(':working_state',  $this->working_state , PDO::PARAM_INT);
                                    try {
                                    $stmt->execute();
                                    $this->setDataSet($stmt->fetch(PDO::FETCH_ASSOC));
                                    return 'success';
                                    } catch (PDOException $exc) {
                                        $this->setErrorMessages($exc->getMessage());
                                        return 'error';
                                    }                                     
                                }
                                public function fetchTotalPerGender($value) {
                                    $sql = 'SELECT COUNT(id) total_member FROM member_details_v WHERE gender=:gender';
                                    $stmt = $this->dbh->prepare($sql);
                                    $stmt->bindParam(':gender',  $this->gender , PDO::PARAM_INT);
                                    try {
                                    $stmt->execute();
                                    $this->setDataSet($stmt->fetch(PDO::FETCH_ASSOC));
                                    return 'success';
                                    } catch (PDOException $exc) {
                                        $this->setErrorMessages($exc->getMessage());
                                        return 'error';
                                    }                                     
                                }
                                public function fetchTotalMembers($value) {
                                    $sql = 'SELECT COUNT(id) total_member FROM member_details_v';
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
                                public function delete($value) {
                                    $sql = 'DELETE FROM members_v WHERE id = :id';
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
                                public function fetchMonths(){
                                    $sql = 'SELECT * FROM member_months_v';
                                    $stmt = $this->dbh->prepare($sql);
                                    try {
                                    $stmt->execute();
                                    return $stmt->fetch(PDO::FETCH_ASSOC);
                                } catch (PDOException $exc) {
                                    echo $exc->getMessage();
                                    return 'failure';
                                }
                                }
                                public function fetchMemberFinance($member_id){
                                    $total_contribution = null;
                                    $sql = 'SELECT * FROM member_months_v WHERE id = :id';
                                    $stmt = $this->dbh->prepare($sql);
                                    $stmt->bindParam(':id',  $this->id , PDO::PARAM_INT);
                                    try {
                                    $stmt->execute();
                                    $months = $stmt->fetch(PDO::FETCH_ASSOC);
                                    foreach ($months as $key => $value) {
                                        if('id' !== $key){
                                        $total_contribution = floatval($total_contribution) + floatval($value);
                                        }
                                    }
                                     $months['total'] = $total_contribution;
                                    return $months;
                                } catch (PDOException $exc) {
                                    echo $exc->getMessage();
                                    return 'failure';
                                }                                    
                                }
                                
                                public function listMembers($search = null){
                                
                                    $db = Zend_Db_Table::getDefaultAdapter();
                                    $selectMembers = new Zend_Db_Select($db);
                                    $selectMembers->from('nmms_members_v');
                                    if(null !== $search){
                                        //$search = filter_var($search , FILTER_SANITIZE_STRING);
                                        //$search = preg_replace('/[^a-zA-Z0-9 ]/', '', $search);
                                        $selectMembers->where('company_name LIKE :search');
                                        $selectMembers->orWhere('company_name LIKE :search');
                                        
                                        $selectMembers->bind(array(
                                                                    ':search' => "{$search}%",
                                        ));
                                    }
                                    $selectMembers->order('member_name ASC');
                                    
                                    return $selectMembers;
                                }
}
