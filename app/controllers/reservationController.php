<?php
class reservationController extends Controller {
    /*
        This is the default method, when the user doesn't write ?url=dashboard this
        method will be fired
    */
    public function index() {
        $this->dashboard();
    }

    /*
        This method takes a parameter defines what reservations to show, whether
        the current reservation or the history
    */
    public function showReservations() {
       $status = $_POST['status'];

       if ($status == 'Hide History')
           echo json_encode(reservation::showReservations()); //Show current reservation
       else
           echo json_encode(reservation::showReservations('History')); //Show History
    }


    /*
        Funtion that controls what happens when the user creates or update a
        reservation
    */
    public function reservationOperation($opType) {
        //Making an array of errors messages
        $errors = array();

        //When the user is updating a reservation we will call the reservation id
        if ($opType != "Create")
            $rowID = str_replace('r', "", $_POST['id']);

        //Check if the date field is empty or not
        $date = $_POST['date'];
        $dataerr = Validation::checkDate($date);
        if ($dataerr != "true")
            $errors['date'] = $dataerr;

        //Check is the hour field is empty or not
        $time = $_POST['hour'];
        $timeErr = Validation::checkTime($date, $time); //Saving error message to a variable
        if ($timeErr != "true")
            $errors['time'] = $timeErr;

        //Check duation field for validation and if empty or not
        $duration = $_POST['duration'];
        $durationErr = Validation::checkDuration($duration); //Saving error message to a variable
        if ($durationErr != "true")
            $errors['duration'] = $durationErr;

        //Taking an string of tables numbers and converts it to a array
        $No_tables = json_decode($_POST['checklist']);
        if (!$No_tables)
            $errors['tables'] = "Tables is Required"; //Saving error message to a variable


        //When all fields are not empty and validated successfully
        if (empty($errors)) {
            //Creating an array of size of tables number
            $tables = array([sizeof($No_tables)]);

            //Creating an object for each table and setting it's values
            for ($i = 0; $i < sizeof($No_tables); $i++) {
                $tables[$i] = new table();
                $tables[$i]->setTableNumber($No_tables[$i]);
            }

            //Creating an object of reservation and seeting it's values
            $reservation = new reservation($tables);
            $reservation->setDate($date);
            $reservation->setTime($time);
            $reservation->setDuration($duration);
            $reservation->setTable($tables);

            //Creating an object of member
            $member = new member();

            /*
              If the opType == Create, then we will return the new table's id
              to the JavaScript and call addReservation method, if the opType == Update, then we will send selected
              table's id and time and call updateReservation method
             */
            if ($opType == "Create")
                $errors['id'] = $member->addReservation($reservation);
            else {
                $reservation->setTime(date("H:i", strtotime($time)));
                $reservation->setReservationID($rowID);
                $member->updateReservation($reservation);
            }
        }
        //Returning array of errors
        echo json_encode($errors);
    }

    /*
        Will take reservation day and time and check for reserved tables then return
        array of them to ajax
    */
    public function checkReservations() {
        //Checking if date, duration or hour field is empty will send an empty array
        if (empty($_POST['date']) || empty($_POST['duration']) || empty($_POST['hour']))
            die(json_encode([]));

        //Reciecing data
        $date = $_POST['date'];
        $time = $_POST['hour'];
        $duration = $_POST['duration'];

        //Creating an object of reservation and set it's value
        $reservation = new reservation(null);
        $reservation->setDate($date);
        $reservation->setTime($time);
        $reservation->setDuration($duration);

        //Return an array of reserved tables
        echo json_encode($reservation->checkReservation());
    }

    /*
        Deleting a reservation
    */
    public function deleteReservations() {
        //Removing "r" char from div's id
        $id = str_replace("r", "", $_POST['id']);

        //Creating an object of reservation and set it's value
        $reservation = new reservation(null);
        $reservation->setReservationID($id);

        //Creating an object of member and set it's value
        $member = new member();
        $member->deleteReservation($reservation);
    }
}
?>
