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

function formatDateFriendlier($date, $format = null)
{
    if (isset($format)) {
        return date($format, strtotime($date));
    }
    return date('d', strtotime($date)) . '/' . date('M', strtotime($date)) . '/' . date('Y', strtotime($date));
}

function shortenText($text, $length)
{
    if ((strlen($text) - $length) >= 3) {
        return substr($text, 0, $length) . '...';
    } else {
        return substr($text, 0, $length) . '...';
    }
}
