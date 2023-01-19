<?php
require_once('../config/connect.php');
require_once('functions.php');

$courseName = $_POST['course_name'];
$courseCode = $_POST['course_code'];
$departmentId = getDepartmentId($_POST['department_name']);

if(isset($courseCode) && isset($courseName) && isset($departmentId)){
    if(createNewCourse($courseName, $courseCode, $departmentId)){
        echo 'Course Created Successfully!';
    }else{
        echo 'Unknown error occured.';
    }
    
}

?>

<div><a href="../index">Go Home</a></div>