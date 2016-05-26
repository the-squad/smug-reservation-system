<?php

class food {
    //Intializing variables
    private $ID;
    private $type;
    private $name;
    private $price;
    private $desription;
    private $rate;
    private $Pic = array();

    //Setter and getter methods
    function getPic() {
        return $this->Pic;
    }

    function setPic($Pic) {
        $this->Pic = $Pic;
    }

    function getID() {
        return $this->ID;
    }

    function getType() {
        return $this->type;
    }

    function getName() {
        return $this->name;
    }

    function getPrice() {
        return $this->price;
    }

    function getDesription() {
        return $this->desription;
    }

    function getRate() {
        return $this->rate;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setDesription($desription) {
        $this->desription = $desription;
    }

    function setRate($rate) {
        $this->rate = $rate;
    }

    /*
        Reads food data from the database
    */
    public static function getFood() {
        //Creating object of database
        $DB = Database::getObject();

        //Getting food catagories from the database
        $types = $DB->fetchAll($DB->get('food_catagories', ['id', 'type']));
        $foodList = []; //3D array of food

        foreach ($types as $key => $value) {
            $sql = "SELECT `id`, `name`, `description`, `price`, IFNULL(ROUND(`rate`/`users_count`), 1) AS `rate`, (SELECT `picture` FROM `pictures` WHERE `food_id` = `food`.`id` LIMIT 0,1) as `picture`"
                ."FROM `food` WHERE `type_id` = {$value['id']}";
            $food = $DB->fetchAll($DB->execute($sql));
            for ($i=0; $i < count($food); $i++) {
                if(!file_exists($food[$i]['picture'])){
                    $food[$i]['picture'] = 'photo/not-available.png';
                }
            }
            $foodList[$value['type']] = [
                'id' => $value['id'],
                'food' => $food
            ];
        }
        return $foodList; //Reutring food items
    }
}
