<?php
abstract class Human {
    //Intialzing Variables
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $String;
    protected $phoneNumber;

    //Setter and Getter methods
    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function getString() {
        return $this->String;
    }

    function getphoneNumber() {
        return $this->phoneNumber;
    }
    function setId($id) {
        $this->id = $id;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setString($String) {
        $this->String = $String;
    }

    function setphoneNumber($phoneNumber)
    {
        $this->phoneNumber=$phoneNumber;
    }

    public function updateProfile() {
        $DB = Database::getObject();
        //$id=$_SESSION['id'];
        $id = $this->getId();


        $array = array("email" => $this->getEmail(), "phone_number" => $this->getphoneNumber());

        //print_r($array);
        $DB->edit("user", $array, "id", $id);


        $array2 = array("password" => $this->getPassword(), "address" => $this->getAddress());
        $DB->edit("member_details", $array2, "user_id", $id);
    }
}
