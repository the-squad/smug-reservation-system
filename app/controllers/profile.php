<?php

require_once 'home.php';

class Profile extends Controller {

    public function index() {
        if (isset($_SESSION['id'])) {
            $m = member::find($_SESSION['id']);
            $this->view('profile', [
                'profile' => [
                    'name' => $m->getFirstName() . " " . $m->getLastName(),
                    'email' => $m->getEmail(),
                    'address' => $m->getAddress(),
                    'phone' => $m->getphoneNumber()
                ]
            ]);
        } else {
            $home = new home();
            $home->index();
        }
    }

    public function updateProfile() {


        $errors = array();

        $email = $_POST['email'];

        if (strtolower($email) != strtolower($_SESSION['email'])) {
            $emailErr = Validation::checkEmail($email);
            if ($emailErr != "Email doesn't exist") {
                if ($emailErr == "true") {
                    $emailErr = "Email Exist";
                }
                $errors['email'] = $emailErr;
            }
        }

        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $password = $_POST['password'];
            $passwordErr = Validation::checkpassword($password);
            if ($passwordErr != "true") {
                $errors['password'] = $passwordErr;
            }
            $confirm_password = $_POST['confirmpassword'];
            $confirmpasswordErr = Validation::checkConfirmPassword($confirm_password, $password);
            if ($confirmpasswordErr != "true") {
                $errors['conpassword'] = $confirmpasswordErr;
            }
        }

        $address = $_POST['address'];
        $addressErr = Validation::checkAddress($address);
        if ($addressErr != "true") {
            $errors['address'] = $addressErr;
        }

        //Note add variable phonenumber $ get$set function in user and put upate profile function in user
        $phone = $_POST['phonenumber'];
        $phoneErr = Validation::checkPhone($phone);
        if ($phoneErr != "true") {
            $errors['phonenumber'] = $phoneErr;
        }

        echo json_encode($errors);

        if (empty($errors)) {
            $usr = member::find($_SESSION['id']);
            $usr->setEmail($email);
            $usr->setAddress($address);
            $usr->setphoneNumber($phone);
            if(!empty($_POST['password'])){
                $usr->setPassword(md5($_POST['password']));
            }
            $usr->updateProfile();
        }
    }

    public function deleteProfile() {
        $u = new user();
        $u->setId($_SESSION['id']);
        $password = $_POST['password'];
        if (md5($password) == $_SESSION['password']) {
            $u->deleteProfile();
            user::logout();
            echo "done";
        }else{
            echo 'Password is wrong !';
        }
    }

}
