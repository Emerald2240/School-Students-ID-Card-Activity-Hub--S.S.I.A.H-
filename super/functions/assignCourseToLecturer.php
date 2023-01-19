<?php
require_once('../config/connect.php');
require_once('functions.php');


$lecturerInfo = getLecturerInfoWithEmail($_POST['lecturer_email']);
$courseInfo = getCourseInfoWithName($_POST['course_name']);

if(isset($lecturerInfo) && isset($courseInfo)){
    if( assignCourseToLecturer($lecturerInfo['id'], $courseInfo['id'])){
        echo 'Course assigned successfully!';
    }else{
        echo 'unknown failure occured';
    }
}

?>

<div style="text-align:center"><a href="../index">Go Home</a></div>