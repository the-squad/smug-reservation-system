<?php

class Foodmenu extends Controller {

    public function index() {
        $id = '';
        if(isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $m = member::find($_SESSION['id']);
        }
        $this->view('food-menu', [
            'food' => food::getFood(),
            'User_Type' => App::getUserType($id),
            'methods' => paymentmethod::allPaymentMethods()
        ]);
    }

    /*
      When the admin add a new food item this funtion will validate the fields
      then call addFodd method
     */

    public function controlFood() {
        $operation = $_POST['operation'];
        //Creating array of erros
        $errors = array();

        //Validating picture
        if (isset($_FILES['Image'])) {
            $filename = $_FILES['Image']['name'];
            $file_tmp = $_FILES['Image']['tmp_name'];

            $temporary = explode('.', $filename);
            $filename = str_replace(" ", "_", $filename);
            $filename = str_replace("(", "_", $filename);
            $filename = str_replace(")", "_", $filename);
            $file_extension = end($temporary);
            $newfilename = "photo/" . date("Y_m_d_h_i_s_") . $filename . '.' . $file_extension;
            //$newfilename = "x.y";
            move_uploaded_file($file_tmp, $newfilename);
        } else {
            if (!$_POST['Image']) {
                //When there is no photo uploaded
                $errors['photo'] = "Photo is Required";
            }
        }

        //Validating name
        $name = $_POST['name'];
        $nameErr = Validation::checkname($name);
        if ($nameErr != "true")
            $errors['name'] = $nameErr;

        //Validating price
        $price = $_POST['price'];
        $priceErr = Validation::checkNumber($price);
        if ($priceErr != "true")
            $errors['price'] = $priceErr;

        //Validating description
        $description = $_POST['description'];
        $descriptionErr = Validation::checkDescription($description);
        if ($descriptionErr != "true")
            $errors['description'] = $descriptionErr;

        //When there is no errorsif (empty($errors) && $operation == "create") {
        $food = new food();
        $admin = new admin();

        //Filling food object
        if (empty($errors)) {
            $food = new food();
            $admin = new admin();

            //Filling food object
            $food->setName($name);
            $food->setPrice($price);
            $food->setDesription($description);
            if (!isset($_POST['Image'])) {
                $food->setPic([$newfilename]);
            }
            $food->setType($_POST['category']);
            $food->setRate(0);

            if ($operation == "create") {
                $id = $admin->addfood($food);
            } else {
                $id = $_POST['id'];
                $food->setID($id);
                $admin->updatefood($food);
            }
            //Adding food to the database
            if ($id) {
                $errors['id'] = $id;
                if (!isset($_POST['Image'])) {

                    $errors['url'] = $newfilename;
                }
            }
            //re
        }
        //Returning the errors back
        echo json_encode($errors);
    }

    public function deleteFood() {
        echo $_POST['idfood'];
        $food = new food();
        $admin = new admin();
        $food->setID($_POST['idfood']);
        $admin->deletefood($food);
    }
/*
    public function makeOrder() {
        $address = $_POST['address'];
        $paymentmethod = $_POST['paymentmethod'];
        $credit_number = $_POST['credit_number'];
        $cvc = $_POST['cvc'];
        $expire_date = $_POST['expire_date'];
        $p = json_decode($_POST['ss']);
        $p = (array) $p;
        $z = array();
        $w = array();

        $o = new order();
        date_default_timezone_set("Africa/Cairo");
        $date = date('Y-m-d');
        $o->setDate($date);
        $o->set
        foreach ($p as $x) {
            foreach ($x as $key => $value) {
                $z[] = array($key => $value,);
            }
        }
        for ($i = 0; $i < sizeof($z); $i++) {
            $w[] = array("name" => $z[$i]['name'] ,"amount" => $z[++$i]['amount'] );
        }
    }*/
}
