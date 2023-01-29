<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!isset($_SESSION['ultra_log'])) {
    gotoPage("../staff/index");
}

$nullStaff = getStaffInfoWithEmail('superstaff@mail.com');
// var_dump($nullStaff);
// echo '<hr>';
$myJobs = getAllJobsForStaff($nullStaff['id']);
// var_dump($myJobs);
// echo '<hr>';
$myMachine = getStaffsMachine($nullStaff['id']);
// var_dump($myMachine);
// gotoPage('active-courses');
if (!$myMachine) {
    die('Machine not assigned to Super Staff. Assign it then come back.');
}

$waitingCard = getValidWaitingCardId($myMachine['machine_id']);
if (!$waitingCard) {
    $waitingCard = '#';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#S##@@U@#@P#**E*@#R$@#!@$#@$%#@ AdMin</title>
    <link rel="stylesheet" href="includes/style.css">
</head>

<body>
    <div class="header">
        <h1>Assign Card To Student</h1>
        <strong>"Perform your task and i shall know you. Perform your task and your genius shall befriend the more."<br> ~Ogwo David Emenike</strong>
    </div>


    <div>
        <form action="functions/assignCardToStudent.php" method="POST">
            <div class="p-1 form-control">
                <label>Student</label><br>
                <input name="student_email" onkeyup='simpleAsyncSearch("functions/suggestStudent", "student_search_input", "suggestion_list1","assignToStudentButton")' id="student_search_input" type="text" placeholder="**Orji Michael **orjimichael4886@gmail.com **32234234" required>
                <ul id="suggestion_list1">
                </ul>
            </div>
            <div class="p-1 form-control">
                <label>Free Card ID</label><br>
                <input name="card_id" value="<?= $waitingCard ?>" readonly type="text" placeholder="**#532fhis2  **fse234fdsfs" required>
                <ul id="suggestion_list2">
                </ul>
            </div>
            <input type="submit" disabled id="assignToStudentButton" value="Assign">

        </form>
    </div>

    <!-- JS Includes -->
    <?php
    require_once('includes/js_includes.php')
    ?>
</body>

</html>