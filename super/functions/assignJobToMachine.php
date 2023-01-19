<?php
require_once('../config/connect.php');
require_once('functions.php');

$courseName = $_POST['machine_name'];
$nullStaff = getStaffInfoWithEmail('nullvoid@mail.com');
// var_dump($nullStaff);
// echo '<hr>';
$myJobs = getAllJobsForStaff($nullStaff['id']);
// var_dump($myJobs);
// echo '<hr>';
$myMachine = getStaffsMachine($nullStaff['id']);
// var_dump($myMachine);

if (isset($courseName)) {
    if ($myMachine && $myJobs) {
        if (assignSuperJobToMachine($myMachine['id'], $myJobs[0]['id'])) {
            echo 'Job Assigned Successfully!';
        } else {
            echo 'Unknown error occured.';
        }
    } else {
        echo 'Items missing or Machine not assigned to Super staff yet.';
    }
}

?>

<div><a href="../index">Go Home</a></div>