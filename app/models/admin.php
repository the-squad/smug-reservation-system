<?php

/*
  VERY IMPORTANT, PLEASE ADD COMMENTS DESRIBES YOUR QUERIES AND COMMANDS
 */

class admin extends user {
    /*
      Admin adds a new food item to the menu, you will call global add method
     */

    public function addfood(food $food) {
        //assgin variable to this name in data base
        $value_food = ['name' => $food->getName(), 'description' => $food->getDesription(), 'price' => $food->getPrice(), 'type_id' => $food->getType(), 'rate' => $food->getRate(), 'users_count' => 0];
        $DB = Database::getObject(); //create object
        //check if food add or not
        if (($DB->add("food", $value_food))) {
            $result = mysqli_fetch_array($DB->get("food", ["id"], "name", $food->getName())); //get here id from table after add it
            $id = $result[0]; //assgin id into var
            $Pic = $food->getPic(); //assgin pic to var
            //print_r( $Pic);
            //check if it array or not
            if ($Pic) {
                if (is_array($Pic)) {
                    //make query to add several pic for 1 food
                    $sql = "INSERT INTO pictures (food_id,picture) values ";
                    $valuesArr = array();
                    foreach ($Pic as $row) {
                        $valuesArr[] = "('$id', '$row')";
                    }
                    $sql .= implode(',', $valuesArr);
                    $DB->execute($sql); //excute query
                    //echo $sql;
                    return $id;
                } else {
                    $DB->add("pictures", ["food_id" => $id, "picture" => $Pic]); //if pic not an array
                }
            }
        } else {
            //echo 'error';//if he cant add food
        }
    }

    /*
      Admin updates a food item from the menu, you will call global update method
     */

    public function updatefood(food $food) {
        //assgin variable to this name in data base
        $value_food = ['name' => $food->getName(), 'description' => $food->getDesription(), 'price' => $food->getPrice(), 'type_id' => $food->getType()];
        $DB = Database::getObject(); //create object
        //check if food add or not
        if (($DB->edit("food", $value_food, 'id', $food->getID()))) {
            $id = $food->getID(); //assgin id into var
            $Pic = $food->getPic(); //assgin pic to var
            if ($Pic) {
                $DB->delete('pictures', 'food_id', $id);
            }
            //check if it array or not
            if (is_array($Pic)) {
                //make query to add several pic for 1 food
                $sql = "INSERT INTO pictures (food_id,picture) values ";
                $valuesArr = array();
                foreach ($Pic as $row) {
                    $valuesArr[] = "('$id', '$row')";
                }
                $sql .= implode(',', $valuesArr);
                $DB->execute($sql); //excute query
                return $id;
            }
        }
    }

    /*
      Admin deletes a food item from the menu, you will call global delete method
     */

    public function deletefood(food $food) {
        $DB = Database::getObject();
        $id = $food->getID();
        $query = "SELECT `order`.`date` FROM `order` WHERE `order`.`id` IN (SELECT `order_food`.`food_id` FROM `order_food` WHERE `order_food`.`food_id` = '$id')";
        $result = $DB->execute($query);
        if (mysqli_num_rows($result) == 0) {
            $DB->delete('pictures', 'food_id', $id);
            $DB->delete('food', 'id', $id);
        }
        else
        {
            echo "error";
        }
        $DB->closeConnection();
    }

    /*
      Takes the feedback from the database and shows it to the user
     */

    public static function showFeedback() {
        $DB = Database::getObject();
        $sql = "SELECT CONCAT(u.`first_name`,' ', u.`last_name`) as `name`, u.`email`, f.`review`, f.`dislike`, f.`rate`
                FROM `feedback` f JOIN `user` u ON u.`id` = f.`user_id`";
        return $DB->fetchAll($DB->execute($sql));
    }

    public function generateReport($report) {

        $DB = Database::getObject();
        $startDate=$report->getStartDate();
        $endtDate=$report->getEndDate();

        $query = "SELECT a.Total_Reservations,a.sum_duration,a.No_users,b.No_tables,c.Orders,c.Distinct_Users,c.Total_Money,d.Ordered_times,d.Popular_Food "
                . "FROM ( SELECT COUNT(*) AS Total_Reservations,SUM(duration) AS sum_duration,COUNT(DISTINCT reservations.user_id) AS No_users "
                . "FROM `reservations` WHERE `reservations`.`date` BETWEEN '$startDate' AND '$endtDate' ) AS a , "
                . "( SELECT COUNT(*) AS No_tables FROM reservation_tables WHERE reservation_tables.reservation_id IN "
                . "( SELECT reservations.id FROM reservations WHERE `reservations`.`date` BETWEEN '$startDate' AND '$endtDate') ) AS b , "
                . "( SELECT COUNT(`order`.`date`) AS Orders,COUNT(DISTINCT(`order`.`user_id`)) AS Distinct_Users,SUM(`order`.`total_money`) AS Total_Money "
                . "FROM `order` WHERE `order`.`date` BETWEEN '$startDate' AND '$endtDate' ) AS c , ( SELECT `food`.`users_count` AS Ordered_times,`food`.`name` AS Popular_Food FROM `food` HAVING MAX(`food`.`users_count`) ) AS d";


            $row=$DB->execute($query);

        //$result = mysqli_fetch_array($row);
            return mysqli_fetch_all($row, MYSQLI_ASSOC);
    }

    /*
      Admin creates a new account for and employee and set his permsiions to acess
      tabs and operations by calling the setAccessiblePages function, you will
      call global add method
     */

    public function addEmployee(employee $Employee) {
        $DB = Database::getObject();
        //USER table data
        $userArray = array(
            'first_name' => $Employee->getFirstName(),
            'last_name' => $Employee->getLastName(),
            'email' => $Employee->getEmail(),
            'phone_number' => $Employee->getPhoneNumber(),
            'user_type_id' => $Employee->getType()
        );

        //save the EMAIL in variable
        $employeeEMAIL = $Employee->getEmail();
        //get user ID by email to add it later in member_detail table
        $query = "SELECT `user`.`id` FROM `user` WHERE `user`.`email` = '$employeeEMAIL'";
        $result = $DB->execute($query);

        while ($row = mysqli_fetch_array($result)) {
            $employeeID = $row[0];
        }

        $memberDetailsArray = array(
            'user_id' => $employeeID,
            'password' => $Employee->getPassword(),
            'address' => $Employee->getAddress()
        );
        // add to USER table
        $DB->add("user", $userArray);
        // add to member_details table
        $DB->add("member_details", $memberDetailsArray);
        $DB->closeConnection();$DB = Database::getObject();
        //USER table data
        $userArray = array(
            'first_name' => $Employee->getFirstName(),
            'last_name' => $Employee->getLastName(),
            'email' => $Employee->getEmail(),
            'phone_number' => $Employee->getPhoneNumber(),
            'user_type_id' => $Employee->getType()
        );

        //save the EMAIL in variable
        $employeeEMAIL = $Employee->getEmail();
        //get user ID by email to add it later in member_detail table
        $query = "SELECT `user`.`id` FROM `user` WHERE `user`.`email` = '$employeeEMAIL'";
        $result = $DB->execute($query);

        while ($row = mysqli_fetch_array($result)) {
            $employeeID = $row[0];
        }

        $memberDetailsArray = array(
            'user_id' => $employeeID,
            'password' => $Employee->getPassword(),
            'address' => $Employee->getAddress()
        );
        // add to USER table
        $DB->add("user", $userArray);
        // add to member_details table
        $DB->add("member_details", $memberDetailsArray);
        $DB->closeConnection();
    }

    /*
      Admin updates employee's permissions, you will call global update method
     */

    public function updateEmployee(employee $Employee) {
        // get Employee ID from his row
        $rowID = str_replace('r', "", $_POST['id']);
        $DB = Database::getObject();
        //get his new Type
        $employeeNewType = $Employee->getType();
        //query to get the newType ID
        $query1 = "SELECT `user_types`.`id` FROM `user_types` WHERE `user_types`.`type` = '$employeeNewType'";
        //Execute the query
        $result = $DB->execute($query1);
        // put the newTypeID in $typeID variable
        while ($row = mysqli_fetch_array($result)) {
            $typeID = $row[0];
        }
        //update his old type with the newType ... used his ID to get this row
        $query2 = "UPDATE `user` SET `user`.`user_type_id`= '$employeeNewType'"
                . " WHERE `user`.`id` = '$rowID'";
        //Execute the query
        $result = $DB->execute($query2);
        //close connection
        $DB->closeConnection();
    }

    /*
      Admin deletes an employess account from the website, you will call global
      delete method
     */

    public function deleteEmployee(employee $Employee) {
        $DB = Database::getObject();

        //get employee ID from the Object
        $empID = $Employee->id;

        // delete his password and Address from member_details table
        $DB->delete("member_details", "user_id", $empID);

        // delete his informations from user table
        $DB->delete("user", "id", $empID);

        //close DB connection
        $DB->closeConnection();
    }

    /*
      Set employess permssions, you will take input from checkboxes
     */

    public function setAccessiblePages(employee $Employee) {
        //TODO
    }

    /*
      Add a new table to the database and chooses it loaction, you will call global add method
     */

    public function addTable(table $table) {
        $DB = Database::getObject(); // بجيب كائن من قاعده البيانات علشان اتعامل معاها :D
        if (!$DB->add('table', ['x' => $table->getX() // السطر ده و اللي تحته مكان الترابيزه
                    , 'y' => $table->getY()
                    , 'table_number' => $table->getTableNumber() // ده بقى رقم الترابيزه نفسها ، اللي الادمن بيدخله مش اللي بتعمله الداتابيز :D
                    , 'chairs_number' => $table->getSeatsNumber() // اما ده بقى عدد الكراسي :D
                ])) {
            return "Error inserting table<br>"; // لو الترابيزه متضافتش بسبب حاجة زي ان رقم الترابيزه موجود اصلا
        } else {
            return mysqli_fetch_assoc($DB->get('table', ['id'], 'table_number', $table->getTableNumber()))['id']; // الترابيزه اتضافت الحمدلله :D
        }
        $DB->closeConnection(); // بقفل الاتصال بقى لان ملوش لازمه و السلام عليكم و رحمة الله و بركاته :D
    }

    public function updateTable(table $table) {
        $DB = Database::getObject();
        if ($DB->edit("table", ['x' => $table->getX()
                    , 'y' => $table->getY()
                    , 'table_number' => $table->getTableNumber()
                    , 'chairs_number' => $table->getSeatsNumber()
                        ], "id", $table->getID())) {
            return 'done';
        } else {
            return "Error";
        }
    }

    /*
      Deletes a table from the database, you will call global delete method
     */

    public function DeleteTable(table $table) {
        $DB = Database::getObject(); // كائن من قاعده البيانات
        if (!$DB->delete('table', 'table_number', $table->getTableNumber())) { // بمسح برقم الترابيزه
            //echo "Error delete table<br>"; // لو الترابيزه متمسحتش
        } else {
            //echo "Done<br>"; // لو الترابيزه اتمسحت
        }
        $DB->closeConnection(); // بقفل الاتصال بقاعده البيانات :D
    }

    /*
      Reads reservation records from the database and shows it the admin
      You will show him all reservations, and it will contain
      - Name
      - Phone Number
      - Email
      - Date
      - Hour
      - Duration
      - Tables number
      - Tables he reserved
      - Payment method
     */

    public static function showAllreservations() {
        /*
         * Query for select data 'All reservations' from 4 tables and caldulate the number of chirs of each reservation
         * output it with ordering date & time
         */
        $DB = Database::getObject();
        $sql = "SELECT user.id ,user.first_name , user.last_name , user.phone_number , user.email , reservations.date , reservations.time , concat(\"[\", GROUP_CONCAT(`table`.id), \"]\") as `tables` ,"
                . "reservations.duration , SUM(table.chairs_number) as `chairs_number` FROM user "
                . "JOIN reservations ON user.id=reservations.user_id "
                . "JOIN reservation_tables ON reservations.id=reservation_tables.reservation_id "
                . "JOIN `table` ON reservation_tables.table_id=`table`.`id` "
                . "GROUP BY reservation_tables.reservation_id "
                . "ORDER BY reservations.date , reservations.time";

        //call function execute which take query and execute it
        $check = $DB->execute($sql);
        return mysqli_fetch_all($check, MYSQLI_ASSOC);
    }

}
