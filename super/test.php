<?php
require_once('config/connect.php');
require_once('functions/functions.php');

// if(createNewCourse('Test Course', 'TCC123', 1)){
//     echo 'Course created successfully';
// }

// if (createNewDepartment('Test Department', 'TDP')) {
//     echo 'Department created successfully';
// }

// if (createLecturer('i', 'ioi', 'Male', 'ie', '234324', 1)) {
//         echo 'Lecturer created successfully';
//     }

// if (assignCourseToLecturer(1, 1)) {
//         echo 'Lecturer assigned successfully';
//     }


// cleanWaitingCardIdFile('letsgo');

// echo getWaitingCardId('letsgo');

$nullStaff = getStaffInfoWithEmail('superstaff@mail.com');
// var_dump($nullStaff);
// echo '<hr>';
$myJobs = getAllJobsForStaff($nullStaff['id']);
// var_dump($myJobs);
// echo '<hr>';
$myMachine = getStaffsMachine($nullStaff['id']);
// var_dump($myMachine);
// gotoPage('active-courses');
$waitingCard = getValidWaitingCardId($myMachine['name']);

if($waitingCard){
    echo $waitingCard;
}else{
    echo 'no valid card found';
}
