<?php

class home extends Controller {

    public function index() {
        if (isset($_SESSION['email']))
            $this->dashboard();
        else
            $this->view('home/index',['tables' => table::showTables()]);
    }

    public function dashboard() {
        if (isset($_SESSION['email'])) {
            $ut = App::getUserType($_SESSION['id']);
            if ($ut == 0) {
                $userR = reservation::showReservations();
                $m = new member();
                $m->setId($_SESSION['id']);
                $invoice = $m->showInvoicesHistory();
            } else {
                $userR = admin::showAllreservations();
                $invoice = order::viewAllinvoices();
            }
            $this->view('home/dashboard', [
                'reservations' => $userR,
                'invoice' => $invoice,
                'feedback' => admin::showFeedback(),
                'tables' => table::showTables(),
                'User_Type' => App::getUserType($_SESSION['id']),
                'tabs' => App::allowedPages($_SESSION['id'])
            ]);
        } else
            $this->index();
    }

    //?url=home/login
    //?url=home/index
    //?url=home/logout
    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        /*
            Saving error messages into variables to show it to the user
        */
        $emailErrMss = Validation::checkEmail($email);
        $passwordErrMss = Validation::checkpassword($password);

        /*
            Validating login inputs
        */
        if ($emailErrMss == "true") {
            if ($passwordErrMss == "true") {
                if (user::login($email, $password))
                    echo "true";
                else
                    echo "Password is wrong";
            } else
                echo $passwordErrMss;
        } else
            /*
                If the email doesn't exist, empty or not valid. Error message
                will be shown when user press confirm
            */
            echo $emailErrMss;
    }

    public function logout() {
        user::logout();
        $this->index();
    }

    public function register() {
        $guest = new Guest();
        $errors = array();
        $Fname = $_POST['firstname'];
        $fnameErr = Validation::checkname($Fname);

        if($fnameErr != "true")
        {
            $errors['fname'] = $fnameErr;
        }

        $Lname = $_POST['lastname'];
        $LnameErr = Validation::checkname($Lname);

        if($LnameErr != "true")
        {
            $errors['lname'] = $LnameErr;
        }

        $email = $_POST['email'];
        $emailErr = Validation::checkEmail($email);

        if($emailErr != "Email doesn't exist")
        {
            if($emailErr == "true")
            {
                $emailErr="Email Exist";
            }
            $errors['email'] = $emailErr;
        }

        $password = $_POST['password'];
        $passwordErr = Validation::checkpassword($password);

        if($passwordErr != "true")
        {
            $errors['password'] = $passwordErr;

        }

        $confirm_password = $_POST['confirmpassword'];
        $confirmpasswordErr = Validation::checkConfirmPassword($confirm_password, $password);

        if($confirmpasswordErr != "true")
        {
            $errors['conpassword'] =  $confirmpasswordErr;
        }

        $address = $_POST['address'];
        $addressErr = Validation::checkAddress($address);

        if($addressErr != "true")
        {
            $errors['address'] = $addressErr;
        }

        $phone = $_POST['phonenumber'];
        $phoneErr = Validation::checkPhone($phone);

        if($phoneErr != "true")
        {
            $errors['phonenumber'] = $phoneErr;
        }

            echo json_encode($errors);

        if(empty($errors))
        {
            Guest::Regestration($email, $password, $Fname, $Lname, $address, $phone);
        }
    }

    public function error() {
        $this->view('error', [
            'msg' => 'This page does not exist'
        ]);
    }

}
