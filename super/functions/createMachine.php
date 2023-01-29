<?php
require_once('../config/connect.php');
require_once('functions.php');

// if (str_contains('f', $_POST['gender']) || str_contains('F', $_POST['gender'])) {
//     $gender = 'Female';
// }
$name = $_POST['machine_name'];
$machineId = $_POST['machine_id'];
$mark = $_POST['mark'];

if (!doesMachineIdExist($machineId)) {
    if (isset($name) && isset($machineId) && isset($mark)) {
        if (createMachine($name, $mark, $machineId)) {
            echo 'Machine Created Successfully!';
        } else {
            echo 'Unknown error occured.';
        }
    }
} else {
    echo 'Machine already exists.';
}
?>

<div><a href="../index">Go Home</a></div>