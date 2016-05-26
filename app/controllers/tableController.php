<?php

class tableController extends Controller {

    public function index() {

    }

    public function addtable() {
        $error = array();
        $x = $_POST['x'];
        $y = $_POST['y'];
        $chairnumbers = $_POST['chairnumbers'];
        $tablenum = $_POST['tablNumbers'];

//        if (Validation::Num($chairnumbers) != "true") {
//            $error['$chairnumbers'] = "Chair Number Should be only Number";
//        }
//
//        if (Validation::Num($tablenum) != "true") {
//            $error['$tablenum'] = "Table Number Should be only Number";
//        }

        if (!$error) {
            $table = new table();
            $table->setSeatsNumber($chairnumbers);
            $table->setTableNumber($tablenum);
            $table->setX($x);
            $table->setY($y);
            $admin = new admin();
            $error['id'] = $admin->addTable($table);
        }
        echo json_encode($error);
    }

    public function updateTable() {
        $error = array();
        $ID = $_POST['id'];
        $x = $_POST['x'];
        $y = $_POST['y'];
        $chairnumbers = $_POST['chairnumbers'];
        $tablenum = $_POST['tablNumbers'];
//
//        if (Validation::Num($chairnumbers) != "true") {
//            $error['$chairnumbers'] = "Chair Number Should be only Number";
//        }
//
//        if (Validation::Num($tablenum) != "true") {
//            $error['$tablenum'] = "Table Number Should be only Number";
//        }

        if (!$error) {
            $table = new table();
            $table->setSeatsNumber($chairnumbers);
            $table->setTableNumber($tablenum);
            $table->setX($x);
            $table->setY($y);
            $table->setID($ID);
            $admin = new admin();
            echo $admin->updateTable($table);
        } else {
            echo json_encode($error);
        }
    }

    public function deletetable() {
            $admin = new admin();
            $table = new table();
            $table->setTableNumber($_POST['tableNumber']);
            if (!$table->checkTableAvailability()) {
                $admin->DeleteTable($table);
                echo "done";
            } else {
                echo "false";
            }
        }

    public function viewTables() {
        echo json_encode(table::showTables()); //Show tables
    }

}

?>
