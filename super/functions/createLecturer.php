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
$staffId = $_POST['staff_id'];
$departmentId = getDepartmentId($_POST['department_name']);

if (!validateEmail($email) && !validateLecturerEmail($email) && !validateSuperAdminEmail($email)) {
    if (isset($firstName) && isset($lastName) && isset($departmentId)) {
        if (createLecturer($firstName, $lastName, $gender, $email, $staffId, $departmentId)) {
            echo 'Lecturer Created Successfully! Their default password is 1';
        } else {
            echo 'Unknown error occured.';
        }
    }
}else{
    echo'Email already exists.';
}
?>

<div><a href="../index">Go Home</a></div>