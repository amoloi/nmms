<?php

interface Application_Model_IPerson
{
    public function getID();
    public function getName();
    public function getAddress();
    public function setAddress($Address);
    public function isEmployee();
    public function isCustomer();
    public function isMember();
    public function getEmployee();
    public function getCustomer();
    public function getMember();

}

class Person implements iPerson{
    protected $ID, $Name, $Address;
    protected $Employee = null, $Customer = null, $Member = null;
    public function getID(){
        return $this->ID;
    }
    public function getName(){
        return $this->Name;
    }
    public function getAddress(){
        return $this->Address;
    }
    public function setAddress($Address){
        $this->Address = $Address;
    }
    public function isEmployee(){
        return !isNull($this->Employee);
    }
    public function isCustomer(){
        return !isNull($this->Customer);
    }
    public function isMember(){
        return !isNull($this->Member);
    }
    public function getEmployee(){
        return $this->Employee;
    }
    public function getCustomer(){
        return $this->Customer;
    }
    public function getMember(){
        return $this->Member;
    }
}
class PersonHolder implements iPerson{
    protected $Person;
    public function getID(){
        return $this->Person->getID();
    }
    public function getName(){
        return $this->Person->getName();
    }
    public function getAddress(){
        return $this->Person->getAddress();
    }
    public function setAddress($Address){
        return $this->Person->setAddress($Address);
    }
    public function isEmployee(){
        return $this->Person->isEmployee();
    }
    public function isCustomer(){
        return $this->Person->isCustomer();
    }
    public function isMember(){
        return $this->Person->isMember();
    }
    public function getEmployee(){
        return $this->Person->getEmployee();
    }
    public function getCustomer(){
        return $this->Customer->getCustomer();
    }
    public function getMember(){
        return $this->Member->getMember();
    }
}
class Customer extends PersonHolder{
    protected $SomethingCustomerRelated = null;
    function __Construct(){
        $this->Person = $Person;
    }
    function getSomethingEmployeeRelated(){
        return $SomethingCustomerRelated;
    }
}
class Employee extends PersonHolder{
    protected $SomethingEmployeeRelated = null;
    function __Construct(){
        $this->Person = $Person;
    }
    function getSomethingEmployeeRelated(){
        return $SomethingEmployeeRelated;
    }
}
class Member extends PersonHolder{
    protected $SomethingMemberRelated = null;
    function __Construct(){
        $this->Person = $Person;
    }
    function getSomethingMemberRelated(){
        return $SomethingMemberRelated;
    }
}  

