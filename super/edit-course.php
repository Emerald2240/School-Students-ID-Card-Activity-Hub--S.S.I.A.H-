<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!isset($_SESSION['ultra_log'])) {
    gotoPage("../index");
}

// gotoPage('active-courses');
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
        <h1>Edit Course</h1>
        <strong>"The biggest fool is one who cannot learn, even from their own mistakes"<br> ~Orji Michael Chukwuebuka</strong>
    </div>

    <div>
        <form action="functions/editCourse.php" method="POST">
            <div class="p-1 form-control">
                <label>Select Course</label><br>
                <input onkeyup='simpleAsyncSearch("functions/suggestCourse", "course_search_input", "suggestion_list2","assignToLecturerButton")' id="course_search_input" type="text" placeholder="**CEE123  **Computer Engineering in Nigeria" required>
                <ul id="suggestion_list2">
                </ul>
            </div>
            <br>
            <hr>
            <br>
            <div class="p-1 form-control">
                <label>New Full Course Name</label><br>
                <input type="text" placeholder="**Computer Programming In Nigeria" required>
            </div>
            <div class="p-1 form-control">
                <label>New Course Code</label><br>
                <input type="text" placeholder="**CEE123" required>
            </div>
            <div class="p-1 form-control">
                <label>New Course Department</label><br>
                <input onkeyup='simpleAsyncSearch("functions/suggestDept", "department_search_input", "suggestion_list","assignToLecturerButton")' id="department_search_input" type="text" placeholder="**Computer Engineering" required>
                <ul id="suggestion_list">
                </ul>
            </div>

            <input type="submit" disabled id="assignToLecturerButton" value="Create">
        </form>
    </div>

    <!-- JS Includes -->
    <?php 
    require_once('includes/js_includes.php')
    ?>
</body>

</html>