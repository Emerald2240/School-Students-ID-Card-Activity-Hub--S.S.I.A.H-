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
        <h1>Assign Machine To Staff</h1>
        <strong>"Perform your task and i shall know you. Perform your task and your genius shall befriend the more."<br> ~Ogwo David Emenike</strong>
    </div>

    <div>
        <form action="functions/assignCourseToLecturer.php" method="POST">
            <div class="p-1 form-control">
                <label>Lecturer</label><br>
                <input name="lecturer_email" onkeyup='simpleAsyncSearch("functions/suggestLecturer", "lecturer_search_input", "suggestion_list1","assignToLecturerButton")' id="lecturer_search_input" type="text" placeholder="**Engr Ozor **Engrozor@gmail.com **32234234" required>
                <ul id="suggestion_list1">
                </ul>
            </div>
            <div class="p-1 form-control">
                <label>Course</label><br>
                <input name="course_name" onkeyup='simpleAsyncSearch("functions/suggestCourse", "course_search_input", "suggestion_list2","assignToLecturerButton")' id="course_search_input" type="text" placeholder="**CEE123  **Computer Engineering in Nigeria" required>
                <ul id="suggestion_list2">
                </ul>
            </div>
            <input type="submit" disabled id="assignToLecturerButton" value="Assign">

        </form>
    </div>

    <!-- JS Includes -->
    <?php
    require_once('includes/js_includes.php')
    ?>
</body>

</html>