<?php

class paymentmethod {
    private $id;
    private $name;

    /*
    $options = [
        "optionname" => [
            "id" => 1,
            "type" => "number",
            "value" => 5],
        "optionname 2" => [
            "id" => 2,
            "type" => "text",
            "value" => "Mohamed"]
    ];
    */
    private $options = [];

    function getID() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getOptions() {
        return $this->options;
    }

    /*
    $options = ["optionname" => [
        "id" => 5,
        "type" => "number",
        "value" => "4"
    ]];
    */
    function setOptions($options) {
        foreach ($options as $key => $value) {
            if(isset($this->options[$key]))
                $this->options[$key]['value'] = $value['value'];
        }
    }


    public function filldata(Order $order) {
        $orderID = $order->getOrderID();
        $query = "INSERT INTO `payment_values`(`details_id`, `order_id`, `value`) VALUES ";
        $values = [];
        $DB = Database::getObject();
        foreach($order->getPaymentMethod()->getOptions() as $key => $value) {
            $values[]="({$value['id']}, {$orderID}, '{$value['value']}')";
        }
        $query .= implode(", ", $values);
        //die($query);
        return $DB->execute($query);
    }
########################## [Static methods]##########################
    /*
     * ['x', 'y', 'z']
     */
    public static function addPaymentMethod($Name, $options) {
        $DB = Database::getObject();
        if (!$DB->add('payment_method', ['name' => $Name])) {
            throw new Exception("Error: payment method {$Name} already exist!");
        }
        $method_id = mysqli_fetch_assoc($DB->get('payment_method', ['id'], 'name', $Name))['id'];
        $availableOptions = self::availableOptions();
        $method_options_ids = [];
        foreach($availableOptions as $value) {
            if (in_array($value['name'], $options)) {
                $method_options_ids[] = "('{$method_id}','{$value['id']}')";
            }
        }
        if (empty($method_options_ids)) {
            throw new Exception("Error: No options selected or they are not in the Database");
        }
        $query = "INSERT INTO `payment_details`(`method_id`, `option_id`) VALUES ".implode(",", $method_options_ids);
        if (!$DB->execute($query)) {
            throw new Exception("Error: faild to assign options to method ".$Name);
        }
        return TRUE;
    }

    /*
     * takes array of options and store it in the database.
     *
     * ex.
     * $Options = [
     *     'Option name' => [
     *         'type' => 'number'
     *     ],
     *     'Option name 2' => [
     *         'type' => 'Text'
     *     ]
     * ];
     *
     * return : number of added options.
     *
     */
    public static function addOptions($Options) {
        $DB = Database::getObject();
        $added_options_count = 0;
        foreach($Options as $key => $value) {
            if ($DB->add('payment_options', ['name' => $key, 'type' => $value['type']])) {
                $added_options_count++;
            }
        }
        return $added_options_count;
    }

    /*
     * Delete payment method Options by it's name.
     *
     * $Options : Array of Options name's.
     *     ex. ["phone", "cvc", "id"]
     *
     * return : number of deleted options.
     */
    public static function deleteOptions($Options) {
        $DB = Database::getObject();
        $deleted_options_count = 0;
        foreach($Options as $value) {
            if ($DB->delete('payment_options', 'name', $value)) {
                $deleted_options_count++;
            }
        }
        return $deleted_options_count;
    }

    /*
     * return : array of all available options.
     *
     * $example = [
     *     'Option name' => [
     *         'id' => 1,
     *         'type' => 'number'
     *     ],
     *     'Option name 2' => [
     *         'id' => 2,
     *         'type' => 'Text'
     *     ]
     * ];
     */
    public static function availableOptions() {
        $options = [];
        $result = Database::getObject()->get('payment_options', ['id', 'name', 'type']);
        while($row = mysqli_fetch_assoc($result)){
            $options[$row['name']] = [
                'id' => $row['id'],
                'type' => $row['type']
            ];
        }
        return $options;
    }

    /*
     * Get Payment method by it's name.$Name
     *
     * $Name : Payment method name.
     *
     * return :
     *      1- NULL : if payment method doesn't exist.
     *      2- Object of 'paymentmethod' : if it's exist.
     */
     public static function findPayment($Name) {
         $DB = Database::getObject();
         $method_Object = new paymentmethod;
         $method_id = mysqli_fetch_assoc($DB->get('payment_method', ['id'], 'name', $Name))['id'];
         if (!$method_id) {
             return NULL;
         }
         $method_Object->name = $Name;
         $query = "SELECT `o`.`name`, `o`.`type`, `o`.`id` FROM `payment_options` `o` JOIN `payment_details` `d`
                   ON `o`.`id` = `d`.`option_id` WHERE `d`.`method_id` = {$method_id}";
         $result = $DB->execute($query);
         while ($row = mysqli_fetch_assoc($result)) {
             $method_Object->options[$row['name']] = [
                 'id' => $row['id'],
                 'type' => $row['type']
             ];
         }
         return $method_Object;
     }
     public static function allPaymentMethods() {
         $DB = Database::getObject();
         $method = $DB->get('payment_method', ['id', 'name']);
         $methods = [];
         while ($row = mysqli_fetch_assoc($method)) {
             $methods[] = $row['name'];
         }
         return $methods;
     }
}
