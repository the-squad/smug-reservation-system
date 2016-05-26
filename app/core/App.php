<?php

class App {

    protected $controller = 'Home';

    protected $method = 'index';

    protected $prams = [];

    public function __construct() {
        $url = $this->parseUrl(); // بيقطع اللي اتبعت من الget method
        /*
        $url[0] -> اسم الكنترولر
        $url[1] -> اسم الميثود
        $url[2] -> البراميترث اللي هتتبعت للميثود
        */
        if (isset($url[0]) && !empty($url[0])) { // لو اول خانه موجوده ومش فاضيه
            if (file_exists("../app/controllers/{$url[0]}.php")) { //لو ال;نترولر موجود
                $this->controller = $url[0];
                unset($url[0]); // بنشيل اول خانه من الاراي
            } else {
                $this->method = 'error';
            }
        }

        require_once "../app/controllers/{$this->controller}.php";

        $this->controller = new $this->controller; // اوبجت من ال;نترولر

        if (isset($url[1]) && method_exists($this->controller, $url[1])) { // لو الخانه التانيه موجوده و الميثود موجوده جوا ال;نترولر
            $this->method = $url[1];
            unset($url[1]); // بيشيل تاني خانه من الاراي
        }

        $this->params = $url ? array_values($url) : []; // لو الاراي فضيت البراميترز هي;ونوا عباره عن اراي فاضيه، ولو لسه مليانه هياخد باقي اللي في الاراي و يحطه في البراميترز
        // بيعمل ;ول للميثود من ال;نترولر و بعت ليها البراميترز
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl() {
        if (isset($_GET['url'])) { // لو بعت لي; بنقطعه ، غير ;ده بنرجع اراي فاضيه
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    public static function allowedPages($id){
        $DB = Database::getObject();
        $sql = "SELECT `tab`.`file_name`
                FROM `tab` JOIN `user_access`
                ON `tab`.`id` = `user_access`.`tab_id`
                JOIN `user_types`
                ON `user_types`.`id` = `user_access`.`type_id`
                WHERE `user_types`.`id` = (select `user`.`user_type_id` FROM `user` where `user`.`id` = $id)
                ORDER BY `tab`.`id`";
        $result = $DB->execute($sql);
        $pages = [];
        foreach ($result as $value) {
            $pages[] = $value['file_name'];
        }
        return $pages;
    }
    public static function getUserType($id){
        $DB = Database::getObject();
        $sql = "select `user_types`.`type`
                FROM `user_types` JOIN `user` ON `user_types`.`id` = `user`.`user_type_id`
                WHERE `user`.`id` = '$id'";
        $result = $DB->execute($sql);
        $type = mysqli_fetch_array($result)[0];
        if ($type == "user"){
            $type = 0;
        }else if ($type == "guest" || $type == NULL){
            $type = 2;
        }else {
            $type = 1;
        }
        return $type;
    }
}
