<?php
session_start();
$db_handle = new DBController();


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

function gotoPage($location)
{
  header('location:' . $location);
  exit();
}


function showSweetAlert($type, $id = null)
{
  switch ($type) {
    case 'success':
      echo '<script>swal({
                //title: "New Course",
                title: "Successful",
                icon: "success",
                button: "Got It!",
              });</script>';
      break;

    case 'course_save_success':
      echo '<script>
            swal({
                //title: "New Course",
                title: "Successful",
                icon: "success",
                button: "Got It!",
            });
        </script>';
      break;

    case 'client_paid_admin_success':
      echo '<script>swal({
                        //title: "Edit Course",
                        title: "Client Payment Confirmed",
                        icon: "success",
                        button: "Got It!",
                      });</script>';
      break;

    case 'course_delete_success':
      echo '<script>swal({
                        //title: "Delete Course",
                        title: "Course Deleted Succesfully",
                        icon: "success",
                        button: "Got It!",
                      });</script>';
      break;

    case 'failure':
      echo '<script>swal({
                title: "Error",
                //title: "Payment confirmation failed",
                icon: "error",
                button: "Got It!",
              });</script>';
      break;

    case 'failure__argument_not_set':
      echo '<script>swal({
                    title: "Error!",
                    text: "Missing compulsory argument",
                    //title: "",
                    icon: "error",
                    button: "Got It!",
                  });</script>';
      break;

    case 'warning':
      break;

    case 'info':
      break;

    case 'advanced':
      echo '<script>swal({
                        text: `Search for a movie. e.g. "La La Land".`,
                        content: "input",
                        button: {
                          text: "Search!",
                          closeModal: false,
                        },
                      })
                      .then(name => {
                        if (!name) throw null;
                       
                        return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
                      })
                      .then(results => {
                        return results.json();
                      })
                      .then(json => {
                        const movie = json.results[0];
                       
                        if (!movie) {
                          return swal("No movie was found!");
                        }
                       
                        const name = movie.trackName;
                        const imageURL = movie.artworkUrl100;
                       
                        swal({
                          title: "Top result:",
                          text: name,
                          icon: imageURL,
                        });
                      })
                      .catch(err => {
                        if (err) {
                          swal("Oh noes!", "The AJAX request failed!", "error");
                        } else {
                          swal.stopLoading();
                          swal.close();
                        }
                      });</script>';
      break;

    case 'getTrueOnButtonClicked':
      echo '<script>swal("Click on either the button or outside the modal.")
            .then((value) => {
              swal(`The returned value is: ${value}`);
            });</script>';

    case 'warnBeforePerformingAction':
      echo '<script>swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                  icon: "success",
                });
              } else {
                swal("Your imaginary file is safe!");
              }
            });</script>';



    default:
      break;
  }
}

function updateCourseSession($resultId, $lecturerId, $courseId, $courseCredits, $studentSet, $semester, $hasPractical, $practicalLecturerId)
{
  global $db_handle;

  $courseCredits = sanitize($courseCredits, 'clean');
  if ($practicalLecturerId == 'null') {
    $practicalLecturerId = $lecturerId;
  }


  $query = "UPDATE `results` SET 
  `course_credits` = $courseCredits,
  `set_year` = '$studentSet',
  `semester` = $semester,	
  `has_practical` = $hasPractical,
  `practical_lecturer_id` = $practicalLecturerId
   WHERE `results`.`id` = $resultId";

  if ($db_handle->runQueryWithoutResponse($query)) {
    //createLog('Success', 'updateCourseSession');
    return true;
  } else {
    //createLog('Failed', 'updateCourseSession');
    return false;
  }
}

function showAlertForOperationDoneOnOtherPage()
{
  //showSweetAlert('success');
  if (isset($_SESSION['alert'])) {
    showSweetAlert($_SESSION['alert']);
    $_SESSION['alert'] = null;
  }
}

function validateEmail($email)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('students', 'email', $email);

  return isset($result) && count($result) > 0;
}

function validateLecturerEmail($email)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('lecturers', 'email', $email);

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

function confirmUserEmailAndPassword($postemail, $postpassword, $rememberMe)
{
  global $db_handle;
  //$response = [];
  //students first
  $result = $db_handle->selectAllWhereWith2Conditions('students', 'email', $postemail, 'password', sha1($postpassword));
  if (isset($result) && count($result) > 0) {
    foreach ($result as $row) {
      extract($row);
      $_SESSION['user_name'] = ucwords(strtolower($first_name)) . " " . ucwords(strtolower($last_name));
      $_SESSION['first_name'] = $first_name;
      $_SESSION['last_name'] = $last_name;
      $_SESSION['full_name'] = $first_name . ' ' . $last_name;
      $_SESSION['student_id'] = $id;
      $_SESSION['student_email'] = $postemail;
      $_SESSION['student_set'] = $set_year;
      $_SESSION['phone'] = $phone;
      $_SESSION['student_reg'] = $row['reg_no'];

      $_SESSION['log'] = true;

      // //This is the line of code for saving cookies AKA remember me

      // if (isset($remember)) {
      if ($rememberMe == true) {
        //Creates a cookie named "user" with the value "John Doe". The cookie will expire after 30 days (86400 * 30). The "/" means that the cookie is available in entire website (otherwise, select the directory you prefer).

        //setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('client_mail', $postemail, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('client_password', $postpassword, time() + (86400 * 30), "/"); // 86400 = 1 day

      } else {
        if (isset($_COOKIE['mem_log'])) {
          setcookie('mem_log', '');
        }
        setcookie("client_mail",  $_SESSION['user_email'], time() + (10 * 365 * 24 * 60 * 60));
        setcookie("client_pass", '', time() + (10 * 365 * 24 * 60 * 60));
      }
    }
    return $result;
  } else {
    //lecturers next
    $result = $db_handle->selectAllWhereWith2Conditions('lecturers', 'email', $postemail, 'password', sha1($postpassword));
    if (isset($result) && count($result) > 0) {
      foreach ($result as $row) {
        extract($row);
        $_SESSION['user_name'] = ucwords(strtolower($first_name)) . " " . ucwords(strtolower($last_name));
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['full_name'] = $first_name . ' ' . $last_name;
        $_SESSION['lecturer_id'] = $id;
        $_SESSION['lecturer_email'] = $postemail;
        $_SESSION['lecturer_title'] = $title;
        $_SESSION['phone'] = $phone;

        $_SESSION['super_log'] = true;

        // //This is the line of code for saving cookies AKA remember me

        // if (isset($remember)) {
        if ($rememberMe == true) {
          //Creates a cookie named "user" with the value "John Doe". The cookie will expire after 30 days (86400 * 30). The "/" means that the cookie is available in entire website (otherwise, select the directory you prefer).

          //setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
          setcookie('client_mail', $postemail, time() + (86400 * 30), "/"); // 86400 = 1 day
          setcookie('client_password', $postpassword, time() + (86400 * 30), "/"); // 86400 = 1 day

        } else {
          if (isset($_COOKIE['mem_log'])) {
            setcookie('mem_log', '');
          }
          setcookie("client_mail",  $_SESSION['user_email'], time() + (10 * 365 * 24 * 60 * 60));
          setcookie("client_pass", '', time() + (10 * 365 * 24 * 60 * 60));
        }
      }
      return $result;
    } else {
      //superAdmins last
      $result = $db_handle->selectAllWhereWith2Conditions('super_admins', 'email', $postemail, 'password', sha1($postpassword));
      if (isset($result) && count($result) > 0) {
        foreach ($result as $row) {
          extract($row);
          $_SESSION['user_name'] = ucwords(strtolower($first_name)) . " " . ucwords(strtolower($last_name));
          $_SESSION['first_name'] = $first_name;
          $_SESSION['last_name'] = $last_name;
          $_SESSION['full_name'] = $first_name . ' ' . $last_name;
          $_SESSION['sadmin_id'] = $id;
          $_SESSION['sadmin_email'] = $postemail;
          $_SESSION['sadmin_authority'] = $authority;
          $_SESSION['phone'] = $phone;

          $_SESSION['ultra_log'] = true;

          // //This is the line of code for saving cookies AKA remember me

          // if (isset($remember)) {
          if ($rememberMe == true) {
            //Creates a cookie named "user" with the value "John Doe". The cookie will expire after 30 days (86400 * 30). The "/" means that the cookie is available in entire website (otherwise, select the directory you prefer).

            //setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie('client_mail', $postemail, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie('client_password', $postpassword, time() + (86400 * 30), "/"); // 86400 = 1 day

          } else {
            if (isset($_COOKIE['mem_log'])) {
              setcookie('mem_log', '');
            }
            setcookie("client_mail",  $_SESSION['user_email'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("client_pass", '', time() + (10 * 365 * 24 * 60 * 60));
          }
        }
        return $result;
      } else {
        return ([['error' => 'Wrong Password']]);
        //return false;
      }
      //return false;
    }
    //return false;
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

function createNewStudent($firstName, $lastName, $gender, $email, $phone, $reg, $departmentId, $password)
{
  global $db_handle;

  $firstName = sanitize($firstName, 'clean');
  $lastName = sanitize($lastName, 'clean');
  $email = sanitize($email);
  $gender = sanitize($gender);
  $phone = sanitize($phone);
  $reg = sanitize($reg);
  //$departmentId = getDepartmentID(sanitize($department));
  $password = sha1($password);


  $query = "INSERT INTO `students` (
  `first_name`,
  `last_name`,	
  `gender`,
  `email`,
  `reg_no`,	
  `phone`,
  `department_id`,	
  `password`) VALUES (
    '$firstName',
    '$lastName',
    '$gender',
    '$email',
    '$reg',
    '$phone',
    $departmentId,
    '$password');";
  return $db_handle->runQueryWithoutResponse($query);
}

function getCoursesTakenByStudent($regNo)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('students', 'reg_no', $regNo);

  if (isset($result)) {
    $coursesTaken = json_decode($result[0]['courses_taken'], true);
    sort($coursesTaken,);

    return $coursesTaken;
  } else {
    return false;
  }
}

function getStudentLevel($regNo)
{
  $years = 0;
  $coursesTaken = getCoursesTakenByStudent($regNo);

  // foreach ($coursesTaken as $course) {
  //   if ($course['course_level'] > $course) {
  //     $years++;
  //   }
  // }

  for ($i = 0; $i < count($coursesTaken); $i++) {
    if ($coursesTaken[$i]['course_level'] > $years) {
      $years = $coursesTaken[$i]['course_level'];
    }
  }

  return $years;
}

function countCoursesPerYear($coursesTaken, $year)
{
  $count = 0;
  foreach ($coursesTaken as $courseTaken) {
    $courseSessionInfo = getCourseSessionInfo($courseTaken['course_id'], $courseTaken['course_credits']);
    if (!empty($courseSessionInfo)) {
      if ($courseSessionInfo['year'] == $year) {
        $count++;
      }
    }
  }
  return $count;
}

function getCalenderYearPerLevel($coursesTaken, $level)
{
  for ($i = 0; $i < count($coursesTaken); $i++) {
    if ($coursesTaken[$i]['course_level'] == $level) {
      return $coursesTaken[$i]['year_taken'];
    }
  }
}

function getResultsPerCourseTaken($courseTaken, $semester, $year)
{
  //echo $i;
  //echo 1;
  global $db_handle;
  //$response = [];
  if (isset($courseTaken)) {
    $result = $db_handle->selectAllWhereWith4Conditions('results', 'course_id', $courseTaken['course_id'], 'course_credits', $courseTaken['course_credits'], 'year', $year, 'semester', $semester);

    //selectAllWhere('students', 'reg_no', $regNo);
    //echo 2;

    if (isset($result)) {
      // echo 3;
      $courseResultsFull = $result;
      return $courseResultsFull[0];
    } else {
      $result = $db_handle->selectAllWhereWith3Conditions('results', 'course_id', $courseTaken['course_id'], 'year', $year, 'semester', $semester);

      //selectAllWhere('students', 'reg_no', $regNo);
      //echo 2;

      if (isset($result)) {
        // echo 3;
        $courseResultsFull = $result;
        return $courseResultsFull[0];
      } else {
        //echo 4;
        return false;
        //return '<br>No result found for this course';
      }
    }
  }
}

function getCourseInfo($id)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('courses', 'id', $id);
  if (isset($result)) {
    return $result[0];
  } else {
    return false;
  }
}

function getPersonalResult($results, $regNo)
{
  $resultsObj = json_decode($results, true);
  //$resultsObj = $results;

  foreach ($resultsObj as $result) {
    if ($result['reg_num'] == $regNo) {
      return $result;
    }
  }
  return false;
}

function returnGrade($score)
{
  switch ($score) {
    case ($score < 40):
      return 'F';

    case ($score >= 40 && $score < 50):
      return 'D';

    case ($score >= 50 && $score < 60):
      return 'C';

    case ($score >= 60 && $score < 70):
      return 'B';

    case ($score >= 70):
      return 'A';

    default:
      return 'X';
  }
}






///////////////////////////////////////////////////////////////////////// Borrowed From Admin ///////////////////////////////////////////////////////////////////////////////////////

function calculateStudentLevel($set)
{
  $set = explode('/', $set);
  $year = date('Y');
  $level = 0;
  if (isset($set[0])) {
    $level = ($year - $set[0]);
  }
  createLog('Success', 'calculateStudentLevel');
  if ($level < 1) {
    return 1;
  }
  return ($level);
}

function createLog($title, $description)
{
  global $db_handle;

  $title = sanitize($title, 'clean');
  $description = sanitize($description, 'none');

  $query = "INSERT INTO `log` (
    `log_title`,
    `log_description`
         ) VALUES (
    '$title', 
    '$description'
         )";
  return $db_handle->runQueryWithoutResponse($query);
}

function getCourseSessionInfo($courseId, $credits)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhereWith2Conditions('results', 'course_id', $courseId, 'course_credits', $credits);

  if (isset($result)) {
    return $result[0];
  } else {
    return false;
  }
}

function compileIncourse($incourseArray)
{
  $scoretotal = 0;
  $absoluteTotal = 0;
  if (isset($incourseArray)) {
    foreach ($incourseArray as $incourse) {
      $absoluteTotal += $incourse['total'];
      $scoretotal += $incourse['score'];
    }
  } else {
    return 0;
  }

  return ceil(30 * ((($scoretotal / $absoluteTotal) * 100) / 100));
}

function compileExam($examArray)
{
  $scoretotal = 0;
  $absoluteTotal = 0;
  if (isset($examArray)) {
    foreach ($examArray as $exam) {
      $absoluteTotal += $exam['total'];
      $scoretotal += $exam['score'];
    }
  } else {
    return 0;
  }

  return ceil(70 * ((($scoretotal / $absoluteTotal) * 100) / 100));
}
