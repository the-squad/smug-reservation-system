<?php

class user extends Human {
    //Intializing variables
    protected $address;
    protected $password;
    protected $type;

    //Intializing variables
    function getAddress() {
        return $this->address;
    }

    function getPassword() {
        return $this->password;
    }

    function getType() {
        return $this->type;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setType($type) {
        $this->type = $type;
    }

    /*
        You will check in for user login data, you must show error message if email
        or password was wrong. NOTE: Check email first then the password
    */
    public static function login($email,$password) {
        if (filter_var($email , FILTER_VALIDATE_EMAIL))
        {
            if(strlen($password) > 8)
            {
                $DB = Database::getObject();
                $sql = "SELECT `id`, `first_name`, `last_name`, `email`, `phone_number`, `user_type_id` , `address`  FROM `user` JOIN `member_details` WHERE `member_details`.`user_id` = `user`.`id` AND `user`.`email` LIKE '$email' AND `member_details`.`password` = md5('$password')";
                $result = $DB->execute($sql);
                if(mysqli_num_rows($result)==1)
                {
                    $asoarr = mysqli_fetch_assoc($result);
                    //session_start();
                    foreach ($asoarr as $key => $value) {
                        $_SESSION["$key"] = $value;
                    }
                    $_SESSION["password"] = md5($password);
                    return true;
                }
                else
                {
                    return false;
                }
            }

        }
        return false;
    }

    /*
        Take the user to the index.php
    */
    public static function logout() {
        session_unset();
        session_destroy();
        session_start();
    }

    public function deleteProfile() {
        $DB = Database::getObject();
        return $DB->delete('user', 'id', $this->getId());
    }

    /*
        Send a link that heads to forget-password.php
    */
    public function forgetPassword($email) {
        //TODO
    }
}
