<?php
require_once('../config/connect.php');
require_once('functions.php');

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$gender = $_POST['gender'];
$staffId = '-';
// if (str_contains('f', $_POST['gender']) || str_contains('F', $_POST['gender'])) {
//     $gender = 'Female';
// }
$email = $_POST['email'];
$regNumber = $_POST['reg_number'];
$departmentId = getDepartmentId($_POST['department_name']);

if (!validateEmail($email) && !validateStaffEmail($email) && !validateSuperAdminEmail($email)) {
    if (!validateStudentRegNumber($regNumber)) {

        if (isset($firstName) && isset($lastName) && isset($departmentId)) {
            if (createStudent($firstName, $lastName, $gender, $email, $regNumber, $departmentId)) {
                echo 'Student Created Successfully!';
            } else {
                echo 'Unknown error occured.';
            }
        }
    } else {
        echo 'Student reg number already exists.';
    }
} else {
    echo 'Email already exists.';
}
?>

<div><a href="../index">Go Home</a></div>