<?php

class table {
    //Intializing variables
    private $ID;
    private $tableNumber;
    private $seatsNumber;
    private $x;
    private $y;

    //Intializing variables
    function getID() {
        return $this->ID;
    }

    function setTableNumber($tableNumber){
        $this->tableNumber = $tableNumber;
    }

    function getTableNumber(){
        return $this->tableNumber;
    }

    function getSeatsNumber() {
        return $this->seatsNumber;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setSeatsNumber($seatsNumber) {
        $this->seatsNumber = $seatsNumber;
    }

    function setX($x) {
        $this->x = $x;
    }

    function getX() {
        return $this->x;
    }

    function setY($y) {
        $this->y = $y;
    }

    function getY() {
        return $this->y;
    }

    /*
        Reading talbes from the database and return them to display

        WRITTEN BY: MUHAMMAD AL.RIFAI

        CHECKED
    */
    static function showTables()
    {
        //Creating an object of database
        $DB = Database::getObject();

        //Selecting talbes from the database
        $tables = $DB->get('table', ["id", "table_number", "chairs_number", "x", "y"]);
        return mysqli_fetch_all($tables, MYSQLI_ASSOC); //Recieving array of tables
    }

    public function checkTableAvailability() {
		date_default_timezone_set("Africa/Cairo");
		$date = date('Y-m-d');
		$sql = "SELECT DISTINCT(reservation_tables.table_id)FROM reservation_tables WHERE reservation_tables.reservation_id IN (SELECT reservations.id FROM reservations WHERE `reservations`.`date` >= '$date') AND reservation_tables.table_id IN(SELECT `table`.`id` FROM `table` WHERE `table`.`table_number` = '$this->tableNumber')";
		$DB = Database::getObject();
		$result = $DB->execute($sql);
		$result = mysqli_fetch_assoc($result);
		return $result['table_id'];
    }
}
