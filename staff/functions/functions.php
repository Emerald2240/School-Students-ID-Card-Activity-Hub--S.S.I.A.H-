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

/**
 * Removes unwanted and harmful characters
 * 
 * Takes in a string cleanses and formats it, then returns a clean copy.
 * 
 * @param string $data
 * Any data or variable that may contain characters that needs cleansing.
 * @param string $case
 * [optional]
 * 
 * If set to 'lower' it automatically formats the results to lowercase, if set to 'none' it is left as it is, if set to 'clean' it formats the results to uppercase.
 * @return string
 * Returns cleansed string.
 */
function sanitize($data, $case = null)
{
    $result = htmlentities($data, ENT_QUOTES);
    if ($case == 'lower') {
        $result = strtoupper($result);
    } elseif ($case == 'none') {
        //leave it as it is
    } elseif ($case == 'clean') {
        $result = ucwords(strtolower($result));
    } else {
        $result = strtoupper($result);
    }
    return $result;
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

function getActiveJobForStaff($staffId)
{
    $myMachine = getStaffsMachine($staffId);
    if ($myMachine) {
        return $myMachine['active_job_id'];
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

function getStudentFromId($studentId)
{
    global $db_handle;

    $result = $db_handle->selectAllWhere('studentss', 'id', $studentId);
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

function formatDateFriendlierForJsChart($date, $format = null)
{
    if (isset($format)) {
        return date($format, strtotime($date));
    }
    return date('m', strtotime($date)) . '/' . date('d', strtotime($date)) . '/' . date('Y', strtotime($date));
    // return date('m', strtotime($date));
}

function formatDateFriendlierForJsChartByMonth($date, $format = null)
{
    if (isset($format)) {
        return date($format, strtotime($date));
    }
    // return date('m', strtotime($date)) . '/' . date('d', strtotime($date)) . '/' . date('Y', strtotime($date));
    return date('M', strtotime($date));
}

function formatDateHourAndMinute($date, $format = null)
{
    if (isset($format)) {
        return date($format, strtotime($date));
    }
    return date('H', strtotime($date)) . ':' . date('i', strtotime($date)); //. ':' . date('s', strtotime($date));
}

function shortenText($text, $length)
{
    if ((strlen($text) - $length) >= 3) {
        return substr($text, 0, $length) . '...';
    } else {
        return $text;
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

function createNewJob($title, $taskId, $staffId)
{
    global $db_handle;

    $title = sanitize($title, 'clean');

    $query = "INSERT INTO `jobs` (
    `name`,
    `task_id`,
    `staff_id`
         ) VALUES (
    '$title', 
    $taskId,
    $staffId
         )";
    return $db_handle->runQueryWithoutResponse($query);
}

function deleteJob($jobId)
{
    global $db_handle;
    //$response = [];
    $result = $db_handle->deleteSingleColumnWhere1Condition('jobs', 'id', $jobId);

    if (isset($result)) {
        return ($result);
    } else {
        return false;
    }
}

function activateJob($jobId, $machineId)
{
    global $db_handle;
    //$response = [];
    $result = $db_handle->updateSingleColumnWhere1Condition('machines', 'active_job_id', $jobId, 'id', $machineId);

    if (isset($result)) {
        return ($result);
    } else {
        return false;
    }
}

function updateJob($jobId, $jobTitle, $jobTaskId)
{
    global $db_handle;
    //$response = [];
    $query = "UPDATE `jobs` SET 
    `name` = '$jobTitle',
    `task_id` = $jobTaskId
     WHERE `jobs`.`id` = $jobId";

    if ($db_handle->runQueryWithoutResponse($query)) {
        return true;
    } else {
        return false;
    }
}

function getAllJobEntriesForJobId($jobId)
{
    global $db_handle;

    $result = $db_handle->selectAllWhere('job_entries', 'job_id', $jobId);
    if (isset($result)) {
        return $result;
    } else {
        return false;
    }
}

function getAllStudentsScannedPerJobId($jobId)
{
    $allJobEntries = getAllJobEntriesForJobId($jobId);
    $allStudents = [];

    foreach ($allJobEntries as $jobEntry) {
        if (!array_search($jobEntry['student_id'], $allStudents)) {
            array_push($allStudents, $jobEntry['student_id']);
        }
    }

    return $allStudents;
}

/**
 * Gets a particular jobs entries and for each day it has been used
 * 
 * @param string $jobId
 * The job whose entries are being looked for
 * @param string $case
 * [optional]
 * 
 * @return array
 * Returns a multi dimensional array. 0 for the days; 1 for the number entries for each day.
 */
function divideJobEntriesIntoCountsPerDay($staffId)
{
    $allJobEntries = getAllJobEntriesForJobId($staffId);
    if (isset($allJobEntries)) {

        $jobEntriesPerDay = [];
        $uniqueDatesPerJobEntry = [];
        $combinedValues = [];

        //gets all the unique dates
        foreach ($allJobEntries as $jobEntry) {
            if (!searchArray($uniqueDatesPerJobEntry, formatDateFriendlierForJsChart($jobEntry['date_updated']))) {
                array_push($uniqueDatesPerJobEntry, formatDateFriendlierForJsChart($jobEntry['date_updated']));
            }
        }

        //gets all entries for each of the unique days
        foreach ($uniqueDatesPerJobEntry as $date) {
            $totalEntriesPerDay = 0;
            foreach ($allJobEntries as $jobEntry) {
                if ($date == formatDateFriendlierForJsChart($jobEntry['date_updated'])) {
                    $totalEntriesPerDay++;
                }
            }
            array_push($jobEntriesPerDay, $totalEntriesPerDay);
        }

        array_push($combinedValues, $uniqueDatesPerJobEntry);
        array_push($combinedValues, $jobEntriesPerDay);

        return $combinedValues;
    } else {
        return false;
    }
}

/**
 * Gets a particular jobs entries and for each day it has been used
 * 
 * @param string $jobId
 * The job whose entries are being looked for
 * @param string $case
 * [optional]
 * 
 * @return array
 * Returns a multi dimensional array. 0 for the days; 1 for the number entries for each day.
 */
function divideJobEntriesIntoCountsPerDayForStaff($jobId)
{
    $allJobEntries = getAllJobEntriesForStaff($jobId);
    if (isset($allJobEntries)) {

        $jobEntriesPerDay = [];
        $uniqueDatesPerJobEntry = [];
        $combinedValues = [];

        //gets all the unique dates
        foreach ($allJobEntries as $jobEntry) {
            if (!searchArray($uniqueDatesPerJobEntry, formatDateFriendlierForJsChartByMonth($jobEntry['date_updated']))) {
                array_push($uniqueDatesPerJobEntry, formatDateFriendlierForJsChartByMonth($jobEntry['date_updated']));
            }
        }

        //gets all entries for each of the unique days
        foreach ($uniqueDatesPerJobEntry as $date) {
            $totalEntriesPerDay = 0;
            foreach ($allJobEntries as $jobEntry) {
                if ($date == formatDateFriendlierForJsChartByMonth($jobEntry['date_updated'])) {
                    $totalEntriesPerDay++;
                }
            }
            array_push($jobEntriesPerDay, $totalEntriesPerDay);
        }

        array_push($combinedValues, $uniqueDatesPerJobEntry);
        array_push($combinedValues, $jobEntriesPerDay);

        return $combinedValues;
    } else {
        return false;
    }
}

function divideStaffAttendanceTasksIntoTwelveMonths($staffId)
{
    $attendanceTasks = getAllAttendanceTasksForStaff($staffId);
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    if (isset($attendanceTasks)) {

        $tasksPerMonth = [];

        //gets all the unique dates
        foreach ($months as $month) {
            $count = 0;
            foreach ($attendanceTasks as $task) {
                // echo formatDateFriendlierForJsChartByMonth($task['date_updated']);
                // echo '<br>';
                if ($month == formatDateFriendlierForJsChartByMonth($task['date_updated'])) {
                    $count++;
                }
            }
            array_push($tasksPerMonth, $count);
        }
        return $tasksPerMonth;
    } else {
        return false;
    }
}

function divideStaffSchoolFeeTasksIntoTwelveMonths($staffId)
{
    $attendanceTasks = getAllSchoolFeeTasksForStaff($staffId);
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    if (isset($attendanceTasks)) {

        $tasksPerMonth = [];

        //gets all the unique dates
        foreach ($months as $month) {
            $count = 0;
            foreach ($attendanceTasks as $task) {
                // echo formatDateFriendlierForJsChartByMonth($task['date_updated']);
                // echo '<br>';
                if ($month == formatDateFriendlierForJsChartByMonth($task['date_updated'])) {
                    $count++;
                }
            }
            array_push($tasksPerMonth, $count);
        }
        return $tasksPerMonth;
    } else {
        return false;
    }
}

function divideStaffDepartmentalFeeTasksIntoTwelveMonths($staffId)
{
    $attendanceTasks = getAllDepartmentalFeeTasksForStaff($staffId);
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    if (isset($attendanceTasks)) {

        $tasksPerMonth = [];

        //gets all the unique dates
        foreach ($months as $month) {
            $count = 0;
            foreach ($attendanceTasks as $task) {
                // echo formatDateFriendlierForJsChartByMonth($task['date_updated']);
                // echo '<br>';
                if ($month == formatDateFriendlierForJsChartByMonth($task['date_updated'])) {
                    $count++;
                }
            }
            array_push($tasksPerMonth, $count);
        }
        return $tasksPerMonth;
    } else {
        return false;
    }
}

function divideStaffFacultyFeeTasksIntoTwelveMonths($staffId)
{
    $attendanceTasks = getAllFacultyFeeTasksForStaff($staffId);
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    if (isset($attendanceTasks)) {

        $tasksPerMonth = [];

        //gets all the unique dates
        foreach ($months as $month) {
            $count = 0;
            foreach ($attendanceTasks as $task) {
                // echo formatDateFriendlierForJsChartByMonth($task['date_updated']);
                // echo '<br>';
                if ($month == formatDateFriendlierForJsChartByMonth($task['date_updated'])) {
                    $count++;
                }
            }
            array_push($tasksPerMonth, $count);
        }
        return $tasksPerMonth;
    } else {
        return false;
    }
}

function searchArray($array, $needle)
{
    foreach ($array as $value) {
        if ($value == $needle) {
            return true;
        }
    }
    return false;
}

function checkIfActiveMachineJobBelongsToStaff($staffId)
{
    $myMachine = getStaffsMachine($staffId);
    if (!$myMachine) {
        return false;
    }
    $activeJobId = $myMachine['active_job_id'];
    $activeJobInfo = getJobFromId($activeJobId);
    if (!$activeJobInfo) {
        return false;
    }
    return ($activeJobInfo['staff_id'] == $staffId);
}
