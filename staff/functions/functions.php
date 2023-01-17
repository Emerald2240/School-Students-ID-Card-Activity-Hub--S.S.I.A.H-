<?php
session_start();
$db_handle = new DBController();

$first_name = 'Tester';
$last_name = 'Zero';
$id = 1;
$postemail = 'testerzero@mail.com';
$phone = '08148863871';
$gender = 'Male';
$department = 'Computer Engineering';
$title = 'Programmer';
$staff_id_number = '23434534554';

$_SESSION['user_name'] = ucwords(strtolower($first_name)) . " " . ucwords(strtolower($last_name));
$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['full_name'] = $first_name . ' ' . $last_name;
$_SESSION['staff_id'] = $id;
$_SESSION['staff_email'] = $postemail;
$_SESSION['staff_gender'] = $gender;
$_SESSION['staff_department'] = $department;
$_SESSION['phone'] = $phone;
$_SESSION['staff_title'] = $title;
$_SESSION['staff_id_number'] = $staff_id_number;

$_SESSION['super_log'] = true;
















function gotoPage($location)
{
    header('location:' . $location);
    exit();
}

function getActiveTaskForStaff($staffId)
{
    $myMachine = getStaffsMachine($staffId);
    if ($myMachine) {
        return getJobFromId($myMachine['active_job_id']);
    } else {
        return false;
    }
}

function getStaffsMachine($staffId)
{
    global $db_handle;

    $result = $db_handle->selectAllWhere('machines', 'owner_id', $staffId);
    if (isset($result)) {
        return $result[0];
    } else {
        return false;
    }
}

function getJobFromId($jobId)
{
    global $db_handle;

    $result = $db_handle->selectAllWhere('jobs', 'id', $jobId);
    if (isset($result)) {
        return $result[0];
    } else {
        return false;
    }
}


function getTaskFromId($taskId)
{
    global $db_handle;

    $result = $db_handle->selectAllWhere('tasks', 'id', $taskId);
    if (isset($result)) {
        return $result[0];
    } else {
        return false;
    }
}

function formatDateFriendlier($date, $format = null)
{
    if (isset($format)) {
        return date($format, strtotime($date));
    }
    return date('d', strtotime($date)) . '/' . date('m', strtotime($date)) . '/' . date('Y', strtotime($date));
}


function formatDateHourAndMinute($date, $format = null)
{
    if (isset($format)) {
        return date($format, strtotime($date));
    }
    return date('h', strtotime($date)) . ':' . date('i', strtotime($date)); //. ':' . date('s', strtotime($date));
}

function shortenText($text, $length)
{
    if ((strlen($text) - $length) >= 3) {
        return substr($text, 0, $length) . '...';
    } else {
        return substr($text, 0, $length) . '...';
    }
}

function getAllAttendanceTasksForStaff($staffId)
{
    $allJobEntries = getAllJobEntriesForStaff($staffId);
    $allAttendanceTaskJobEntries = [];

    foreach ($allJobEntries as $jobEntry) {
        $job = getJobFromId($jobEntry['job_id']);
        $task = getTaskFromId($job['task_id']);
        if ($task['name'] == 'Attendance') {
            array_push($allAttendanceTaskJobEntries, $jobEntry);
        }
    }

    return $allAttendanceTaskJobEntries;
}

function getAllSchoolFeeTasksForStaff($staffId)
{
    $allJobEntries = getAllJobEntriesForStaff($staffId);
    $allSchoolFeeTaskJobEntries = [];

    foreach ($allJobEntries as $jobEntry) {
        $job = getJobFromId($jobEntry['job_id']);
        $task = getTaskFromId($job['task_id']);
        if ($task['name'] == 'School Fees') {
            array_push($allSchoolFeeTaskJobEntries, $jobEntry);
        }
    }

    return $allSchoolFeeTaskJobEntries;
}

function getAllFacultyFeeTasksForStaff($staffId)
{
    $allJobEntries = getAllJobEntriesForStaff($staffId);
    $allFacultyFeeTaskJobEntries = [];

    foreach ($allJobEntries as $jobEntry) {
        $job = getJobFromId($jobEntry['job_id']);
        $task = getTaskFromId($job['task_id']);
        if ($task['name'] == 'Faculty Fees') {
            array_push($allFacultyFeeTaskJobEntries, $jobEntry);
        }
    }

    return $allFacultyFeeTaskJobEntries;
}

function getAllDepartmentalFeeTasksForStaff($staffId)
{
    $allJobEntries = getAllJobEntriesForStaff($staffId);
    $allDepartmentalFeeTaskJobEntries = [];

    foreach ($allJobEntries as $jobEntry) {
        $job = getJobFromId($jobEntry['job_id']);
        $task = getTaskFromId($job['task_id']);
        if ($task['name'] == 'Departmental Fees') {
            array_push($allDepartmentalFeeTaskJobEntries, $jobEntry);
        }
    }

    return $allDepartmentalFeeTaskJobEntries;
}

function getAllJobsForStaff($staffId)
{
    global $db_handle;
    $result = $db_handle->selectAllWhere('jobs', 'staff_id', $staffId);
    if (isset($result)) {
        return $result;
    } else {
        return false;
    }
}

function getAllJobEntriesForStaff($staffId)
{
    $allJobEntries = [];
    $jobs = getAllJobsForStaff($staffId);

    global $db_handle;

    foreach ($jobs as $job) {
        $result = $db_handle->selectAllWhere('job_entries', 'job_id', $job['id']);
        if (isset($result)) {
            foreach ($result as $jobEntry) {
                array_push($allJobEntries, $jobEntry);
            }
        }
    }
    if (isset($allJobEntries)) {
        return $allJobEntries;
    } else {
        return false;
    }
}

function getAllStudentsScannedPerLecturer($staffId)
{
    $allJobEntries = getAllJobEntriesForStaff($staffId);
    $allStudents = [];

    foreach ($allJobEntries as $jobEntry) {
        if (!array_search($jobEntry['student_id'], $allStudents)) {
            array_push($allStudents, $jobEntry['student_id']);
        }
    }

    return $allStudents;
}

function getStudentInfo($studentId)
{
    global $db_handle;

    $result = $db_handle->selectAllWhere('students', 'id', $studentId);
    if (isset($result)) {
        return $result[0];
    } else {
        return false;
    }
}

function getGenderCount($studentArray, $gender)
{
    $count = 0;

    foreach ($studentArray as $student) {
        $studentInfo = getStudentInfo($student);
        if ($studentInfo['gender'] == $gender) {
            $count++;
        }
    }

    return $count;
}

function getEntryValidity($jobEntries, $validity)
{
    $count = 0;

    foreach ($jobEntries as $entry) {

        if ($entry['response'] == $validity) {
            $count++;
        }
    }

    return $count;
}

function getLatestJobEntryFromStudentForStaff($studentId, $staffId)
{
    global $db_handle;

    $result = $db_handle->selectAllWhere('job_entries', 'student_id', $studentId);
    if (isset($result)) {
        foreach ($result as $jobEntry) {
            $job = getJobFromId($jobEntry['job_id']);
            if ($job['staff_id'] == $staffId)
                return $jobEntry;
        }
    } else {
        return false;
    }
}
