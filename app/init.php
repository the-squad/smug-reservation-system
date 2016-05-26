<?php
session_start();
$models = array(
    'Human' => 'models/human.php',
    'Guest' => 'models/guest.php',
    'user' => 'models/user.php',
    'Usermanagment' => 'models/usermanagment.php',
    'paymentmethod' => 'models/paymentmethod.php',
    'admin' => 'models/admin.php',
    'employee' => 'models/employee.php',
    'feedback' => 'models/feedback.php',
    'food' => 'models/food.php',
    'member' => 'models/member.php',
    'order' => 'models/order.php',
    'report' => 'models/report.php',
    'reservation' => 'models/reservation.php',
    'table' => 'models/table.php',
    'Validation' => 'models/Validation.php'
);

foreach ($models as $key => $value) {
    require_once $value;
}
require_once 'Database.php';
require_once 'core/App.php';
require_once 'core/Controller.php';