<?php
require_once('../config/connect.php');
require_once('functions.php');

$departmentName = $_POST['department_name'];
$departmentCode = $_POST['department_code'];
$departmentId = getDepartmentId($_POST['department_name']);

if ($departmentId) {
    echo 'Department already exists.';
} else {


    if (isset($departmentCode) && isset($departmentName)) {
        if (createNewdepartment($departmentName, $departmentCode)) {
            echo 'Department Created Successfully!';
        } else {
            echo 'Unknown error occured.';
        }
    }
}
?>

<div><a href="../index">Go Home</a></div>