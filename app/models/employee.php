<?php

class employee extends user {
    //Intializing variables
    private $Salary;
    private $accessiblePages;

    //Setter and getter methods
    function getSalary() {
        return $this->Salary;
    }

    function getAccessiblePages() {
        return $this->accessiblePages;
    }

    function setSalary($Salary) {
        $this->Salary = $Salary;
    }

    function setAccessiblePages($accessiblePages) {
        $this->accessiblePages = $accessiblePages;
    }
}
