<?php

class reservation {
    //Intializing variables
    private $reservationID;
    private $memberID;
    private $type ;
    private $date;
    private $time ;
    private $duration ;
    private $table;

    //Setting and getting methods
    function __construct($table) {
        $this->table = new table();
    }

    function getReservationID() {
        return $this->reservationID;
    }

    function getMemberID() {
        return $this->memberID;
    }

    function getType() {
        return $this->type;
    }

    function getDate() {
        return $this->date;
    }

    function getTime() {
        return $this->time;
    }

    function getDuration() {
        return $this->duration;
    }

    function getTable() {
        return $this->table;
    }

    function setReservationID($reservationID) {
        $this->reservationID = $reservationID;
    }

    function setMemberID($memberID) {
        $this->memberID = $memberID;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function setDuration($duration) {
        $this->duration = $duration;
    }

    function setTable($table) {
        $this->table = $table;
    }

    /*
        Displating reservations to the user, it show current reservations or
        history depends of the parameter

        WRITTEN BY: MUHAMMAD KHAIRALLAH

        CHECKED
    */
    public static function showReservations($type='Current') {
        //Getting user's of from the session
        $userID = $_SESSION['id'];

        //Getting default date and time values
        date_default_timezone_set("Africa/Cairo");
        $date = date('Y-m-d');

        //Creating an object of the database
        $DB = Database::getObject();

        //When type == current it will show reservation in the future only
        if($type=='Current') {
            //Selecing reservation's date, time, duration, chairs' number and tables
            $query = "SELECT  r.date, DATE_FORMAT(r.time,'%h:%i %p') as `time`, r.duration ,SUM(tl.chairs_number) as `chairs_number`,r.id , concat(\"[\", GROUP_CONCAT(tl.id), \"]\") as `tables`"
                        . "FROM reservations r JOIN reservation_tables rt on r.id=rt.reservation_id "
                        . "JOIN `table` tl ON rt.table_id=tl.id WHERE r.user_id = '$userID' && r.date >= '$date' "
                        . "GROUP BY r.id "
                        . "ORDER BY r.date";
        } else {
            //Selecing reservation's date, time, duration, chairs' number and tables
            $query = "SELECT r.date , DATE_FORMAT(r.time,'%h:%i %p') as `time`, r.duration ,SUM(tl.chairs_number) as `chairs_number`, concat(\"[\", GROUP_CONCAT(tl.id), \"]\") as `tables` "
                        . "FROM reservations r JOIN reservation_tables rt on r.id=rt.reservation_id "
                        . "JOIN `table` tl ON rt.table_id=tl.id WHERE r.user_id = '$userID' && r.date < '$date' "
                        . "GROUP BY r.id "
                        . "ORDER BY r.date";
        }

        //Runnung the query
        $row = $DB->execute($query);
        return mysqli_fetch_all($row, MYSQLI_ASSOC); //Recieving reservations details
    }

    /*
        Checking tables if they are free or not in the selected date, time and duration
        and return them back

        WRITTEN BT: MUHAMMAD KAMAL

        CHECKED
    */
    public function checkReservation() {
        //Creating an object of the database
        $DB = Database::getObject();

        //Selecting tables and check if they are reserved or not
        $query = "SELECT `table`.`table_number` FROM `table` JOIN `reservation_tables` ON `reservation_tables`.`table_id` = `table`.`id` WHERE
                    `reservation_tables`.`reservation_id` IN (SELECT  `reservations`.`id` FROM `reservations`
                  WHERE
                    `reservations`.`date` = '$this->date'
                  AND (`reservations`.`time` BETWEEN '$this->time'  AND ADDTIME('$this->time' , SEC_TO_TIME($this->duration  * 3600 - 60))
                  OR '$this->time' BETWEEN `reservations`.`time` AND ADDTIME(`reservations`.`time`,
                      SEC_TO_TIME(`reservations`.`duration` * 3600 - 60))))";

        //Running the query
        $result = $DB->execute($query);
        return mysqli_fetch_all($result,MYSQLI_ASSOC); //Recieving reservard tables
    }
}
