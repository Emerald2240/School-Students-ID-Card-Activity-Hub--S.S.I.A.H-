<?php
session_start();
$db_handle = new DBController();

// $first_name = 'Leonardo';
// $last_name = 'super';
// $id = 1;
// $postemail = 'orjimichael4886@gmail.com';
// $authority = 'ultimate';
// $phone = '08148863871';

// $_SESSION['user_name'] = ucwords(strtolower($first_name)) . " " . ucwords(strtolower($last_name));
// $_SESSION['first_name'] = $first_name;
// $_SESSION['last_name'] = $last_name;
// $_SESSION['full_name'] = $first_name . ' ' . $last_name;
// $_SESSION['sadmin_id'] = $id;
// $_SESSION['sadmin_email'] = $postemail;
// $_SESSION['sadmin_authority'] = $authority;
// $_SESSION['phone'] = $phone;

// $_SESSION['ultra_log'] = true;

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
 * If set to 'lower' it automatically formats the results to lowercase, if set to 'none' it is left as it is.
 * @return string
 * Returns cleansed string.
 */
function sanitize($data, $case = null)
{
  $result = htmlentities($data, ENT_QUOTES);
  if ($case == 'lower') {
    $result = strtolower($result);
  } elseif ($case == 'none') {
    //leave it as it is
  } elseif ($case == 'clean') {
    $result = ucwords(strtolower($result));
  } else {
    $result = strtoupper($result);
  }
  return $result;
}

function gotoPage($location)
{
  header('location:' . $location);
  exit();
}

function createNewCourse($course_name, $course_code, $departmentId)
{
  global $db_handle;

  $course_name = sanitize($course_name, 'clean');
  $course_code = sanitize($course_code);

  // $password = sha1($password);
  //$departmentId = getDepartmentID(sanitize($department));



  $query = "INSERT INTO `courses` (
  `course_name`,
  `course_code`,
  `department_id`
  ) VALUES (
    '$course_name',
    '$course_code',
    $departmentId
    );";
  return $db_handle->runQueryWithoutResponse($query);
}

function createNewDepartment($department_name, $department_code)
{
  global $db_handle;

  $department_name = sanitize($department_name);
  $department_code = sanitize($department_code);

  // $password = sha1($password);
  //$departmentId = getDepartmentID(sanitize($department));



  $query = "INSERT INTO `departments` (
  `department_name`,
  `department_code`
  ) VALUES (
    '$department_name',
    '$department_code'
        );";
  return $db_handle->runQueryWithoutResponse($query);
}

function createStaff($firstName, $lastName, $gender, $email, $staffId, $departmentId)
{
  global $db_handle;

  $firstName = sanitize($firstName, 'clean');
  $lastName = sanitize($lastName, 'clean');
  $email = sanitize($email);
  $gender = sanitize($gender);
  $staffId = sanitize($staffId);
  //$departmentId = getDepartmentID(sanitize($department));

  $query = "INSERT INTO `staff` (
  `first_name`,
  `last_name`,	
  `gender`,
  `email`,
  `staff_id_number`,	
  `department_id`) VALUES (
    '$firstName',
    '$lastName',
    '$gender',
    '$email',
    '$staffId',
    $departmentId
    );";
  return $db_handle->runQueryWithoutResponse($query);
}

function createStudent($firstName, $lastName, $gender, $email, $regNumber, $departmentId)
{
  global $db_handle;

  $firstName = sanitize($firstName, 'clean');
  $lastName = sanitize($lastName, 'clean');
  $email = sanitize($email);
  $gender = sanitize($gender);
  $regNumber = sanitize($regNumber);
  //$departmentId = getDepartmentID(sanitize($department));

  $query = "INSERT INTO `students` (
  `first_name`,
  `last_name`,	
  `gender`,
  `email`,
  `reg_no`,	
  `department_id`) VALUES (
    '$firstName',
    '$lastName',
    '$gender',
    '$email',
    '$regNumber',
    $departmentId
    );";
  return $db_handle->runQueryWithoutResponse($query);
}

function createMachine($machineName, $mark, $machineId)
{
  global $db_handle;

  $machineName = sanitize($machineName, 'clean');
  $mark = sanitize($mark, 'clean');
  $machineId = sanitize($machineId, 'clean');

  $query = "INSERT INTO `machines` (
  `name`,
  `mark`,	
  `machine_id`) VALUES (
    '$machineName',
    '$mark',
    '$machineId'
    );";
  return $db_handle->runQueryWithoutResponse($query);
}

function assignCourseToLecturer($lecturerId, $courseId)
{
  global $db_handle;

  $lecturerInfo = getLecturerInfoWithId($lecturerId);
  $lecturerCoursesHandling = $lecturerInfo['course_handling'];
  $newCourseJsonified = ["course_id" => $courseId];
  $lecturerCoursesHandling = json_decode($lecturerCoursesHandling, true);

  foreach ($lecturerCoursesHandling as $course) {
    if ($course['course_id'] == $courseId) {
      return true;
    }
  }



  array_push($lecturerCoursesHandling, $newCourseJsonified);
  $lecturerCoursesHandling = json_encode($lecturerCoursesHandling);


  $query = "UPDATE `lecturers` SET 
  `course_handling` = '$lecturerCoursesHandling'
   WHERE `lecturers`.`id` = $lecturerId";

  if ($db_handle->runQueryWithoutResponse($query)) {
    //createLog('Success', 'updateCourseSession');
    return true;
  } else {
    //createLog('Failed', 'updateCourseSession');
    return false;
  }
}

function assignMachineToStaff($staffId, $machineId)
{
  global $db_handle;

  $query = "UPDATE `machines` SET 
  `owner_id` = $staffId
   WHERE `machines`.`id` = $machineId";

  if ($db_handle->runQueryWithoutResponse($query)) {
    //createLog('Success', 'updateCourseSession');
    return true;
  } else {
    //createLog('Failed', 'updateCourseSession');
    return false;
  }
}

function assignCardToStudent($studentId, $cardId)
{
  global $db_handle;

  $query = "UPDATE `students` SET 
  `card_id` = '$cardId'
   WHERE `students`.`id` = $studentId";

  if ($db_handle->runQueryWithoutResponse($query)) {
    //createLog('Success', 'updateCourseSession');
    $superMachine = getSuperMachineInfo();
    cleanWaitingCardIdFile($superMachine['machine_id'], true);
    return true;
  } else {
    //createLog('Failed', 'updateCourseSession');
    return false;
  }
}

function getSuperMachineInfo()
{
  $nullStaff = getStaffInfoWithEmail('superstaff@mail.com');
  return getStaffsMachine($nullStaff['id']);
}

function getLecturerId($lecturerName)
{
  $lecturerName = sanitize($lecturerName, 'clean');
  //echo ($lecturerName);
  global $db_handle;
  $fullName = explode(' ', $lecturerName);
  //print_r($fullName);
  foreach ($fullName as $name) {
    $result = $db_handle->selectAllWhere('lecturers', 'first_name', $name);
    if (isset($result)) {
      //createLog('Success', 'getLecturerId');
      return $result[0]['id'];
    } else {
      $result2 = $db_handle->selectAllWhere('lecturers', 'last_name', $name);
      if (isset($result2)) {
        //createLog('Success on new try', 'getLecturerId');
        return $result2[0]['id'];
      }
    }
  }
  //createLog('Failed', 'getLecturerId');
  return false;
}

function getLecturerInfoWithId($id)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('lecturers', 'id', $id);
  if (isset($result)) {
    // //createLog('Success', 'getLecturerName');
    return $result[0];
  } else {
    // //createLog('Failed', 'getLecturerName');
    return false;
  }
}

function getLecturerInfoWithEmail($email)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('lecturers', 'email', $email);
  if (isset($result)) {
    // //createLog('Success', 'getLecturerName');
    return $result[0];
  } else {
    // //createLog('Failed', 'getLecturerName');
    return false;
  }
}

function getStaffInfoWithEmail($email)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('staff', 'email', $email);
  if (isset($result)) {
    // //createLog('Success', 'getLecturerName');
    return $result[0];
  } else {
    // //createLog('Failed', 'getLecturerName');
    return false;
  }
}

function getStudentInfoWithEmail($email)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('students', 'email', $email);
  if (isset($result)) {
    // //createLog('Success', 'getLecturerName');
    return $result[0];
  } else {
    // //createLog('Failed', 'getLecturerName');
    return false;
  }
}

function getDepartmentId($departmentName)
{

  global $db_handle;

  $result = $db_handle->selectAllWhere('departments', 'department_name', $departmentName);
  if (isset($result)) {
    return $result[0]['id'];
  } else {
    return false;
  }
}

function getCourseInfoWithId($id)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('courses', 'course_name', $id);
  if (isset($result)) {
    return $result[0];
  } else {
    return false;
  }
}

function getCourseInfoWithName($course_name)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('courses', 'course_name', $course_name);
  if (isset($result)) {
    return $result[0];
  } else {
    return false;
  }
}

function getMachineInfoWithName($machine_name)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('machines', 'machine_id', $machine_name);
  if (isset($result)) {
    return $result[0];
  } else {
    return false;
  }
}

function readWaitingCardPerMachineFile($machineId, $cardId)
{
  $fileContent = "";
  if (isset($machineId) && isset($cardId)) {
    $myfile = fopen($machineId . 'Waiting.txt', "r") or die("0");
    $fileContent = fread($myfile, filesize($machineId . 'waiting.txt'));
    fclose($myfile);

    return $fileContent;
  }

  return false;
}

function assignSuperJobToMachine($machineId, $jobId)
{
  global $db_handle;

  $query = "UPDATE `machines` SET 
  `active_job_id` = $jobId
   WHERE `machines`.`id` = $machineId";

  if ($db_handle->runQueryWithoutResponse($query)) {
    //createLog('Success', 'updateCourseSession');
    return true;
  } else {
    //createLog('Failed', 'updateCourseSession');
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



function getWaitingCardId($machineName)
{
  $fileContent = "";
  if (file_exists($machineName . 'Waiting.txt')) {
    $myfile = fopen($machineName . 'Waiting.txt', "r");
    $fileContent = fread($myfile, filesize($machineName . 'Waiting.txt'));
    fclose($myfile);
  } else {
    return false;
  }

  return $fileContent;
}

function cleanWaitingCardIdFile($machine_name, $insideFunctionsFolder = null)
{
  if (isset($insideFunctionsFolder)) {
    $myfile = fopen("../" . $machine_name . 'Waiting.txt', "w");
  } else {
    $myfile = fopen($machine_name . 'Waiting.txt', "w");
  }
  $txt = '#';
  fwrite($myfile, $txt);
  fclose($myfile);
  return true;
}

function getValidWaitingCardId($machineName)
{
  $currentWaitingId = getWaitingCardId($machineName);

  if ($currentWaitingId != '#') {
    if (!hasCardBeenUsed($currentWaitingId)) {
      return $currentWaitingId;
    } else {
      return false;
    }
  } else {
    return false;
  }
}

function hasCardBeenUsed($cardId)
{
  global $db_handle;
  $result = $db_handle->selectAllWhere('students', 'card_id', $cardId);
  if (isset($result)) {
    return true;
  } else {
    return false;
  }
}


function validateEmail($email)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('students', 'email', $email);

  return isset($result) && count($result) > 0;
}

function validateStaffEmail($email)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('staff', 'email', $email);

  return isset($result) && count($result) > 0;
}

function validateSuperAdminEmail($email)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('super_admins', 'email', $email);

  return isset($result) && count($result) > 0;
}

function validateStudentRegNumber($reg)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('students', 'reg_no', $reg);

  return isset($result) && count($result) > 0;
}

function doesMachineIdExist($machineId)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('machines', 'machine_id', $machineId);

  return isset($result) && count($result) > 0;
}
