<?php

/*
    VERY IMPORTANT, PLEASE ADD COMMENTS DESRIBES YOUR QUERIES AND COMMANDS
*/

class order {
    //Intializing variables
    private $orderID;
    private $date;
    private $time;
    private $food = []; // [food => Amount]
    private $totalMoney;
    private $paymentMethod; // انا ضفتها

    //Setter and getter methods
    function __construct() {}

    function getPaymentMethod() {
        return $this->paymentMethod;
    }

    function setPaymentMethod($Name) {
        $this->paymentMethod = paymentmethod::findPayment($Name);
    }

    function getOrderID() {
        return $this->orderID;
    }

    function getDate() {
        return $this->date;
    }

    function getTime() {
        return $this->time;
    }

    function getFood() {
        return $this->food;
    }

    function getAmount() {
        return $this->amount;
    }

    function getTotalMoney() {
        return $this->totalMoney;
    }

    function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function setFood(food $food, $amount) {
        $this->food[$food->getName()] = $amount;
    }

    function setTotalMoney($totalMoney) {
        $this->totalMoney = $totalMoney;
    }

    /*
        Admin will be able to see all invoices users have made in his resturant
    */
    public function viewAllinvoices() {
        $DB = Database::getObject();
        // query statement
        $query = "SELECT user.first_name , user.last_name , user.email , `order`.date ,"
                . " `order`.time , `order`.total_money "
                . "FROM `order` "
                . "JOIN `user` ON `order`.`user_id` = user.id";
        $row = $DB->execute($query);

        if ($row) {
            // make numeric array each index is associated array ( like GRAPH 😭 )
            $arr = $DB->fetchAll($row);
        } else {
            // empty ARRAY
            $arr = array();
        }
        return $arr;
    }
}
