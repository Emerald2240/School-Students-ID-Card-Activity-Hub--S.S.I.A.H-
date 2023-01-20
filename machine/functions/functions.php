<?php
session_start();
$db_handle = new DBController();


function performJobAssignedToMachine($machineId, $cardId)
{
    $machineInfo = getMachineInfoWithMachineId($machineId);
    if (!$machineInfo) {
        return false;
    }
    echo 'Machine found<br>';
    $jobId = $machineInfo['active_job_id'];
    $jobInfo = getJobFromId($jobId);
    if (!$jobInfo) {
        return false;
    }
    echo 'Job found<br>';
    $jobTaskInfo = getTaskFromId($jobInfo['task_id']);
    if (!$jobTaskInfo) {
        return false;
    }
    $taskName = $jobTaskInfo['name'];
    echo 'Task found: ' . $taskName . '<br>';


    switch ($taskName) {
        case 'School Fees':
            return checkSchoolFees($cardId, $jobId);
            break;
        case 'Departmental Fees':
            return checkDepartmentalFees($cardId, $jobId);
            break;
        case 'Faculty Fees':
            return checkFacultyFees($cardId, $jobId);
            break;
        case 'Attendance':
            return signAttendance($cardId, $jobId);
            break;
        case 'Card Assignment':
            return createWaitingCardId($machineId, $cardId);
            break;
        default:
            break;
    }
}

function checkSchoolFees($cardId, $jobId)
{
    $student = getStudentFromCardId($cardId);
    if (!$student) {
        return false;
    } else {
        global $db_handle;

        $result = $db_handle->selectAllWhere('school_fees', 'student_id', $student['id']);
        if (isset($result)) {
            createJobEntry($jobId, $student['id'], true);
            return true;
        } else {
            createJobEntry($jobId, $student['id'], false);
            return false;
        }
    }
}

function checkDepartmentalFees($cardId, $jobId)
{

    $student = getStudentFromCardId($cardId);
    if (!$student) {
        return false;
    } else {
        global $db_handle;

        $result = $db_handle->selectAllWhere('departmental_fees', 'student_id', $student['id']);
        if (isset($result)) {
            createJobEntry($jobId, $student['id'], true);
            return true;
        } else {
            createJobEntry($jobId, $student['id'], false);
            return false;
        }
    }
}

function checkFacultyFees($cardId, $jobId)
{

    $student = getStudentFromCardId($cardId);
    if (!$student) {
        return false;
    } else {
        global $db_handle;

        $result = $db_handle->selectAllWhere('faculty_fees', 'student_id', $student['id']);
        if (isset($result)) {
            createJobEntry($jobId, $student['id'], true);
            return true;
        } else {
            createJobEntry($jobId, $student['id'], false);
            return false;
        }
    }
}

function signAttendance($cardId, $jobId)
{

    $student = getStudentFromCardId($cardId);
    if (!$student) {
        return false;
    } else {
        return createJobEntry($jobId, $student['id'], true);
    }
}

function createWaitingCardId($machineId, $cardId)
{
    $myfile = fopen("../super/" . $machineId . 'Waiting.txt', "w") or die(false);
    $txt = $cardId;
    fwrite($myfile, $txt);
    fclose($myfile);
    return true;
    // die;
}

function getStudentFromCardId($cardId)
{
    global $db_handle;

    $result = $db_handle->selectAllWhere('students', 'card_id', $cardId);
    if (isset($result)) {
        return $result[0];
    } else {
        return false;
    }
}

function createJobEntry($jobId, $studentId, $response)
{
    global $db_handle;
    $response = convertTrueOrFalseToZeroAndOne($response);

    if (!hasJobEntryBeenCreatedBefore($jobId, $studentId, $response)) {


        $query = "INSERT INTO `job_entries` (
    `job_id`,
    `student_id`,
    `response`
         ) VALUES (
    $jobId, 
    $studentId,
    $response
         )";
        return $db_handle->runQueryWithoutResponse($query);
    } else {
        return true;
    }
}

function convertTrueOrFalseToZeroAndOne($boolVal)
{
    if ($boolVal) {
        return 1;
    }
    return 0;
}

function getMachineInfoWithMachineId($machineId)
{
    global $db_handle;

    $result = $db_handle->selectAllWhere('machines', 'machine_id', $machineId);
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

function hasJobEntryBeenCreatedBefore($jobId, $studentId, $response)
{
    global $db_handle;

    $result = $db_handle->selectAllWhereWith3Conditions('job_entries', 'job_id', $jobId, 'student_id', $studentId, 'response', $response);
    if (isset($result)) {
        return true;
    } else {
        return false;
    }
}
