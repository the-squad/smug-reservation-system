<?php
class Validation {
    public static function checkname($name) {
        if(!$name)
            return "Name is required";
        else if(!ctype_alpha(str_replace(' ', '', $name)))
            return "Name is should be only charachter";
        else if(strlen($name)<2 | strlen($name)>15)
            return "name should be between 2 : 15 char";
        else
            return true;
    }
    /*
        Checking email data
    */
    public static function checkEmail($Email) {
        $DB = Database::getObject();
        //Check if the email is empty
        if ($Email == "")
        {
            return "Email is required";
        }
        //Check if the email isn't valid
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL))
            return "Invalid Email";
        else {
            //Checking if the email exists in the database
            $result = mysqli_fetch_array($DB->get("user",array("id"),"email",$Email));
            $result2 = mysqli_fetch_array($DB->get("member_details",array("user_id"),"user_id",$result[0]));
            if ($result2[0])
                return "true";
            else if ($result[0])
                return "update";
            else
                 return "Email doesn't exist";
        }
    }

    public static function checkpassword($password) {
        if(!$password)
            return "Password is Required";
        else if(strlen($password)<8 | strlen($password)>16)
            return "Password should be between 8:16 digit";
        else
            return true;
    }

    public static function checkConfirmPassword($confirm_password,$password) {
        if(!$confirm_password)
            return "Confirm password is Required";
        else if($confirm_password != $password)
            return "Password didn't match";
        else
            return "true";
    }

    public static function checkPhone($phone) {
        if(!$phone)
            return "phone is required";
        else if(!is_numeric($phone))
            return "phone should be only Numbers";
        else if(strlen($phone)!=11)
            return " Phone number must be 11 numbers";
        else
            return true;
    }

    public static function checkAddress($address) {
        if(!$address)
            return "Address is Required";
        else if(strlen($address)<7 || strlen($address)>30)
            return "Address must be between 7:14 digits";
        else
            return true;
    }

    public static function checkDuration($duration) {
        if(!$duration)
            return "Duration is Required";
        if($duration<1 | $duration>24)
            return "Invalid Duration";
        else
            return true;
    }

    public static function checkTime($date,$time) {
        date_default_timezone_set("Africa/Cairo");
        if(!$time)
            return "Time is Required";


        if( $date== (date('Y-m-d')) && $time< (date("H:i:s")))
        {
                return "Invalid Time";
        }
        else
            return TRUE;
    }

    public static function checkDate($date) {
        if(!$date)
            return "Date is Required";

        date_default_timezone_set("Africa/Cairo");
        $curdate = date('Y-m-d');  //the current Date in PC
        $newdate = strtotime ( '+30 day' , strtotime ( $curdate ) ) ;  // the Date after 30 day
        $newdate = date ( 'Y-m-j' , $newdate );  // Foramt for Date
//echo "newdate:".$newdate."<br>"."currdate".$curdate."<br>"."Date".$date."<br>";

        if (strtotime($date)<strtotime($curdate)) {
            return "Invalid Date it is old";
        }
        if(strtotime($date)>strtotime($newdate))
        {
            return "Invalid.Enter Date before ".$newdate;
        }

        return true;
    }

    public static function checkNumber($number) {
        if(!$number)
            return "Number is Required";
        if($number<1 | $number>250)
            return "Invalid Number";
        else
            return true;
    }

    public static function checkDescription($Description) {
        if(!$Description)
            return "Discription is required";
        else if(!ctype_alpha(str_replace(' ', '', $Description)))
            return "Description is should be only charachter";
        else if(strlen($Description)<1 | strlen($Description)>190)
            return "name should be between 1 : 190 char";
        else
            return true;
    }
}
