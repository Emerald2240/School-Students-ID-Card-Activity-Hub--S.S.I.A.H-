<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!isset($_SESSION['ultra_log'])) {
    gotoPage("../staff/index");
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
        <h1>Create Course</h1>
        <strong>"And the lord said, let there be light, and there was light"<br> ~Genesis</strong>
    </div>

    <div>
        <form action="functions/createCourse.php" method="POST">
            <div class="p-1 form-control">
                <label>Full Course Name</label><br>
                <input name="course_name" type="text" placeholder="**Computer Programming In Nigeria" required>
            </div>
            <div class="p-1 form-control">
                <label>Course Code</label><br>
                <input name="course_code" type="text" placeholder="**CEE123" required>
            </div>
            <div class="p-1 form-control">
                <label>Course Department</label><br>
                <input name="department_name" onkeyup='simpleAsyncSearch("functions/suggestDept", "department_search_input", "suggestion_list","newCourseButton")' id="department_search_input" type="text" placeholder="**Computer Engineering" required>
                <ul id="suggestion_list">
                </ul>
            </div>

            <input type="submit" disabled id="newCourseButton" value="Create">
        </form>
    </div>

    <!-- JS Includes -->
    <?php 
    require_once('includes/js_includes.php')
    ?>
</body>

</html>