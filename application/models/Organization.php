<?php

class Application_Model_Organization
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

                

}

